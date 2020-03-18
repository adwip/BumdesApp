<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Bumdes kalipuru | <?= $title ?></title>

    <?php $this->load->view('SuptPage/CssP') ?>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?= base_url() ?>" class="site_title"><i class="fa fa-paw"></i> <span>Bumdes kalipuru</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="https://1.bp.blogspot.com/-kuf6W_Yxf5E/WFqXlaCcAeI/AAAAAAAAIL0/V9UhNuz6MhMJciRalykCPaaPp6QCaPjYwCLcB/s1600/Arnold-Schwarzenegger-n-aime-pas-son-corps.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>John Doe</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <?php $this->load->view('SuptPage/'.$page) ?>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <?php $this->load->view('SuptPage/FooterButton') ?>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <?php $this->load->view('SuptPage/Notifikasi') ?>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main" style="color: black;">
            <div class="col-md-12">
                <button class="btn btn-md btn-warning" onclick="window.location.href=document.referrer"> Kembali</button>
            </div>
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Informasi aset</h3>
              </div>
            </div>
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Data Aset</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-md-3 col-sm-3 col-xs-3 profile_left">
                      <div class="profile_img">
                        <div id="crop-avatar">
                          <!-- Current avatar -->
                          <img style="padding: .5px; border: 1px solid black; max-height: 150px; max-width: 250px;" class="img-responsive avatar-view" src="<?= isset($v[0]->img)?base_url('asset/gambar/'.$v[0]->img):base_url('asset/gambar/unnamed.png') ?>" alt="<?= isset($v[0])?$v[0]->nm:'-' ?>" title="<?= isset($v[0])?$v[0]->nm:'-' ?>">
                        </div>
                      </div>
                      <h3>Tiyo Bumdes</h3>

                      <ul class="list-unstyled user_data">
                        <li><i class="fa fa-map-marker user-profile-icon"></i> <?= isset($v[0])?$v[0]->lk:'-' ?>
                        </li>
                      </ul>
                      
                      <a href="ganti-password" class="btn btn-xs btn-warning"><i class="fa fa-gears m-right-xs"></i> Ubah data aset</a>
                      <br />

                      <!-- start skills -->
                      <!-- <h4>Aktivitas</h4>
                      <ul class="list-unstyled user_data">
                        <li>
                          <p>Penambahan data</p>
                            <label>60</label>
                        </li>
                        <li>
                          <p>Perubahan data</p>
                            <label>13</label>
                        </li>
                        <li>
                          <p>Penghapusan data</p>
                            <label>10</label>
                        </li>
                      </ul> -->
                      <!-- end of skills -->

                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-9">

                      <div class="profile_title">
                        <div class="col-md-6">
                          <h2>Data aset</h2>
                        </div>
                        <div class="col-md-6">
                        </div>
                      </div><br>
                      <!-- start of user-activity-graph -->
                        <table class="col-md-12 col-sm-12 col-xs-12">
                            <tr>
                                <td class="col-md-2 col-sm-2 col-xs-2"><h5>Aset :</h5></td>
                                <td class="col-md-4 col-sm-4 col-xs-4"><h4><?= isset($v[0])?$v[0]->nm:'-' ?></h4></td>
                                <td class="col-md-2 col-sm-2 col-xs-2"><h5>Nomor :</h5></td>
                                <td class="col-md-4 col-sm-4 col-xs-4"><h4><?= isset($v[0])?$v[0]->na:'-' ?></h4></td>
                            </tr>
                            <tr>
                                <td class="col-md-2 col-sm-2 col-xs-2"><h5>Sumber :</h5></td>
                                <td class="col-md-4 col-sm-4 col-xs-4"><h4><?= isset($v[0])?$v[0]->sb:'-' ?></h4></td>
                                <td class="col-md-2 col-sm-2 col-xs-2"><h5>Kondisi :</h5></td>
                                <td class="col-md-4 col-sm-4 col-xs-4"><h4><?= isset($v[0])?$v[0]->kd:'-' ?></h4></td>
                            </tr>
                            <tr>
                                <td class="col-md-2 col-sm-2 col-xs-2"><h5>Keadaan :</h5></td>
                                <td class="col-md-4 col-sm-4 col-xs-4"><h4><?= isset($v[0])?$v[0]->kn:'-' ?></h4></td>
                                <td class="col-md-2 col-sm-2 col-xs-2"><h5>Sumber :</h5></td>
                                <td class="col-md-4 col-sm-4 col-xs-4"><h4><?= isset($v[0])?$v[0]->sb:'-' ?></h4></td>
                            </tr>
                            <tr>
                                <td class="col-md-2 col-sm-2 col-xs-2"><h5>Keterangan :</h5></td>
                                <td colspan="3" class="col-md-4 col-sm-4 col-xs-4"><p><?= isset($v[0])?$v[0]->kt:'-' ?></p></td>
                            </tr>
                        </table>
                      <!-- end of user-activity-graph -->
                    </div>
                  </div>
                </div>
              </div>
            </div><br>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Histori penyewaan</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      
                  </div>
                </div>
              </div>
            </div><br>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Histori bagi hasil</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    

    <?php $this->load->view('SuptPage/JsP') ?>
    <script src="<?= base_url('asset/JS/Fitur.js') ?>"></script>
    <script src="<?= base_url('asset/JS/Form.js') ?>"></script>
  </body>
</html>
