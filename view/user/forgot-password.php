<?php
    $title = "IFUP - Mot de passe oublié";
    require_once("view/front/layout/header.front.inc.php");
?>
<section id="forgot-password" class="space">
        <div class="wrap-deco">
            <?php if(!isset($_GET["token"])){ ?>
                <form id="form-forgot-password-token" class="space ctr" method="post" action="index.php?module=user&action=forgot-password">
                    <p>Votre email :</p>
                    <span><i class="fa fa-envelope arrow-select2"></i>
                    <input name="ifup_user_email" class="forms-settings-input" type="email" required></span>
                    <button type="submit"  class="btn">Réinitialiser</button>
                </form>
            <?php } else { ?>
                <form id="form-forgot-password" class="space ctr" method="post" action="index.php?module=user&action=forgot-password&token=<?php echo $_GET['token'];?>">
                    <p>Nouveau mot de passe :</p>
                    <span><i class="fa fa-lock arrow-select2"></i>
                    <input name="ifup_user_password" class="forms-settings-input" type="password"  required  placeholder=""></span>

                    <p>Confirmer votre mot de passe :</p>
                    <span><i class="fa fa-lock arrow-select2"></i>
                    <input name="ifup_user_password_confirmation" class="forms-settings-input" type="password"  required  placeholder=""></span>
                    <button type="submit"  class="btn">Réinitialiser</button>
                </form>
            <?php } ?>
        </div>
</section>

