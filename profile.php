<div class="container">
    <div class="row">
        <div class="col-md-12" >
            <div class="panel panel-info" style="margin-top: 50px;">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3 col-lg-3 " align="center">
                            <img alt="User Pic" src="<?= $users->avatar ?>" style="height: 300px; width: 300px;" id="profile_img" class="rounded">
                        </div>

                        <div class=" col-md-9 col-lg-9 ">
                            <table class="table table-user-information">
                                <tbody>
                                <tr>
                                    <td>Fornavn:</td>
                                    <td><?= $users->firstname ?></td>
                                </tr>
                                <tr>
                                    <td>Efternavn:</td>
                                    <td><?= $users->lastname ?></td>
                                </tr>
                                <tr>
                                    <td>Brugernavn:</td>
                                    <td><?= $users->username ?></td>
                                </tr>
                                <tr>
                                    <td>Bruger Niveau:</td>
                                    <td><?php
                                        if ($users->fk_userrole == 1) {
                                            $userrole = "Super Admin";
                                        }
                                        else if ($users->fk_userrole == 2) {
                                            $userrole = "Admin";
                                        }
                                        else if ($users->fk_userrole == 3) {
                                            $userrole = "Medarbejder";
                                        }
                                        echo $userrole;
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Email Adresse:</td>
                                    <td><?= $users->email ?></td>
                                </tr>
                                <tr>
                                    <td>Adresse:</td>
                                    <td><?= $users->address ?></td>
                                </tr>
                                <tr>
                                    <td>Telefon Nummer:</td>
                                    <td>+45 <?= $users->phone ?></td>
                                </tr>

                                </tbody>
                            </table>

                            <a href="?side=redigerBruger&id=<?= $_SESSION['user_id'] ?>" class="btn btn-primary">Rediger Profil</a>
                            <?php
                            if ($users->fk_userrole <= 3) {
                                if ($users->id != 1) {
                                    echo '<a href="?side=sletBruger&id='. $_SESSION['user_id'] . '" class="btn btn-danger">Slet Profil</a>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

