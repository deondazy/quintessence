<?php

namespace QF\Core;

class Util
{
    /**
     * Redirects to a new URL using JavaScript.
     *
     * @param string $url The url to redirect to
     */
    public static function redirect($url)
    {
        echo "<script>window.location.replace('"  . $url . "')</script>";
        exit;
    }

    /**
     * Cleans provided input.
     *
     * @param string $input
     *
     * @return string
     */
    public static function escape($input)
    {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }

    public static function getdate($timestamp)
    {
        $info = getdate($timestamp);
        $info[ 'mon0' ] = substr('0'.$info[ 'mon' ], -2, 2);
        $info[ 'mday0' ] = substr('0'.$info[ 'mday' ], -2, 2);
        return $info;
    }

    /**
     * Returns the relative time string from timestamp
     *
     * @param int $ts Timestamp
     *
     * @return string
     */
    public static function time2str($ts)
    {
        if (!ctype_digit($ts)) {
            $ts = strtotime($ts);
        }
        $diff = time() - $ts;
        if ($diff == 0) {
            return 'now';
        } elseif ($diff > 0) {
            $day_diff = floor($diff / 86400);
            if ($day_diff == 0) {
                if ($diff < 60) {
                    return 'just now';
                }
                if ($diff < 120) {
                    return '1 minute ago';
                }
                if ($diff < 3600) {
                    return floor($diff / 60).' minutes ago';
                }
                if ($diff < 7200) {
                    return '1 hour ago';
                }
                if ($diff < 86400) {
                    return floor($diff / 3600).' hours ago';
                }
            }
            if ($day_diff == 1) {
                return 'Yesterday';
            }
            if ($day_diff < 7) {
                return $day_diff.' days ago';
            }
            if ($day_diff < 31) {
                return ceil($day_diff / 7).' weeks ago';
            }
            if ($day_diff < 60) {
                return 'last month';
            }
            return date('F Y', $ts);
        } else {
            $diff = abs($diff);
            $day_diff = floor($diff / 86400);
            if ($day_diff == 0) {
                if ($diff < 120) {
                    return 'in a minute';
                }
                if ($diff < 3600) {
                    return 'in '.floor($diff / 60).' minutes';
                }
                if ($diff < 7200) {
                    return 'in an hour';
                }
                if ($diff < 86400) {
                    return 'in '.floor($diff / 3600).' hours';
                }
            }
            if ($day_diff == 1) {
                return 'Tomorrow';
            }
            if ($day_diff < 4) {
                return date('l', $ts);
            }
            if ($day_diff < 7 + (7 - date('w'))) {
                return 'next week';
            }
            if (ceil($day_diff / 7) < 4) {
                return 'in '.ceil($day_diff / 7).' weeks';
            }
            if (date('n', $ts) == date('n') + 1) {
                return 'next month';
            }
            return date('F Y', $ts);
        }
    }

