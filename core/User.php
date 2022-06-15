<?php

namespace QF\Core;

use Mailgun\Mailgun;

class User extends Base
{
    public function __construct($table = null)
    {
        ($table) ? $this->table = $table : parent::__construct('users');
    }

    /**
     * Logs in a user
     *
     * @param string $username User supplied username.
     * @param string $password User supplied password.
     * @param bool $remember Keep user logged in after session? Default to false.
     *
     * @throws \QF\Core\Exception\WrongValueException
     */
    public function login($email, $password, $remeber = true)
    {
        $email    = Util::escape(strtolower($email));
        $user     = $this->getByEmail($email);
        $password = trim($password);

        if (!$user) {
            $this->error[] = "Email and password combination is incorrect";
            return false;
        }

        if ($password != $user->password) {
            $this->error[] = "Email and password combination is incorrect";
            return false;
        }

        /*if ($user->is_active != 1) {
            $this->error[] = "Account has not been activated";
            return false;
        }*/

        $sessiondata = $this->addSession($user->id);

        if (!$sessiondata) {
            $this->error[] = 'System error: Unable to login';
            return false;
        }

        $return['message'] = 'Login successful';

        $return['hash'] = $sessiondata['hash'];
        $return['expire'] = $sessiondata['expire'];
        $return['user_id'] = $user->id;

        return $return;
    }

    /**
     * Creates a new user, adds them to database
     *
     * @param string $email
     * @param string $password
     * @param string $repeatpassword
     * @param array  $params
     * @param bool $sendmail = NULL
     *
     * @return bool
     */
    public function register($email, $password, array $params = [], $sendmail = NULL)
    {
        // Validate password
        if (strlen($password) < 8) {
            $this->error[] = "Password must be at least 8 characters long";

            return false;
        }

        // Validate email
        if (!Util::isEmail($email)) {
            $this->error[] = "Email address is invalid";

            return false;
        }

        // Check if email already exists
        if ($this->getByEmail($email)) {
            $this->error[] = "Email is taken";

            return false;
        }

        // Check if phone number already exists
        if ($this->getByPhoneNumber($params['phone'])) {
            $this->error[] = "Phone number is taken";

            return false;
        }

        $ID = $this->addUser($email, $password, $params, $sendmail);


        if (!$ID) {
            $this->error[] = "Unable to register";

            return false;
        }

        $sessiondata = $this->addSession($ID);

        if (!$sessiondata) {
            $this->error[] = 'System error: Unable to login';
            return false;
        }

        $return['message'] = 'Registration successful';

        $return['hash'] = $sessiondata['hash'];
        $return['expire'] = $sessiondata['expire'];

        return $return;
    }

    /**
     * Logs out the session, identified by hash
     *
     * @param string $hash
     *
     * @return bool
     */
    public function logout($hash)
    {
        if (strlen($hash) != 40) {
            return false;
        }

        return $this->deleteSession($hash);
    }

