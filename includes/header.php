<header class="bg-light">
        <!--Navbar Container-->
        <div class="wrapper-navbar">
            <nav class="navbar navbar-expand-lg">
                <a class="navbar-brand" href="index">
                    <i class="fas fa-home text-info"></i>
                    <span class="brand-title">&ensp;Online Residential</span>
                </a>

                <button class="navbar-toggler btn btn-info" type="button" data-toggle="collapse" data-target="#navbarToggle" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarToggle">
                  <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">FAQs&ensp;<i class="far fa-question-circle text-danger"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)" id="stat-tab">Site statistics&ensp;<i class="fas fa-wave-square text-success"></i></a>
                    </li>
                    <li class="nav-item mobile-content">
                        <a class="nav-link filterAsideHandler" href="javascript:void(0)">Search & Filter&ensp;<i class="fas fa-search-plus text-warning"></i></a>
                    </li>
                  </ul>

                <?php if(isset($_SESSION['user_arr'])){ ?>
                    <ul class="navbar-nav profile-dropdown">
                        <li class="dropdown header-notification">
                            <button class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="text-primary far fa-bell"></i>&ensp;Notifications&ensp;<span class="badge badge-primary">1</span></button>
                            <div class="dropdown-menu dropdown-menu-right mt-3 bg-light">
                                <a class="dropdown-item text-truncate" href="#">Not Implemented!</a>
                            </div>
                        </li>
                        <li class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="far fa-user"></i>&ensp;<?=explode(" ",$_SESSION['user_arr']['name'])[0];?>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right mt-3 bg-light">
                            <a class="dropdown-item" href="user-profile"><i class="far fa-address-card"></i>&ensp;My Profile</a>
                            <a class="dropdown-item" href="ad-upload"><i class="far fa-plus-square"></i>&ensp;Post New Ad</a>
                            <a class="dropdown-item" href="user-ad-list"><i class="far fa-list-alt"></i>&ensp;My Ad list</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="logout"><i class="text-danger fas fa-sign-out-alt"></i>&ensp;Logout</a>
                            </div>
                        </li>
                    </ul>
                <?php } else{ ?>
                   <div class="btn-group nav-btn-group" role="group" aria-label="Basic example">
                        <a href="registration" class="btn btn-outline-success sign-up-btn">Sign up&ensp;<i class="fas fa-user-plus"></i></a>
                        <a href="login" class="btn btn-success">Login&ensp;<i class="fas fa-sign-in-alt"></i></a>
                  </div>
                <?php } ?>
                </div>
            </nav>
        </div>
    <!--Navbar Container-->
    </header>
