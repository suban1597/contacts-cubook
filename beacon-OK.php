<?php


$API_URL = 'https://api.line.me/v2/bot/message';
//it-beacon
$ACCESS_TOKEN = '4rdPrwctgzH4f52jYbtvykZkki+MN2xZK+finbLthiCRMR1fyBLt+dlKU8ExfQxxcV7ZC9VX+lG/VG5XnZHp7xuoVQs4tyoCNUA0TxZek8M1DqArJBPPalW51qk2NWCu0L1En5v+FdTDw3csua882gdB04t89/1O/w1cDnyilFU='; 
$channelSecret = '39a9b2c7954e9685bc7007335ea632ba';
//it@cubook
//$ACCESS_TOKEN = 'MalHeKonc+s+4OxE1F17SBgCojCXD37LHJpTEmsmUwEm6lAqxZyRN28h5jISMwoKUtuZTNQVw8z6582k6avlNPpED8QLmdMDcTGKSdONAFL4e/PZ+1NGrb0j4M1Q59hnpKYaUT4elMd92DmjRyuyWAdB04t89/1O/w1cDnyilFU=';
//$channelSecret = '2669bb384ac7522ea63d19dd55f324de';

$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN);

$request = file_get_contents('php://input');   // Get request content
$request_array = json_decode($request, true);   // Decode JSON to Array
var_export($request_array);

date_default_timezone_set("Asia/Bangkok");

$month_arr=array(
    "1"=>"มกราคม",
    "2"=>"กุมภาพันธ์",
    "3"=>"มีนาคม",
    "4"=>"เมษายน",
    "5"=>"พฤษภาคม",
    "6"=>"มิถุนายน", 
    "7"=>"กรกฎาคม",
    "8"=>"สิงหาคม",
    "9"=>"กันยายน",
    "10"=>"ตุลาคม",
    "11"=>"พฤศจิกายน",
    "12"=>"ธันวาคม"                 
);

$new_date = date("d")." ".$month_arr[date("n")]." ".(date("Y")+543);
echo $new_date;
$new_time = date("H:i:s");
echo $new_time;


$jsonFlex = [
    "type" => "flex",
    "altText" => "เวลาเข้า-ออกงาน",
    "contents" => [
      "type" => "bubble",
//      "size" => "giga",
      "direction" => "ltr",
      "header" => [
        "type" => "box",
        "layout" => "vertical",
        "contents" => [
          [
            "type" => "text",
            "text" => "บันทึกเวลา",
            "size" => "lg",
            "align" => "start",
            "weight" => "bold",
            "color" => "#009813",
          ],
          [
            "type" => "separator",
            "margin" => "lg",
            "color" => "#C3C3C3"
          ],
          [
            "type" => "text",
            "text" => "$new_date",
            "align" => "center",                   
            "size" => "3xl",
            "weight" => "bold",
            "color" => "#000000"
          ],
          [
            "type" => "text",
            "text" => "$new_time",
            "align" => "center",              
            "size" => "4xl",
            "weight" => "bold",
            "color" => "#0000ff"
          ],
//          [
//            "type" => "text",
//            "text" => "สาขาแว่นแก้ว",
//            "size" => "lg",
//            "weight" => "bold",
//            "color" => "#000000"
//          ],
          [
            "type" => "separator",
            "margin" => "lg",
            "color" => "#C3C3C3"
          ]
        ]
      ],
      "footer" => [
        "type" => "box",
        "layout" => "horizontal",
        "contents" => [
          [
            "type" => "text",
            "text" => "รายละเอียด",
            "size" => "lg",
            "align" => "start",
            "color" => "#0084B6",
            "action" => [
              "type" => "uri",
              "label" => "รายละเอียด",
              "uri" => "https://www.google.co.th/"
            ]
          ]
        ]
      ]
    ]
  ];

if ( sizeof($request_array['events']) > 0 ) {
    foreach ($request_array['events'] as $event) {
        error_log(json_encode($event));
        $reply_message = '';
        $reply_token = $event['replyToken'];

        $data = [
            'replyToken' => $reply_token,
            'messages' => [$jsonFlex]
        ];

        print_r($data);
      
        $post_body = json_encode($data, JSON_UNESCAPED_UNICODE);

        $send_result = send_reply_message($API_URL.'/reply', $POST_HEADER, $post_body);

        echo "Result: ".$send_result."\r\n";
        
    }
}

echo "OK";

function send_reply_message($url, $post_header, $post_body)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $post_header);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_body);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $result = curl_exec($ch);
    curl_close($ch);

    return $result;

}

?>