    /**
     * Creates an activation entry and sends email to user
     *
     * @param int $uid
     * @param string $email
     * @param string $type
     * @param boolean $sendmail = NULL
     *
     * @return boolean
    */
    protected function addRequest($user_id, $email, $type, &$sendmail, $firstName)
    {
        global $config;

        if ($type != "activation" && $type != "reset") {
            $this->error[] = "Error: Invalid request";
            return false;
        }

        $query = Database::instance()->query("SELECT id, expire FROM {$config->database_tables->requests} WHERE user_id = ? AND type = ?");
        $query->execute([$user_id, $type]);

        if (Database::instance()->rowCount() > 0) {
            $row = Database::instance()->fetchOne();

            $expiredate = $row->expire;
            $currentdate = time();

            if ($currentdate < $expiredate) {
                $this->error[] = "A request already exists, check your email.";
                return false;
            }

            $this->deleteRequest($row->id);
        }

        if ($type == "activation" && $this->getById($user_id)->is_active == 1) {
            $this->error[] = "Account is already activated.";

            return false;
        }

        $key = Util::getRandomInt(6);
        $expire = $config->site->request_expire;

        $query = Database::instance()->query("INSERT INTO {$config->database_tables->requests} (user_id, request_key, expire, type) VALUES (?, ?, ?, ?)");

        if (!$query->execute(array($user_id, $key, $expire, $type))) {
            $this->error[] = "System Error: Request failed";

            return false;
        }

        $request_id = Database::instance()->lastInsertId();

        if ($sendmail === true) {
            // Check configuration for SMTP parameters
            $mgClient = new Mailgun($config->mail->mailgun_api_key);
            $domain = $config->mail->domain;

            if ($type == "activation") {
                $emailBody = file_get_contents(__DIR__ . '/../emails/email-verify.html');

                $emailBody = str_replace('{user}', $firstName, $emailBody);
                $emailBody = str_replace('{code}', $key, $emailBody);
                $emailBody = str_replace('{email}', $email, $emailBody);

                $html = new \Html2Text\Html2Text($emailBody);

                $emailTxt = $html->getText();

                $result = $mgClient->sendMessage($domain, array(
                    'from' => "{$config->site->name} <{$config->site->noreply_email}>",
                    'to' => $email,
                    'subject' => "[Action Required] Please confirm your registration",
                    'text' => $emailTxt,
                    'html' => $emailBody,
                ));
            } else {
                $emailBody = file_get_contents(__DIR__ . '/../emails/forgot-password.html');
                $emailBody = str_replace('{key}', $key, $emailBody);

                $html = new \Html2Text\Html2Text($emailBody);

                $emailTxt = $html->getText();

                $result = $mgClient->sendMessage($domain, array(
                    'from' => "{$config->site->name} <{$config->site->noreply_email}>",
                    'to' => $email,
                    'subject' => "Password recovery",
                    'text' => $emailTxt,
                    'html' => $emailBody,
                ));
            }

            if (!$result) {
                $this->deleteRequest($request_id);
                $this->error[] = 'System error: Unable to send email';

                return false;
            }
        }

        return true;
    }

    /**
     * Resend activation email
     * 
     * @param string $email
     * @param bool $sendmail = NULL
     * 
     * @return bool
     */
    public function resendActivation($email, $sendmail = NULL)
    {
        $user = $this->getByEmail($email);

        if (!$user) {
            $this->error[] = "Email address is not registered";

            return false;
        }

        if ($user->is_active == 1) {
            $this->error[] = "Account is already activated";

            return false;
        }

        return $this->addRequest($user->id, $email, "activation", $sendmail, $user->first_name);
    }

    /**
     * Returns request data if key is valid
     *
     * @param string $key
     * @param string $type
     *
     * @return array $return
     */
    public function getRequest($key, $type)
    {
        global $config;

        $query = Database::instance()->query("SELECT id, user_id, expire FROM {$config->database_tables->requests} WHERE request_key = ? AND type = ?");
        $query->execute([$key, $type]);

        if ($query->rowCount() === 0) {
            $this->error[] = 'Incorrect key';

            return false;
        }

        $row = Database::instance()->fetchOne();

        $expiredate = $row->expire;
        $currentdate = time();

        if ($currentdate > $expiredate) {
            $this->deleteRequest($row->id);
            $this->error[] = 'Key expired';

            return false;
        }

        $return['error'] = false;
        $return['id'] = $row->id;
        $return['user_id'] = $row->user_id;

        return $return;
    }

    /**
     * Deletes request from database
     *
     * @param int $id
     *
     * @return boolean
     */
    protected function deleteRequest($id)
    {
        global $config;

        $query = Database::instance()->query("DELETE FROM {$config->database_tables->requests} WHERE id = ?");

        return $query->execute([$id]);
    }

