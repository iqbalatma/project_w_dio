            <div class="content">
              <div class="page-inner">
                <div class="page-header">
                  <h4 class="page-title"><?= $title ?></h4>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="card">

                      <form method="post">
                        <div class="card-body my-3">

                          <div class="row justify-content-center">
                            <div class="col-md-6 col-lg-8">
                              <div class="form-group d-flex">
                                <img src="<?= base_url('assets/img/logo.png') ?>" alt="" class="img-fluid border" width="300px">
                                <div class="ml-4">
                                  <label for="edit-logo">Upload logo baru</label>
                                  <input type="file" class="form-control-file" id="edit-logo">
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="row justify-content-center">
                            <div class="col-md-5 col-lg-5">
                              <div class="form-group">
                                <label for="edit-nama-perusahaan">
                                  Nama perusahaan
                                </label>
                                <input 
                                  type        = "text" 
                                  id          = "edit-nama-perusahaan" 
                                  name        = "edit-nama-perusahaan" 
                                  placeholder = "Nama perusahaan" 
                                  value       = "<?= $meta->fullname ?>" 
                                  class       = "form-control <?php if(form_error('edit-nama-perusahaan') !== ''){ echo 'is-invalid'; } ?>"
                                >
                                <?= form_error('edit-nama-perusahaan') ?>
                              </div>
                              <div class="form-group">
                                <label for="edit-alamat-perusahaan">
                                  Alamat perusahaan
                                </label>
                                <input 
                                  type        = "text" 
                                  id          = "edit-alamat-perusahaan" 
                                  name        = "edit-alamat-perusahaan" 
                                  placeholder = "Alamat perusahaan" 
                                  value       = "<?= $meta->address ?>" 
                                  class       = "form-control <?php if(form_error('edit-alamat-perusahaan') !== ''){ echo 'is-invalid'; } ?>"
                                >
                                <?= form_error('edit-alamat-perusahaan') ?>
                              </div>
                              <div class="form-group">
                                <label for="edit-website">
                                  Alamat website
                                </label>
                                <input 
                                  type        = "text" 
                                  id          = "edit-website" 
                                  name        = "edit-website" 
                                  placeholder = "Alamat website" 
                                  value       = "<?= $meta->website ?>" 
                                  class       = "form-control <?php if(form_error('edit-website') !== ''){ echo 'is-invalid'; } ?>"
                                >
                                <?= form_error('edit-website') ?>
                              </div>
                            </div>

                            <div class="col-md-5 col-lg-5">
                              <div class="form-group">
                                <label for="edit-kontak-1">
                                  Kontak 1
                                </label>
                                <input 
                                  type        = "tel" 
                                  minlength   = "10"
                                  maxlength   = "14"
                                  id          = "edit-kontak-1" 
                                  name        = "edit-kontak-1" 
                                  placeholder = "Kontak 1" 
                                  value       = "<?= $meta->contact_1 ?>" 
                                  class       = "form-control <?php if(form_error('edit-kontak-1') !== ''){ echo 'is-invalid'; } ?>"
                                >
                                <?= form_error('edit-kontak-1') ?>
                              </div>
                              <div class="form-group">
                                <label for="edit-kontak-2">
                                  Kontak 2
                                </label>
                                <input 
                                  type        = "tel" 
                                  minlength   = "10"
                                  maxlength   = "14"
                                  id          = "edit-kontak-2" 
                                  name        = "edit-kontak-2" 
                                  placeholder = "Kontak 2" 
                                  value       = "<?= $meta->contact_2 ?>" 
                                  class       = "form-control <?php if(form_error('edit-kontak-2') !== ''){ echo 'is-invalid'; } ?>"
                                >
                                <?= form_error('edit-kontak-2') ?>
                              </div>
                              <div class="form-group">
                                <label for="edit-email">
                                  E-mail
                                </label>
                                <input 
                                  type        = "email" 
                                  id          = "edit-email" 
                                  name        = "edit-email" 
                                  placeholder = "E-mail" 
                                  value       = "<?= $meta->email ?>" 
                                  class       = "form-control <?php if(form_error('edit-email') !== ''){ echo 'is-invalid'; } ?>"
                                >
                                <?= form_error('edit-email') ?>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="card-action row justify-content-center">
                          <a href=<?= base_url("informasi-perusahaan") ?> class="btn btn-light btn-border col-3 mx-1">
                            Batal
                          </a>
                          <button type="submit" class="btn btn-secondary col-3 mx-1">
                            Simpan
                          </button>
                        </div>
                      </form>

                    </div>
                  </div>
                </div>
              </div>
            </div>