            <div class="content">
              <div class="page-inner">
                <div class="page-header">
                  <h4 class="page-title"><?= $title ?></h4>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="card">
                      <!-- <div class="card-header">
                          <div class="card-title">Form Elements</div>
                      </div> -->
                      <div class="card-body my-3">
                        <div class="row">
                          <div class="col-md-6 col-lg-8 mb-3">
                            <?php $date = explode(" ", $meta->updated_at) ?>
                            Terakhir diupdate pada  <strong><?= $date[0] ?></strong>, pukul <strong><?= $date[1] ?></strong>
                            <br>
                            Oleh <strong><?= $meta->updated_by ?></strong>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6 col-lg-4">
                            <img src="<?= base_url('assets/img/logo.png') ?>" alt="" class="img-fluid border" width="400px">
                          </div>
                          <div class="col-md-6 col-lg-8">
                            <table>
                              <tr>
                                <td>
                                  Nama perusahaan
                                </td>
                                <td width="20px">
                                  :
                                </td>
                                <td class="h4">
                                  <?= $meta->fullname ?>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  Alamat perusahaan
                                </td>
                                <td width="20px">
                                  :
                                </td>
                                <td class="h4">
                                  <?= $meta->address ?>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  Kontak 1
                                </td>
                                <td width="20px">
                                  :
                                </td>
                                <td class="h4">
                                  <a href="tel:<?= $meta->contact_1 ?>"><?= $meta->contact_1 ?></a>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  Kontak 2
                                </td>
                                <td width="20px">
                                  :
                                </td>
                                <td class="h4">
                                  <a href="tel:<?= $meta->contact_2 ?>"><?= $meta->contact_2 ?></a>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  E-mail
                                </td>
                                <td width="20px">
                                  :
                                </td>
                                <td class="h4">
                                  <a href="mailto:<?= $meta->email ?>"><?= $meta->email ?></a>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  Alamat website
                                </td>
                                <td width="20px">
                                  :
                                </td>
                                <td class="h4">
                                  <a href="<?= $meta->website ?>"><?= $meta->website ?></a>
                                </td>
                              </tr>
                            </table>
                          </div>
                        </div>
                      </div>
                      <div class="card-action row justify-content-center">
                        <a href=<?= current_url() . '/edit' ?> class="btn btn-default col-6 mx-1">Edit profil</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>