    /**
     * Creates a reset key for an email address and sends email
     *
     * @param string $email
     *
     * @return array $return
     */
    public function requestReset($email, $sendmail = NULL)
    {
        if (!Util::isEmail($email)) {
            $this->error[] = "Invalid email";
            return false;
        }

        $query = Database::instance()->query("SELECT id FROM {$this->table} WHERE email = ?");
        $query->execute([$email]);

        if (Database::instance()->rowCount() == 0) {
            $this->error[] = "Email is not found";
            return false;
        }

        $addRequest = $this->addRequest(Database::instance()->fetchOne()->id, $email, "reset", $sendmail);

        if (!$addRequest) {
            $this->error[] = "Request failed";
            return false;
        }
        return true;
    }

    /**
     * Allows a user to reset their password after requesting a reset key.
     *
     * @param string $key
     * @param string $password
     * @param string $repeatpassword
     * @param string $captcha = NULL
     *
     * @return array $return
     */
    public function resetPass($key, $password, $repeatpassword)
    {
        if (strlen($key) != 6) {
            $this->error[] = "Invalid reset key";
            return false;
        }

        if ($password !== $repeatpassword) {
            // Passwords don't match
            $this->error[] = "Password don't match";
            return false;
        }

        $data = $this->getRequest($key, "reset");

        if ($data['error'] == 1) {
            $this->error[] = "Request error";
            return false;
        }

        $user = $this->getById($data['user_id']);

        if (!$user) {
            $this->deleteRequest($data['id']);
            $this->error[] = "System error: Unkwon user";
            return false;
        }

        if ($password == $user->password) {
            $this->error[] = "New password is the same as old password";
            return false;
        }

        $query = Database::instance()->query("UPDATE {$this->table} SET password = ? WHERE id = ?");
        $query->execute([$password, $data['user_id']]);

        if ($query->rowCount() == 0) {
            $this->error[] = "System error: Update failed";
            return false;
        }

        $this->deleteRequest($data['id']);

        return true;
    }

    /**
     * Adds a new user to database
     *
     * @param string $email      -- email
     * @param string $password   -- password
     * @param array $params      -- additional params
     *
     * @return int $userId
     */
    protected function addUser($email, $password, array $params = [], &$sendmail = true)
    {
        $query = Database::instance()->query("INSERT INTO {$this->table} VALUES ()");

        if (!$query->execute()) {
            $this->error[] = "System Error: Query execution failed";
            return false;
        }

        $userId = Database::instance()->lastInsertId();
        $email = Util::escape(strtolower($email));

        if ($sendmail) {
            $addRequest = $this->addRequest($userId, $email, "activation", $sendmail, $firstName = $params['first_name']);

            if (!$addRequest) {
                $query = Database::instance()->query("DELETE FROM {$this->table} WHERE id = ?");
                $query->execute([$userId]);

                $this->error[] = 'Request failed';

                return false;
            }
            $isActive = 0;
        } else {
            $isActive = 1;
        }

        if (is_array($params) && count($params) > 0) {
            $customParamsQueryArray = [];

            foreach($params as $paramKey => $paramValue) {
                $customParamsQueryArray[] = array('value' => $paramKey . ' = ?');
            }

            $setParams = ', ' . implode(', ', array_map(function ($entry) {
                return $entry['value'];
            }, $customParamsQueryArray));
        } else {
            $setParams = '';
        }

        $query = Database::instance()->query("UPDATE {$this->table} SET email = ?, password = ?, is_active = ? {$setParams} WHERE id = ?");

        $bindParams = array_values(array_merge([$email, $password, $isActive], $params, [$userId]));

        if (!$query->execute($bindParams)) {
            $query = Database::instance()->query("DELETE FROM {$this->table} WHERE id = ?");
            $query->execute([$userId]);
            $this->error[] = "System Error: Unable to add a user";

            return false;
        }

        return $userId;
    }

    /**
     * Gets ID for a given email address and returns an array
     *
     * @param string $email
     *
     * @return array $userId
     */
    public function getUserId($email)
    {
        $query = Database::instance()->query("SELECT `id` FROM {$this->table} WHERE `email` = ?");
        $query->execute([$email]);

        if (Database::instance()->rowCount() == 0) {
            return false;
        }

        return Database::instance()->fetchOne()->id;
    }

