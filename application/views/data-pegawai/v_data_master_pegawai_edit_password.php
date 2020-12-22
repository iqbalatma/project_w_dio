            <div class="content">
              <div class="page-inner">

                <div class="row">
                  <div class="col-md-12">
                    <div class="card">

                      <div class="card-header">
                        <div class="d-flex align-items-center">
                          <h4 class="card-title font-weight-bold"><?= $title ?></h4>
                          <a href="<?= base_url( 'data-pegawai/' . getBeforeLastSegment('', 2) ) ?>" class="close ml-auto p-1">
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
                                  <label for="edit-lastname">
                                    Nama depan
                                  </label>
                                  <input 
                                    type        = "text" 
                                    id          = "edit-firstname" 
                                    name        = "edit-firstname" 
                                    placeholder = "Nama depan" 
                                    value       = "<?= (set_value('edit-firstname') !== '') ? set_value('edit-firstname') : $employee->first_name ; ?>"
                                    class       = "form-control <?php if(form_error('edit-firstname') !== ''){ echo 'is-invalid'; } ?>"
                                    disabled
                                  >
                                  <?= form_error('edit-firstname') ?>
                                </div>
                                <!-- 2 -->
                                <div class="form-group row ml-1">
                                  <label for="edit-lastname">
                                    Nama belakang
                                  </label>
                                  <input 
                                    type        = "text" 
                                    id          = "edit-lastname" 
                                    name        = "edit-lastname" 
                                    placeholder = "Nama belakang" 
                                    value       = "<?= (set_value('edit-lastname') !== '') ? set_value('edit-lastname') : $employee->last_name ; ?>"
                                    class       = "form-control <?php if(form_error('edit-lastname') !== ''){ echo 'is-invalid'; } ?>"
                                    disabled
                                  >
                                  <?= form_error('edit-lastname') ?>
                                </div>
                              </div>
                              <!-- 3 -->
                              <div class="form-group row">
                                <label for="edit-lastname">
                                  Username
                                </label>
                                <input 
                                  type        = "text" 
                                  id          = "edit-username" 
                                  name        = "edit-username" 
                                  placeholder = "username" 
                                  value       = "<?= (set_value('edit-username') !== '') ? set_value('edit-username') : $employee->username ; ?>"
                                  class       = "form-control <?php if(form_error('edit-username') !== ''){ echo 'is-invalid'; } ?>"
                                  disabled
                                >
                                <?= form_error('edit-username') ?>
                              </div>

                              <hr width="70%" class="my-4">

                              <!-- 4 -->
                              <div class="form-group row">
                                <label for="edit-pwnew">
                                  Password baru <span class="text-danger">*</span>
                                </label>
                                <input 
                                  type        = "password" 
                                  id          = "edit-pwnew" 
                                  name        = "edit-pwnew" 
                                  placeholder = "Masukkan lebih dari 5 karakter untuk password baru"
                                  class       = "form-control <?php if(form_error('edit-pwnew') !== ''){ echo 'is-invalid'; } ?>"
                                >
                                <?= form_error('edit-pwnew') ?>
                              </div>
                              <!-- 5 -->
                              <div class="form-group row">
                                <label for="edit-pwnewconf">
                                  Ulangi password baru <span class="text-danger">*</span>
                                </label>
                                <input 
                                  type        = "password" 
                                  id          = "edit-pwnewconf" 
                                  name        = "edit-pwnewconf" 
                                  placeholder = "Masukkan kembali password baru anda"
                                  class       = "form-control <?php if(form_error('edit-pwnewconf') !== ''){ echo 'is-invalid'; } ?>"
                                >
                                <?= form_error('edit-pwnewconf') ?>
                              </div>

                              <!-- button -->
                              <div class="form-group row justify-content-center mt-3">
                                <a href="<?= base_url( 'data-pegawai/' . getBeforeLastSegment() ) ?>" class="btn btn-outline-secondary col-5 mx-1">
                                  Batal
                                </a>
                                <button type="submit" class="btn btn-success col-5 mx-1">
                                  Simpan
                                </button>
                                <input type="hidden" name="id" value="<?= $employee->id ?>">
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