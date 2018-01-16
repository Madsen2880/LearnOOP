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
            ?>
        </ul>
        <form class="form-inline my-2 my-lg-0" method="post">
            <input class="form-control mr-sm-2" type="search" name="navn" placeholder="Søgning..." aria-label="Search">
            <button class="btn btn-outline-primary my-2 my-sm-0" name="search" type="submit">Søg</button>
        </form>
        <ul class="navbar-nav mr-right">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                                echo '<img src="' . $users->avatar . '" style="width: 30px; height: 30px;" class="rounded"> ' . $u->username;
                            }
                        }
                    } else {
                        echo 'Log Ind';
                    }
                    ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown"  style="overflow: hidden">

                    <?php
                    if($user->secCheckLevel() >= 50) {
                        echo '<a class="dropdown-item" href="index.php?side=profil"><i class="fa fa-user"></i> Profil</a>';
                    }

                    if($user->secCheckLevel() >= 90) {
                        echo '<a class="dropdown-item" href="index.php?side=beskeder"><i class="fas fa-envelope"></i> Beskeder</a>';
                    }

                    if($user->secCheckLevel() == 99) {
                        echo '<a class="dropdown-item" href="index.php?side=opdater"><i class="fas fa-sync"></i> Opdater</a>';
                    }
                    ?>
                    <div class="dropdown-divider"></div>
                    <?php
                    if($user->is_loggedin() === TRUE) {
                        echo '<a class="dropdown-item" href="index.php?side=logud"><i class="fas fa-sign-out-alt"></i>Log ud</a>';
                    } else {
                        echo '<a class="dropdown-item" href="index.php?side=logind"><i class="fas fa-sign-in-alt"></i> Log ind</a>';
                    }
                    ?>
                </div>
            </li>

        </ul>
    </div>
</nav>