<?php 

function debug($data){
	echo "<pre>";
	print_r($data);
};
function load($data){
	foreach ($_POST as $k => $v) {
		if(array_key_exists($k, $data)){
			$data[$k]['value'] = $v;
		}
	}
	return $data;
};
function validate($data){
	$errors = '';
	foreach($data as $k => $v){
		if($data[$k]['required'] && empty($data[$k]['value'])){
			$errors.="<li> не заполнено поле ".$data[$k]['field_name']."</li>";
		}
	}
	return $errors;
};
function send_mail($field, $mail_settings){
	$mail = new PHPMailer\PHPMailer\PHPMailer();

	try{
		$mail->SMTPDebug = 0;
		$mail->isSMTP();
	    $mail->Host=$mail_settings['host'];
	    $mail->SMTPAuth=$mail_settings['smtp_auth'];
	    $mail->Username=$mail_settings['username'];
	    $mail->Password=$mail_settings['password'];
        $mail->SMTPSecure=$mail_settings['smtp_secure'];
    	$mail->Port=$mail_settings['port'];

    	$mail->setFrom($mail_settings['from_email'], $mail_settings['from_name']);
	    $mail->addAddress($mail_settings['to_email']);

	    $mail->isHTML(true);
	    $mail->Charset = 'UTF-8';
	    $mail->Subject = 'Here is the subject toPic';
	    $message = $field["text"]["value"];
	    $mail->Body = $message;
	    $mail->send();
	    return true;
	} catch (Exception $e) {
    	echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}
	return false;
}



 ?>