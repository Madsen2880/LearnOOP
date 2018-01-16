<?php
/**
 * Created by PhpStorm.
 * User: mcarp
 * Date: 09-01-2018
 * Time: 12:43
 */

if(isset($_POST['btn-login']))
{
    $username = strip_tags($_POST['txt_uname_email']);
    $password = strip_tags($_POST['txt_password']);

    if($user->doLogin($username,$password) == true)
    {
       $user->redirect('joined');
    }
    else if($user->doLogin($username, $password) == false)
    {
        $error = "Forkerte oplysninger!";
    }
}

$user->destroyToken();
?>

<div>

    <div class="container">

        <form class="form-signin" method="post" id="login-form">
            <input type="hidden" name="token" value="<?php echo $user->getToken() ?>">
            <h2 class="form-signin-heading">Log Ind</h2><hr />

            <div id="error">
                <?php
                if(isset($error))
                {
                    ?>
                    <div class="alert alert-danger alert-dismissible" id="myAlert">
                        <a href="#" class="close">&times;</a>
                        <i class="glyphicon glyphicon-warning-sign"></i> &nbsp;<?php echo $error; ?>
                    </div>
                    <?php
                }
                ?>
            </div>

            <div class="form-group">
                <input type="text" class="form-control" name="txt_uname_email" placeholder="Brugernavn eller E-mail" value="<?= @$_POST['txt_uname_email'] ?>" required />
                <span id="check-e"></span>
            </div>

            <div class="form-group">
                <input type="password" class="form-control" name="txt_password" placeholder="Din adgangskode" requried />
            </div>

            <hr />

            <div class="form-group">
                <button type="submit" name="btn-login" class="btn btn-success">
                    <i class="fa fa-sign-in-alt"></i> &nbsp; LOG IND
                </button>
            </div>
            <br />
            <label>Har du ikke en konto endnu? <a href="./index.php?side=opret">Opret en konto</a></label>
        </form>

    </div>

</div>