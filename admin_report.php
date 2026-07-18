<?php

require_once "config.php";

function sendAdminReport($conn, $user_id)
{

    $sql = "SELECT * FROM users
            WHERE user_id=?
            AND platform='eitaa'";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("s",$user_id);

    $stmt->execute();

    $result = $stmt->get_result();

    if($result->num_rows==0){

        return false;

    }

    $user = $result->fetch_assoc();

    if($user["report_sent"]){

        return true;

    }

    $text="";

    $text.="🎉 ثبت درخواست جدید\n\n";

    $text.="👤 نام: ".$user["fullname"]."\n";

    $text.="📱 شماره تماس: ".$user["contact_number"]."\n";

    $text.="💛 شماره درخواستی: ".$user["desired_number"]."\n";

    $text.="📍 پلتفرم: ایتا";



    $token=BOT_TOKEN;

    $chat_id=ADMIN_CHAT_ID;



    $url="https://eitaayar.ir/api/".$token."/sendMessage";



    $data=[

        "chat_id"=>$chat_id,

        "text"=>$text

    ];



    $ch=curl_init($url);

    curl_setopt($ch,CURLOPT_POST,true);

    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

    curl_setopt($ch,CURLOPT_POSTFIELDS,$data);

    curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);

    $response=curl_exec($ch);

    curl_close($ch);



    $response=json_decode($response,true);



    if(isset($response["ok"]) && $response["ok"]){

        $stmt=$conn->prepare(

            "UPDATE users
             SET report_sent=1
             WHERE user_id=?
             AND platform='eitaa'"

        );

        $stmt->bind_param("s",$user_id);

        $stmt->execute();

        return true;

    }

    return false;

}