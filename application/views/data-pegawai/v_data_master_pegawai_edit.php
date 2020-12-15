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
                                    Nama depan <span class="text-danger">*</span>
                                  </label>
                                  <input 
                                    type        = "text" 
                                    id          = "edit-firstname" 
                                    name        = "edit-firstname" 
                                    placeholder = "Nama depan" 
                                    value       = "<?= (set_value('edit-firstname') !== '') ? set_value('edit-firstname') : $employee->first_name ; ?>"
                                    class       = "form-control <?php if(form_error('edit-firstname') !== ''){ echo 'is-invalid'; } ?>"
                                    autofocus
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
                                  >
                                  <?= form_error('edit-lastname') ?>
                                </div>
                              </div>
                              <!-- 3 -->
                              <div class="form-group row">
                                <label for="edit-phone">
                                  Nomor handphone <span class="text-danger">*</span>
                                </label>
                                <input 
                                  type        = "tel" 
                                  minlength   = "10"
                                  maxlength   = "14"
                                  id          = "edit-phone" 
                                  name        = "edit-phone" 
                                  placeholder = "cth: 085619559999" 
                                  value       = "<?= (set_value('edit-phone') !== '') ? set_value('edit-phone') : $employee->phone ; ?>"
                                  class       = "form-control <?php if(form_error('edit-phone') !== ''){ echo 'is-invalid'; } ?>"
                                >
                                <?= form_error('edit-phone') ?>
                              </div>
                              <!-- 4 -->
                              <div class="form-group row">
                                <label for="edit-address">
                                  Alamat <span class="text-danger">*</span>
                                </label>
                                <textarea 
                                  cols        = "30"
                                  rows        = "3"
                                  id          = "edit-address" 
                                  name        = "edit-address" 
                                  placeholder = "Alamat lengkap pegawai" 
                                  class       = "form-control <?php if(form_error('edit-address') !== ''){ echo 'is-invalid'; } ?>"
                                ><?= (set_value('edit-address') !== '') ? set_value('edit-address') : $employee->address ; ?></textarea>
                                <?= form_error('edit-address') ?>
                              </div>
                              <!-- 5 -->
                              <div class="form-group row">
                                <label for="edit-role">
                                  Jabatan <span class="text-danger">*</span>
                                </label>
                                <select class="form-control" name="edit-role">
                                  <option>-- pilih jabatan --</option>
                                  <?php foreach ($roles as $role): ?>
                                    <?php if ($role->role_name === 'superadmin') continue; ?>
                                    <option value=<?php echo "{$role->id}" ?> <?php echo ($employee->role_id == $role->id)?('selected'):('') ?>>
                                      <?php echo "{$role->role_name}" ?>
                                    </option>
                                  <?php endforeach; ?>
                                </select>
                                <?= form_error('edit-role') ?>
                              </div>
                              <!-- 6 -->
                              <div class="form-group row">
                                <label for="edit-store">
                                  Toko cabang <span class="text-danger">*</span>
                                </label>
                                <select class="form-control" name="edit-store">
                                  <option>-- pilih toko cabang --</option>
                                  <?php foreach ($stores as $store): ?>
                                    <option value=<?php echo "{$store->id}" ?> <?php echo ($employee->store_id == $store->id)?('selected'):('') ?>>
                                        <?php echo "{$store->store_name}" ?>
                                      </option>
                                  <?php endforeach; ?>
                                </select>
                                <?= form_error('edit-store') ?>
                              </div>

                              <!-- button -->
                              <div class="form-group row justify-content-center mt-3">
                                <a href="<?= base_url( 'data-pegawai/' . getBeforeLastSegment('', 2) ) ?>" class="btn btn-outline-secondary col-5 mx-1">
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