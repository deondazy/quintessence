<?php
/**
 * Quintessence Fraternity Chat Screen
 */
if (!session_id()) {
    session_start();
}

use QF\Core\Util;

require __DIR__ . '/../bootstrap.php';

$file = "chat/";
$pageName = 'Chat';

$chat = new QF\Core\Chat;
$chats = $chat->getAll();



include __DIR__ . '/header.php'; ?>
<style>
    .bottom-message-box {
        position: absolute;
        bottom: -20px;
        width: 100%;
        z-index: 999;
        left: 0;
        right: 0;
    }

    .chat-list {
        margin-bottom: 170px !important;
    }
    .madia-user {
        font-weight: 700;
        color: #C62828;
    }
</style>



<!-- Line content divider -->
<div class="panel panel-flat">
    <div class="panel-body">
        <ul class="media-list chat-list content-group" id="chatwindow">

        </ul>

        <form method="post" class="typing-area">
            <input type="text" value="<?php echo $user->currentUserId(); ?>" class="incoming_id" name="incoming_id" hidden>
            <div class="bottom-message-box panel panel-body">
                <textarea id="message" name="message" class="form-control content-group input-field" rows="3" cols="1"
                    placeholder="Enter your message..."></textarea>

                <div class="row">
                    <div class="col-xs-6">
                    </div>

                    <div class="col-xs-6 text-right">
                        <button id="sendchat" type="submit" class="btn btn-primary btn-labeled btn-labeled-right"><b><i
                                    class="icon-circle-right2"></i></b> Send</button>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>
<!-- /line content divider -->


<?php include __DIR__ . '/footer.php'; ?>

<script>
    const form = document.querySelector(".typing-area"),
incoming_id = form.querySelector(".incoming_id").value,
inputField = form.querySelector(".input-field"),
sendBtn = form.querySelector("#sendchat"),
chatBox = document.querySelector(".chat-list");

form.onsubmit = (e)=>{
    e.preventDefault();
}

inputField.focus();

inputField.onkeyup = ()=>{
    if(inputField.value != ""){
        sendBtn.classList.add("active");
    }else{
        sendBtn.classList.remove("active");
    }
}

sendBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "<?php echo $site->url; ?>/dashboard/send-chat.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === 4){
          if(xhr.status === 200){
              inputField.value = "";
              scrollToBottom();
          }
      }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}

chatBox.onmouseenter = ()=>{
    chatBox.classList.add("active");
}

chatBox.onmouseleave = ()=>{
    chatBox.classList.remove("active");
}

setInterval(() =>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "<?php echo $site->url; ?>/dashboard/get-chat.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === 4){
          if(xhr.status === 200){
            let data = xhr.response;
            chatBox.innerHTML = data;
            if(!chatBox.classList.contains("active")){
                scrollToBottom();
              }
          }
      }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("incoming_id="+incoming_id);
}, 500);

function scrollToBottom(){
    chatBox.scrollTop = chatBox.scrollHeight;
  }
  
</script>