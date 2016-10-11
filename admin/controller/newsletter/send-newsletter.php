<?php
    if(isset($_SESSION['admin'])) {
        if(isset($_GET["newsletter"])){
            include_once('model/newsletter/select_newsletter.php');
            $newsletter = select_newsletter($_GET['newsletter']);

            if($newsletter){
                include_once('model/newsletter/select_contacts.php');
                $contacts = select_contacts();
                if($contacts){
                    include_once('model/newsletter/update_newsletter_date.php');
                    $set_send = update_newsletter_date($_GET['newsletter']);
                    if($set_send && $set_send->rowCount() > 0){
                        $_SESSION['flash']['danger'] = null;// pour concatener tous les warnings, danger, success

                        $message_text = 'Bonjour,
                        Vous êtes bien inscrit à la newsletter de IFUP. Cependant, celle-ci n\'a pas pu s\'afficher correctement.
                        Nous vous conseillons de visualiser la newsletter avec une adresse gmail pour l\'instant.';

                        $subject = $newsletter["ifup_newsletter_object"];
                        $sender_name = "IFUP";
                        $sender_mail = "contact@ifup.fr";


                        foreach($contacts as $key => $contact){
                            $recipient_mail = $contact["ifup_contact_email"];
                            $message_html = preg_replace('/ifup_contact_email/', $contact["ifup_contact_email"], $newsletter["ifup_newsletter_content"]);

                            if($message_html){
                                $send_mail = xp_send_mail($sender_mail, $recipient_mail, $subject, $message_html, $message_text , $sender_name);
                                if(!$send_mail){
                                    $_SESSION['flash']['danger'] .= "L'envoi de la newsletter a échoué pour le mail : ". $recipient_mail .".<br/>";
                                }
                            }
                            else{
                                $_SESSION['flash']['danger'] .= "L'envoi de la newsletter a échoué pour le mail : ". $recipient_mail .".<br/>";
                            }
                        }
                        $_SESSION['flash']['success'] = "L'envoi de la newsletter a été effectué<br/>";
                        header("location: index.php?module=newsletter&amp;action=index");
                        exit();
                    }
                    else{
                        $_SESSION['flash']['danger'] = "L'envoi de la newsletter a échoué.<br/>";
                        header("location: index.php?module=newsletter&action=index");
                        exit();
                    }
                }
                else{
                    $_SESSION['flash']['warning'] = "Aucune personne n'est inscrite à la newsletter. Il est donc impossible d'envoyer la newsletter.";
                    header('Location: index.php?module=newsletter&action=index');
                    exit();
                }
            }
            else{
                $_SESSION['flash']['warning'] = "Nous n'avons pas pu charger les informations de la newsletter.";
                header('Location: index.php?module=newsletter&action=index');
                exit();
            }
        }
        else{
            header('Location: index.php?module=newsletter&action=index');
            exit();
        }
    }
    else{
        $_SESSION['flash']['danger'] = "Vous devez vous connecter pour accéder à cette partie du site.";
        header('Location: index.php?module=user-admin&action=login');
        exit();
    }