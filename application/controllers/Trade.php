<?php

require_once APPPATH.'..\asset\fpdf\fpdf.php';
class Trade extends CI_Controller{
    function __construct(){
        parent:: __construct();
		date_default_timezone_set('Asia/Jakarta');
        $tp='MNG';
        if ($tp=='MNG') {
            $this->page = 'MenuPage';
        }else if ($tp=='GOV') {
            $this->page = 'MenuPageGov';
        }elseif ($tp=='SYS') {
            $this->page = 'MenuPageGov';
        }
        $this->bulan = ['01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember'];
        $this->PDF = new FPDF();
        $this->waktu = date('Y-m-d H:i:s');
        if (true) {
            $this->ret=true;
        }else{
            $this->ret=false;
        }
    }

    function index(){
        $data['page']=$this->page;
        $data['title'] = 'Homepage';
        //echo $this->input->get('tipe');
        $this->load->view('General/home',$data);
    }

    function distribution($type='html'){//=================OK
        $data['page']=$this->page;
        $data['title'] = '';
        $data['bln'] = $this->bulan;
        $data['tahun'] = date('Y');
        $data['bulan'] = date('m');
        if (isset($_GET['tahun'])) {
            $data['tahun'] = $this->input->get('tahun',TRUE);
            $data['bulan'] = $this->input->get('bulan',TRUE);
        }
        $data['thn'] = $this->tm->get_tahun();
        $data['v'] = $this->tm->get_total_penjualan($data['tahun'],$data['bulan'],true);
        $data['value']=$this->tm->get_info_distribusi($data['tahun'],$data['bulan']);
        $data['v_grafik']=$this->fm->get_grafik_nilai_distribusi($data['tahun']);
        $data['v_grafik2']=$this->fm->get_grafik_nilai_non_distribusi($data['tahun']);
        // echo $data['v']->hg;
        
        if ($type=='html') {
            $this->load->view('MenuPage/Main/distribution',$data);
            // echo $data['v_grafik2'];
        }else{
            if ($this->ret) {
                $val['ses']='Ok';
                $val['tabel']=$data['value'];
                $val['row']=isset($data['v']->hg)?$data['v']->hg:0;
                $val['grafik']=json_decode($data['v_grafik']);
                $val['grafik2']=json_decode($data['v_grafik2']);
            }else{
                $val['ses']='Off';
            }
            echo json_encode($val);
        }
    }


    function distribusi_barang(){//=============ada view
        $data['page']=$this->page;
        $data['title'] = '';
        $data['tanggal'] = date('d/m/Y');
        $data['v']=$this->lm->get_komoditas('JSON');
        $data['v2'] = $this->am->get_rekanan('JSON');
        $this->load->view('MenuPage/Form/tambah_distribusi_barang',$data);
    }
    
    function catat_transaksi(){//=============ada view
        $data['page']=$this->page;
        $data['title'] = 'Pencatatan penjualan';
        $data['tanggal'] = date('d/m/Y');
        $this->load->view('MenuPage/Form/catat_transaksi',$data);
    }

    function form_barang_keluar(){//=============ada view
        $data['page']=$this->page;
        $data['title'] = '';
        $data['tanggal'] = date('d/m/Y');
        $data['v']=$this->lm->get_komoditas('JSON');
        $data['v2'] = $this->am->get_rekanan('json');
        $this->load->view('MenuPage/Form/tambah_barang_keluar',$data);
    }

