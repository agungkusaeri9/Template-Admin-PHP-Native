<nav class="navbar navbar-expand-lg main-navbar">
    <ul class="navbar-nav mr-3">
        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
    </ul>
    <ul class="navbar-nav navbar-right ml-auto">
        <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="<?= BASE_URL . '/assets/img/avatar/avatar-1.png' ?>" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">Hi, <?= $_SESSION['nama'] ?></div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title"></div>
                <a href="<?= BASE_URL . '/main.php?page=profile' ?>" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profile
                </a>
                <div class="dropdown-divider"></div>
                <a href="<?= BASE_URL . '/logout.php' ?>" onclick="document.getElementById('formLogout').submit();" class="dropdown-item has-icon text-danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </li>
    </ul>
</nav>