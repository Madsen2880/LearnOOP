<?php
/**
 * Created by PhpStorm.
 * User: mcarp
 * Date: 15-01-2018
 * Time: 09:13
 */
if($user->secCheckLevel() >= 90) {
?>
<table class="table">
    <thead class="thead-dark">
    <tr>
        <th scope="col">Navn</th>
        <th scope="col">Email</th>
        <th scope="col">Besked</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach($email->getAllEmails() as $emails) { ?>
    <tr>
        <td><?= $emails->name ?></td>
        <td><?= $emails->email ?></td>
        <td><?= $emails->message ?></td>
        <td><a href="?side=sletEmail&id=<?=$emails->id?>"><button class="btn btn-danger" >Slet</button></a></td>
    </tr>
        <?php }
    } else {
    $user->redirect('forside');
    }
    ?>
    </tbody>
</table>