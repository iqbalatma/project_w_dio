<div class="wrapper">
    <!-- Main Header -->
    <div class="main-header">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="blue">

            <a href="<?= base_url() ?>" class="logo">
                <img src="<?= base_url("assets/img/logo-navbar.png") ?>" alt="navbar brand" class="navbar-brand" width="150px">
            </a>
            <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">
                    <i class="icon-menu"></i>
                </span>
            </button>
            <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="icon-menu"></i>
                </button>
            </div>
        </div>
        <!-- End Logo Header -->

        <!-- Navbar Header -->
        <nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">

            <div class="container-fluid">
                <!-- <div class="collapse" id="search-nav">
                    <form class="navbar-left navbar-form nav-search mr-md-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button type="submit" class="btn btn-search pr-1">
                                    <i class="fa fa-search search-icon"></i>
                                </button>
                            </div>
                            <input type="text" placeholder="Search ..." class="form-control">
                        </div>
                    </form>
                </div> -->
                <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                    <li class="nav-item toggle-nav-search hidden-caret">
                        <a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
                            <i class="fa fa-search"></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown hidden-caret">
                        <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                            <div class="avatar-sm">
                                <img src="<?= base_url("assets/img/avatar/{$this->session->avatar}") ?>" alt="avatar" class="avatar-img rounded-circle">
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-user animated fadeIn">
                            <div class="dropdown-user-scroll scrollbar-outer">
                                <li>
                                    <div class="user-box">
                                        <div class="avatar-lg"><img src="<?= base_url("assets/img/avatar/{$this->session->avatar}") ?>" alt="avatar profile" class="avatar-img rounded"></div>
                                        <div class="u-text">
                                            <h3>
                                                Hi, <strong><?= "{$this->session->first_name} {$this->session->last_name}"; ?></strong>
                                            </h3>
                                            <?php
                                            switch ($this->session->role_id) {
                                                case '0': $roleName = 'superadmin'; break;
                                                case '1': $roleName = 'Owner'; break;
                                                case '2': $roleName = 'Admin Gudang'; break;
                                                case '3': $roleName = 'Kasir'; break;
                                            }
                                            ?>
                                            <p class="text-muted text-capitalize"><?= $roleName ?></p>
                                            <!-- <p class="text-muted">halo@nerochrono.cyou</p> -->
                                            <!-- <a href="profile.html" class="btn btn-xs btn-secondary btn-sm">View Profile</a> -->
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="<?= base_url() ?>">Dashboard</a>
                                    <!-- <a class="dropdown-item" href="<?= base_url('profil') ?>">Profil saya</a> -->
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>">Logout</a>
                                </li>
                            </div>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- End Navbar -->
    </div>
    <!-- End Main Header -->