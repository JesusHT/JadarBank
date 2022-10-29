<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'Exception.php';
    require 'PHPMailer.php';
    require 'SMTP.php';

    class Email {
        private $email;
        private $name;
        private $host;
        private $password;

        function __construct(){
            $this -> email      = constant('ADRESS');
            $this -> name       = constant('NAME');
            $this -> host       = constant('HOST-MAIL');
            $this -> password   = constant('PASSWORD-MAIL');
        }

        public function sendMail($adress,$nameClient,$subject,$body){
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->SMTPDebug = 0;                                       //Enable verbose debug output (Mostrar errores -> SMTP::DEBUG_SERVER)
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = $this -> host;                          //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = $this -> email;                         //SMTP username
                $mail->Password   = $this -> password;                      //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom($this -> email, $this -> name);
                $mail->addAddress($adress, $nameClient);                    //Add a recipient

                //Content
                $mail->isHTML(true);                                         //Set email format to HTML
                $mail->Subject = $subject;

                $mail->Body = $body;
                
                $mail->send();  
                    
                return true;
                
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
    }
?>