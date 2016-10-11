<?php
// FUNCTION LIMIT TEXT :
function limit_text($text, $limit){
    if(str_word_count($text, 0)> $limit){
        $words = str_word_count($text,2);
        $pos = array_keys($words);
        $text = substr($text,0,$pos[$limit]). '...';
    }
    return $text;
}
// FUNCTION SESSION :
    function secu_session_start($name = ""){
        session_name($name);
        session_start();
        //HTTP_X... récup l'ip du client si il passe par un proxy et REMOTE_ADDR récup l'ip du client s'il passe sans un proxy.
        //on doit prévoir les 2 cas pour récup l'ip.
        $ip = !empty($_SERVER["HTTP_X_FORWARDED_FOR"]) ? $_SERVER["HTTP_X_FORWARDED_FOR"] : $_SERVER["REMOTE_ADDR"];

        $security = $ip . $_SERVER["HTTP_USER_AGENT"];

        if(empty($_SESSION)){
            $_SESSION['security'] = $security;
            //echo '<p>session vide ! on enregistre la chaine de sécurité</p>';
            return true;
        }
        elseif($_SESSION['security'] != $security){
            //on regénère la session puis on la vide si $security est différent de celui qu'on a stocké précédemment dans la session.
            //ca veut dire que quelqu'un essaie de se connecter depuis un autre device et/ou navigateur.
            session_regenerate_id();
            $_SESSION = array();
            //echo '<p>session corrompue, on la regénère et la vide</p>';
            return false;
        }
        else{
            return true;
        }
    }

// FUNCTION MAIL :
    function xp_send_mail($sender_mail, $recipient_mail, $subject, $message_html, $message_text, $sender_name = "", $reply_mail = "", $attach_file = ""){
        // Générer la frontière entre texte, html et pièce jointe

        $border = md5(uniqid(mt_rand()));

        if ($sender_name != "") {
            $header = 'from: "'.$sender_name.'" <'.$sender_mail.'>'."\r\n";
        } else {
            $header = 'from: "'.$sender_mail.'" <'.$sender_mail.'>'."\r\n";
        }

        if ($reply_mail != "") {
            $header .= 'Return-Path: <'.$reply_mail.'>'."\r\n";
        } else {
            $header .= 'Return-Path: <'.$sender_mail.'>'."\r\n";
        }

        $header .= 'MIME-Version: 1.0'."\r\n";
        $header .= 'Content-Type: multipart/mixed; boundary="'.$border.'"';

    //text or html or both :
        if (!empty($message_text) && empty($message_html)) {
            $content = 'This is a multi-part message in MIME format\r\n';
            $content .= '--' .$border. "\r\n";
            $content .= 'Content-Type: text/plain; charset="utf-8"'."\r\n";
            $content .= 'Content-Transfert-Encoding: 8bit'."\r\n";
            $content .= $message_text."\r\n";
        }
        elseif(!empty($message_text) && !empty($message_html)){
            $content = 'This is a multi-part message in MIME format\r\n';
            $content .= '--'.$border."\r\n";
            $content .= 'Content-Type: text/plain; charset="utf-8"'."\r\n";
            $content .= 'Content-Transfert-Encoding: 8bit'."\r\n";
            $content .= $message_text."\r\n";

            //les 2 content-type html et text pcq certains mails n'interpretent pas le html.
            $content .= '--' .$border. "\r\n";
            $content .= 'Content-Type: text/html; charset="utf-8"'."\r\n";
            $content .= 'Content-Transfert-Encoding: 8bit'."\r\n";
            $content .= $message_html."\r\n";
        }
        elseif(empty($message_text) && !empty($message_html)){
            $content = 'This is a multi-part message in MIME format\r\n';
            $content .= '--' .$border. "\r\n";
            $content .= 'Content-Type: text/html; charset="utf-8"'."\r\n";
            $content .= 'Content-Transfert-Encoding: 8bit'."\r\n";
            $content .= $message_html."\r\n";
        }
        else{
            $content = 'This is a multi-part message in MIME format\r\n';
            $content .= '--' .$border. "\r\n";
            $content .= 'Content-Type: text/plain; charset="utf-8"'."\r\n";
            $content .= 'Content-Transfert-Encoding: 8bit'."\r\n";
            $content .= $message_html."\r\n";
        }


        if ($attach_file != ''){

            $tab_attach_file = explode(';',$attach_file);
            $nb_attach_file = count($tab_attach_file);

            for($i=0 ; $i < $nb_attach_file ; $i++){

                if (file_exists($tab_attach_file[$i])) {

                    $type = filetype($tab_attach_file[$i]);

                    $name = explode('/', $tab_attach_file[$i]);
                    $max = max(array_keys($name));

                    $content .= '--'.$border."\r\n";
                    $content .= 'Content-Type: '.$type.'; name="'.$name[$max].'"'."\r\n";
                    $content .= 'Content-Transfer-Encoding: base64'."\r\n\r\n";
                    $content .= 'Content-Disposition:attachment; filename="'.$name[$max].'"'."\r\n";

                    $content .= chunk_split(base64_encode(file_get_contents($tab_attach_file[$i])))."\r\n";

                }
            }
        }

        if(mail($recipient_mail, $subject, $content, $header))
        {
            return true;
        }
        else
        {
            return false;
        }
    }


