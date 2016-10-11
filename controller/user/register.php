<?php
    if(isset($_POST['ifup_user_password']) && isset($_POST['ifup_user_email'])){

        include_once('model/user/select_verify_email.php');
        $email_exists = select_verify_email($_POST["ifup_user_email"]);

        if(!$email_exists)//if there is no email in the db we can add this user email
        {
            if(!empty($_POST["ifup_user_password"]) && $_POST["ifup_user_password"] == $_POST["ifup_user_confirm_password"] && !empty($_POST["ifup_user_email"]) && filter_var($_POST['ifup_user_email'], FILTER_VALIDATE_EMAIL) == true){
                $token = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 60);
                $_POST['ifup_user_password'] = md5($_POST['ifup_user_password']);

                include_once('model/user/insert_user.php');
                $insert_user = insert_user($_POST, $token);
                if($insert_user){
                    $message_html = '<html>
                                    <body>
                                    Merci pour votre inscription ! Veuillez confirmer votre compte en cliquant sur le lien suivant:
                                    <a href="http://gautierg.etudiant-eemi.com/perso/ifup/index.php?module=user&amp;action=first-settings&token='.$token.'">Confirmez votre compte</a>
                                    </body>
                                </html>';

                    $message_text = 'Merci pour votre inscription ! Veuillez confirmer votre compte en cliquant sur le lien suivant:
                                    http://gautierg.etudiant-eemi.com/perso/ifup/index.php?module=user&amp;action=first-settings&token='.$token;

                    $recipient_mail = $_POST["ifup_user_email"];
                    $subject = "validation de votre compte client ifup";
                    $sender_name = "ifup";
                    $sender_mail = "contact@ifup.fr";

                    $send_mail = xp_send_mail($sender_mail, $recipient_mail, $subject, $message_html, $message_text , $sender_name);

                    $_SESSION['flash']['success'] = 'Confirmez votre inscription via l\'email que nous vous avons envoyé!';
                    header('Location: ?module=front&action=index');
                    exit();
                }
                else{
                    $_SESSION['flash']['danger'] = 'Votre ajout a échoué. Veuillez réessayer';
                    header("Location:?module=front&action=index");
                    exit();
                }
            }
            else{
                $_SESSION['flash']['danger'] = 'Certains champs sont incorrects. Veuillez réeassayer';
                header("Location: index.php?module=front&action=index");
                exit();
            }
        }
        else{
            $_SESSION['flash']['danger'] = "Cet email existe déjà!";
            header("Location: index.php?module=front&action=index");
            exit();
        }
    }
    else{
        include_once("view/404.php");
    }