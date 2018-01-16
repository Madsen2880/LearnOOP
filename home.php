<div class="jumbotron">
    <h1 class="display-4">Hello, world!</h1>
    <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
    <hr class="my-4">
    <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
    <p class="lead">
        <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
    </p>
</div>
<?php
if($user->is_loggedin() === TRUE) {
    foreach ($user->getAll() as $u){
        if ($u->fk_userrole == 1) {
            $userrole = "Super Admin";
        }
        else if ($u->fk_userrole == 2) {
            $userrole = "Admin";
        }
        else if ($u->fk_userrole == 3) {
            $userrole = "Medarbejder";
        }
        if ($u->id === $_SESSION['user_id']) {
            echo "<p>Hej, " . $u->firstname . " " . $u->lastname . "!</p>";
            echo "<p>Dit brugernavn er: " . $u->username . ".</p>";
            echo "<p>Din brugerrolle er: " . $userrole . ".</p>";
        }
    }
}
?>