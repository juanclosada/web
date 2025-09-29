<?php

function enviarEmail($destino, $asunto, $mensaje, $adjunto = [])
{
    $destino = 'jhonatan.soporte98@gmail.com';
    include_once dirname(__DIR__) . '/vendor/PHPMailer/src/Exception.php';
    include_once dirname(__DIR__) . '/vendor/PHPMailer/src/PHPMailer.php';
    include_once dirname(__DIR__) . '/vendor/PHPMailer/src/SMTP.php';
    //
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->SetLanguage("es", 'phpmailer/language/');

    if (!defined('SERVER_EMAIL_HOST') || !defined('SERVER_EMAIL_PORT') || !defined('SERVER_EMAIL_USERNAME') || !defined('SERVER_EMAIL_PASSWORD') || !defined('NOMBRE_ADM_PLATAFORMA') || !defined('EMAIL_ADM_PLATAFORMA')) {
        echo 'No se ha configurado el servicio SMTP';
        exit();
    }
    try {
        $mail->IsSMTP();
        $mail->Host = SERVER_EMAIL_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = SERVER_EMAIL_USERNAME;
        $mail->Password = SERVER_EMAIL_PASSWORD;
        $mail->SMTPSecure = SERVER_EMAIL_SECURE;
        $mail->Port = SERVER_EMAIL_PORT;
        //
        $mail->From = EMAIL_ADM_PLATAFORMA;
        $mail->FromName = NOMBRE_ADM_PLATAFORMA;
        //
        if (is_array($destino)) {
            foreach (array_unique($destino) as $dest) {
                if (!empty($dest)) {
                    $dest = trim($dest);
                    $dest = str_replace(" ", "", $dest);
                    $mail->AddAddress($dest);
                }
            }
        } else {
            if (!empty($destino)) {
                $destino = trim($destino);
                $destino = str_replace(" ", "", $destino);
                $mail->AddAddress($destino);
            }
        }
        $mail->WordWrap = 50;
        if (!empty($adjunto)) {
            foreach ($adjunto as $attach) {
                $mail->AddAttachment($attach);
            }
        }
        $mail->IsHTML(true);
        $mail->CharSet = 'UTF-8';
        $asunto = "=?UTF-8?B?" . base64_encode($asunto) . "=?=";
        $mail->Subject = $asunto;
        $mail->Body = $mensaje;
        //
        if (!$mail->Send()) {
            echo  '1-Error enviando el recibo al email. Detalle del error => ' . $mail->ErrorInfo . ' \n';
            exit();
        }
    } catch (Exception $e) {
        echo  '2-Error enviando el email. Detalle del error => ' . $mail->ErrorInfo . '\n';
        exit();
    }
    echo  'good';
    exit();
}
