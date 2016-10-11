<?php
    if(isset($_POST['submit_form_newsletter'])){
        if(filter_var($_POST['ifup_email'], FILTER_VALIDATE_EMAIL) && !empty($_POST['ifup_email']) ){

            include_once('model/front/select_verify_email_newsletter.php');
            $mail_exists = select_verify_email_newsletter($_POST['ifup_email']);

            if(!$mail_exists){
                include_once('model/front/insert_contact_newsletter.php');
                $insert_contact_newsletter = insert_contact_newsletter($_POST['ifup_email']);

                if($insert_contact_newsletter && $insert_contact_newsletter->rowCount() > 0){
                    $message_html = '<html>
                                <body>
                                <h2>Bonjour,</h2>
                                    Vous êtes bien inscrit à la newsletter de IFUP.
                                    Vous pouvez tout de même vous désinscrire en cliquant sur le lien suivant
                                <a href="' . WEBSITE_URL .'index.php?module=front&amp;action=newsletter&delete-email='. $_POST['ifup_email'] .'">Se désabonner</a>
                                </body>
                            </html>';
                    $message_text = 'Bonjour,
                    Vous êtes bien inscrit à la newsletter de IFUP.
                    Vous pouvez tout de même vous désinscrire en cliquant sur le lien suivant :
                    '.WEBSITE_URL.'index.php?module=front&amp;action=newsletter&delete-email='. $_POST['ifup_email'];

                    $recipient_mail = $_POST['ifup_email'];
                    $subject = "Inscription à la newsletter de IFUP";
                    $sender_name = "ifup";
                    $sender_mail = "contact@ifup.fr";

                    $send_mail = xp_send_mail($sender_mail, $recipient_mail, $subject, $message_html, $message_text , $sender_name);

                    if($send_mail){
                        $_SESSION['flash']['success'] .= 'Un mail de confirmation a été envoyé à l\'adresse '. $_POST['ifup_email'] .'<br/>';
                        header("Location:?module=front&action=index");
                        exit();
                    }
                    else{
                        $_SESSION['flash']['danger'] .= "L'envoi du mail de confirmation a échoué mais vous êtes bien abonné à la newsletter.<br/>";
                        header("location: index.php?module=front&amp;action=index");
                        exit();
                    }
                }
                else{
                    $_SESSION['flash']['warning'] .= "Votre inscription à la newsletter a échoué. Veuillez réessayer.<br/>";
                    header("location: index.php?module=front&action=index");
                    exit();
                }
            }
            else{
                $_SESSION['flash']['warning'] .= "Cet email est déjà inscrit à la newsletter.<br/>";
                header("location: index.php?module=front&action=index");
                exit();
            }
        }
        else{
            $_SESSION['flash']['warning'] .= "Vous devez saisir une adresse email valide.<br/>";
            header("location: index.php?module=front&action=index");
            exit();
        }
    }
    elseif(isset($_GET['delete-email'])){
        if(filter_var($_GET['delete-email'], FILTER_VALIDATE_EMAIL)){
            include_once('model/front/delete_contact_newsletter.php');
            $delete_contact_newsletter = delete_contact_newsletter($_GET['delete-email']);

            if($delete_contact_newsletter && $delete_contact_newsletter->rowCount() > 0){
                $_SESSION['flash']['success'] .= 'Vous êtes bien désabonné à la newsletter.<br/>';
                header("Location:?module=front&action=index");
                exit();
            }
            else{
                $_SESSION['flash']['danger'] .= 'Le désabonnement a échoué.<br/>';
                header("Location:?module=front&action=index");
                exit();
            }
        }
    }else{
        header("location: index.php?module=front&action=index");
        exit();
    }