    function set_barang_keluar(){
        $nama = $this->input->post('komoditas',TRUE);
        $n_kom = $this->input->post('n_kom',TRUE);
        $n_sat = $this->input->post('n_sat',TRUE);
        $n_mit = $this->input->post('n_mit',TRUE);
        $jumlah = $this->input->post('jumlah',TRUE);
        $tujuan = $this->input->post('tujuan',TRUE);
        $mitra = $this->input->post('mitra',TRUE);
        $harga = $this->input->post('nilai',TRUE);
        $harga = $harga?$harga:null;
        $sat = $this->input->post('sat',TRUE);
        $tanggal = $this->input->post('tanggal',TRUE);
        $tanggal = date('Y-m-d',strtotime($tanggal));
        $catatan = $this->input->post('cat',TRUE);
        $mesg =  $tujuan=='Distribusi'?' kepada '.$n_mit:null;
        $pesan = 'Penerimaan dari penjualan '.$n_kom.' sebanyak '.$jumlah.' '.$n_sat.' untuk tujuan '.$tujuan  .$mesg;

        
        $v = $this->tm->tambah_distribusi($nama, $jumlah, $tujuan, $mitra, $sat, $harga, $tanggal, $catatan);
        if ($v['stat']&&$harga&&isset($_POST['tambah_trans'])) {
            $v1=$this->fm->set_arus_kas('IN', $pesan, $harga, date('Y-m-d',strtotime($tanggal)), 'System', $v['id']);
            if ($v1['res']) {
                $log_mes = '[TAMBAH][KEUANGAN][STOK KELUAR]['.$v1['id'].']['.$v['id'].'] Menambah arus kas masuk (Debit) untuk penjualan '.$n_kom.' sebanyak '.$jumlah.' '.$n_sat;
                $this->hr->log_admin('0081578813144', $log_mes, date('Y-m-d'), date('H:i:s'));
            }
        }
        if ($v['stat']) {
            $log_mesg = '[TAMBAH][STOK KELUAR]['.$v['id'].'] Stok '.$n_kom.' keluar sebanyak '.$jumlah.' '.$n_sat.' untuk '.$tujuan.$mesg;
            $this->hr->log_admin('0081578813144', $log_mesg, date('Y-m-d'), date('H:i:s'));
            $data = $this->lm->get_komoditas('JSON');
            echo json_encode(['resp'=>200,'data'=>$data]);
        }else{
            echo json_encode(['resp'=>100]);
        }
        
        // echo json_encode($_POST);
    }

    function form_edit_barang_keluar_gudang($id){//=============ada view
        $data['page']=$this->page;
        $data['title'] = '';
        $data['tanggal'] = date('d/m/Y');
        $data['v'] = $this->tm->get_edit_stok_keluar($id);
        $data['v2'] = $this->am->get_rekanan('JSON');
        // echo json_encode($data['v']);
        $this->load->view('MenuPage/Form/edit_barang_keluar_gudang',$data);
    }

    function edit_barang_keluar(){
        $n_kom = $this->input->post('nama',TRUE);
        $id = $this->input->post('id',TRUE);
        $jn = $this->input->post('tujuan',TRUE);
        $mt = $this->input->post('mitra',TRUE);
        $mt = $mt?$mt:null;
        $jl = $this->input->post('jumlah',TRUE);
        $st = $this->input->post('satuan',TRUE);
        $nl = $this->input->post('nilai',TRUE);
        $nl = $nl?$nl:null;
        $ck = $this->input->post('potong_saldo',TRUE);
        $tg = $this->input->post('tanggal',TRUE);
        $tg = date('Y-m-d',strtotime($tg));
        $ct = $this->input->post('catatan',TRUE);
        $n_mit = $this->input->post('n_mit',TRUE);

        //$mesg =  $tujuan=='Distribusi'?' kepada '.$n_mit:null;
        $ext = $jn=='Distribusi'?$jn.' kepada '.$n_mit:'Non-distribusi';
        $log_mesg = '[EDIT][STOK KELUAR]['.$id.'] Perubahan data '.$n_kom.' keluar/distribusi sebanyak '.$jl.' '.$st;

        $resp=false;

        $v = $this->tm->edit_stok_keluar($id,$jl, $tg, $jn, $ct, $mt, $nl);
        if ($v) {//perubahan data stok
            $this->hr->log_admin('0081578813144', $log_mesg, date('Y-m-d'), date('H:i:s'));
            $resp =true;
        }

        if ($ck) {//perubahan data keuangan
            $ket_kas = 'Penerimaan dari penjualan '.$n_kom.' sebanyak '.$jl.' '.$st.' untuk tujuan '.$ext;
            $v = $this->fm->set_arus_kas('IN', $ket_kas, $nl, $tg, 'System', $id);
            if ($v['res']) {
                $log_mesg='[TAMBAH][KEUANGAN][STOK KELUAR]['.$v['id'].']['.$id.'] Menambah catatan keuangan dari penjualan '.$n_kom.' sebanyak '.$jl.' '.$st.' untuk '.$ext;
                $this->hr->log_admin('0081578813144', $log_mesg, date('Y-m-d'), date('H:i:s'));
                $resp = true;
            }else{
                $v=$this->fm->edit_arus_kas($id, $nl, 'Debit', $tg, $ket_kas);
                if ($v['resp']) {
                    $log_mesg='[EDIT][KEUANGAN][STOK KELUAR]['.$v['id'].']['.$id.'] Perubahan catatan keuangan dari penjualan '.$n_kom.' sebanyak '.$jl.' '.$st.' untuk '.$ext;
                    $this->hr->log_admin('0081578813144', $log_mesg, date('Y-m-d'), date('H:i:s'));
                    $resp = true;
                }
            }
        }else {//perubahan data keuangan
            $v = $this->fm->del_keuangan($id);
            $log_mesg='[HAPUS][KEUANGAN][STOK KELUAR]['.$id.']['.$id.'] Menghapus data keuangan dari penjualan '.$n_kom.' sebanyak '.$jl.' '.$st;
            if ($v['res']) {//log delete kas
                $this->hr->log_admin('0081578813144', $log_mesg, date('Y-m-d'), date('H:i:s'));
                $resp=true;
            }
        }

        if ($resp) {
            echo 200;
            // echo json_encode($_POST);
        }
    }

