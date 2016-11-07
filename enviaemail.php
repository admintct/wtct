<?php

function cosemail($elmisqatge,$estil='',$adrecafirma = ''){
    if (empty($adrecafirma)){
        $adrecafirma = $GLOBALS['$destiemail'];
    }
    $ftorna = '<!DOCTYPE html><html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">'.
                '<head><title>email from TCT SL</title>'.$estil.'</head>'.
                '<body {font-family:verdana;}>'.
                $GLOBALS['logoemail'].
                '<div>'.
                $elmisqatge.
                '</div>'.
                '</br></br><font color="DarkBlue"><b>TCT SL</b></font>'.
                '</br></br><div><img border=0 hspace=0 alt="" src="http://www.tct.es/logo/icons/phone.png" align=baseline>&nbsp;&nbsp;&nbsp; +34 93 268 40 25</div>'.
                '<div><img border=0 hspace=0 alt="" src="http://www.tct.es/logo/icons/email.png" align=baseline>&nbsp;&nbsp;&nbsp; '.$adrecafirma.'</div> </body></html>';
    return $ftorna;
}


//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
function enviaemail($aquin,$nomaqui="TCT Web User",$subjecte="MAIL FROM TCT",$elhtml="MAIL FROM TCT",$eltxte="MAIL FROM TCT",$elsadjunts="",$efrom="info@tct.es",$nomfrom="TCT SL",$nom_cc="",$email_cc="",$estil=''){
    date_default_timezone_set('Etc/UTC');

    require 'PHPMailerAutoload.php';

    //Create a new PHPMailer instance
    $mail = new PHPMailer;
    $mail->CharSet = "UTF-8";
    //Tell PHPMailer to use SMTP
    $mail->isSMTP();
    //Enable SMTP debugging
    // 0 = off (for production use)
    // 1 = client messages
    // 2 = client and server messages
    $mail->SMTPDebug = 0;
    //Ask for HTML-friendly debug output
    $mail->Debugoutput = 'html';
    //Set the hostname of the mail server
    $mail->Host = '172.20.9.49'; //$GLOBALS['$smptserver'];
    //Set the SMTP port number - likely to be 25, 465 or 587
    $mail->Port = 25;
    //Whether to use SMTP authentication
    $mail->SMTPAuth = true;
    //Set the encryption system to use - ssl (deprecated) or tls
    $mail->SMTPSecure = '';
    //Username to use for SMTP authentication
    $mail->Username = "tino@tct.es";
    //Password to use for SMTP authentication
    $mail->Password = "arandano";
    //Set who the message is to be sent from
    $mail->setFrom($efrom, $nomfrom);
    //Set an alternative reply-to address
    $mail->addReplyTo($efrom, $nomfrom);
    //Set who the message is to be sent to
    if (strpos($aquin,'|')){
        $c = '*'; $xnom;
        $n = 1;
        while ($c){
            $c = camp($aquin, $n, '|');
            $n++;
            $xnom = camp($nomaqui, $n, '|');
            if ($c){
                $mail->addAddress($c, $xnom);
                $c = '';
            }
        }
    }
    else{
        $mail->addAddress($aquin, $nomaqui);
    }
    // CC
    if ($email_cc){
        $mail->AddCC($email_cc, $nom_cc);
    }
    //Set the subject line
    $mail->Subject = $subjecte;
    //Read an HTML message body from an external file, convert referenced images to embedded,
    //convert HTML into a basic plain-text alternative body
    //$mail->msgHTML(file_get_contents('C:\siscon\SC9\ACA\HTML\html.html'), dirname(__FILE__));
    $elmisatgehtml = stripslashes(cosemail($elhtml,$estil,$efrom)); 
    $mail->msgHTML($elmisatgehtml);
    $mail->IsHTML(true);

    //Replace the plain text body with one created manually
    $mail->AltBody = $eltxte;
    //Attach an image file
    if ($elsadjunts){
        $arat = explode('|', $elsadjunts);
        foreach ($arat as $artmp) {
            if (file_exists($artmp)){
                $mail->addAttachment($artmp);
            }
        }
    }

    //send the message, check for errors
    if (!$mail->send()) {
        return "Email Error: " . $mail->ErrorInfo;
    } else {
        return "";
    }
}

?>