<div class="wrapper sidebar_minimize">

    <div class="main-panel">

        <div class="content">

            <div class="page-inner">

                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header text-center">
                                <div class="card-title">Welcome</div>
                                <div class="card-title">Please Login To Continue</div>
                            </div>


                            <form action="<?= base_url('auth/login'); ?>" method="POST">
                                <div class="card-body">
                                    <div class="row center">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-8">
                                            <?= $this->session->flashdata('message'); ?>

                                            <div class="form-group">
                                                <label for="username">Username</label>
                                                <input type="text" name="username" class="form-control" id="username" placeholder="Enter username" autofocus>
                                                <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" name="password" class="form-control" id="password" placeholder="Enter Password">
                                                <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-action">

                                    <button class="btn btn-primary center-inline-block" type="submit">Login</button>

                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="https://www.themekita.com">
                                ThemeKita
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Help
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Licenses
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="copyright ml-auto">
                    2018, made with <i class="fa fa-heart heart text-danger"></i> by <a href="https://www.themekita.com">ThemeKita</a>
                </div>
            </div>
        </footer> -->
    </div>


</div>