<?php
    //when it's the first time the user come to change his password : we retrieve his email and send him a message with a link with
    //a token and then he can change his password on the same view(there is a isset($_get token) in the view to display the mail form or the password form.
    if(isset($_POST["ifup_user_email"])){
        include_once('model/user/select_user_by_email.php');
        $mail_has_user = select_user_by_email($_POST["ifup_user_email"]);
        if($mail_has_user){
            $token = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 60);
            $email = $_POST["ifup_user_email"];

            include_once('model/user/update_password_to_token.php');
            $update_password_to_token = update_password_to_token($email, $token);
            if($update_password_to_token){
                $message_html = '<html>
                                <body>
                                Vous avez oublié votre mot de passse ? Veuillez cliquer sur le lien suivant pour changer votre mot de passe:
                                <a href="http://gautierg.etudiant-eemi.com/perso/ifup/index.php?module=user&amp;action=forgot-password&token='.$token.'">Réinitialiser son mot de passe</a>
                                </body>
                            </html>';

                $message_text = 'Vous avez oublié votre mot de passse ? Veuillez cliquer sur le lien suivant pour changer votre mot de passe:
                                http://gautierg.etudiant-eemi.com/perso/ifup/index.php?module=user&amp;action=forgot-password&token='.$token;

                $recipient_mail = $_POST["ifup_user_email"];
                $subject = "Reinitialiser votre mot de passe IFUP";
                $sender_name = "ifup";
                $sender_mail = "contact@ifup.fr";

                $send_mail = xp_send_mail($sender_mail, $recipient_mail, $subject, $message_html, $message_text , $sender_name);

                $_SESSION['flash']['success'] = 'Un lien pour réinitialiser votre mot de passe vous a été envoyé!';
                header("Location:?module=front&action=index");
                exit();
            }
            else{
                $_SESSION['flash']['danger'] = 'Echec de la création du mot de passe temporaire. Veuillez réessayer.';
                header("Location:index.php?module=user&action=forgot-password");
                exit();
            }
        }
        else{
            $_SESSION['flash']['danger'] = "Cet email n'existe pas";
            header("Location:?module=user&action=forgot-password");
            exit();
        }
    } //when the user received the mail and come back with token and completes the form with his new password :
    elseif(isset($_POST["ifup_user_password"]) && $_POST["ifup_user_password"] == $_POST["ifup_user_password_confirmation"]){
        if(isset($_GET['token'])){
            include_once('model/user/update_new_password.php');
            $_POST["ifup_user_password"] = md5($_POST["ifup_user_password"]);

            $update_password = update_new_password($_GET['token'], $_POST["ifup_user_password"]);
            if($update_password && $update_password->rowCount() > 0){
                $_SESSION['flash']['success'] = 'Votre mot de passe a bien été réinitialisé!';
                header("Location:?module=front&action=index");
                exit();
            }
            else{
                $_SESSION['flash']['danger'] = "Nous n'avons pas pu prendre en compte votre nouveau mot de passe.<br/>
                                                Veuillez réessayer à nouveau.";
                header("Location:?module=user&action=forgot-password");
                exit();
            }
        }
        else{
            $_SESSION['flash']['danger'] = "Nous n'avons pas pu prendre en compte votre nouveau mot de passe.<br/>
                                                Veuillez réessayer à nouveau.";
            header("Location:?module=user&action=forgot-password");
            exit();
        }
    }
    else{
        include_once('view/user/forgot-password.php');
    }

