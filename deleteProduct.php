<?php
/**
 * Created by PhpStorm.
 * User: mcarp
 * Date: 17-01-2018
 * Time: 09:27
 */

$products->deleteProduct($_GET['id']);
$user->redirect('produkter');