    function pdf_detail_komoditas_keluar($id){
        $v = $this->lm->get_detail_komoditas($id);
        $r= $this->lm->get_detail_komoditas_keluar($id,'json');($id);
        // $r = $this->lm->get_komoditas('JSON');
        // membuat halaman baru
        // echo '<title>Belanja barang</title>';
        $this->PDF->AddPage();
        // setting jenis font yang akan digunakan
        $this->PDF->SetFont('Arial','B',16);
        // mencetak string 
        $this->PDF->Cell(190,7,'INFORMASI KOMODITAS '.strtoupper(isset($v[0])?$v[0]->nk:'-'),0,1,'C');
        $this->PDF->SetFont('Arial','B',12);
        $this->PDF->Cell(190,7,'BUMDES Pujotirto',0,1,'C');
        $this->PDF->Cell(190,0,'',1,1);
        // Memberikan space kebawah agar tidak terlalu rapat
        $this->PDF->Cell(10,7,'',0,1);
        $this->PDF->SetFont('Arial','',15);
        $this->PDF->Cell(190,7,date('d/m/Y'),0,1,'R');
        
        
        $this->PDF->Cell(190,10,'',0,1);

        $this->PDF->Cell(30,7,'Komoditas :',0,0);
        $this->PDF->Cell(50,7,isset($v[0])?$v[0]->nk:'-',0,0);
        $this->PDF->Cell(40,7,'',0,0);
        $this->PDF->Cell(30,7,'Harga jual :',0,0);
        $this->PDF->Cell(50,7,isset($v[0])?$v[0]->hj:'-',0,1);

        $this->PDF->Cell(190,5,'',0,1);

        $this->PDF->Cell(30,7,'Stok           :',0,0);
        $this->PDF->Cell(50,7,isset($v[0])?$v[0]->sk:'-',0,0);
        $this->PDF->Cell(40,7,'',0,0);
        $this->PDF->Cell(30,7,'Harga beli :',0,0);
        $this->PDF->Cell(50,7,isset($v[0])?$v[0]->hb:'-',0,1);

        
        $this->PDF->Cell(190,10,'',0,1);
        
        /*
        $this->PDF->SetFont('Arial','',12);
        $this->PDF->Cell(80,10,'Total nilai barang keluar',0,1);
        $this->PDF->SetFont('Arial','B',20);
        $this->PDF->Cell(190,10,'Rp. 400,000',0,1,'C');
        $this->PDF->Cell(10,10,'',0,1);*/
        $this->PDF->SetFont('Arial','',15);
        $this->PDF->Cell(10,10,'Historis telur masuk',0,1);

        $this->PDF->SetFont('Arial','B',11);
        $this->PDF->Cell(10,6,'No',1,0);
        $this->PDF->Cell(20,6,'Tanggal',1,0,'C');
        $this->PDF->Cell(81,6,'Jenis',1,0,'C');
        $this->PDF->Cell(18,6,'Jumlah',1,0,'C');
        $this->PDF->Cell(23,6,'Nilai',1,0,'C');
        $this->PDF->Cell(23,6,'Untung',1,0,'C');
        $this->PDF->Cell(15,6,'Stok',1,1,'C');
        $this->PDF->SetFont('Arial','',9);
        
        foreach ($r as $key => $v) {
            $this->PDF->Cell(10,6,($key+1),1,0,'C');
            $this->PDF->Cell(20,6,date('d/m/Y',strtotime($v->tg)),1,0);
            $this->PDF->Cell(81,6,$v->ct,1,0);
            $this->PDF->Cell(18,6,$v->jl,1,0);
            $this->PDF->Cell(23,6,'Rp. '.$v->nl,1,0);
            $this->PDF->Cell(23,6,'Rp. '.$v->kn,1,0);
            $this->PDF->Cell(15,6,$v->stk,1,1);
        }
        $this->PDF->Output('I','Daftar_barang_'.date('d_m_Y').'.pdf');
    }



}
