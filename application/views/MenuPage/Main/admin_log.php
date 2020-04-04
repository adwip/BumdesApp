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
          <!-- <div class="">
            <div class="page-title">
              <div class="title_left">
                <h1>Manajemen Toko Bumdes</h1> 
              </div>
            </div>
          </div> -->
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
              <h1>Log admin pengelola</h1>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <div class="row">
                  <div class="col-md-12">
                    <div class="row">
                        <form id="log-admin" action="admin-log">
                            <div class="col-md-6 col-sm-6">  
                              <div class="form-group">
                                  <label for="">Tahun</label>
                                  <select name="tahun" class="form-control" onchange="$('#log-admin').submit()">
                                    <?php 
                                      foreach ($v_tahun as $key => $val) {
                                        $val->thn==$y?$sel='selected':$sel=null;
                                        echo '<option '.$sel.' value="'.$val->thn.'">'.$val->thn.'</option>';
                                      }
                                    ?>
                                  </select>
                              </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                              <div class="form-group">
                                <label for="">Bulan</label>
                                <select name="bulan" class="form-control" onchange="$('#log-admin').submit()">
                                <?php 
                                  foreach ($bln as $key => $val) {
                                    $key==$m?$sel='selected':$sel=null;
                                    echo '<option '.$sel.' value="'.$key.'">'.$val.'</option>';
                                  }
                                  ?>
                                </select>
                              </div>
                            </div>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h1>Manajemen BUMDes</h1>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form action="">
                      <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Keterangan</th>
                            <th>Waktu log</th>
                            <th>Tanggal log</th>
                          </tr>
                        </thead>

                        <tbody id="val-body">
                          <?= $v ?>
                        </tbody>
                      </table>
                    </form>
                  </div>
                </div>
              </div>
          </div>
          <br>
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
    <!--Javascript tambahan -->
    <script src="<?= base_url('asset') ?>/JS/Fitur.js"></script>
    <!-- <script src="<?= base_url('asset/JS/Ajax_req.js') ?>"></script> -->
  </body>
</html>