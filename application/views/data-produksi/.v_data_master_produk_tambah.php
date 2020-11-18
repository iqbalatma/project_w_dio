            <div class="content">
              <div class="page-inner">

                <div class="row">

                <!-- <div class="container">
                  <h2>Dynamic Tabs</h2>
                  <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
                    <li><a data-toggle="tab" href="#menu1">Menu 1</a></li>
                    <li><a data-toggle="tab" href="#menu2">Menu 2</a></li>
                    <li><a data-toggle="tab" href="#menu3">Menu 3</a></li>
                  </ul>

                  <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">
                      <h3>HOME</h3>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                    <div id="menu1" class="tab-pane fade">
                      <h3>Menu 1</h3>
                      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>
                    <div id="menu2" class="tab-pane fade">
                      <h3>Menu 2</h3>
                      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                    </div>
                    <div id="menu3" class="tab-pane fade">
                      <h3>Menu 3</h3>
                      <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                    </div>
                  </div>
                </div> -->

                  <div class="col-md-12">
                    <div class="card">

                      <div class="card-header">
                        <div class="d-flex align-items-center">
                          <h4 class="card-title font-weight-bold"><?= $title ?></h4>
                          <a href="<?= base_url('data-produksi/' . getBeforeLastSegment()) ?>" class="close ml-auto p-1">
                            <span aria-hidden="true">&times;</span>
                          </a>
                        </div>
                      </div>

                      <div class="card-body">
                        <div class="row justify-content-center">
                          <div class="col-10 col-md-6 col-lg-6 col-xl-4">

                            <?php if ($this->session->wizard == '1') { ?>
                              <form id="1" method="post" action="<?= current_url() ?>">
                                <input type="hidden" value="1" name="step">
                                <!-- 1 -->
                                <div class="form-group row">
                                  <label for="add-kodeproduk">
                                    Kode produk <span class="text-danger">*</span>
                                  </label>
                                  <input 
                                    type        = "text"
                                    id          = "add-kodeproduk"
                                    name        = "add-kodeproduk" 
                                    placeholder = "Kode produk" 
                                    value       = "<?= set_value('add-kodeproduk') ?>"
                                    class       = "form-control <?php if (form_error('add-kodeproduk') !== '') {echo 'is-invalid';} ?>" 
                                    autofocus
                                  >
                                  <?= form_error('add-kodeproduk') ?>
                                </div>
                                <!-- 2 -->
                                <div class="form-group row">
                                  <label for="add-fullname">
                                    Nama produk <span class="text-danger">*</span>
                                  </label>
                                  <input 
                                    type        = "text"
                                    id          = "add-fullname"
                                    name        = "add-fullname" 
                                    placeholder = "Nama lengkap produk" 
                                    value       = "<?= set_value('add-fullname') ?>"
                                    class       = "form-control <?php if (form_error('add-fullname') !== '') {echo 'is-invalid';} ?>" 
                                  >
                                  <?= form_error('add-fullname') ?>
                                </div>
                                <!-- 3 -->
                                <div class="form-group row">
                                  <label for="add-unit">
                                    Unit <span class="text-danger">*</span>
                                  </label>
                                  <select class="form-control" name="add-unit">
                                    <option disabled selected>-- pilih unit --</option>
                                      <option value="gram"> Gram </option>
                                      <option value="mililiter"> Mililiter </option>
                                  </select>
                                  <?= form_error('add-unit') ?>
                                </div>
                                <!-- 4 -->
                                <div class="form-group row">
                                  <label for="add-volume">
                                    Volume <span class="text-danger">*</span>
                                  </label>
                                  <input 
                                    type        = "text"
                                    id          = "add-volume"
                                    name        = "add-volume" 
                                    placeholder = "Komposisi / berat / ukuran per unit" 
                                    value       = "<?= set_value('add-volume') ?>"
                                    class       = "form-control <?php if (form_error('add-volume') !== '') {echo 'is-invalid';} ?>" 
                                    autofocus
                                  >
                                  <?= form_error('add-volume') ?>
                                </div>

                                <!-- button -->
                                <div class="form-group row justify-content-center mt-3">
                                  <a href="<?= base_url('data-produksi/' . getBeforeLastSegment()) ?>" class="btn btn-light btn-border col-5 mx-1">
                                    Batal
                                  </a>
                                  <button type="submit" class="btn btn-success col-5 mx-1">
                                    Selanjutnya <i class="ml-2 fas fa-arrow-right"></i>
                                  </button>
                                </div>
                              </form>

                            <?php } elseif ($this->session->wizard == '2') { ?>

                              <form id="2" method="post" action="<?= current_url() ?>">
                                <input type="hidden" value="2" name="step">
                                <!-- 1 -->
                                <div class="form-group row">
                                  <label for="add-firstname">
                                    Kode 2 <span class="text-danger">*</span>
                                  </label>
                                  <input 
                                    type        = "text"
                                    id          = "add-kodeproduk"
                                    name        = "add-kodeproduk" 
                                    placeholder = "Nama depan" 
                                    value       = "<?= set_value('add-firstname') ?>"
                                    class       = "form-control <?php if (form_error('add-firstname') !== '') {echo 'is-invalid';} ?>" 
                                    autofocus
                                  >
                                  <?= form_error('add-firstname') ?>
                                </div>
                                <!-- 2 -->
                                <div class="form-group row">
                                  <label for="add-firstname">
                                    Nama produk <span class="text-danger">*</span>
                                  </label>
                                  <input 
                                    type        = "text"
                                    id          = "add-firstname"
                                    name        = "add-firstname" 
                                    placeholder = "Nama depan" 
                                    value       = "<?= set_value('add-firstname') ?>"
                                    class       = "form-control <?php if (form_error('add-firstname') !== '') {echo 'is-invalid';} ?>" 
                                    autofocus
                                  >
                                  <?= form_error('add-firstname') ?>
                                </div>
                                <!-- 3 -->
                                <div class="form-group row">
                                  <label for="add-role">
                                    Unit <span class="text-danger">*</span>
                                  </label>
                                  <select class="form-control" name="add-role">
                                    <option disabled selected>-- pilih unit --</option>
                                    <?php foreach ($roles as $role) : ?>
                                      <?php if ($role->role_name === 'superadmin') continue; ?>
                                      <option value="<?php echo $role->id ?>">
                                        <?php echo $role->role_name ?>
                                      </option>
                                    <?php endforeach; ?>
                                  </select>
                                  <?= form_error('add-role') ?>
                                </div>
                                <!-- 4 -->
                                <div class="form-group row">
                                  <label for="add-firstname">
                                    Volume <span class="text-danger">*</span>
                                  </label>
                                  <input 
                                    type        = "text"
                                    id          = "add-firstname"
                                    name        = "add-firstname" 
                                    placeholder = "Nama depan" 
                                    value       = "<?= set_value('add-firstname') ?>"
                                    class       = "form-control <?php if (form_error('add-firstname') !== '') {echo 'is-invalid';} ?>" 
                                    autofocus
                                  >
                                  <?= form_error('add-firstname') ?>
                                </div>

                                <!-- button -->
                                <div class="form-group row justify-content-center mt-3">
                                  <a href="<?= base_url('data-pegawai/' . getBeforeLastSegment()) ?>" class="btn btn-light btn-border col-5 mx-1">
                                    Batal
                                  </a>
                                  <button type="submit" class="btn btn-success col-5 mx-1">
                                    Simpan
                                  </button>
                                </div>
                              </form>

                            <?php } elseif ($this->session->wizard == '3') { ?>

                              <form id="3" method="post" action="<?= current_url() ?>">
                                <input type="hidden" value="3" name="step">
                                <!-- 1 -->
                                <div class="form-group row">
                                  <label for="add-firstname">
                                    Kode 3 <span class="text-danger">*</span>
                                  </label>
                                  <input 
                                    type        = "text"
                                    id          = "add-kodeproduk"
                                    name        = "add-kodeproduk" 
                                    placeholder = "Nama depan" 
                                    value       = "<?= set_value('add-firstname') ?>"
                                    class       = "form-control <?php if (form_error('add-firstname') !== '') {echo 'is-invalid';} ?>" 
                                    autofocus
                                  >
                                  <?= form_error('add-firstname') ?>
                                </div>
                                <!-- 2 -->
                                <div class="form-group row">
                                  <label for="add-firstname">
                                    Nama produk <span class="text-danger">*</span>
                                  </label>
                                  <input 
                                    type        = "text"
                                    id          = "add-firstname"
                                    name        = "add-firstname" 
                                    placeholder = "Nama depan" 
                                    value       = "<?= set_value('add-firstname') ?>"
                                    class       = "form-control <?php if (form_error('add-firstname') !== '') {echo 'is-invalid';} ?>" 
                                    autofocus
                                  >
                                  <?= form_error('add-firstname') ?>
                                </div>
                                <!-- 3 -->
                                <div class="form-group row">
                                  <label for="add-role">
                                    Unit <span class="text-danger">*</span>
                                  </label>
                                  <select class="form-control" name="add-role">
                                    <option disabled selected>-- pilih unit --</option>
                                    <?php foreach ($roles as $role) : ?>
                                      <?php if ($role->role_name === 'superadmin') continue; ?>
                                      <option value="<?php echo $role->id ?>">
                                        <?php echo $role->role_name ?>
                                      </option>
                                    <?php endforeach; ?>
                                  </select>
                                  <?= form_error('add-role') ?>
                                </div>
                                <!-- 4 -->
                                <div class="form-group row">
                                  <label for="add-firstname">
                                    Volume <span class="text-danger">*</span>
                                  </label>
                                  <input 
                                    type        = "text"
                                    id          = "add-firstname"
                                    name        = "add-firstname" 
                                    placeholder = "Nama depan" 
                                    value       = "<?= set_value('add-firstname') ?>"
                                    class       = "form-control <?php if (form_error('add-firstname') !== '') {echo 'is-invalid';} ?>" 
                                    autofocus
                                  >
                                  <?= form_error('add-firstname') ?>
                                </div>

                                <!-- button -->
                                <div class="form-group row justify-content-center mt-3">
                                  <a href="<?= base_url('data-pegawai/' . getBeforeLastSegment()) ?>" class="btn btn-light btn-border col-5 mx-1">
                                    Batal
                                  </a>
                                  <button type="submit" class="btn btn-success col-5 mx-1">
                                    Simpan
                                  </button>
                                </div>
                              </form>
                              <?php } ?>

                          </div>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>

              </div>
            </div>