    /**
     * Retrieve the id of logged user.
     *
     * @return int
     */
    public function currentUserId()
    {
        global $config;

        $hash = isset($_COOKIE[$config->cookie->login['name']]) ? $_COOKIE[$config->cookie->login['name']] : '';

        $query = Database::instance()->query("SELECT user_id FROM {$config->database_tables->sessions} WHERE hash = ?");
        $query->execute([$hash]);

        if ($query->rowCount() == 0) {
            return false;
        }

        return Database::instance()->fetchOne()->user_id;
    }

    /**
     * Activates a user's account
     *
     * @param string $key
     *
     * @return array $return
     */
    public function activate($key)
    {
        if (strlen($key) !== 6) {
            $this->error[] = "Invalid activation key";

            return false;
        }

        $getRequest = $this->getRequest($key, "activation");

        if ($getRequest['error'] == 1) {
            $this->error[] = "Request error";

            return false;
        }

        if ($this->getById($getRequest['user_id'])->is_active == 1) {
            $this->deleteRequest($getRequest['id']);
            $this->error = "Request error: Account is already active";

            return false;
        }

        $return['id'] = $this->getById($getRequest['user_id'])->id;

        $query = Database::instance()->query("UPDATE {$this->table} SET is_active = :is_active WHERE id = :id");
        $query->execute([':is_active' => 1, ':id' => $getRequest['user_id']]);

        $this->deleteRequest($getRequest['id']);

        $return['error'] = false;
        $return['message'] = "Account activated";

        return $return;
    }

    /**
     * Checks if a user is logged.
     *
     * @return bool
     */
    public function isLogged()
    {
        global $config;

        return (isset($_COOKIE[$config->cookie->login['name']]) && $this->checkSession($_COOKIE[$config->cookie->login['name']]));
    }

    /**
     * Checks if a user account is active.
     * 
     * @param int $userId
     * 
     * @return bool
     */
    public function isActive($userId)
    {
        $user = $this->getById($userId);

        return $user->is_active;
    }

    public function addCookie($hash, $expire)
    {
        global $config;

        $cookieName = $config->cookie->login['name'];
        $cookieVal  = trim($hash);
        $cookieExp  = trim($expire);
        $cookiePath = preg_replace('|https?://[^/]+|i', '', $config->site->url . '/');

        // Set cookie for the logged user
        return setcookie($cookieName, $cookieVal, $cookieExp, $cookiePath);
    }

    public function add2faCookie($email)
    {
        global $config;

        $cookieName = $config->cookie->_2fa['name'];
        $cookieVal  = md5($email.$config->cookie->_2fa['secret']);
        $cookieExp  = trim($config->cookie->_2fa['expire']);
        $cookiePath = preg_replace('|https?://[^/]+|i', '', $config->site->url . '/');

        // Set cookie for the logged user
        return setcookie($cookieName, $cookieVal, $cookieExp, $cookiePath);
    }

    /**
     * Creates a session for a specified user_id
     *
     * @param int $user_id
     * @param boolean $remember
     *
     * @return array $data
     */
    protected function addSession($user_id)
    {
        global $config;

        $ip = $this->getIp();
        $user = $this->getById($user_id);

        if (!$user) {
            return false;
        }

        $data = [];

        $data['hash'] = sha1($config->site->key . microtime());
        $agent = $_SERVER['HTTP_USER_AGENT'];

        $this->deleteExistingSessions($user_id);

        $data['expire'] = $config->cookie->login['expire'];

        $data['cookie_value'] = sha1($data['hash'] . $config->site->key);

        $query = Database::instance()->query("INSERT INTO {$config->database_tables->sessions} (`user_id`, `hash`, `expire_date`, `ip`, `agent`, `cookie_value`) VALUES (?, ?, ?, ?, ?, ?)");

        if (!$query->execute(array($user_id, $data['hash'], $data['expire'], $ip, $agent, $data['cookie_value']))) {
            return false;
        }

        return $data;
    }

