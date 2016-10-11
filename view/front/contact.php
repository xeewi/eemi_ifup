<?php
    $title = "IFUP - Contactez-nous";
    require_once("view/front/layout/header.front.inc.php");
?>
    <section id="contact-deco" class="ctr">

        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2624.426517259628!2d2.339143915674758!3d48.86914517928858!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66e3c7e25a349%3A0x5012b3632a6880b7!2sPalais+Brongniart!5e0!3m2!1sfr!2sfr!4v1453058086301" width="100%" height="250" frameborder="0" style="border:0" allowfullscreen></iframe>

        <p class="ctr">28 Place de la Bourse, 75002 Paris</p>

        <div class="wrap-deco">

            <div class="clear"></div>

            <div id="intro-faq" class="ctr">
                <h2 class="title">Nous Contacter</h2>
            </div>

            <p class="">Un problème où une question, ne répondons à vos questions.</p>

            <form method="post" action="index.php?module=front&action=contact" id="contact" class="ctr space">

                <div class="space"><img src="assets/img/user.png" class="arrow-select" alt="Nom"><input name="ifup_user_name" class="forms-log" required type="name" placeholder="Votre Nom"></div>

                <div class="space"><img src="assets/img/mail.png" class="arrow-select" alt="mail"><input name="ifup_user_email" class="forms-log" required type="email" placeholder="Votre adresse Email"></div>

                <div class="space">
                    <textarea name="ifup_user_message" class="forms-log" placeholder="Ecrivez votre message..."></textarea>
                </div>
                <button class="btn space" title="Envoyez" type="submit">Envoyez votre message</button>
            </form>

        </div>

    </section>
<?php require_once("view/front/layout/footer.front.inc.php");?>
