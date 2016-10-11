<?php
    if(isset($_POST['ifup_user_name']) && isset($_POST['ifup_user_message']) && isset($_POST['ifup_user_email'])){
        if(filter_var($_POST['ifup_user_email'], FILTER_VALIDATE_EMAIL) && !empty($_POST['ifup_user_email']) && !empty($_POST['ifup_user_message']) && !empty($_POST['ifup_user_name'])){
            $message_html = '<html>
                        <body>' . $_POST['ifup_user_message'] .'
                        </body>
                    </html>';

            $message_text = $_POST['ifup_user_message'];
            $recipient_mail = 'contact@ifup.fr';
            $subject = "Message sur le site IFUP";
            $sender_name = $_POST['ifup_user_name'];
            $sender_mail = $_POST["ifup_user_email"];

            $send_mail = xp_send_mail($sender_mail, $recipient_mail, $subject, $message_html, $message_text , $sender_name);
            if($send_mail){
                $_SESSION['flash']['success'] = 'Votre message a bien été envoyé.';
                header('Location: ?module=front&action=index');
                exit();
            }
            else{
                $_SESSION['flash']['danger'] = "L'envoi du message a échoué. Veuillez réessayer.";
                header('Location: ?module=front&action=contact');
                exit();
            }
        }
        else{
            $_SESSION['flash']['warning'] = "Certains champs sont incorrects. Veuillez réessayer.";
            header('Location: ?module=front&action=contact');
            exit();
        }
    }
    else{
        include_once('view/front/contact.php');
    }
