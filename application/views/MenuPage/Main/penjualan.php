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
    <!-- bootstrap-daterangepicker -->
    <link href="<?= base_url('asset/') ?>/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- bootstrap-datetimepicker -->
    <link href="<?= base_url('asset/') ?>/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
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
        
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
            <h1>Laporan kegiatan penjualan</h1>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <div class="row">
                <div class="col-md-3">
                  <button class="btn btn-md btn-warning">Unduh laporan penjualan</button>
                </div>
                <div class="col-md-3">
                  <a href="add-transaction" class="btn btn-md btn-info">Input hasil penjualan</a>
                </div>
                <div class="col-md-6">
                  <div class="row">
                    <form id="TipForm" action="">
                      <div class="col-md-4 col-sm-4">  
                        <div class="form-group">
                          <select name="tipe" class="form-control">
                            <option value="Hari">Minggu</option>
                            <option selected value="Bulan">Bulan</option>
                            <option value="Tahun">Tahun</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-4">
                        <div class="form-group">
                          <select name="subjek" class="form-control">
                            <option value="minggu">Januari</option>
                            <option value="bulan">Februari</option>
                            <option value="Tahun">Maret</option>
                            <option value="Tahun">April</option>
                            <option value="Tahun">Juni</option>
                            <option value="Tahun">Juli</option>
                            <option value="Tahun">Agustus</option>
                            <option value="Tahun">September</option>
                            <option value="Tahun">Oktober</option>
                            <option value="Tahun">November</option>
                            <option value="Tahun">Desember</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-4" style="display: none;">
                        <div class="form-group">
                          <div class='input-group date' id='myDatepicker2'>
                              <input disabled value="<?= $tanggal ?>" type='text' name="subjek" class="form-control" />
                              <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                              </span>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <button type="submit" class="btn btn-md btn-primary">Tampilkan</button>
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
        <br>
        <br>
          <div class="row tile_count">
            <div class="col-md-12 col-sm-12 col-xs-12 tile_stats_count">
              <span class="count_top"><h4><i class="fa fa-user"></i> Laba penjualan</h4></span>
              <div class="count text-center">Rp. 50,000,000</div>
            </div>
          </div>
          <br>
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h3>Informasi kegiatan penjualan</h3>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <form action="">
                      <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Tujuan</th>
                            <th><i>Author</i></th>
                            <th>Tanggal</th>
                            <th>Transaksi</th>
                            <th>Ekstra</th>
                          </tr>
                        </thead>

                        <tbody>
                          <tr>
                            <td>1</td>
                            <td>X-puru store</td>
                            <td>Tony stark</td>
                            <td>10/02/2016</td>
                            <td>Rp. 2,000,000</td>
                            <td><?= anchor('#','Detail') ?></td>
                          </tr>
                          <tr>
                            <td>2</td>
                            <td>Erag store</td>
                            <td>Steve rogers</td>
                            <td>10/02/2016</td>
                            <td>Rp. 2,000,000</td>
                            <td><?= anchor('#','Detail') ?></td>
                          </tr>
                        </tbody>
                      </table>
                    </form>
            </div>
          </div>
        </div>
          
          <br>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">
                <div class="row x_title">
                  <div class="col-md-4">
                    <h3>Grafik penjualan</h3>
                  </div>
                </div>

                <div class="col-md-10 col-sm-10 col-xs-12">
                  <!-- <div id="chart_plot_01" class="demo-placeholder"></div> -->
                  <div id="grafik_penjualan"></div>
                </div>
                <div class="col-md-1 col-sm-1 col-xs-12 bg-white">
                  <div class="x_title">
                    <h2>Barang paling laku</h2>
                    <div class="clearfix"></div>
                  </div>

                  <div class="col-md-12 col-sm-12 col-xs-6">
                    <ul>
                      <li>Pupuk</li>
                      <li>Sabun</li>
                      <li>Oli</li>
                      <li>Sanck</li>
                    </ul>
                  </div>

                </div>

                <div class="clearfix"></div>
              </div>
            </div>
          </div>
          <br>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer style="border-top: 1px solid #d9dee4;">
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <?php $this->load->view('SuptPage/JsP') ?>
    <!--Highchart-->
    <script src = "https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="<?= base_url('asset/') ?>/JS/Highchart.js"></script>
    <script src="<?= base_url('asset/') ?>/JS/Form_hapus.js"></script>
    <!--Javascript tambahan -->
    <script src="<?= base_url('asset') ?>/JS/Fitur.js"></script>
    <script src="<?= base_url('asset/JS/Ajax_req.js') ?>"></script>
    <script type="text/javascript">
      testGraf()
      testGraf2()
      $('#myDatepicker2').datetimepicker({
        format: 'DD/MM/YYYY'
    });
    </script>
  </body>
</html>