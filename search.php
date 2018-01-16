<?php
    if(isset($_POST['search'])) {
        if(strlen($_POST['navn']) > 6 || strlen($_POST['navn']) < 1) {
            $error['navn'] = '<div class="alert alert-danger alert-dismissible" data-dismiss="alert" id="myAlert">
            <a href="#" class="close">&times;</a>
            <i class="glyphicon glyphicon-warning-sign"></i>
            Din søgning skal være mellem 1 og 6 tegn.
            </div>';
        } else {
            $user->redirect('produkter&search='.$_POST['navn'].'');
        }
    }
?>

<div class="container">
<h1>Produkt Søgning</h1>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form method="post">
                <div class="form-group">
                    <label for="navn">Produkt Navn</label>
                    <?=@$error['navn']?>
                    <input type="text" name="navn" id="navn" class="form-control" value="<?= @$_POST['navn'] ?>">
                </div>

                <input type="submit" class="btn btn-success" value="Søg" name="search" />
            </form>
            <br>
            <br>
            <br>
            <a href="index.php?side=produkter"><button class="btn btn-success">Vis alle produkter</button></a>
        </div>
    </div>
</div>
</div>
