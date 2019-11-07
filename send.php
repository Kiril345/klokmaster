<?php
//проверяем значения полученые при проверке скриптом формы

		//$txtname = trim($_POST['txtname']);

		//$txtemail = trim($_POST['txtemail']);

		//$txtphone = trim($_POST['txtphone']);

		//$txtmessage = trim($_POST['txtmessage']);

		// от кого
		//$fromMail = 'servisbas';


		// Сюда введите Ваш email
		//$emailTo = 'servisbas.odessa@gmail.com';


		//$subject = 'Форма обратной связи';
		//$subject = '=?utf-8?b?'. base64_encode($subject) .'?=';
		//$headers = "Content-type: text/plain; charset=\"utf-8\"\r\n";
		//$headers .= "From: ". $fromName ." <". $fromMail ."> \r\n";

		// тело письма
		//$body = "Получено письмо с сайта servisbas.org.ua\n\nИмя: $txtname\nТелефон: $txtphone\ne-mail: $txtemail\nСообщение: $txtmessage";
		//$mail = mail($emailTo, $subject, $body, $headers, '-f'. $fromMail );




        $_POST['txtmessage'] =  substr(htmlspecialchars(trim($_POST['txtmessage'])), 0, 1000000);

        $_POST['txtname'] =  substr(htmlspecialchars(trim($_POST['txtname'])), 0, 30);

        $_POST['txtphone'] =  substr(htmlspecialchars(trim($_POST['txtphone'])), 0, 30);

        $_POST['txtemail'] =  substr(htmlspecialchars(trim($_POST['txtemail'])), 0, 50);

        $mess = '<b>Имя клиента:</b>'.$_POST['txtname'].'<br /><b>Контактный телефон:</b>'.$_POST['txtphone'].'<br /><b>Контактный email:</b>'.$_POST['txtemail'].'<br /><br /><b>Сообщение:</b>'.$_POST['txtmessage'];
        require 'class.phpmailer.php';
        $mail = new PHPMailer();       // от кого
        $mail->FromName = 'klockmaster';   // от кого
        $mail->AddAddress('pershukow@gmail.com'); // кому - адрес, Имя
        $mail->IsHTML(true);        // выставляем формат письма HTML
        $mail->Subject = 'Сообщение с сайта';                              // тема письма
		if(isset($_FILES['fileff'])) {
                 if($_FILES['fileff']['error'] == 0){
                    $mail->AddAttachment($_FILES['fileff']['tmp_name'], $_FILES['fileff']['name']);
                 }
        }
        // если было изображение, то прикрепляем его в виде картинки к телу письма.

        $mail->Body = $mess;

        // отправляем наше письмо
        if (!$mail->Send()) die ('Mailer Error: '.$mail->ErrorInfo);
        echo 'ok';

?>
