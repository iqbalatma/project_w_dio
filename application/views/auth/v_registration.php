<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Forms Registration</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="<?= base_url('dashboard'); ?>">
                        <i class="flaticon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('auth/registration'); ?>">Forms Registration</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form action="<?= base_url('auth/registration'); ?>" method="POST">
                        <div class="card-header">
                            <div class="card-title">Form Registration</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-lg-4">

                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" name="username" id="username" placeholder="Enter Username">
                                        <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password">
                                        <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email">
                                        <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="firstname">First Name</label>
                                        <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Enter Firstname">
                                        <?= form_error('firstname', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="lastname">Last Name</label>
                                        <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Enter Lastname">
                                        <?= form_error('lastname', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Phone Number</label>
                                        <input type="number" class="form-control" name="phone" id="phone" placeholder="Enter Phone Number">
                                        <?= form_error('phone', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <textarea class="form-control" name="address" id="address" rows="5">

                                                </textarea>
                                        <?= form_error('address', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Role User</label>
                                        <select class="form-control" id="roleuser" name="roleuser">
                                            <?php
                                            $i = 0;
                                            while ($i < count($role_data)) {

                                            ?>
                                                <option value="<?= $role_data[$i]->id; ?>"><?= ucfirst($role_data[$i]->role_name); ?></option>
                                            <?php
                                                $i++;
                                            }; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Store</label>
                                        <select class="form-control" id="store" name="store">
                                            <?php
                                            $i = 0;
                                            while ($i < count($store_data)) {

                                            ?>
                                                <option value="<?= $store_data[$i]->id; ?>"><?= ucfirst($store_data[$i]->store_name); ?></option>
                                            <?php
                                                $i++;
                                            }; ?>
                                        </select>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="card-action">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>