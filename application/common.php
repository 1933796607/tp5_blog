<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function email($to, $title, $content)
{
    //实例化
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                      // Enable verbose debug output
        $mail->CharSet = 'utf-8';
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.163.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = '13624384578@163.com';                     // SMTP username
        $mail->Password   = '19990115jjs';                               // SMTP password
        $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Port       = 587;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('13624384578@163.com', 'ruisi');
        $mail->addAddress($to);     // Add a recipient

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $title;
        $mail->Body    = $content;

        return $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        Exception($mail->ErrorInfo, 1001);
    }
}
//把span字符串替换成a
function replace($data)
{
    return str_replace('span', 'a', $data);
}
//把字符串转换为数组
function strToArray($data)
{
    return explode('|', $data);
}
