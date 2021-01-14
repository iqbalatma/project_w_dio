            <div class="content">
              <div class="page-inner">

                <div class="row">
                  <div class="col-md-12">
                    <div class="card">

                      <div class="card-header">
                        <div class="d-flex align-items-center">
                          <h4 class="card-title font-weight-bold"><?= $title ?></h4>
                          <a href="<?= base_url( 'data-produksi/' . getBeforeLastSegment('', 2) ) ?>" class="close ml-auto p-1">
                            <span aria-hidden="true">&times;</span>
                          </a>
                        </div>
                      </div>

                      <div class="card-body">
                        <div class="row justify-content-center">
                          <div class="col-10 col-md-8 col-xl-7">

                            <form method="post" enctype='multipart/form-data'>
                              <div class="d-flex">
                                <div class="col-6 mr-2">
                                  <div class="form-group d-flex-row justify-content-center">
                                    <img src="<?= base_url("assets/img/product/{$product->image}") ?>" alt="" class="img-fluid border rounded p-2" width="300px">
                                    <div class="mt-4">
                                      <label for="edit-foto">Upload foto produk <span class="text-danger">**</span></label>
                                      <input type="file" id="edit-foto" name='edit-foto' accept=".png, .jpg, .jpeg" class="form-control-file">
                                      <br>
                                      <span class="text-danger">** Gambar hanya bisa .jpg, .jpeg, dan .png</span>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-6 ml-2">
                                  <!-- 1 -->
                                  <div class="form-group row">
                                    <label for="edit-kodeproduk">
                                      Kode produk
                                    </label>
                                    <input 
                                      type        = "text" 
                                      id          = "edit-kodeproduk" 
                                      name        = "edit-kodeproduk" 
                                      placeholder = "Kode produk" 
                                      value       = "<?= (set_value('edit-kodeproduk') !== '') ? set_value('edit-kodeproduk') : $product->product_code ; ?>"
                                      class       = "form-control <?php if(form_error('edit-kodeproduk') !== ''){ echo 'is-invalid'; } ?>"
                                      readonly
                                    >
                                    <?= form_error('edit-kodeproduk') ?>
                                  </div>
                                  <!-- 2 -->
                                  <div class="form-group row">
                                    <label for="edit-fullname">
                                      Nama produk <span class="text-danger">*</span>
                                    </label>
                                    <input 
                                      type        = "text" 
                                      id          = "edit-fullname" 
                                      name        = "edit-fullname" 
                                      placeholder = "Nama lengkap produk" 
                                      value       = "<?= (set_value('edit-fullname') !== '') ? set_value('edit-fullname') : $product->full_name ; ?>"
                                      class       = "form-control <?php if(form_error('edit-fullname') !== ''){ echo 'is-invalid'; } ?>"
                                      maxlength   = 100
                                      autofocus
                                    >
                                    <?= form_error('edit-fullname') ?>
                                  </div>
                                  <!-- 3 -->
                                  <div class="form-group row">
                                    <label for="edit-unit">
                                      Unit <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-control <?php if (form_error('edit-unit') !== '') {echo 'is-invalid';} ?>" name="edit-unit">
                                      <option disabled selected>-- pilih unit --</option>
                                        <?php // <option value="gram"  echo ($product->unit == 'gram')?('selected'):('') > Gram </option> ?>
                                        <option value="mililiter" <?php echo ($product->unit == 'mililiter')?('selected'):('') ?>> Mililiter </option>
                                        <option value="liter"     <?php echo ($product->unit == 'liter')?('selected'):('') ?>> Liter </option>
                                        <option value="pcs"       <?php echo ($product->unit == 'pcs')?('selected'):('') ?>> Pcs </option>
                                        <option value="sachet"    <?php echo ($product->unit == 'sachet')?('selected'):('') ?>> Sachet </option>
                                        <option value="galon"     <?php echo ($product->unit == 'galon')?('selected'):('') ?>> Galon </option>
                                        <option value="drum"      <?php echo ($product->unit == 'drum')?('selected'):('') ?>> Drum </option>
                                        <option value="pail"      <?php echo ($product->unit == 'pail')?('selected'):('') ?>> pail </option>
                                    </select>
                                    <?= form_error('edit-unit') ?>
                                  </div>
                                  <!-- 4 -->
                                  <div class="form-group row">
                                    <label for="edit-volume">
                                      Volume / Berat / Jumlah <span class="text-danger">*</span>
                                    </label>
                                    <input 
                                      type        = "tel" 
                                      id          = "edit-volume" 
                                      name        = "edit-volume" 
                                      placeholder = "Volume / berat / jumlah per unit" 
                                      value       = "<?= (set_value('edit-volume') !== '') ? set_value('edit-volume') : $product->volume ; ?>"
                                      class       = "form-control <?php if(form_error('edit-volume') !== ''){ echo 'is-invalid'; } ?>"
                                      pattern     = "[0-9]{1,6}" 
                                      title       = "Harus angka minimal 1 dan maksimal 6 angka"
                                    >
                                    <?= form_error('edit-volume') ?>
                                  </div>
                                  
                                  <!-- grouping row -->
                                  <div class="d-flex justify-content-center">
                                    <!-- 1 -->
                                    <div class="form-group row col-12 px-0">
                                      <label for="edit-hpp">
                                        HPP
                                      </label>
                                      <input 
                                        type        = "text" 
                                        id          = "edit-hpp" 
                                        name        = "edit-hpp" 
                                        placeholder = "HPP" 
                                        value       = "<?= (set_value('edit-hpp') !== '') ? set_value('edit-hpp') : $product->price_base ?>"
                                        class       = "hpp form-control <?php if(form_error('edit-hpp') !== ''){ echo 'is-invalid'; } ?>"
                                        disabled
                                      >
                                    </div>
                                  </div>
                                  
                                  <!-- grouping row -->
                                  <div class="d-flex justify-content-center">
                                    <!-- 1 -->
                                    <div class="form-group row mr-1 col-6 px-0">
                                      <label for="edit-sellingprice">
                                        Harga jual normal <span class="text-danger">*</span>
                                      </label>
                                      <input 
                                        type        = "tel" 
                                        id          = "edit-sellingprice" 
                                        name        = "edit-sellingprice" 
                                        placeholder = "Harga normal" 
                                        value       = "<?= (set_value('edit-sellingprice') !== '') ? set_value('edit-sellingprice') : $product->selling_price ; ?>"
                                        class       = "sellingprice live-typing form-control <?php if(form_error('edit-sellingprice') !== ''){ echo 'is-invalid'; } ?>"
                                        pattern     = "[0-9]{1,8}" 
                                        title       = "Harus angka minimal satu dan maksimal 8 angka"
                                        data-filter = "\+?\d{0,8}"
                                      >
                                      <?= form_error('edit-sellingprice') ?>
                                    </div>
                                    <!-- 2 -->
                                    <div class="form-group row ml-1 col-6 px-0">
                                      <label for="edit-resellerprice">
                                        Harga jual reseller <span class="text-danger">*</span>
                                      </label>
                                      <input 
                                        type        = "tel" 
                                        id          = "edit-resellerprice" 
                                        name        = "edit-resellerprice" 
                                        placeholder = "Harga reseller" 
                                        value       = "<?= (set_value('edit-resellerprice') !== '') ? set_value('edit-resellerprice') : $product->reseller_price ; ?>"
                                        class       = "resellerprice live-typing form-control <?php if(form_error('edit-resellerprice') !== ''){ echo 'is-invalid'; } ?>"
                                        pattern     = "[0-9]{1,8}" 
                                        title       = "Harus angka minimal satu dan maksimal 8 angka"
                                        data-filter = "\+?\d{0,8}"
                                      >
                                      <?= form_error('edit-resellerprice') ?>
                                    </div>
                                  </div>
                                  
                                  <!-- grouping row -->
                                  <div class="d-flex justify-content-start">
                                    <p>Prosentase margin&nbsp;:</p>
                                    <p class="live-output ml-2"></p>
                                  </div>

                                  <!-- grouping row -->
                                  <!-- <div class="mt-2 d-flex justify-content-center"> -->
                                    <!-- 1 -->
                                    <!-- <div class="form-group row mr-1 col-6 px-0">
                                      <label for="edit-pricereseller">
                                        Harga jual reseller <span class="text-danger">*</span>
                                      </label>
                                      <input 
                                        type        = "text" 
                                        id          = "edit-pricereseller" 
                                        name        = "edit-pricereseller" 
                                        placeholder = "Harga reseller" 
                                        value       = ""
                                        class       = "form-control "
                                      >
                                    </div> -->
                                    <!-- 2 -->
                                    <!-- <div class="form-group row ml-1 col-6 px-0">
                                      <label for="edit-pricewholesale">
                                        Harga jual grosir
                                      </label>
                                      <input 
                                        type        = "text" 
                                        id          = "edit-pricewholesale" 
                                        name        = "edit-pricewholesale" 
                                        placeholder = "Harga grosir" 
                                        value       = ""
                                        class       = "form-control "
                                      >
                                    </div> -->
                                  <!-- </div> -->

                                </div>
                              </div>
                              
                              <hr class="my-5" width="80%">

                              <!-- button -->
                              <div class="form-group row justify-content-center mb-4">
                                <a href="<?= base_url( 'data-produksi/'.getBeforeLastSegment('', 2)."/detail/{$product->id}" ) ?>" class="btn btn-outline-secondary col-5 mx-1">
                                  Kembali
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