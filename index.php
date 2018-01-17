<?php
/**
 * Created by PhpStorm.
 * User: mcarp
 * Date: 16-11-2017
 * Time: 09:56
 */

ob_start();
session_start();

require_once './config.php';

$setting = new settings($db);
$user = new User($db);
$email = new Email($db);
$products = new Products($db);

if ($user->is_loggedin() == true) {
    $users = $user->getOne($_SESSION['user_id']);
}

include_once './inc/head.php';
include_once './inc/menu.php';

if ($user->is_loggedin() == true && $debug == 1){
    include_once './inc/debug.php';
}

if(isset($_POST['search'])) {
    if(strlen($_POST['navn']) > 6 || strlen($_POST['navn']) < 1) {
        $error['navn'] = '<div class="alert alert-danger alert-dismissible" id="myAlert">
            <a href="#" class="close">&times;</a>
            <i class="glyphicon glyphicon-warning-sign"></i>
            Din søgning skal være mellem 1 og 6 tegn.
            </div>';
    } else {
        $user->redirect('produkter&search='.$_POST['navn'].'');
    }
}

if ($user->secCheckMethod('GET') || $user->secCheckMethod('POST')) {
    $get = $user->secGetInputArray(INPUT_GET);
    if (isset($get['side']) && !empty($get['side'])) {
        switch ($get['side']) {

            case 'forside';
                include_once './home.php';
                break;
            case 'omkring';
                include_once './about.php';
                break;
            case 'kontakt';
                include_once './contact.php';
                break;
            case 'logind';
                include_once './login.php';
                break;
            case 'logud';
                include_once './logout.php';
                break;
            case 'opret';
                include_once './signup.php';
                break;
            case 'beskeder';
                include_once './messages.php';
                break;
            case 'sletEmail';
                include_once './deleteEmail.php';
                break;
            case 'opdater';
                include_once './update.php';
                break;
            case 'produkter';
                include_once './products.php';
                break;
            case 'search';
                include_once './search.php';
                break;
            case 'produkt';
                include_once './singleProduct.php';
                break;
            case 'nytProdukt';
                include_once './newProduct.php';
                break;
            case 'profil';
                include_once './profile.php';
                break;
            case 'sletProdukt';
                include_once './deleteProduct.php';
                break;
            case 'redigerProdukt';
                include_once './editProduct.php';
                break;
            case 'sletBruger';
                include_once './deleteUser.php';
                break;
            case 'redigerBruger';
                include_once './editUser.php';
                break;

            default:
                header('Location: index.php?side=forside');
                break;
        }
    } else {
        header('Location: index.php?side=forside');
    }
}

include_once './inc/footer.php';

