//FUNCTION UPLOAD :
    function xp_upload_file($file, $allowed_exts, $content_dir, $max_size = 1000000, $width = 300, $height = 300){
        if( isset($_FILES[$file]) && $_FILES[$file]['error'] == 0 )
        {
            //create upload dir if not exists :
            if(!file_exists($content_dir)){
                mkdir($content_dir);
            }

            if($max_size == NULL || empty($max_size)){
                $max_size = 1000000;
            }
            if($width == NULL || empty($width)){
                $width = 300;
            }
            if($height == NULL || empty($height)){
                $height = 300;
            }
            if ($_FILES[$file]['size'] <= $max_size) {

                $tmp_file = $_FILES[$file]['tmp_name'];
                //rename file to have a unique string
                $new_name = md5(uniqid(time(), true));

                //retrieve extension of the file : 3 methods :
                //1 : $type_file = basename($_FILES[$file]['type']);//pour recup que l'extension et non pas application/pdf
                //2 : $type_file = strtolower(substr(strrchr($_FILES[$file]['name'], '.'), 1));//strrchr trouve la derniere occurence du point dans la chaine et retourn la chaine qui suit. substr($file, 1) recup la chaine sans le point
                //3 : with pathinfo()
                $file_info = pathinfo($_FILES[$file]['name']);
                $type_file = strtolower($file_info['extension']);

                $path = $content_dir . $new_name . '.'. $type_file;

                if (!is_uploaded_file($tmp_file)) {
                    return false;
                }else{
                    if (in_array($type_file, $allowed_exts )) {
                        if(in_array($type_file, ['pdf', 'xlsx', 'xls', 'ppt', 'pptx', 'doc', 'docx', 'gif', 'svg'])){

                            if (move_uploaded_file($tmp_file,$path)) {
                                return $path;
                            } else {
                                return false;
                            }
                        }
                        else{
                            $origin_size = getimagesize($tmp_file);

                            if($origin_size[0] >= $origin_size[1]){
                                $ratio = $origin_size[0] / $origin_size[1];
                            } else{
                                $ratio = $origin_size[1] / $origin_size[0];
                            }

                            if($width > $height){
                                $new_width = $width;

                                $new_height = $new_width / $ratio;
                            }else{
                                $new_height = $height;

                                $new_width = $new_height / $ratio;
                            }

                            switch ($type_file) {
                                case 'jpeg':
                                case 'jpg':
                                    $origin_file = imagecreatefromjpeg($tmp_file);//retourne un identifiant d'image représentant une image obtenue à partir du fichier filename.
                                    $new_img = imagecreatetruecolor($new_width , $new_height);// créer une nouvelle image avec les dimensions qu'on veut (elle est vide CAD noire)
                                    imagecopyresized($new_img , $origin_file, 0, 0, 0, 0, $new_width, $new_height, $origin_size[0],$origin_size[1]);//fout les bonnes dimensions dans la nouvelle image

                                    if(imagejpeg($new_img, $path)){//enregistre, déplace vers le dossier voulu et renomme l'img.
                                        imagedestroy($origin_file);
                                        return $path;
                                    }
                                    else{
                                        return false;
                                    }
                                    break;
                                case 'png':

                                    $origin_file = imagecreatefrompng($tmp_file);//retourne un identifiant d'image représentant une image obtenue à partir du fichier filename.
                                    $new_img = imagecreatetruecolor($new_width , $new_height);// créer une nouvelle image avec les dimensions qu'on veut (elle est vide CAD noire)
                                    imagecopyresized($new_img , $origin_file, 0, 0, 0, 0, $new_width, $new_height, $origin_size[0],$origin_size[1]);//fout les bonnes dimensions dans la nouvelle image

                                    if(imagepng($new_img, $path)){//enregistre, déplace vers le dossier voule et renomme l'img.
                                        imagedestroy($origin_file);
                                        return $path;
                                    }
                                    else{
                                        return false;
                                    }
                                    break;
                                case 'gif':
                                    $origin_file = imagecreatefromgif($tmp_file);//retourne un identifiant d'image représentant une image obtenue à partir du fichier filename.
                                    $new_img = imagecreatetruecolor($new_width , $new_height);// créer une nouvelle image avec les dimensions qu'on veut (elle est vide CAD noire)
                                    imagecopyresized($new_img , $origin_file, 0, 0, 0, 0, $new_width, $new_height, $origin_size[0],$origin_size[1]);//fout les bonnes dimensions dans la nouvelle image

                                    if(imagegif($new_img, $path)){//enregistre, déplace vers le dossier voule et renomme l'img.
                                        imagedestroy($origin_file);
                                        return $path;
                                    }
                                    else{
                                        return false;
                                    }
                                    break;
                                default:
                                    return $path;
                                    break;
                            }
                        }
                    }
                    else{
                        return false;
                    }
                }
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }