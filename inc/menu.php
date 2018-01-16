<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="./index.php?side=forside">Navbar - <?php foreach ($setting->getAllSettings() as $settings) {echo $settings->site_name;} ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <?php
            foreach ($setting->getAllMenu() as $menu) {
                echo '<li class="nav-item">';
                echo '<a class="nav-link" href="./index.php?side=' . $menu->link . '">' . $menu->name . '</a>';
                echo '</li>';
            }

            if($user->secCheckLevel() >= 90) {
                echo '<li class="nav-item"><a href="index.php?side=beskeder" class="nav-link">Beskeder</a></li>';
                echo '<li class="nav-item"><a href="index.php?side=opdater" class="nav-link">Opdater</a></li>';
            } else {
                echo '';
            }

            if($user->is_loggedin() === TRUE) {
                echo '<li class="nav-item"><a href="index.php?side=logud" class="nav-link">Log ud</a></li>';
            } else {
                echo '<li class="nav-item"><a href="index.php?side=logind" class="nav-link">Log ind</a></li>';
            }
            ?>
        </ul>
        <form class="form-inline my-2 my-lg-0" method="post">
            <input class="form-control mr-sm-2" type="search" name="navn" placeholder="Søgning..." aria-label="Search">
            <button class="btn btn-outline-primary my-2 my-sm-0" name="search" type="submit">Søg</button>
        </form>
        <ul class="navbar-nav mr-auto">
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
                        echo '<li class="nav-item"><a href="index.php?side=profil" class="nav-link"><img src="https://placehold.it/25x25" class="rounded"> ' . $u->username . '</a></li>';
                    }
                }
            }
            ?>
        </ul>
    </div>
</nav>