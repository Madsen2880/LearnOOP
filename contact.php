<?php
if(isset($_POST['btn_send'])){
    $error = $email->validateContact($_POST);
    if(sizeof($error) == 0) {
        if($email->sendMail($_POST) == true) {
            $success = '<div class="alert alert-success alert-dismissible" id="myAlert">
                            <a href="#" class="close">&times;</a>
                            <i class="glyphicon glyphicon-warning-sign"></i>
                            Tak for din henvendelse, vi vender tilbage til dig hurtigst muligt!
                            </div>';
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
                    <label for="navn">Navn</label>
                    <?=@$error['navn']?>
                    <input type="text" name="navn" id="navn" class="form-control" value="<?= @$_POST['navn'] ?>">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <?=@$error['email']?>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" value="<?= @$_POST['email'] ?>">
                </div>

                <div class="form-group">
                    <label for="besked">Besked</label>
                    <?=@$error['besked']?>
                    <textarea class="form-control" id="besked" name="besked" rows="3"><?= @$_POST['besked'] ?></textarea>
                </div>

                <input type="submit" class="btn btn-success" value="Send" name="btn_send" />
            </form>
        </div>
    </div>
</div>

