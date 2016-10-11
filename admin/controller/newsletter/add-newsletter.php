<?php
if(isset($_SESSION['admin'])){
    if(isset($_POST["submit_form_add_newsletter"])){//verif if form is submitted
        if(!empty($_POST["ifup_newsletter_title"])
            && !empty($_POST["ifup_newsletter_object"])
            && !empty($_POST["ifup_newsletter_section_1"])
            && !empty($_POST["ifup_newsletter_section_2"])
            && !empty($_POST["ifup_newsletter_url_section_1"])
            && filter_var($_POST["ifup_newsletter_url_section_1"], FILTER_VALIDATE_URL) == true
            && !empty($_POST["ifup_newsletter_url_name_section_1"])
            && !empty($_POST["ifup_newsletter_url_section_2"])
            && filter_var($_POST["ifup_newsletter_url_section_2"], FILTER_VALIDATE_URL) == true
            && !empty($_POST["ifup_newsletter_url_name_section_2"])
            && isset($_FILES['ifup_image_file_1']) && $_FILES["ifup_image_file_1"]['error'] == 0
            && isset($_FILES['ifup_image_file_2']) && $_FILES["ifup_image_file_2"]['error'] == 0
            ){//verif if form is valid


            //upload parameters :
            $allowed_exts = ["png", "jpeg", "jpg"];
            $content_dir = "../assets/upload/";

            $files = ['ifup_image_file_1', 'ifup_image_file_2'];

            $upload_files = array();
            $img_urls = array();
            foreach($files as $key => $file ){
                $upload_files[$key] = xp_upload_file($file, $allowed_exts, $content_dir, $max_size = 1000000, $width = 300, $height = 300);//return the path of the file ex : assets/upload/dehfize.jpg

                if($upload_files[$key]) {
                    /*================================================================================================
                    *****IMPORTANT - clean path of $upload_file (because we are not at the root of the website)*******
                    ================================================================================================*/
                    $divide_upload_file = explode('../',$upload_files[$key]);
                    $max = max(array_keys($divide_upload_file));
                    $upload_file_clean = $divide_upload_file[$max];//the path without the '../' !

                    $img_urls[$key] = WEBSITE_URL . $upload_file_clean;
                }
                else{
                    $_SESSION['flash']['danger'] = "Echec de l'ajout de l'image " . $key++ . ". Veuillez réessayer. L'ajout de l'image a échoué (à cause du format ou de la taille)<br/>";
                    header("Location: index.php?module=newsletter&action=add-newsletter");
                    exit();
                }
            }

            $title = ucfirst($_POST["ifup_newsletter_title"]);
            $object = ucfirst($_POST["ifup_newsletter_object"]);

            //set email of the current user contact to enable  désinscription :
            $contact_mail= "ifup_contact_email";

            $url_name_section_1 = ucfirst($_POST["ifup_newsletter_url_name_section_1"]);
            $url_name_section_2 = ucfirst($_POST["ifup_newsletter_url_name_section_2"]);

            $url_section_1 = $_POST["ifup_newsletter_url_section_1"];
            $url_section_2 = $_POST["ifup_newsletter_url_section_2"];

            $section_1 = $_POST["ifup_newsletter_section_1"];
            $section_2 = $_POST["ifup_newsletter_section_2"];

            $content ="<html xmlns=\"http://www.w3.org/1999/xhtml\">
       <head>
          <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
          <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\"/>
          <title>". $title ."</title>

          <style type=\"text/css\">
             /* Client-specific Styles */
             div, p, a, li, td { -webkit-text-size-adjust:none; }
             #outlook a {padding:0;} /* Force Outlook to provide a \"view in browser\" menu link. */
             html{width: 100%; }
             body{width:100% !important; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; margin:0; padding:0;}
             /* Prevent Webkit and Windows Mobile platforms from changing default font sizes, while not breaking desktop design. */
             .ExternalClass {width:100%;} /* Force Hotmail to display emails at full width */
             .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;} /* Force Hotmail to display normal line spacing. */
             #backgroundTable {margin:0; padding:0; width:100% !important; line-height: 100% !important;}
             img {outline:none; text-decoration:none;border:none; -ms-interpolation-mode: bicubic;}
             a img {border:none;}
             .image_fix {display:block;}
             p {margin: 0px 0px !important;}
             table td {border-collapse: collapse;}
             table { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; }
             a {color: #33b9ff;text-decoration:none!important;}
             /*STYLES*/
             table[class=full] { width: 100%; clear: both; }
             /*IPAD STYLES*/
             @media only screen and (max-width: 640px) {
                a[href^=\"tel\"], a[href^=\"sms\"] {
                text-decoration: none;
                color: #33b9ff; /* or whatever your want */
                pointer-events: none;
                cursor: default;
                }
                .mobile_link a[href^=\"tel\"], .mobile_link a[href^=\"sms\"] {
                   text-decoration: default;
                   color: #33b9ff !important;
                   pointer-events: auto;
                   cursor: default;
                }
                table[class=devicewidth] {width: 440px!important;text-align:center!important;}
                table[class=devicewidthinner] {width: 420px!important;text-align:center!important;}
                img[class=banner] {width: 440px!important;height:220px!important;}
                img[class=col2img] {width: 440px!important;height:220px!important;}
             }
             /*IPHONE STYLES*/
             @media only screen and (max-width: 480px) {
                a[href^=\"tel\"], a[href^=\"sms\"] {
                text-decoration: none;
                color: #33b9ff; /* or whatever your want */
                pointer-events: none;
                cursor: default;
                }
                .mobile_link a[href^=\"tel\"], .mobile_link a[href^=\"sms\"] {
                text-decoration: default;
                color: #33b9ff !important;
                pointer-events: auto;
                cursor: default;
                }
                table[class=devicewidth] {width: 280px!important;text-align:center!important;}
                table[class=devicewidthinner] {width: 260px!important;text-align:center!important;}
                img[class=banner] {width: 280px!important;height:140px!important;}
                img[class=col2img] {width: 280px!important;height:140px!important;}
             }
          </style>
       </head>
       <body>
          <!-- Start of preheader -->
          <table width=\"100%\" bgcolor=\"#fcfcfc\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" id=\"backgroundTable\" st-sortable=\"preheader\" >
             <tbody>
                <tr>
                   <td>
                      <table width=\"600\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\" class=\"devicewidth\">
                         <tbody>
                            <tr>
                               <td width=\"100%\">
                                  <table width=\"600\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\" class=\"devicewidth\">
                                     <tbody>
                                        <!-- Spacing -->
                                        <tr>
                                           <td width=\"100%\" height=\"20\"></td>
                                        </tr>
                                        <!-- Spacing -->
                                        <tr>
                                           <td width=\"100%\" align=\"left\" valign=\"middle\" style=\"font-family: Helvetica, arial, sans-serif; font-size: 13px; color: #282828\" st-content=\"preheader\">
                                              Visualiser cet email directement sur <a href=\"". WEBSITE_URL."\" style=\"text-decoration: none; color: #8981bc\">IFUP</a>
                                           </td>
                                        </tr>
                                        <!-- Spacing -->
                                        <tr>
                                           <td width=\"100%\" height=\"20\"></td>
                                        </tr>
                                        <!-- Spacing -->
                                     </tbody>
                                  </table>
                               </td>
                            </tr>
                         </tbody>
                      </table>
                   </td>
                </tr>
             </tbody>
          </table>
          <!-- End of preheader -->
          <!-- Start of header -->
          <table width=\"100%\" bgcolor=\"#fcfcfc\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" id=\"backgroundTable\" st-sortable=\"header\">
             <tbody>
                <tr>
                   <td>
                      <table width=\"600\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\" class=\"devicewidth\">
                         <tbody>
                            <tr>
                               <td width=\"100%\">
                                  <table width=\"600\" bgcolor=\"#f5f5f5\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\" class=\"devicewidth\">
                                     <tbody>
                                        <tr>
                                           <td>
                                              <!-- logo -->
                                              <table bgcolor=\"#f5f5f5\" width=\"140\" align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"devicewidth\">
                                                 <tbody>
                                                    <tr>
                                                       <td bgcolor=\"#f5f5f5\" width=\"140\" height=\"50\" align=\"center\">
                                                          <div class=\"imgpop\">
                                                             <a target=\"_blank\" href=\"http://ifup.fr\">
                                                             <img src=\"https://lut.im/E2WqXfvKID/Q5TpWOXe6AIpLYxk.png\" height=\"47\" style=\"display:block; border:none; outline:none; text-decoration:none;\">
                                                             </a>
                                                          </div>
                                                       </td>
                                                    </tr>
                                                 </tbody>
                                              </table>
                                              <!-- end of logo -->
                                              <!-- start of menu -->
                                              <table bgcolor=\"#5ebab2\" width=\"250\" height=\"50\" border=\"0\" align=\"right\" valign=\"middle\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"devicewidth\">
                                                 <tbody bgcolor=\"#5ebab2\">
                                                    <tr>
                                                       <td bgcolor=\"#5ebab2\" height=\"50\" align=\"center\" valign=\"middle\" style=\"font-family: Helvetica, arial, sans-serif; font-size: 13px;color: #fff\" st-content=\"menu\">
                                                          <a href=\"". WEBSITE_URL."\" style=\"color: #fff;text-decoration: none;\">Accueil</a>
                                                          &nbsp;&nbsp;&nbsp;
                                                          <a href=\"mailto:contact@ifup.fr\" style=\"color: #fff;text-decoration: none;\">Contact</a>
                                                          &nbsp;&nbsp;&nbsp;
                                                          <a href=\"https://www.facebook.com/IFUP-1702596323310442/\" style=\"color: #fff;text-decoration: none;\">Facebook</a>
                                                          &nbsp;&nbsp;&nbsp;
                                                       </td>
                                                    </tr>
                                                 </tbody>
                                              </table>
                                              <!-- end of menu -->
                                           </td>
                                        </tr>
                                     </tbody>
                                  </table>
                               </td>
                            </tr>
                         </tbody>
                      </table>
                   </td>
                </tr>
             </tbody>
          </table>
          <!-- End of Header -->
          <!-- Start of seperator -->
          <table width=\"100%\" bgcolor=\"#fcfcfc\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" id=\"backgroundTable\" st-sortable=\"seperator\">
             <tbody>
                <tr>
                   <td>
                      <table width=\"600\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" class=\"devicewidth\">
                         <tbody>
                            <tr>
                               <td align=\"center\" height=\"30\" style=\"font-size:1px; line-height:1px;\"><img src=\"https://lut.im/8YRuuJFjgj/2GarhktIPK7CJmyk.png\" alt=\"application mobile\" height=\"auto\" width=\"100%\"></td>
                            </tr>
                         </tbody>
                      </table>
                   </td>
                </tr>
             </tbody>
          </table>
          <!-- End of seperator -->
          <!-- Start of main-banner -->
          <!-- End of main-banner -->


          <!-- End of seperator -->
          <!-- start of Full text -->



          <!-- Start of seperator -->
          <table width=\"100%\" bgcolor=\"#fcfcfc\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" id=\"backgroundTable\" st-sortable=\"seperator\">
             <tbody>
                <tr>
                   <td>
                      <table width=\"600\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" class=\"devicewidth\">
                         <tbody>
                            <tr>
                               <td align=\"center\" height=\"30\" style=\"font-size:1px; line-height:1px;\">&nbsp;</td>
                            </tr>
                         </tbody>
                      </table>
                   </td>
                </tr>
             </tbody>
          </table>
          <!-- End of seperator -->
          <!-- Start of Left Image -->
          <table width=\"100%\" bgcolor=\"#fcfcfc\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" id=\"backgroundTable\" st-sortable=\"left-image\">
             <tbody>
                <tr>
                   <td>
                      <table width=\"600\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\" class=\"devicewidth\">
                         <tbody>
                            <tr>
                               <td width=\"100%\">
                                  <table width=\"600\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\" class=\"devicewidth\">
                                     <tbody>
                                        <tr>
                                           <td>
                                              <!-- Start of left column -->
                                              <table width=\"280\" align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"devicewidth\">
                                                 <tbody>
                                                    <!-- image -->
                                                    <tr>
                                                       <td width=\"280\" height=\"140\" align=\"center\" class=\"devicewidth\">
                                                          <img src=\"" . $img_urls[0] . "\" alt=\"\" border=\"0\" width=\"280\" height=\"140\" style=\"display:block; border:none; outline:none; text-decoration:none;\" class=\"col2img\">
                                                       </td>
                                                    </tr>
                                                    <!-- /image -->
                                                 </tbody>
                                              </table>
                                              <!-- end of left column -->
                                              <!-- spacing for mobile devices-->
                                              <table align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"mobilespacing\">
                                                 <tbody>
                                                    <tr>
                                                       <td width=\"100%\" height=\"15\" style=\"font-size:1px; line-height:1px; mso-line-height-rule: exactly;\">&nbsp;</td>
                                                    </tr>
                                                 </tbody>
                                              </table>
                                              <!-- end of for mobile devices-->
                                              <!-- start of right column -->
                                              <table width=\"280\" align=\"right\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"devicewidth\">
                                                 <tbody>
                                                    <tr>
                                                       <td>
                                                          <table width=\"280\" align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"devicewidth\">
                                                             <tbody>
                                                                <!-- title -->
                                                                <tr>
                                                                   <td style=\"font-family: Helvetica, arial, sans-serif; font-size: 18px; color: #282828; text-align:left; line-height: 24px;\">
                                                                      " . $section_1. "
                                                                   </td>
                                                                </tr>
                                                                <!-- end of title -->

                                                                <!-- read more -->
                                                                <tr>
                                                                   <td>
                                                                      <table width=\"120\" height=\"32\" bgcolor=\"#5ebab2\" align=\"left\" valign=\"middle\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-radius:3px;\" st-button=\"learnmore\">
                                                                         <tbody>
                                                                            <tr>
                                                                               <td  bgcolor=\"#5ebab2\" height=\"9\" align=\"center\" style=\"font-size:1px; line-height:1px;\">&nbsp;</td>
                                                                            </tr>
                                                                            <tr>
                                                                               <td  bgcolor=\"#5ebab2\" height=\"14\" align=\"center\" valign=\"middle\" style=\"font-family: Helvetica, Arial, sans-serif; font-size: 13px; font-weight:bold;color: #ffffff; text-align:center; line-height: 14px; ; -webkit-text-size-adjust:none;\" st-title=\"fulltext-btn\">
                                                                                  <a style=\"text-decoration: none;color: #fff; text-align:center;\" href=\"". $url_section_1 ."\">". $url_name_section_1 ."</a>
                                                                               </td>
                                                                            </tr>
                                                                            <tr>
                                                                               <td bgcolor=\"#5ebab2\" height=\"9\" align=\"center\" style=\"font-size:1px; line-height:1px;\">&nbsp;</td>
                                                                            </tr>
                                                                         </tbody>
                                                                      </table>
                                                                   </td>
                                                                </tr>
                                                                <!-- end of read more -->
                                                             </tbody>
                                                          </table>
                                                       </td>
                                                    </tr>
                                                 </tbody>
                                              </table>
                                              <!-- end of right column -->
                                           </td>
                                        </tr>
                                     </tbody>
                                  </table>
                               </td>
                            </tr>
                         </tbody>
                      </table>
                   </td>
                </tr>
             </tbody>
          </table>
          <!-- End of Left Image -->
          <!-- Start of seperator -->
          <table width=\"100%\" bgcolor=\"#fcfcfc\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" id=\"backgroundTable\" st-sortable=\"seperator\">
             <tbody>
                <tr>
                   <td>
                      <table width=\"600\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" class=\"devicewidth\">
                         <tbody>
                            <tr>
                               <td align=\"center\" height=\"30\" style=\"font-size:1px; line-height:1px;\">&nbsp;</td>
                            </tr>
                         </tbody>
                      </table>
                   </td>
                </tr>
             </tbody>
          </table>
          <!-- End of seperator -->
          <!-- Start of seperator -->
          <table width=\"100%\" bgcolor=\"#fcfcfc\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" id=\"backgroundTable\" st-sortable=\"seperator\">
             <tbody>
                <tr>
                   <td>
                      <table width=\"600\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" class=\"devicewidth\">
                         <tbody>
                            <tr>
                               <td align=\"center\" height=\"30\" style=\"font-size:1px; line-height:1px;\">&nbsp;</td>
                            </tr>
                         </tbody>
                      </table>
                   </td>
                </tr>
             </tbody>
          </table>
          <!-- End of seperator -->
          <!-- Start of Right Image -->
          <table width=\"100%\" bgcolor=\"#fcfcfc\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" id=\"backgroundTable\" st-sortable=\"right-image\">
             <tbody>
                <tr>
                   <td>
                      <table width=\"600\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\" class=\"devicewidth\">
                         <tbody>
                            <tr>
                               <td width=\"100%\">
                                  <table width=\"600\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\" class=\"devicewidth\">
                                     <tbody>
                                        <tr>
                                           <td>
                                              <!-- Start of left column -->
                                              <table width=\"280\" align=\"right\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"devicewidth\">
                                                 <tbody>
                                                    <!-- image -->
                                                    <tr>
                                                       <td width=\"280\" height=\"140\" align=\"center\" class=\"devicewidth\">
                                                          <img src=\"". $img_urls[1] ."\" alt=\"\" border=\"0\" width=\"280\" height=\"140\" style=\"display:block; border:none; outline:none; text-decoration:none;\" class=\"col2img\">
                                                       </td>
                                                    </tr>
                                                    <!-- /image -->
                                                 </tbody>
                                              </table>
                                              <!-- end of left column -->
                                              <!-- spacing for mobile devices-->
                                              <table align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"mobilespacing\">
                                                 <tbody>
                                                    <tr>
                                                       <td width=\"100%\" height=\"15\" style=\"font-size:1px; line-height:1px; mso-line-height-rule: exactly;\">&nbsp;</td>
                                                    </tr>
                                                 </tbody>
                                              </table>
                                              <!-- end of for mobile devices-->
                                              <!-- start of right column -->
                                              <table width=\"280\" align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"devicewidth\">
                                                 <tbody>
                                                    <tr>
                                                       <td>
                                                          <table width=\"280\" align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"devicewidth\">
                                                             <tbody>
                                                                <!-- title -->
                                                                <tr>
                                                                   <td style=\"font-family: Helvetica, arial, sans-serif; font-size: 18px; color: #282828; text-align:left; line-height: 24px;\">
                                                                      " . $section_2 . "
                                                                   </td>
                                                                </tr>
                                                                <!-- end of title -->
                                                                <!-- read more -->
                                                                <tr>
                                                                   <td>
                                                                      <table width=\"120\" height=\"32\" bgcolor=\"#5ebab2\" align=\"left\" valign=\"middle\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-radius:3px;\" st-button=\"learnmore\">
                                                                         <tbody bgcolor=\"#5ebab2\">
                                                                            <tr>
                                                                               <td bgcolor=\"#5ebab2\"height=\"9\" align=\"center\" style=\"font-size:1px; line-height:1px;\">&nbsp;</td>
                                                                            </tr>
                                                                            <tr>
                                                                               <td bgcolor=\"#5ebab2\" height=\"14\" align=\"center\" valign=\"middle\" style=\"font-family: Helvetica, Arial, sans-serif; font-size: 13px; font-weight:bold;color: #ffffff; text-align:center; line-height: 14px; ; -webkit-text-size-adjust:none;\" st-title=\"fulltext-btn\">
                                                                                  <a style=\"text-decoration: none;color: #fff; text-align:center;\" href=\"" . $url_section_2 . "\">" . $url_name_section_2 ."</a>
                                                                               </td>
                                                                            </tr>
                                                                            <tr>
                                                                               <td bgcolor=\"#5ebab2\" height=\"9\" align=\"center\" style=\"font-size:1px; line-height:1px;\">&nbsp;</td>
                                                                            </tr>
                                                                         </tbody>
                                                                      </table>
                                                                   </td>
                                                                </tr>
                                                                <!-- end of read more -->
                                                             </tbody>
                                                          </table>
                                                       </td>
                                                    </tr>
                                                 </tbody>
                                              </table>
                                              <!-- end of right column -->
                                           </td>
                                        </tr>
                                     </tbody>
                                  </table>
                               </td>
                            </tr>
                         </tbody>
                      </table>
                   </td>
                </tr>
             </tbody>
          </table>
          <!-- End of Right Image -->
          <!-- Start of seperator -->
          <table width=\"100%\" bgcolor=\"#fcfcfc\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" id=\"backgroundTable\" st-sortable=\"seperator\">
             <tbody>
                <tr>
                   <td>
                      <table width=\"600\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" class=\"devicewidth\">
                         <tbody bgcolor=\"#fcfcfc\">
                            <tr>
                               <td bgcolor=\"#fcfcfc\" align=\"center\" height=\"30\" style=\"font-size:1px; line-height:1px;\">&nbsp;</td>
                            </tr>
                         </tbody>
                      </table>
                   </td>
                </tr>
             </tbody>
          </table>
          <!-- End of seperator -->
          <!-- Start of footer -->
          <table width=\"100%\" bgcolor=\"#fcfcfc\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" id=\"backgroundTable\" st-sortable=\"footer\">
             <tbody>
                <tr>
                   <td>
                      <table width=\"600\" bgcolor=\"#5ebab2\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\" class=\"devicewidth\">
                         <tbody>
                            <tr>
                               <td width=\"100%\">
                                  <table bgcolor=\"#5ebab2\" width=\"600\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\" class=\"devicewidth\">
                                     <tbody bgcolor=\"#5ebab2\">
                                        <!-- Spacing -->
                                        <tr>
                                           <td bgcolor=\"#5ebab2\"height=\"10\" style=\"font-size:1px; line-height:1px; mso-line-height-rule: exactly;\">&nbsp;</td>
                                        </tr>
                                        <!-- Spacing -->
                                        <tr>
                                           <td>
                                              <!-- Social icons -->
                                              <table  width=\"250\" align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"devicewidth\">
                                                 <tbody bgcolor=\"#5ebab2\">
                                                    <tr>
                                                       <td bgcolor=\"#5ebab2\" align=\"center\" valign=\"middle\" style=\"font-family: Helvetica, arial, sans-serif; font-size: 13px;color: #fff\" st-content=\"preheader\">
                                  Mail indésirable ? <a href=\"" . WEBSITE_URL ."index.php?module=front&amp;action=newsletter&delete-email=". $contact_mail ."\">Se désabonner</a></td>
                                                    </tr>
                                                 </tbody>
                                              </table>
                                              <!-- end of Social icons -->
                                           </td>
                                        </tr>
                                        <!-- Spacing -->
                                        <tr>
                                           <td bgcolor=\"#5ebab2\" height=\"10\" style=\"font-size:1px; line-height:1px; mso-line-height-rule: exactly;\">&nbsp;</td>
                                        </tr>
                                        <!-- Spacing -->
                                     </tbody>
                                  </table>
                               </td>
                            </tr>
                         </tbody>
                      </table>
                   </td>
                </tr>
             </tbody>
          </table>
          <!-- End of footer -->
          <!-- Start of Postfooter -->
          <!-- End of postfooter -->
       </body>
    </html>";


            include_once('model/newsletter/insert_newsletter.php');
            $insert_newsletter = insert_newsletter($title, $object, $content);

            if($insert_newsletter && $insert_newsletter->rowCount() > 0){
                $_SESSION['flash']['success'] = "La newsletter a été ajoutée avec succès.";
                header("Location: index.php?module=newsletter&action=index");
                exit();
            }
            else{
                $_SESSION['flash']['danger'] = "Echec de l'ajout de la newsletter. Veuillez réessayer.";
                header("Location: index.php?module=newsletter&action=add-newsletter");
                exit();
            }


        }
        else{
            //if form is not valid :
            $_SESSION['flash']['danger'] = 'Certains champs sont incorrects ou manquants. Veuillez réessayer';
            header("Location: index.php?module=newsletter&action=add-newsletter");
            exit();
        }
    }
    else{
        //if no POST :
        include_once('view/newsletter/add-newsletter.php');
    }
}
else{
    $_SESSION['flash']['danger'] = "Vous devez vous connecter pour accéder à cette partie du site.";
    header('Location: index.php?module=user-admin&action=login');
    exit();
}