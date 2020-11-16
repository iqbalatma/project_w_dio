            <div class="content">
              <div class="page-inner">

                <div class="row">
                  <div class="col-md-12">
                    <div class="card">

                      <div class="card-header">
                        <div class="d-flex align-items-center">
                          <h4 class="card-title font-weight-bold"><?= $title ?></h4>
                          <a href="<?= base_url( 'data-pegawai/' . getBeforeLastSegment() ) ?>" class="close ml-auto p-1">
                            <span aria-hidden="true">&times;</span>
                          </a>
                        </div>
                      </div>

                      <div class="card-body">
                        <div class="row justify-content-center">
                          <div class="col-10 col-md-6 col-lg-6 col-xl-4">

                            <form method="post">
                              <!-- grouping row -->
                              <div class="d-flex">
                                <!-- 1 -->
                                <div class="form-group row mr-1">
                                  <label for="add-firstname">
                                    Nama depan <span class="text-danger">*</span>
                                  </label>
                                  <input 
                                    type        = "text" 
                                    id          = "add-firstname" 
                                    name        = "add-firstname" 
                                    placeholder = "Nama depan" 
                                    value       = "<?= set_value('add-firstname') ?>"
                                    class       = "form-control <?php if(form_error('add-firstname') !== ''){ echo 'is-invalid'; } ?>"
                                    autofocus
                                  >
                                  <?= form_error('add-firstname') ?>
                                </div>
                                <!-- 2 -->
                                <div class="form-group row ml-1">
                                  <label for="add-lastname">
                                    Nama belakang
                                  </label>
                                  <input 
                                    type        = "text" 
                                    id          = "add-lastname" 
                                    name        = "add-lastname" 
                                    placeholder = "Nama belakang" 
                                    value       = "<?= set_value('add-lastname') ?>"
                                    class       = "form-control <?php if(form_error('add-lastname') !== ''){ echo 'is-invalid'; } ?>"
                                  >
                                  <?= form_error('add-lastname') ?>
                                </div>
                              </div>
                              <!-- 3 -->
                              <div class="form-group row">
                                <label for="add-phone">
                                  Nomor handphone <span class="text-danger">*</span>
                                </label>
                                <input 
                                  type        = "tel" 
                                  minlength   = "10"
                                  maxlength   = "14"
                                  id          = "add-phone" 
                                  name        = "add-phone" 
                                  placeholder = "cth: 085619559999" 
                                  value       = "<?= set_value('add-phone') ?>"
                                  class       = "form-control <?php if(form_error('add-phone') !== ''){ echo 'is-invalid'; } ?>"
                                >
                                <?= form_error('add-phone') ?>
                              </div>
                              <!-- 4 -->
                              <div class="form-group row">
                                <label for="add-address">
                                  Alamat <span class="text-danger">*</span>
                                </label>
                                <textarea 
                                  cols        = "30"
                                  rows        = "3"
                                  id          = "add-address" 
                                  name        = "add-address" 
                                  placeholder = "Alamat lengkap pegawai" 
                                  class       = "form-control <?php if(form_error('add-address') !== ''){ echo 'is-invalid'; } ?>"
                                ><?= set_value('add-address') ?></textarea>
                                <?= form_error('add-address') ?>
                              </div>
                              <!-- 5 -->
                              <div class="form-group row">
                                <label for="add-role">
                                  Jabatan <span class="text-danger">*</span>
                                </label>
                                <select class="form-control" name="add-role">
                                  <option disabled selected>-- pilih jabatan --</option>
                                  <?php foreach ($roles as $role): ?>
                                    <?php if ($role->role_name === 'superadmin') continue; ?>
                                    <option value="<?php echo $role->id ?>">
                                      <?php echo $role->role_name ?>
                                    </option>
                                  <?php endforeach; ?>
                                </select>
                                <?= form_error('add-role') ?>
                              </div>
                              <!-- 6 -->
                              <div class="form-group row">
                                <label for="add-store">
                                  Toko cabang <span class="text-danger">*</span>
                                </label>
                                <select class="form-control" name="add-store">
                                  <option disabled selected>-- pilih toko cabang --</option>
                                  <?php foreach ($stores as $store): ?>
                                    <option value="<?php echo $store->id ?>">
                                      <?php echo $store->store_name ?>
                                    </option>
                                  <?php endforeach; ?>
                                </select>
                                <?= form_error('add-store') ?>
                              </div>

                              <hr width="70%" class="mt-4 mb-3">
                              
                              <!-- 7 -->
                              <div class="form-group row">
                                <label for="add-username">
                                  username <span class="text-danger">*</span>
                                </label>
                                <input 
                                  type        = "text" 
                                  id          = "add-username" 
                                  name        = "add-username" 
                                  placeholder = "Username" 
                                  value       = "<?= set_value('add-username') ?>"
                                  class       = "form-control <?php if(form_error('add-username') !== ''){ echo 'is-invalid'; } ?>"
                                >
                                <?= form_error('add-username') ?>
                              </div>
                              <!-- 7 -->
                              <div class="form-group row">
                                <label for="add-email">
                                  E-mail <span class="text-danger">*</span>
                                </label>
                                <input 
                                  type        = "text" 
                                  id          = "add-email" 
                                  name        = "add-email" 
                                  placeholder = "Alamat E-mail" 
                                  value       = "<?= set_value('add-email') ?>"
                                  class       = "form-control <?php if(form_error('add-email') !== ''){ echo 'is-invalid'; } ?>"
                                >
                                <?= form_error('add-email') ?>
                              </div>
                              <!-- 8 -->
                              <div class="form-group row">
                                <label for="add-password">
                                  Password <span class="text-danger">*</span>
                                </label>
                                <input 
                                  type        = "text" 
                                  id          = "add-password" 
                                  name        = "add-password" 
                                  placeholder = "Password" 
                                  value       = "<?= set_value('add-password') ?>"
                                  class       = "form-control <?php if(form_error('add-password') !== ''){ echo 'is-invalid'; } ?>"
                                >
                                <?= form_error('add-password') ?>
                              </div>
                              <!-- 9 -->
                              <div class="form-group row">
                                <label for="add-verPassword">
                                  Ulangi password <span class="text-danger">*</span>
                                </label>
                                <input 
                                  type        = "text" 
                                  id          = "add-verPassword" 
                                  name        = "add-verPassword" 
                                  placeholder = "Ulangi untuk konfirmasi" 
                                  value       = "<?= set_value('add-verPassword') ?>"
                                  class       = "form-control <?php if(form_error('add-verPassword') !== ''){ echo 'is-invalid'; } ?>"
                                >
                                <?= form_error('add-verPassword') ?>
                              </div>

                              <!-- button -->
                              <div class="form-group row justify-content-center mt-3">
                                <a href="<?= base_url( 'data-pegawai/' . getBeforeLastSegment() ) ?>" class="btn btn-light btn-border col-5 mx-1">
                                  Batal
                                </a>
                                <button type="submit" class="btn btn-success col-5 mx-1">
                                  Simpan
                                </button>
                              </div>
                            </form>

                          </div>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>

              </div>
            </div>