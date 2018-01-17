<?php
/**
 * Created by PhpStorm.
 * User: mcarp
 * Date: 17-01-2018
 * Time: 11:52
 */

if(isset($_POST['btn-edit']))
{
    $firstname = strip_tags($_POST['firstname']);
    $lastname = strip_tags($_POST['lastname']);
    $username = strip_tags($_POST['username']);
    $password = strip_tags($_POST['password']);
    $email = strip_tags($_POST['email']);
    $address = strip_tags($_POST['address']);
    $phone = strip_tags($_POST['phone']);

    if ($firstname=="") {
        $error[] = "Angiv et fornavn !";
    }
    else if ($lastname=="") {
        $error[] = "Angiv et efternavn !";
    }
    else if($username=="")	{
        $error[] = "Angiv et brugernavn !";
    }
    else if($email == "") {
        $error[] = "Angiv en email adresse!";
    }
    else if($address == "") {
        $error[] = "Angiv en adresse!";
    }
    else if($phone == "") {
        $error[] = "Angiv et telefon nummer";
    }
    else
    {
        try
        {
            $stmt = $_SESSION['user_id'] == $users->id;
            if($stmt == true) {
                if($user->editUser($_POST) == true){
                    $user->redirect('profil');
                }
            }
            else
            {
                $error[] = "Brugernavnet er allerede i brug!";
            }
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form method="post" class="form-signin">
                <input type="hidden" name="id" value="<?= $users->id ?>">
                <h2 class="form-signin-heading">Rediger Bruger</h2><hr />
                <?php
                if(isset($error))
                {
                    foreach($error as $error)
                    {
                        ?>
                        <div class="alert alert-danger alert-dismissible" data-dismiss="alert" id="myAlert">
                            <a href="#" class="close">&times;</a>
                            <i class="glyphicon glyphicon-warning-sign"></i> &nbsp;<?php echo $error; ?>
                        </div>
                        <?php
                    }
                }
                else if(isset($_GET['joined']))
                {
                    ?>
                    <div class="alert alert-success alert-dismissible" id="myAlert">
                        <a href="#" class="close">&times;</a>
                        <i class="glyphicon glyphicon-check"></i> &nbsp;Dine bruger data er blevet opdateret
                    </div>
                    <?php
                }
                ?>
                <div class="form-group">
                    <input type="text" class="form-control" name="firstname" placeholder="Indtast Fornavn" value="<?= @$users->firstname ?>" />
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="lastname" placeholder="Indtast Efternavn" value="<?= @$users->lastname ?>" />
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="username" placeholder="Indtast Brugernavn" value="<?= @$users->username ?>" />
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Indtast Adgangskode" />
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" name="email" placeholder="Indtast Email" value="<?= @$users->email ?>">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="address" placeholder="Indtast Adresse" value="<?= @$users->address ?>">
                </div>
                <div class="form-group">
                    <input type="number" class="form-control" name="phone" placeholder="Indtast Email" value="<?= @$users->phone ?>">
                </div>
                <div class="clearfix"></div><hr />
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="btn-edit">
                        <i class="fa fa-user-plus"></i>&nbsp;Opdater
                    </button>
                    <button type="reset" class="btn btn-danger">
                        <i class="fa fa-ban"></i>&nbsp;FORTRYD
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $(".close").click(function(){
            $("#myAlert").alert("close");
        });
    });
</script>