<div class="content">
              <div class="page-inner">

                <div class="row">
                  <div class="col-md-12">
                    <div class="card">

                      <div class="card-header">
                        <div class="d-flex align-items-center">
                          <h4 class="card-title font-weight-bold"><?= $title ?></h4>
                          <!-- <a href="<?= base_url( 'data-pegawai/' . getBeforeLastSegment() ) ?>" class="close ml-auto p-1">
                            <span aria-hidden="true">&times;</span>
                          </a>
                          Hapus data -->
                        </div>
                      </div>

                      <div class="card-body">
                        <div class="row justify-content-center">
                          <div class="col-8 mt-2">

                            <div class="row d-flex">
                              <div class="col-5 mx-auto">
                                <!-- 1 -->
                                <div class="d-flex avatar avatar-xxl mx-auto">
                                  <img src="<?= base_url("assets/img/avatar/{$employee->avatar}") ?>" alt="" class="avatar-img rounded">
                                </div>
                                <div class="d-flex justify-content-center mt-3">
                                  <span class="h4 text-capitalize">
                                    <i class="fas fa-user-tie mr-1"></i>
                                    <?= $employeeRole->role_name ?>
                                  </span>
                                  <span class="h4 mx-2">-</span>
                                  <span class="h4 text-capitalize">
                                    <i class="fas fa-building mr-1"></i>
                                    <?= $employeeStore->store_name ?>
                                  </span>
                                </div>
                                <!-- 2 -->
                                <div class="mt-3">
                                  <h5 class="font-weight-bold"> Username </h5>
                                  <div class="d-flex">

                                    <h5 class="w-100 bg-light pr-2 py-2 rounded">
                                      <span class="mr-1 p-2 bg-dark text-white rounded" id="basic-addon1">@</span>
                                      <?= $employee->username ?>
                                    </h5>
                                  </div>
                                </div>
                                <!-- 3 -->
                                <div class="mt-3">
                                  <h5 class="font-weight-bold"> E-mail </h5>
                                  <h5 class="bg-light px-2 py-2 rounded"><?= $employee->email ?></h5>
                                </div>
                              </div>

                              <div class="col-5 mx-auto">
                                <!-- 1 -->
                                <div class="mt-3">
                                  <h5 class="font-weight-bold"> Nama depan </h5>
                                  <h5 class="bg-light px-2 py-2 rounded"><?= $employee->first_name ?></h5>
                                </div>
                                <!-- 2 -->
                                <div class="mt-3">
                                  <h5 class="font-weight-bold"> Nama belakang </h5>
                                  <h5 class="bg-light px-2 py-2 rounded"><?= $employee->last_name ?></h5>
                                </div>
                                <!-- 3 -->
                                <div class="mt-3">
                                  <h5 class="font-weight-bold"> No. Handphone </h5>
                                  <h5 class="bg-light px-2 py-2 rounded"><?= $employee->phone ?></h5>
                                </div>
                                <!-- 4 -->
                                <div class="mt-3">
                                  <h5 class="font-weight-bold"> Alamat </h5>
                                  <h5 class="bg-light px-2 py-2 rounded"><?= $employee->address ?></h5>
                                </div>
                              </div>
                            </div>

                            <!-- button -->
                            <form action="<?= base_url("{$menuActive}/{$submenuActive}/edit-pass") ?>" method="post">
                              <div class="form-group row justify-content-center mt-5">
                                <a href="<?= base_url( "{$menuActive}/" . getBeforeLastSegment('', 2) ) ?>" class="btn btn-outline-secondary col-3 mx-1">
                                  Keluar
                                </a>
                                <button type="submit" class="btn btn-outline-danger col-4 mx-1">
                                  Ubah password
                                </button>
                                <input type="hidden" name="id" value="<?= $employee->id ?>">
                                <a href="<?= base_url( "{$menuActive}/{$submenuActive}/edit/" . getLastSegment() ) ?>" class="btn btn-default col-3 mx-1">
                                  Perbarui data
                                </a>
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