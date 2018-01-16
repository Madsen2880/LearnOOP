<?php
/**
 * Created by PhpStorm.
 * User: mcarp
 * Date: 09-01-2018
 * Time: 13:09
 */

if(isset($_POST['btn-signup']))
{
    $firstname = strip_tags($_POST['txt_fname']);
    $lastname = strip_tags($_POST['txt_lname']);
    $username = strip_tags($_POST['txt_uname']);
    $password = strip_tags($_POST['txt_upass']);

    if ($firstname=="") {
        $error[] = "Angiv et fornavn !";
    }
    else if ($lastname=="") {
        $error[] = "Angiv et efternavn !";
    }
    else if($username=="")	{
        $error[] = "Angiv et brugernavn !";
    }
    else if($password=="")	{
        $error[] = "Angiv en adgangskode!";
    }
    else if(strlen($password) < 6){
        $error[] = "Adgangskoden skal mindst være på 6 karaktere";
    }
    else
    {
        try
        {
            $stmt = $user->checkUsername($username);
            if($stmt == false) {
                if($user->register($firstname, $lastname, $username, $password) == true){
                       $user->redirect('logind');
                }
            }
            else
            {
                $error[] = "Brugernavnet er allerede i brug !";
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
                <h2 class="form-signin-heading">Opret en bruger</h2><hr />
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
                        <i class="glyphicon glyphicon-check"></i> &nbsp;Registreringen er gemmeført, <a href='?joined'>log ind</a> her
                    </div>
                    <?php
                }
                ?>
                <div class="form-group">
                    <input type="text" class="form-control" name="txt_fname" placeholder="Indtast Fornavn" value="<?= @$_POST['txt_fname'] ?>" />
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="txt_lname" placeholder="Indtast Efternavn" value="<?= @$_POST['txt_lname'] ?>" />
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="txt_uname" placeholder="Indtast Brugernavn" value="<?= @$_POST['txt_uname'] ?>" />
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="txt_upass" placeholder="Indtast Adgangskode" />
                </div>
                <div class="clearfix"></div><hr />
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="btn-signup">
                        <i class="fa fa-user-plus"></i>&nbsp;OPRET
                    </button>
                    <button type="reset" class="btn btn-danger">
                        <i class="fa fa-ban"></i>&nbsp;FORTRYD
                    </button>
                </div>
                <br />
                <label>Har du allerede en konto? <a href="./index.php?side=logind">Log ind her</a></label>
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