<?php
if($user->is_loggedin() == true) {

    echo 'Velkommen ! <b>'.$_SESSION['username'].'</b>';

} else {

    $user->redirect('logind');

}