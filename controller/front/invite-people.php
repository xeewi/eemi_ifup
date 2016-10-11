<?php
    if(isset($_SESSION['user'])){
        if(isset($_POST['submit_form_invite'])){
            if(filter_var($_POST['ifup_user_email'], FILTER_VALIDATE_EMAIL) && !empty($_POST['ifup_user_email'])){
                $message_html = '<html>
                                <body>
                                <h2>Bonjour,</h2>'
                                    . $_SESSION['user']["ifup_user_firstname"].' '. $_SESSION['user']["ifup_user_lastname"] .' souhaite vous inviter à rejoindre la communauté IFUP !
                                    Vous pouvez vous inscrire directement sur le site en cliquant sur "S\'inscrire" à l\'adresse suivante :
                                <a href="'.WEBSITE_URL.'index.php?module=front&amp;action=index">ifup.fr</a>
                                </body>
                            </html>';

                $message_text = 'Bonjour,'
                . $_SESSION['user']["ifup_user_firstname"].' '. $_SESSION['user']["ifup_user_lastname"] .' souhaite vous inviter à rejoindre la communauté IFUP !
                Vous pouvez vous inscrire directement sur le site en cliquant sur "S\'inscrire" à l\'adresse suivante :
                '.WEBSITE_URL.'index.php?module=front&amp;action=index';

                $recipient_mail = $_POST["ifup_user_email"];
                $subject = $_SESSION['user']["ifup_user_firstname"]. " vous invite sur IFUP.fr";
                $sender_name = "ifup";
                $sender_mail = "contact@ifup.fr";

                $send_mail = xp_send_mail($sender_mail, $recipient_mail, $subject, $message_html, $message_text , $sender_name);

                if($send_mail){
                    $_SESSION['flash']['success'] .= 'Une invitation à rejoindre la communauté a été envoyée à l\'adresse '. $_POST['ifup_user_email'] . '<br/>';
                    header("Location:?module=front&action=index");
                    exit();
                }
                else{
                    $_SESSION['flash']['warning'] .= "L'envoi de l'invitation a échoué. Veuillez réessayer.";
                    header("location: index.php?module=front&amp;action=index");
                    exit();
                }
            }
            else{
                $_SESSION['flash']['warning'] .= "L'email que vous avez saisi est incorrect.";
                header("location: index.php?module=front&amp;action=index");
                exit();
            }
        }
        else{
            $_SESSION['flash']['danger'] .= "Vous devez vous connecter pour accéder à cette partie du site.";
            header("location: index.php?module=front&amp;action=index");
            exit();
        }
    }
    else{
        $_SESSION['flash']['danger'] .= "Vous devez vous connecter pour accéder à cette partie du site.";
        header("location: index.php?module=front&amp;action=index");
        exit();
    }