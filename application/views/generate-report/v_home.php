            <div class="content">
              <div class="page-inner">
                <div class="page-header">
                  <h4 class="page-title"><?= $title ?></h4>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="card">

                      <form method="post" enctype='multipart/form-data'>
                        <div class="card-body my-3">

                          <div class="row justify-content-center">
                            <div class="col-md-6 col-lg-8">
                              <div class="form-group d-flex justify-content-center">
                                <div class="ml-4 mt-3">
                                  <label for="imagefile">Upload logo</label>
                                  <input type="file" id="imagefile" name='imagefile' accept=".png, .jpg, .jpeg" class="form-control-file">
                                </div>
                              </div>
                            </div>
                          </div>

                        </div>

                        <div class="card-action row justify-content-center">
                          <input type="hidden" name="upload" id="upload" value="upload">
                          <button type="submit" class="btn btn-success col-3 mx-1">
                            Simpan
                          </button>
                        </div>
                      </form>

                    </div>
                  </div>
                </div>
              </div>
            </div>