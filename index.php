<?php 

require_once './vendor/autoload.php';
require_once './incs/function.php';
require_once './incs/data.php';

if(!empty($_POST)){
    $field = load($fields);
	// debug(validate($field));
    if($err = validate($field)){
        $res = ["answer"=>"error", "error"=>$err];
    }else{
        if(!send_mail($field, $mail_settings)){
            $res = ["answer"=>"error", "data"=>$field, "error"=>"message is not seNd"];
        }else{
            $res = ["answer"=>"good", "data"=>$field];
        }
    }    
    exit(json_encode($res));
}

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./incs/style.css">
 	<title>Form 3</title>
 </head>
 <body>
 	<form method="post" class='form'>
 		<label for="name">имя</label>
 		<input  id='name' type="text" name="name" placeholder="имя"><br>
 		<label for='email'>эл. почта</label>
 		<input type="email" name="email" placeholder="эл. почта"><br>
 		<label for="text">текст</label>
 		<textarea id='text' name='text' placeholder="введите текст"></textarea><br>
 		<input type="submit" class='btn' value="send">
        <div class='loader'>
            <img src="./incs/spin.svg">
        </div>
    </form>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="  crossorigin="anonymous"></script>
    <script src='./incs/main.js'></script>
 </body>
 </html>