    /**
     * Checks if a session is valid
     *
     * @param string $hash
     *
     * @return bool
     */
    public function checkSession($hash)
    {
        global $config;

        $ip = $this->getIp();
        $table_session = $config->database_tables->sessions;

        Database::instance()->query("SELECT `id`, `user_id`, `hash`, `expire_date`, `ip`, `agent`, `cookie_value` FROM {$table_session} WHERE `hash` = :hash");
        Database::instance()->bind(':hash', $hash);
        Database::instance()->execute();

        if (Database::instance()->rowCount() == 0) {
            return false;
        }

        $result       = Database::instance()->fetchOne();
        $sessionId    = $result->id;
        $userId       = $result->user_id;
        $expireDate   = $result->expire_date;
        $currentDate  = time();
        $dbIp         = $result->ip;
        $dbAgent      = $result->agent;
        $dbCookie     = $result->cookie_value;

        if ($currentDate > $expireDate) {
            $this->deleteExistingSessions($userId);

            return false;
        }

        /*if ($ip != $dbIp) {
            return false;
        }*/

        if ($dbCookie == sha1($hash . $config->site->key)) {
            return true;
        }

        return false;
    }

    /**
     * Removes all existing sessions for a given user_id
     *
     * @param int $user_id
     *
     * @return bool
     */
    protected function deleteExistingSessions($user_id)
    {
        global $config;

        $table_session = $config->database_tables->sessions;

        Database::instance()->query("DELETE FROM {$table_session} WHERE user_id = :user_id");
        Database::instance()->bind(':user_id', $user_id);
        Database::instance()->execute();

        return Database::instance()->rowCount() == 1;
    }

    /**
     * Removes all existing sessions for a given hash
     *
     * @param int $user_id
     *
     * @return bool
     */
    protected function deleteSession($hash)
    {
        global $config;

        $table_session = $config->database_tables->sessions;

        Database::instance()->query("DELETE FROM {$table_session} WHERE hash = :hash");
        Database::instance()->bind(':hash', $hash);
        Database::instance()->execute();

        $loginCookie = $config->cookie->login['name'];
        $_2faCookie = $config->cookie->_2fa['name'];
        $cookiePath = preg_replace('|https?://[^/]+|i', '', $config->site->url . '/');

        // Set cookie for the logged user
        setcookie($loginCookie, '', time() - 7000, $cookiePath);
        setcookie($_2faCookie, '', time() - 7000, $cookiePath);

        return Database::instance()->rowCount() == 1;
    }

    /**
     * Get a user data by hash
     *
     * @param int $hash
     *
     * @return bool
     */
    public function getByHash($hash)
    {
        global $config;

        $table_session = $config->database_tables->sessions;

        Database::instance()->query("SELECT user_id FROM {$table_session} WHERE hash = :hash");
        Database::instance()->bind(':hash', $hash);
        Database::instance()->execute();

        $uid = Database::instance()->fetchOne()->user_id;

        return $this->getByID($uid);
    }

    /**
     * Checks if Email is verified
     *
     * @return bool
     */
    public function isEmailVerified($userId)
    {
        return (bool) $this->get('is_email_verified', $userId);
    }

   /**
     * Checks if user is an administrator.
     *
     * @return bool
     */
    public function isAdmin($userId )
    {
        return $this->get('admin', $userId);
    }

    /**
     * Gets user data by userId
     *
     * @param string $userId
     *
     * @return bool|object
     */
    public function getById($userId)
    {
        Database::instance()->query("SELECT * FROM {$this->table} WHERE id = :uid");
        Database::instance()->bind(':uid', $userId);
        Database::instance()->execute();

        if (Database::instance()->rowCount() == 0) {
            return false;
        }

        return Database::instance()->fetchAll()[0];
    }

    /**
     * Gets user data by username
     *
     * @param string $username
     *
     * @return bool|object
     */
    public function getByName($username)
    {
        Database::instance()->query("SELECT * FROM {$this->table} WHERE username = :name");
        Database::instance()->bind(':name', $username);
        Database::instance()->execute();

        if (Database::instance()->rowCount() == 0) {
            return false;
        }

        return Database::instance()->fetchAll()[0];
    }

