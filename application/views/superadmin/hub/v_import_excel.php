            <div class="content">
              <div class="page-inner">

                <div class="row justify-content-center">
                  <div class="col-md-8">
                    <div class="card">

                      <div class="card-header bg-dark">
                          <div class="card-title text-warning"><?= $mainTitle ?></div>
                      </div>

                      <div class="card-body my-3">
                        <div class="row justify-content-center my-3">
                          <div class="col-10 col-md-8">
                            <form method="POST" enctype="multipart/form-data" class="form">
                              <span style="color:red;"><sup><i>*only superadmin and higher privileges can import to database</i></sup></span>
                              <input type="text" name="table-name" placeholder="Nama Tabel" class="form-control col-8" autofocus>
                              <div><?= form_error('table-name') ?></div>
                              <input type="file" name="excelFile" class="my-2">
                              <div><?= form_error('excelFile') ?></div>
                              <div class="mt-4">
                                <input type="submit" name="submit" class="mr-1 px-5 py-2 btn btn-sm btn-success">
                                <a href=<?= base_url("superadmin/hub")  ?> class="ml-1 px-5 py-2 btn btn-sm btn-light btn-border">Kembali</a>
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