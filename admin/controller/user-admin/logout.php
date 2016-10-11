<?php
if(isset($_SESSION['admin'])){
    unset($_SESSION['admin']);

    $_SESSION['flash']['success'] = 'Vous êtes bien déconnecté. A bientôt !';
    header('Location: index.php?module=user-admin&action=login');
    exit();
}
else{
    $_SESSION['flash']['danger'] = 'Vous devez vous connecter pour accéder à cette partie du site.';
    header("Location:index.php?module=user-admin&action=login");
    exit();
}