    /**
     * Gets user data by email
     *
     * @param string $email
     *
     * @return bool|object
     */
    public function getByEmail($email)
    {
        Database::instance()->query("SELECT * FROM {$this->table} WHERE email = :email");
        Database::instance()->bind(':email', $email);
        Database::instance()->execute();


        if (Database::instance()->rowCount() == 0) {
            return false;
        }

        return Database::instance()->fetchAll()[0];
    }

    /**
     * Get user data by phone number
     * 
     * @param string $phone
     * 
     * @return bool|object
     */
    public function getByPhoneNumber($phone)
    {
        Database::instance()->query("SELECT * FROM {$this->table} WHERE phone = :phone");
        Database::instance()->bind(':phone', $phone);
        Database::instance()->execute();

        if (Database::instance()->rowCount() == 0) {
            return false;
        }

        return Database::instance()->fetchAll()[0];
    }
    
    /**
     * Gets user data by account number
     *
     * @param string $accno
     *
     * @return bool|object
     */
    public function getByAccountNumber($accno)
    {
        Database::instance()->query("SELECT * FROM {$this->table} WHERE account_number = :accno");
        Database::instance()->bind(':accno', $accno);
        Database::instance()->execute();


        if (Database::instance()->rowCount() == 0) {
            return false;
        }

        return Database::instance()->fetchAll()[0];
    }

    /**
     * Find user by coin address
     *
     * @param string $address
     *
     * @return null|object
     */
    public function findByAddress($address)
    {
        $query = Database::instance()->query(
            "SELECT * FROM {$this->table} WHERE btc_address = :address OR eth_address = :address"
        );
        $query->bindValue(':address', $address);
        $query->execute();
        if ($query->fetchColumn() > 0) {
            return Database::instance()->fetchAll()[0];
        }
        return null;
    }

    /**
     * Get user IP Address
     *
     * @return string
     */
    public function getIp()
    {
        if (getenv('HTTP_CLIENT_IP')) {
            $ipaddress = getenv('HTTP_CLIENT_IP');
        } elseif (getenv('HTTP_X_FORWARDED_FOR')) {
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        } elseif (getenv('HTTP_X_FORWARDED')) {
            $ipaddress = getenv('HTTP_X_FORWARDED');
        } elseif (getenv('HTTP_FORWARDED_FOR')) {
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        } elseif (getenv('HTTP_FORWARDED')) {
            $ipaddress = getenv('HTTP_FORWARDED');
        } elseif (getenv('REMOTE_ADDR')) {
            $ipaddress = getenv('REMOTE_ADDR');
        } else {
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        }

        return $ipaddress;
    }

    /**
     * Get user country from IP Address
     */
    public function getCountry()
    {
        // This will contain the ip of the request
        $ip = $this->getIp();

        /*
         * You can use a more sophisticated method to retrieve the content of a webpage with
         * php using a library or something
         * We will retrieve quickly with the file_get_contents
         */
        $dataArray = json_decode(Util::urlGetContents("http://www.geoplugin.net/json.gp?ip=".$ip));

        /*
         * Outputs something like (obviously with the data of your IP) :
         *
         * geoplugin_countryCode => "DE",
         * geoplugin_countryName => "Germany"
         * geoplugin_continentCode => "EU"
         */

        if (!is_null($dataArray->geoplugin_countryName)) {
            return $dataArray->geoplugin_countryName;
        }

        return 'United States';
    }

    /**
     * Get user profile picture or default to user initials
     *
     * @param int $userId
     *
     * @return string
     */
    public function getProfilePicture($userId)
    {
        if (empty($this->get('avatar', $userId))) {
            return "https://ui-avatars.com/api/?name=".ucfirst($this->get('first_name', $userId))."+".ucfirst($this->get('last_name', $userId))."&font-size=0.33";
        }
        
        return $this->get('avatar', $userId);
    }
}
