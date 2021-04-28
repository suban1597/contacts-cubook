<?php
define('LINE_API',"https://notify-api.line.me/api/notify");
$stickerPkg = 2; //stickerPackageId
$stickerId = 34; //stickerId


$name = $_REQUEST['name'];
$email = $_REQUEST['email'];
$phone = $_REQUEST['phone'];
$lineid = $_REQUEST['lineid'];
$mesg = $_REQUEST['mesg'];

//$token = "HbYDywBRYwgNhwmUMXPjatya2ZzSKJ8ug0cjmrXypD6";
$token = "iVnUd9eXPfTMC3OcuNZFpH0RtCA0k6qTLGr4ttuQ5j1";
$message = 'ปัญหา : '.$mesg."\n".'ผู้แจ้ง : '.$name."\n".'อีเมล์: '.$email."\n".'Phone: '.$phone."\n".'Line ID: '.$lineid;

if($name<>"" || $email <> "" || $mesg <> "") {
 
 
 header('Content-Type: text/html; charset=utf-8');
// $res = notify_message($message);
$res = notify_message($message,$stickerPkg,$stickerId,$token);
 echo "<center>ส่งข้อความเรียบร้อยแล้ว</center>";
 ?>
<meta http-equiv="refresh" content="2;url=contacts.html">
<?php

} else {
 echo "<center>Error: กรุณากรอกข้อมูลให้ครบถ้วน</center>";
}

function notify_message($message,$stickerPkg,$stickerId,$token){
     $queryData = array(
      'message' => $message,
      'stickerPackageId'=>$stickerPkg,
      'stickerId'=>$stickerId
     );
     $queryData = http_build_query($queryData,'','&');
     $headerOptions = array(
         'http'=>array(
             'method'=>'POST',
             'header'=> "Content-Type: application/x-www-form-urlencoded\r\n"
                 ."Authorization: Bearer ".$token."\r\n"
                       ."Content-Length: ".strlen($queryData)."\r\n",
             'content' => $queryData
         ),
     );
     $context = stream_context_create($headerOptions);
     $result = file_get_contents(LINE_API,FALSE,$context);
     $res = json_decode($result);
  return $res;
 }

?>
