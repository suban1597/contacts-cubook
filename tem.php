<?php

header('Content-Type: application/json');
date_default_timezone_set("Asia/Bangkok");
$datef = date('Y-m-d');
$json = file_get_contents('php://input');
$request = json_decode($json, true);

$userId = $request['events'][0]['source']['userId'];

$Type = $request['events'][0]['beacon']['type'];

$a ="\n\r\n userid = ".$userId;
$b ="\n\r\n Type = ".$Type;

$myfile = fopen("log$datef.txt", "w") or die("Unable to open file!");

fwrite($myfile,$json);
fwrite($myfile,$a);
fwrite($myfile,$b);

fclose($myfile);

if($Type ='enter'){

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.line.me/v2/bot/message/push",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
 CURLOPT_POSTFIELDS => "{\r\n\r\n    \"to\": \"$userId\",\r\n  \"messages\": [{\r\n\r\n        \"type\": \"flex\",\r\n\r\n        \"altText\": \"ข่าวไอที-ข่าวด่วน\",\r\n\r\n        \"contents\":{\r\n\r\n  \"type\": \"bubble\",\r\n\r\n  \"body\": {\r\n\r\n    \"type\": \"box\",\r\n\r\n    \"layout\": \"horizontal\",\r\n\r\n    \"contents\": [\r\n\r\n      {\r\n\r\n        \"type\": \"image\",\r\n\r\n        \"url\": \"https://scontent-fbkk5-7.us-fbcdn.net/v1/t.1-48/1426l78O9684I4108ZPH0J4S8_842023153_K1DlXQOI5DHP/dskvvc.qpjhg.xmwo/w/data/978/978191-img.rxlujs.17wrr.jpg\",\r\n\r\n        \"size\": \"full\",\r\n\r\n        \"aspectRatio\": \"16:9\",\r\n\r\n        \"aspectMode\": \"cover\",\r\n\r\n        \"action\": {\r\n\r\n      \"type\": \"uri\",\r\n\r\n      \"uri\": \"line://app/1573243425-WvJoV9Vy\"\r\n\r\n    }\r\n\r\n     \r\n\r\n      }\r\n\r\n    ]\r\n\r\n  }\r\n\r\n}\r\n\r\n    }]\r\n\r\n}",
  CURLOPT_HTTPHEADER => array(
    "authorization: Bearer  line_token",
    "cache-control: no-cache",
    "content-type: application/json",
    "postman-token: 09c612eb-0d33-966b-78de-29fdc4044f55"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}
 
}else{
 
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.line.me/v2/bot/message/push",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
   CURLOPT_POSTFIELDS => "{\r\n    \"to\": \"$userId\",\r\n\r\n   \"messages\": [{\r\n\r\n        \"type\": \"flex\",\r\n\r\n        \"altText\": \"รายงานสภาพอากาศ และการจราจร \",\r\n\r\n        \"contents\":\r\n\r\n{\r\n  \"type\": \"bubble\",\r\n  \"styles\": {\r\n    \"footer\": {\r\n      \"backgroundColor\": \"#42b3f4\"\r\n    }\r\n  },\r\n  \"header\": {\r\n    \"type\": \"box\",\r\n    \"layout\": \"horizontal\",\r\n    \"contents\": [\r\n      {\r\n        \"type\": \"box\",\r\n        \"layout\": \"baseline\",\r\n        \"contents\": [\r\n          {\r\n            \"type\": \"icon\",\r\n            \"size\": \"xxl\",\r\n            \"url\": \"https://modcumram.com/logo_sapa.png\"\r\n          }\r\n        ]\r\n      },\r\n      {\r\n        \"type\": \"box\",\r\n        \"layout\": \"vertical\",\r\n        \"flex\": 5,\r\n        \"contents\": [\r\n          {\r\n            \"type\": \"text\",\r\n            \"text\": \"รายงานสภาพอากาศ\",\r\n            \"weight\": \"bold\",\r\n            \"color\": \"#aaaaaa\",\r\n            \"size\": \"md\",\r\n            \"gravity\": \"top\"\r\n          },\r\n          {\r\n            \"type\": \"text\",\r\n            \"text\": \"ข้อมูลกรมอุตุนิยมวิทยา\",\r\n            \"weight\": \"bold\",\r\n            \"color\": \"#aaaaaa\",\r\n            \"size\": \"lg\",\r\n            \"gravity\": \"top\"\r\n          }\r\n        ]\r\n      }\r\n    ]\r\n  },\r\n  \"hero\": {\r\n    \"type\": \"image\",\r\n    \"url\": \"https://img.tsood.com/userfiles/image/3-1(10).jpg\",\r\n    \"size\": \"full\",\r\n    \"aspectRatio\": \"1:1\",\r\n    \"aspectMode\": \"cover\",\r\n    \"action\": {\r\n      \"type\": \"uri\",\r\n      \"uri\": \"https://www.tmd.go.th/programs/uploads/satda/latest.jpg\"\r\n    }\r\n  },\r\n  \"body\": {\r\n    \"type\": \"box\",\r\n    \"layout\": \"vertical\",\r\n    \"contents\": [\r\n      {\r\n        \"type\": \"text\",\r\n        \"margin\": \"sm\",\r\n        \"text\": \"สภาพอากาศและการจราจร\",\r\n        \"weight\": \"bold\",\r\n        \"size\": \"md\",\r\n        \"wrap\": true\r\n      },\r\n      {\r\n        \"type\": \"box\",\r\n        \"layout\": \"vertical\",\r\n        \"margin\": \"xs\",\r\n        \"contents\": [\r\n          {\r\n            \"type\": \"box\",\r\n            \"layout\": \"baseline\",\r\n            \"spacing\": \"sm\",\r\n            \"contents\": [\r\n              {\r\n                \"type\": \"text\",\r\n                \"text\": \"ที่มาข้อมูล กรมอุตินิยมวิทยาและ จส.100\",\r\n                \"wrap\": true,\r\n                \"color\": \"#666666\",\r\n                \"size\": \"sm\",\r\n                \"flex\": 6\r\n              }\r\n            ]\r\n          }\r\n        ]\r\n      }\r\n    ]\r\n  },\r\n  \"footer\": {\r\n    \"type\": \"box\",\r\n    \"layout\": \"vertical\",\r\n    \"spacing\": \"sm\",\r\n    \"contents\": [\r\n      {\r\n        \"type\": \"button\",\r\n        \"style\": \"link\",\r\n        \"color\": \"#FFFFFF\",\r\n        \"height\": \"sm\",\r\n        \"action\": {\r\n          \"type\": \"message\",\r\n          \"label\": \"พยากรณ์อากาศประจำวัน\",\r\n          \"text\": \"อากาศกรุงเทพ\"\r\n        }\r\n      },\r\n      {\r\n        \"type\": \"button\",\r\n        \"style\": \"link\",\r\n        \"color\": \"#FFFFFF\",\r\n        \"height\": \"sm\",\r\n        \"action\": {\r\n          \"type\": \"uri\",\r\n          \"label\": \"ภาพถ่ายเรดาร์ฝน\",\r\n          \"uri\": \"https://www.tmd.go.th/programs/uploads/satda/latest.jpg\"\r\n        }\r\n      },\r\n      {\r\n        \"type\": \"button\",\r\n        \"style\": \"link\",\r\n        \"color\": \"#FFFFFF\",\r\n        \"height\": \"sm\",\r\n        \"action\": {\r\n          \"type\": \"uri\",\r\n          \"label\": \"เรดาห์ตรวจอากาศ\",\r\n          \"uri\": \"http://rain.tvis.in.th/rain_predict_android.php?lat=13.753364&lon=100.4954246\"\r\n        }\r\n      },\r\n      {\r\n        \"type\": \"button\",\r\n        \"style\": \"link\",\r\n        \"color\": \"#FFFFFF\",\r\n        \"height\": \"sm\",\r\n        \"action\": {\r\n          \"type\": \"message\",\r\n          \"label\": \"การจราจรและอุบัติเหตุ\",\r\n          \"text\": \"อุบัติเหตุ\"\r\n        }\r\n      }\r\n    ]\r\n  }\r\n}\r\n    }]\r\n\r\n\r\n}\r\n\r\n",
  CURLOPT_HTTPHEADER => array(
    "authorization: Bearer  line_token",
    "cache-control: no-cache",
    "content-type: application/json",
    "postman-token: 0569b364-d147-6b1b-b08d-17f5d67c88e1"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}
 
 
}


?>