    /**
     * Converts timestamp accoding to the specified date format
     *
     * @param string $format PHP compatible Date formate
     * @param int $timestamp The given timestamp
     *
     * @return string Formatted date/time
     */
    public static function formatDate($format, $timestamp)
    {
        $matches = preg_split('/((?<!\\\\)%[a-z]\\s*)/iu', $format, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
        $output = '';
        foreach ($matches as $match) {
            if ($match[0] == '%') {
                $output .= strftime($match, $timestamp);
            } else {
                $output .= date($match, $timestamp);
            }
        }
        return $output;
    }

    public static function selected($selected, $current = true, $show = true)
    {
        return self::checkedSelectedResult($selected, $current, $show, 'selected');
    }

    public static function checked($checked, $current = true, $show = true)
    {
        return self::checkedSelectedResult($checked, $current, $show, 'checked');
    }

    private static function checkedSelectedResult($helper, $current, $show, $type)
    {
        if ((string) $helper === (string) $current) {
            $result = " $type='$type'";
        } else {
            $result = '';
        }
        if ($show) {
            echo $result;
        }
        return $result;
    }

    public static function selectFromJson($json, $selected = '', $id = '', $name = '')
    {
        $selected = isset($_POST[$name]) ? htmlspecialchars($_POST[$name]) : '';
        if (file_exists($json)) {
            $file = file_get_contents($json);
            $get_json = json_decode($file);
            foreach ($get_json as $arr) {
                foreach ($arr as $key => $value) {
                    $array[$key] = $value;
                }
            }
            $output = '<select class="select-box" id="'.$id.'" name="'.$name.'">';
            for ($i = 0, $c = count($array); $i < $c; ++$i) {
                $output .= '<option value="'.lcfirst($array[$i]).'" '.self::selected($selected, lcfirst($array[$i]), false).'>'.$array[$i].'</option>';
            }
            $output .= '</select>';
            return $output;
        } else {
            return false;
        }
    }

    public static function selectDate($selected_day = '', $selected_month = '', $selected_year = '')
    {
        $selected_day = isset($_POST['day']) ? htmlspecialchars($_POST['day']) : '';
        $day = '<select class="select-box" id="day" name="day">';
        for ($i = 1; $i <= 31; ++$i) {
            $days[] = $i;
        }
        foreach ($days as $id => $item) {
            $day .= '<option value="'.$item.'" '.self::selected($selected_day, $item, false).'>'.$item.'</option>';
        }
        $day .= '</select>';
        $selected_month = isset($_POST['month']) ? htmlspecialchars($_POST['month']) : '';
        $month = '<select class="select-box" id="month" name="month">';
        $months = ['', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        foreach ($months as $id => $item) {
            if ($id == 0) {
                continue;
            }
            $month .= '<option value="'.$id.'" '.self::selected($selected_month, $id, false).'>'.$item.'</option>';
        }
        $month .= '</select>';
        $selected_year = isset($_POST['year']) ? htmlspecialchars($_POST['year']) : '';
        $year = '<select class="select-box" id="year" name="year">';
        $current_year = date('Y');
        $start_year = $current_year - 50;
        for ($i = $start_year; $i <= $current_year; ++$i) {
            $years[] = $i;
        }
        foreach ($years as $id => $item) {
            $year .= '<option value="'.$item.'" '.self::selected($selected_year, $item, false).'>'.$item.'</option>';
        }
        $year .= '</select>';
        $output = $day.$month.$year;
        return $output;
    }

    public static function isEmail($string)
    {
        if (preg_match("/^([a-zA-Z0-9_\.-]+)@([\da-zA-Z0-9_\.-]+)\.([a-zA-Z\.]{2,6})$/", $string)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Auto Fill a form after submission.
     *
     * @param string $name
     *   The name of the form field
     * @param string $type
     *   The input type text|textarea|checkbox|radio|select
     * @param string $value
     *   The selected value
     */
    public static function fill($name, $value = '', $type = 'text')
    {
        if (isset($_REQUEST[$name])) {
            switch ($type) {
                case 'text':
                    return ' value="'.htmlspecialchars($_REQUEST[$name]).'" ';
                    break;
                case 'textarea':
                    return htmlspecialchars($_REQUEST[$name]);
                    break;
                case 'checkbox':
                    return ' checked ';
                    break;
                case 'radio':
                    if ($_REQUEST[$name] == $value) {
                        return ' checked ';
                    }
                    break;
                case 'select':
                    if ($_REQUEST[$name] == $value) {
                        return ' selected ';
                    }
                    break;
            }
        }
        return null;
    }

    public static function formatCash($digit)
    {
        switch ($digit) {
            case strlen($digit) < 4:
                $digit = $digit;
                break;
            case strlen($digit) == 4:
                $digit = substr_replace($digit, ',', 1, 0);
                break;
            case strlen($digit) == 5:
                $digit = substr_replace($digit, ',', 2, 0);
                break;
            case strlen($digit) == 6:
                $digit = substr_replace($digit, ',', 3, 0);
            default:
                $digit = $digit;
        }
        return $digit;
    }

    public static function formatPhone($phone) {
        // note: making sure we have something
        if(!isset($phone[3])) {
            return '';
        }

        // note: strip out everything but numbers
        $phone = preg_replace("/[^0-9]/", "", $phone);

        $length = strlen($phone);

        switch($length) {
            case 7:
                return preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $phone);
            break;

            case 10:
                return preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", $phone);
            break;

            case 13:
                return preg_replace("/([0-9]{3})([0-9]{3})([0-9]{3})([0-9]{4})/", "$1 $2 $3 $4", $phone);
            break;

            default:
                return $phone;
            break;
        }
    }

    /**
     * Send SMS, using the SmartSMSSolutions API
     *
     * @param array  $params Parameters to pass to the API
     *
     * @return string Status of the sent SMS
     */
    public static function sendSms(array $params)
    {
        global $option;

        // Set Default Parameters
        $params += [
            'token'   => 'GW2rhTnAVE3JRTZHXgaUIkkvdhJafe0IptcZkT4tDWAqvKNdijQJawWybE7dzDmCJd07HIAvokRZbNlNAg0TisVGm7Rmn2QHXu3l',
            'routing' => 3,
            'type'    => 0,
            'sender'  => $option->get('site_name'),
        ];

        $params = http_build_query($params);
        $ch     = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://smartsmssolutions.com/api/');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);

        $output = curl_exec($ch);
        curl_close($ch);

        return $output;
    }

    /**
     * Generates a random string of specified length
     *
     * @param int $length How many characters to generate
     *
     * @return string The generated random string
     */
    public static function getRandomString($length = 10)
    {
        $chars = 'A1B2C3D4E5F6G7H8I9J0K1L2M3N4O5P6Q7R8S9T0U1V2W3X4Y5Z6a1b2c3d4e5f6g7h8i9j0k1l2m3n4o5p6q7r8s9t0u1v2w3x4y5z6';
        $code = '';

        for ($i = 1; $i <= $length; ++$i) {
            $code .= $chars[mt_rand(0, strlen($chars) - 1)];
        }

        return $code;
    }

    /**
     * Generates random numbers of specified digits
     *
     * @param int $length How many digits to generate
     *
     * @return string The generated random numbers
     */
    public static function getRandomInt($length = 10)
    {
        $code = '';

        for ($i = 1; $i <= $length; ++$i) {
            $code .= mt_rand(0, 9);
        }

        return $code;
    }

    /**
     * Converts case to the specified mode
     *
     * @param string $str The string to convert
     * @param string $case The mode to convert the string to
     *
     * @return string The converted string
     */
    public static function convert($str, $case)
    {
        switch ($case) {
            case 'uc': // UPPERCASE
                $case = MB_CASE_UPPER;
                break;
            case 'lc': // lowercase
                $case = MB_CASE_LOWER;
                break;
            case 'tc': // TitleCase
                $case = MB_CASE_TITLE;
                break;
        }

        return mb_convert_case($str, $case, "UTF-8");
    }

    /**
     * Function to create and display error and success messages
     * @param string session name
     * @param string message
     * @param string display class
     *
     * @return string message
     */
    public static function flash($name = '', $message = '', $class = 'alert alert-success')
    {
        // We can only do something if the name isn't empty
        if (!empty($name)) {
            // No message, create it
            if (!empty($message) && empty($_SESSION[$name])) {
                if (!empty($_SESSION[$name])) {
                    unset( $_SESSION[$name] );
                }

                if (!empty($_SESSION[$name.'_class'])) {
                    unset($_SESSION[$name.'_class']);
                }

                $_SESSION[$name] = $message;
                $_SESSION[$name.'_class'] = $class;
            }

            //Message exists, display it
            elseif (!empty($_SESSION[$name]) && empty($message)) {
                $class = !empty($_SESSION[$name.'_class']) ? $_SESSION[$name.'_class'] : 'success';
                echo '<div class="fadeout-message '.$class.'" id="msg-flash"><button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>'.$_SESSION[$name].'</div>';
                unset($_SESSION[$name]);
                unset($_SESSION[$name.'_class']);
            }
        }
    }

    public static function urlGetContents($Url)
    {
        if (!function_exists('curl_init')){
            die('CURL is not installed!');
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $Url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

    public static function headerScripts()
    {
        global $site;

        if (isset($site->header_scripts)) {
            return $site->header_scripts;
        }
    }
}
