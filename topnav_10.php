<nav class="navbar navbar-light navbar-glass navbar-top navbar-expand">
    <div class="d-flex align-items-center py-3 header-gov-logo">
        <img class="me-2" src="assets\img\logos\tamilnadu_logo.png" alt="" width="40">
        <span class="font-sans-serif">
            <h6>Government of <br>TamilNadu </h6>
        </span>
    </div>
    <div class="col text-center nav-item header-mraheas-content">
        <h4 class="d-none d-lg-block d-xl-block">Moovalur Ramamirtham Ammaiyar Higher Education Assurance Scheme</h4>
        <h4 class="d-lg-none d-xl-none d-md-block">MRAHEAS</h4>
    </div>
    <!-- <button class="btn navbar-toggler-humburger-icon navbar-toggler me-1 me-sm-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse" aria-controls="navbarVerticalCollapse" aria-expanded="false" aria-label="Toggle Navigation">
        <span class="navbar-toggle-icon">
            <span class="toggle-line"></span>
        </span>
    </button> -->
    <ul class="navbar-nav navbar-nav-icons ms-auto flex-row align-items-center">
        <li class="nav-item dropdown">
            <a class="nav-link pe-0 ps-2 text-right nav-right-avatar" id="navbarDropdownUser" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="avatar avatar-xl" data-html2canvas-ignore="true">

                    <img class="rounded-circle " src="./assets/img/team/avatar.png" alt="" />

                </div>

            </a>
            <p data-html2canvas-ignore="true" class="header-p-welcome-content">
                <?php
            $usertype = isset($_SESSION['user_details']['user_type']) ? $_SESSION['user_details']['user_type'] : '';

            if ($usertype == '10') {

                echo isset($_SESSION['user_details']['contact_person']) ? 'Welcome, ' . $_SESSION['user_details']['contact_person'] : '';
            }
            ?>
            </p>


            <div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end py-0" aria-labelledby="navbarDropdownUser">
                <div class="bg-white dark__bg-1000 rounded-2 py-2">
                    <a class="dropdown-item header-ul-welcome-content"><?php
                    $usertype = isset($_SESSION['user_details']['user_type']) ? $_SESSION['user_details']['user_type'] : '';

                    if ($usertype == '10') {

                        echo isset($_SESSION['user_details']['contact_person']) ? 'Welcome, ' . $_SESSION['user_details']['contact_person'] : '';
                    }
                    ?>
                    </a>
                    <div  class="dropdown-divider header-ul-welcome-content"></div>
                    <a class="dropdown-item" href="#">
                    <?php
                    echo isset($_SESSION['user_details']['login_names']) ? $_SESSION['user_details']['login_names'] : '';
                    ?>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
            </div>
        </li>
    </ul>
    <!-- <button class="btn navbar-toggler-humburger-icon navbar-toggler me-1 me-sm-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse" aria-controls="navbarVerticalCollapse" aria-expanded="false" aria-label="Toggle Navigation">
        <span class="navbar-toggle-icon">
            <span class="toggle-line"></span>
        </span>
    </button> -->
    <!-- <ul class="navbar-nav navbar-nav-icons ms-auto flex-row align-items-center">
        <li class="nav-item dropdown">
            <div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end dropdown-menu-card dropdown-menu-notification dropdown-caret-bg" aria-labelledby="navbarDropdownNotification">
                <div class="card card-notification shadow-none">
                    <div class="card-header">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-auto">
                                <h6 class="card-header-title mb-0">Notifications</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <li class="nav-item dropdown">

            <div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end py-0" aria-labelledby="navbarDropdownUser">
                <div class="bg-white dark__bg-1000 rounded-2 py-2">
                    <a class="dropdown-item" href="#"></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
            </div>
        </li>
    </ul> -->
</nav>