<?php

if(isset($_POST['btn_send'])) {
    $error = [];
    if(empty($_POST['name'])) {
        $error['name'] = "<div class=\"alert alert-danger alert-dismissible\" data-dismiss=\"alert\" id=\"myAlert\">
                            <a href=\"#\" class=\"close\">&times;</a>
                            <i class=\"glyphicon glyphicon-warning-sign\"></i>
                            Udfyld venligst et navn.
                            </div>";
    }

    if(empty($_POST['price'])) {
        $error['price'] = "<div class=\"alert alert-danger alert-dismissible\" data-dismiss=\"alert\" id=\"myAlert\">
                            <a href=\"#\" class=\"close\">&times;</a>
                            <i class=\"glyphicon glyphicon-warning-sign\"></i>
                            Udfyld venligst prisen.
                            </div>";
    }

    if(empty($_POST['description'])) {
        $error['description'] = "<div class=\"alert alert-danger alert-dismissible\" data-dismiss=\"alert\" id=\"myAlert\">
                            <a href=\"#\" class=\"close\">&times;</a>
                            <i class=\"glyphicon glyphicon-warning-sign\"></i>
                            Udfyld venligst beskrivelsen.
                            </div>";
    }

    if(sizeof($error) == 0) {
        if($products->newProducts($_POST) == true){
            $success = '<div class="alert alert-success alert-dismissible" data-dismiss="alert" id="myAlert">
                            <a href="#" class="close">&times;</a>
                            <i class="glyphicon glyphicon-warning-sign"></i>
                            Produktet '.$_POST['name'].' er oprettet!
                            </div>';
            $_POST = array();
        }
    }
}

?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <br>
            <?=@$success?>
            <form name="contactform" action="" method="post">
                <div class="form-group">
                    <label for="name">Navn</label>
                    <?=@$error['name']?>
                    <input type="text" name="name" id="name" class="form-control" value="<?= @$_POST['name'] ?>">
                </div>

                <div class="form-group">
                    <label for="price">Pris</label>
                    <?=@$error['price']?>
                    <input type="text" class="form-control" id="price" name="price" aria-describedby="emailHelp" value="<?= @$_POST['price'] ?>">
                </div>

                <div class="form-group">
                    <label for="description">Beskrivelse</label>
                    <?=@$error['description']?>
                    <textarea class="form-control" id="description" name="description" rows="3"><?= @$_POST['description'] ?></textarea>
                </div>

                <input type="submit" class="btn btn-success" value="Opret" name="btn_send" />
            </form>
        </div>
    </div>
</div>
