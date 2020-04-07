<?php

require_once APPPATH.'..\asset\fpdf\fpdf.php';
class Logistic extends CI_Controller{

    function __construct(){
        parent:: __construct();
        date_default_timezone_set('Asia/Jakarta');
        $tp='GOV';
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
            $this->ret['ses']=true;
        }else{
            $this->ret['ses']=false;
        }
    }

    function stok_masuk($type='html'){//=================OK
        $data['page']=$this->page;
        $data['bln'] = $this->bulan;
        $data['title'] = 'Belanja komoditas';
        $data['tahun'] = date('Y');
        $data['bulan'] = date('m');
        if (isset($_GET['tahun'])) {
            $data['tahun'] = $this->input->get('tahun',TRUE);
            $data['bulan'] = $this->input->get('bulan',TRUE);
        }
        $data['value']=$this->lm->get_info_belanja_log($data['tahun'],$data['bulan']);
        $data['thn'] = $this->lm->get_tahun('IN');
        $data['v']=$this->lm->total_belanja_barang($data['tahun'],$data['bulan']);
        $data['v_grafik']=$this->fm->get_grafik_belanja_barang($data['tahun']);
        // echo json_encode($data['thn']);
        if ($type=='html') {
            $this->load->view('MenuPage/Main/inc_goods',$data);
            // echo json_encode($data['v']);
        }else{
            if ($this->ret) {
                $val['ses']='Ok';
                $val['tabel']=$data['value'];
                $val['row']=isset($data['v']->hg)?$data['v']->hg:0;
                $val['grafik']=json_decode($data['v_grafik']);
            }else{
                $val['ses']='Off';
            }
            echo json_encode($val);
        }
    }

    function form_tambah_barang_masuk_gudang(){//=============ada view
        $data['page']=$this->page;
        $data['title'] = '';
        $data['tanggal'] = date('d-m-Y');
        $data['b']=$this->fm->get_saldo();
        $data['v']=$this->lm->get_komoditas('JSON');
        $this->load->view('MenuPage/Form/tambah_barang_masuk_gudang',$data);
        // echo json_encode($_GET);
    }

    function exit_item($type='html'){//=================OK
        $data['page']=$this->page;
        $data['title'] = 'Barang keluar';
        $data['bln'] = $this->bulan;
        $data['tahun'] = date('Y');
        $data['bulan'] = date('m');
        if (isset($_GET['tahun'])) {
            $data['tahun'] = $this->input->get('tahun',TRUE);
            $data['bulan'] = $this->input->get('bulan',TRUE);
        }
        $data['thn'] = $this->lm->get_tahun('OUT');
        $data['v'] = $this->tm->get_total_penjualan($data['tahun'],$data['bulan']);
        $data['value']=$this->lm->get_info_barang_keluar($data['tahun'],$data['bulan']);
        
        if ($type=='html') {
            $this->load->view('MenuPage/Main/exit_item',$data);
        }else{
            if ($this->ret) {
                $val['ses']='Ok';
                $val['tabel']=$data['value'];
                $val['row']=isset($data['v']->hg)?$data['v']->hg:0;
            }else{
                $val['ses']='Off';
            }
            echo json_encode($val);
        }
        // echo json_encode($data['value']);
    }

    function komoditas(){//=================OK
        $data['page']=$this->page;
        $data['title'] = 'Komoditas dagang';
        $data['value']=$this->lm->get_komoditas();
        $data['sat'] = $this->am->get_satuan();
        $this->load->view('MenuPage/Main/komoditas',$data);
        // echo json_encode($data['value']);
    }


    function gov_logistik(){
        $data['page']=$this->page;
        $data['title'] = '';
        $data['tanggal'] = date('d/m/Y');
        $data['v'] = $this->am->get_satuan('json');
        $this->load->view('MenuPage/Form/tambah_komoditas',$data);
    }

    function tambah_komoditas(){//=============ada view
        $data['page']=$this->page;
        $data['title'] = '';
        $data['tanggal'] = date('d/m/Y');
        $data['v'] = $this->am->get_satuan('json');
        $this->load->view('MenuPage/Form/tambah_komoditas',$data);
    }

    function form_edit_barang_masuk_gudang($id){//=============ada view
        $data['page']=$this->page;
        $data['title'] = 'Edit data barang masuk';
        $data['v'] = $this->lm->get_edit_stok_masuk($id);
        $data['b']=$this->fm->get_saldo();
        // echo json_encode($data['v']);
        $this->load->view('MenuPage/Form/edit_barang_masuk_gudang',$data);
    }

    
    function form_edit_komoditas_gudang($id){//=============ada view
        $data['page']=$this->page;
        $data['title'] = '';
        $data['tanggal'] = date('d/m/Y');
        $data['v']=$this->am->get_edit_komoditas($id);
        $data['v2']=$this->am->get_satuan('json');
        $this->load->view('MenuPage/Form/edit_komoditas_gudang',$data);
        // echo json_encode($data['v']);
    }

    function detail_logistik_gdg($id){//=============ada view
        $data['page']=$this->page;
        $data['title'] = '';
        $data['tanggal'] = date('d/m/Y');
        $data['id'] = $id;
        $data['v'] = $this->lm->get_detail_komoditas($id);
        $data['v_tabel_histori'] = $this->lm->get_histori_harga_komoditas($id);
        $this->load->view('MenuPage/Detail_Print/detail_logistik_gdg',$data);
        // echo $data['v_tabel_histori'];
    }

    function detail_logistik_masuk($id, $type='html'){//=============ada view
        $data['page']=$this->page;
        $data['title'] = '';
        $data['tanggal'] = date('d/m/Y');
        $data['id'] = $id;
        $data['y'] = date('Y');
        $data['m'] = date('m');
        if (isset($_GET['tahun'])) {
            $data['y'] = $this->input->get('tahun',TRUE);
            $data['m'] = $this->input->get('bulan',TRUE);
        }
        $data['v'] = $this->lm->get_detail_log_masuk($id);
        $id=isset($data['v']->id)?$data['v']->id:null;
        $data['v_masuk_tabel'] = $this->lm->get_detail_komoditas_masuk($id, $data['y'],$data['m']);
        $data['thn'] = $this->lm->get_tahun_his_log($id, 'IN');
        $data['bln'] = $this->bulan;
        if ($type=='html') {
            $this->load->view('MenuPage/Detail_Print/detail_logistik_masuk',$data);
        }else{
            echo $data['v_masuk_tabel'];
            // echo json_encode($_GET);
        }
    }
    

    function detail_logistik_keluar($id, $type='html'){//=============ada view
        $data['page']=$this->page;
        $data['title'] = '';
        $data['tanggal'] = date('d/m/Y');
        $data['id'] = $id;
        $data['y'] = date('Y');
        $data['m'] = date('m');
        if (isset($_GET['tahun'])) {
            $data['y'] = $this->input->get('tahun',TRUE);
            $data['m'] = $this->input->get('bulan',TRUE);
        }
        $data['v'] = $this->lm->get_detail_log_keluar($id);
        $id=isset($data['v']->id)?$data['v']->id:null;
        $data['v_keluar_tabel'] = $this->lm->get_detail_komoditas_keluar($id, $data['y'],$data['m']);
        $data['thn'] = $this->lm->get_tahun_his_log($id, 'OUT');
        $data['bln'] = $this->bulan;
        if ($type=='html') {
            $this->load->view('MenuPage/Detail_Print/detail_logistik_keluar',$data);
        }else{
            echo $data['v_keluar_tabel'];
        }
    }

    //=============ada view
    function pdf_belanja_barang(){
        $tahun = $this->input->get('tahun');
        $bulan = $this->input->get('bulan');
        $inf_bel=$this->lm->total_belanja_barang($tahun,$bulan);
        $inf_bel = isset($inf_bel->hg)?$inf_bel->hg:0;

        $r = $this->lm->get_info_belanja_log($tahun,$bulan,'JSON');
        // membuat halaman baru
        // echo '<title>Belanja barang</title>';
        $this->PDF->AddPage();
        // setting jenis font yang akan digunakan
        $this->PDF->SetFont('Arial','B',16);
        $logo = base_url().'logo.jpeg';
        $this->PDF->Cell(30,30,$this->PDF->Image($logo, ($this->PDF->GetX()-1), $this->PDF->GetY()-12, 33.58),0);
        // mencetak string 
        $this->PDF->Cell(135,7,'LAPORAN BELANJA BARANG PERUSAHAAN',0,1,'C');
        $this->PDF->SetFont('Arial','B',12);
        $this->PDF->Cell(180,8,'BUMDES Indrakila Jaya',0,1,'C');
        $this->PDF->Cell(190,0,'',1,1);
        // Memberikan space kebawah agar tidak terlalu rapat
        $this->PDF->Cell(10,7,'',0,1);
        $this->PDF->SetFont('Arial','',15);
        $this->PDF->Cell(190,7,$this->bulan[$bulan].' | '.$tahun,0,1,'R');
        $this->PDF->SetFont('Arial','',12);
        $this->PDF->Cell(80,10,'Total nilai belanja',0,1);
        $this->PDF->SetFont('Arial','B',20);
        $this->PDF->Cell(190,10,'Rp. '.$inf_bel,0,1,'C');
        $this->PDF->Cell(10,10,'',0,1);
        $this->PDF->SetFont('Arial','',15);
        $this->PDF->Cell(10,10,'Daftar belanja logistik',0,1);
        $this->PDF->SetFont('Arial','B',11);
        $this->PDF->Cell(10,6,'No',1,0);
        $this->PDF->Cell(60,6,'Komoditas',1,0);
        $this->PDF->Cell(30,6,'Tanggal',1,0);
        $this->PDF->Cell(30,6,'Jumlah',1,0);
        $this->PDF->Cell(30,6,'Harga',1,0);
        $this->PDF->Cell(30,6,'Stok',1,1);
        $this->PDF->SetFont('Arial','',9);
        
        foreach ($r as $key => $v) {
            $this->PDF->Cell(10,6,($key+1),1,0);
            $this->PDF->Cell(60,6,$v->nkom,1,0);
            $this->PDF->Cell(30,6,date('d/m/Y',strtotime($v->tanggal)),1,0);
            $this->PDF->Cell(30,6,$v->jumlah,1,0);
            $this->PDF->Cell(30,6,'Rp. '.$v->nilai,1,0);
            $this->PDF->Cell(30,6,$v->stok,1,1);
        }



        $this->PDF->Output('I','Belanja_barang_12_2019.pdf');
    }

    //=============ada view
    function pdf_barang_keluar(){
        $tahun = $this->input->get('tahun');
        $bulan = $this->input->get('bulan');
        $inf_dist=$this->tm->get_total_penjualan($tahun,$bulan);
        $inf_dist= isset($inf_dist->hg)?$inf_dist->hg:0;
        // tm->get_total_penjualan
        $r = $this->lm->get_info_barang_keluar($tahun,$bulan,'JSON');
        // membuat halaman baru
        // echo '<title>Belanja barang</title>';
        $this->PDF->AddPage();
        // setting jenis font yang akan digunakan
        $this->PDF->SetFont('Arial','B',16);
        $logo = base_url().'logo.jpeg';
        $this->PDF->Cell(30,30,$this->PDF->Image($logo, ($this->PDF->GetX()-1), $this->PDF->GetY()-12, 33.58),0);
        // mencetak string 
        $this->PDF->Cell(128,7,'LAPORAN BARANG KELUAR',0,1,'C');
        $this->PDF->SetFont('Arial','B',12);
        $this->PDF->Cell(180,8,'BUMDES Indrakila Jaya',0,1,'C');
        $this->PDF->Cell(190,0,'',1,1);
        // Memberikan space kebawah agar tidak terlalu rapat
        $this->PDF->Cell(10,7,'',0,1);
        $this->PDF->SetFont('Arial','',15);
        $this->PDF->Cell(190,7,$this->bulan[$bulan].' | '.$tahun,0,1,'R');
        $this->PDF->SetFont('Arial','',12);
        $this->PDF->Cell(80,10,'Total nilai barang keluar',0,1);
        $this->PDF->SetFont('Arial','B',20);
        $this->PDF->Cell(190,10,'Rp. '.$inf_dist,0,1,'C');
        $this->PDF->Cell(10,10,'',0,1);
        $this->PDF->SetFont('Arial','',15);
        $this->PDF->Cell(10,10,'Daftar barang',0,1);
        $this->PDF->SetFont('Arial','B',11);
        $this->PDF->Cell(20,6,'No',1,0);
        $this->PDF->Cell(50,6,'Komoditas',1,0);
        $this->PDF->Cell(30,6,'Tanggal',1,0);
        $this->PDF->Cell(30,6,'Jumlah',1,0);
        $this->PDF->Cell(30,6,'Keperluan',1,0);
        $this->PDF->Cell(30,6,'Sisa stok',1,1);
        $this->PDF->SetFont('Arial','',9);
        
        foreach ($r as $key => $v) {
            $this->PDF->Cell(20,6,($key+1),1,0);
            $this->PDF->Cell(50,6,$v->kom,1,0);
            $this->PDF->Cell(30,6,date('d/m/Y',strtotime($v->tgl)),1,0);
            $this->PDF->Cell(30,6,$v->jlh,1,0);
            $this->PDF->Cell(30,6,$v->tjn,1,0);
            $this->PDF->Cell(30,6,$v->stk,1,1);
        }
        $this->PDF->Output('I','Barang_keluar_12_2019.pdf');
    }

    //=============ada view
    function pdf_distribusi_barang(){
        $tahun = $this->input->get('tahun');
        $bulan = $this->input->get('bulan');
        $inf_dist=$this->tm->get_total_penjualan($tahun,$bulan,true);
        $inf_dist= isset($inf_dist->hg)?$inf_dist->hg:0;
        
        $r = $this->tm->get_info_distribusi($tahun,$bulan,'JSON');
        // membuat halaman baru
        // echo '<title>Belanja barang</title>';
        $this->PDF->AddPage();
        // setting jenis font yang akan digunakan
        $this->PDF->SetFont('Arial','B',16);
        $logo = base_url().'logo.jpeg';
        $this->PDF->Cell(30,30,$this->PDF->Image($logo, ($this->PDF->GetX()-1), $this->PDF->GetY()-12, 33.58),0);
        // mencetak string 
        $this->PDF->Cell(130,7,'LAPORAN DISTRIBUSI BARANG',0,1,'C');
        $this->PDF->SetFont('Arial','B',12);
        $this->PDF->Cell(180,8,'BUMDES Indrakila Jaya',0,1,'C');
        $this->PDF->Cell(190,0,'',1,1);
        // Memberikan space kebawah agar tidak terlalu rapat
        $this->PDF->Cell(10,7,'',0,1);
        $this->PDF->SetFont('Arial','',15);
        $this->PDF->Cell(190,7,$this->bulan[$bulan].' | '.$tahun,0,1,'R');
        $this->PDF->SetFont('Arial','',12);
        $this->PDF->Cell(80,10,'Total nilai barang keluar',0,1);
        $this->PDF->SetFont('Arial','B',20);
        $this->PDF->Cell(190,10,'Rp. '.$inf_dist,0,1,'C');
        $this->PDF->Cell(10,10,'',0,1);
        $this->PDF->SetFont('Arial','',15);
        $this->PDF->Cell(10,10,'Daftar barang keluar',0,1);
        $this->PDF->SetFont('Arial','B',11);
        $this->PDF->Cell(10,6,'No',1,0);
        $this->PDF->Cell(20,6,'Tanggal',1,0);
        $this->PDF->Cell(85,6,'Mitra',1,0);
        $this->PDF->Cell(25,6,'Komoditas',1,0);
        $this->PDF->Cell(20,6,'Jumlah',1,0);
        $this->PDF->Cell(30,6,'Nilai',1,1);
        $this->PDF->SetFont('Arial','',9);
        
        foreach ($r as $key => $v) {
            $this->PDF->Cell(10,6,($key+1),1,0);
            $this->PDF->Cell(20,6,date('d/m/Y',strtotime($v->tgl)),1,0);
            $this->PDF->Cell(85,6,$v->tjn,1,0);
            $this->PDF->Cell(25,6,$v->kom,1,0);
            $this->PDF->Cell(20,6,$v->jlh,1,0);
            $this->PDF->Cell(30,6,'Rp. '.$v->ntr,1,1);
        }
        $this->PDF->Output('I','Distribusi_barang_12_2019.pdf');
    }

    //=============ada view
    function pdf_daftar_komoditas(){
        $r = $this->lm->get_info_distribusi(2020,12,'JSON');
        // membuat halaman baru
        // echo '<title>Belanja barang</title>';
        $this->PDF->AddPage();
        // setting jenis font yang akan digunakan
        $this->PDF->SetFont('Arial','B',16);
        $logo = base_url().'logo.jpeg';
        $this->PDF->Cell(30,30,$this->PDF->Image($logo, ($this->PDF->GetX()-1), $this->PDF->GetY()-12, 33.58),0);
        // mencetak string 
        $this->PDF->Cell(130,7,'LAPORAN DISTRIBUSI BARANG',0,1,'C');
        $this->PDF->SetFont('Arial','B',12);
        $this->PDF->Cell(180,8,'BUMDES Indrakila Jaya',0,1,'C');
        $this->PDF->Cell(190,0,'',1,1);
        // Memberikan space kebawah agar tidak terlalu rapat
        $this->PDF->Cell(10,7,'',0,1);
        $this->PDF->SetFont('Arial','',15);
        $this->PDF->Cell(190,7,'Desember | 2019',0,1,'R');
        $this->PDF->SetFont('Arial','',12);
        $this->PDF->Cell(80,10,'Total nilai barang keluar',0,1);
        $this->PDF->SetFont('Arial','B',20);
        $this->PDF->Cell(190,10,'Rp. 400,000',0,1,'C');
        $this->PDF->Cell(10,10,'',0,1);
        $this->PDF->SetFont('Arial','',15);
        $this->PDF->Cell(10,10,'Daftar barang keluar',0,1);
        $this->PDF->SetFont('Arial','B',11);
        $this->PDF->Cell(20,6,'No',1,0);
        $this->PDF->Cell(30,6,'Tanggal',1,0);
        $this->PDF->Cell(60,6,'Mitra',1,0);
        $this->PDF->Cell(30,6,'Komoditas',1,0);
        $this->PDF->Cell(20,6,'Jumlah',1,0);
        $this->PDF->Cell(30,6,'Nilai',1,1);
        $this->PDF->SetFont('Arial','',9);
        
        foreach ($r as $key => $v) {
            $this->PDF->Cell(20,6,($key+1),1,0);
            $this->PDF->Cell(30,6,date('d/m/Y',strtotime($v->tgl)),1,0);
            $this->PDF->Cell(60,6,$v->tjn,1,0);
            $this->PDF->Cell(30,6,$v->kom,1,0);
            $this->PDF->Cell(20,6,$v->jlh,1,0);
            $this->PDF->Cell(30,6,'Rp. '.$v->ntr,1,1);
        }
        $this->PDF->Output('I','Distribusi_barang_12_2019.pdf');
    }

    //=============ada view
    function pdf_komoditas(){
        $r = $this->lm->get_komoditas('JSON');
        // membuat halaman baru
        // echo '<title>Belanja barang</title>';
        $this->PDF->AddPage();
        // setting jenis font yang akan digunakan
        $this->PDF->SetFont('Arial','B',16);
        $logo = base_url().'logo.jpeg';
        $this->PDF->Cell(30,30,$this->PDF->Image($logo, ($this->PDF->GetX()-1), $this->PDF->GetY()-12, 33.58),0);
        // mencetak string 
        $this->PDF->Cell(130,7,'DAFTAR KOMODITAS DAGANG',0,1,'C');
        $this->PDF->SetFont('Arial','B',12);
        $this->PDF->Cell(180,8,'BUMDES Indrakila Jaya',0,1,'C');
        $this->PDF->Cell(190,0,'',1,1);
        // Memberikan space kebawah agar tidak terlalu rapat
        $this->PDF->Cell(10,7,'',0,1);
        $this->PDF->SetFont('Arial','',15);
        $this->PDF->Cell(190,7,date('d/m/Y'),0,1,'R');/*
        $this->PDF->SetFont('Arial','',12);
        $this->PDF->Cell(80,10,'Total nilai barang keluar',0,1);
        $this->PDF->SetFont('Arial','B',20);
        $this->PDF->Cell(190,10,'Rp. 400,000',0,1,'C');
        $this->PDF->Cell(10,10,'',0,1);*/
        $this->PDF->SetFont('Arial','',15);
        $this->PDF->Cell(10,10,'Daftar komoditas',0,1);
        $this->PDF->SetFont('Arial','B',11);
        $this->PDF->Cell(10,6,'No',1,0);
        $this->PDF->Cell(80,6,'Komoditas',1,0);
        $this->PDF->Cell(30,6,'Stok',1,0);
        $this->PDF->Cell(35,6,'Harga jual',1,0);
        $this->PDF->Cell(35,6,'Harga beli',1,1);
        $this->PDF->SetFont('Arial','',9);
        
        foreach ($r as $key => $v) {            
            $this->PDF->Cell(10,6,($key+1),1,0);
            $this->PDF->Cell(80,6,$v->kom,1,0);
            $this->PDF->Cell(30,6,$v->stk,1,0);
            $this->PDF->Cell(35,6,'Rp. '.$v->hgj,1,0);
            $this->PDF->Cell(35,6,'Rp. '.$v->hgb,1,1);
        }
        $this->PDF->Output('I','Daftar_barang_'.date('d_m_Y').'.pdf');
    }
    /*
    function pdf_detail_komoditas_masuk($id){
        $v = $this->lm->get_detail_komoditas($id);
        $r= $this->lm->get_detail_komoditas_masuk($id,'json');($id);
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
        
        
        $this->PDF->SetFont('Arial','',12);
        $this->PDF->Cell(80,10,'Total nilai barang keluar',0,1);
        $this->PDF->SetFont('Arial','B',20);
        $this->PDF->Cell(190,10,'Rp. 400,000',0,1,'C');
        $this->PDF->Cell(10,10,'',0,1);

        $this->PDF->SetFont('Arial','',15);
        $this->PDF->Cell(10,10,'Historis telur masuk',0,1);

        $this->PDF->SetFont('Arial','B',11);
        $this->PDF->Cell(10,6,'No',1,0);
        $this->PDF->Cell(20,6,'Tanggal',1,0,'C');
        $this->PDF->Cell(90,6,'Jenis',1,0,'C');
        $this->PDF->Cell(20,6,'Jumlah',1,0,'C');
        $this->PDF->Cell(20,6,'Stok',1,0,'C');
        $this->PDF->Cell(30,6,'Nilai',1,1,'C');
        $this->PDF->SetFont('Arial','',9);
        
        foreach ($r as $key => $v) {            
            $this->PDF->Cell(10,6,($key+1),1,0,'C');
            $this->PDF->Cell(20,6,date('d/m/Y',strtotime($v->tg)),1,0);
            $this->PDF->Cell(90,6,$v->ct,1,0);
            $this->PDF->Cell(20,6,$v->jl,1,0);
            $this->PDF->Cell(20,6,$v->stk,1,0);
            $this->PDF->Cell(30,6,'Rp. '.$v->nl,1,1);
        }
        $this->PDF->Output('I','Daftar_barang_'.date('d_m_Y').'.pdf');
    }*/

    //=============ada view
    function set_barang_masuk(){
        $nm = $this->input->post('nama',TRUE);
        $n_kom = $this->input->post('n_kom',TRUE);
        $n_sat = $this->input->post('n_sat',TRUE);
        $jn = $this->input->post('jenis',TRUE);
        $jl = $this->input->post('jumlah',TRUE);
        $hg = $this->input->post('harga',TRUE);
        $hg = $hg!=''?$hg:null;
        $ct = $this->input->post('cat',TRUE);
        $sat = $this->input->post('sat',TRUE);
        $tg = $this->input->post('tanggal',TRUE);
        $tg = date('Y-m-d',strtotime($tg));
        $pesan = 'Pembelian/stok masuk '.$n_kom.' sebanyak '.$jl.' '.$n_sat;
        
        $v = $this->lm->set_stok_masuk($nm,$jl, $tg, $jn, $hg, $sat,$ct);
        
        if ($v['stat']>0&&$hg!=null&&isset($_POST['potong_saldo'])) {
            $v1=$this->fm->set_arus_kas('OUT', $pesan, $hg, date('Y-m-d',strtotime($tg)), 'System', $v['id']);
            if ($v1['res']) {
                $log_mes = '[TAMBAH][KEUANGAN][STOK MASUK]['.$v1['id'].']['.$v['id'].'] Menambah arus kas keluar (Kredit) untuk pembelian '.$n_kom.' sebanyak '.$jl.' '.$n_sat;
                $this->hr->log_admin('0081578813144', $log_mes, date('Y-m-d'), date('H:i:s'));
            }
        }
        if ($v['stat']) {
            $log_mes = '[TAMBAH][STOK MASUK]['.$v['id'].'] Penambahan stok masuk '.$n_kom.' sebanyak '.$jl.' '.$n_sat.' dengan cara '.$jn;
            $this->hr->log_admin('0081578813144', $log_mes, date('Y-m-d'), date('H:i:s'));
            $s=$this->fm->get_saldo();
            $s = isset($s[0]->ac)?$s[0]->ac:0;
            echo json_encode(['resp'=>200,'sld'=>$s]);
        }else{
            echo json_encode(['resp'=>100]);
        }
    }

    function edit_barang_masuk(){
        $n_kom = $this->input->post('n_kom',TRUE);
        $id = $this->input->post('id',TRUE);
        $jn = $this->input->post('sumber',TRUE);
        $tg = $this->input->post('tanggal',TRUE);
        $tg = date('Y-m-d',strtotime($tg));
        $jl = $this->input->post('jumlah',TRUE);
        $sat = $this->input->post('satuan',TRUE);
        $hg = $this->input->post('harga',TRUE);
        $pt = $this->input->post('potong_saldo',TRUE);
        $ct = $this->input->post('catatan',TRUE);

        $resp = false;
        // $v=false;
        $log_mesg = '[EDIT][STOK MASUK]['.$id.'] Perubahan data stok masuk untuk komoditas '.$n_kom.' sebanyak '.$jl.' '.$sat;
        $v = $this->lm->edit_stok_masuk($id, $jl, $hg, $tg, $jn, $ct);
        if ($v) {//log edit stok
            $this->hr->log_admin('0081578813144', $log_mesg, date('Y-m-d'), date('H:i:s'));
            if ($jn=='Non-beli') {
                $v = $this->fm->del_keuangan($id);
                $log_mesg='[HAPUS][KEUANGAN][STOK MASUK]['.$id.'] Menghapus data keuangan untuk pembelian '.$n_kom.' sebanyak '.$jl.' '.$sat;
                if ($v) {//log delete kas
                    $this->hr->log_admin('0081578813144', $log_mesg, date('Y-m-d'), date('H:i:s'));
                }
            }
            $resp =true;
        }

        if ($pt) {
            $ket_kas ='Pembelian/stok masuk '.$n_kom.' sebanyak '.$jl.' '.$sat;
            $v = $this->fm->set_arus_kas('OUT', $ket_kas, $hg, $tg, 'System', $id);
            if ($v['res']) {
                $log_mesg='[TAMBAH][KEUANGAN][STOK MASUK]['.$v['id'].']['.$id.'] Menambah catatan keuangan dari pembelian '.$n_kom.' sebanyak '.$jl.' '.$sat;
                $this->hr->log_admin('0081578813144', $log_mesg, date('Y-m-d'), date('H:i:s'));
                $resp = true;
            }else{
                $v=$this->fm->edit_arus_kas($id, $hg, 'Kredit', $tg, $ket_kas);
                if ($v['resp']) {
                    $log_mesg='[EDIT][KEUANGAN][STOK MASUK]['.$v['id'].']['.$id.'] Perubahan catatan keuangan dari pembelian '.$n_kom.' sebanyak '.$jl.' '.$sat;
                    $this->hr->log_admin('0081578813144', $log_mesg, date('Y-m-d'), date('H:i:s'));
                    $resp = true;
                }
            }
        }else {
            $v = $this->fm->del_keuangan($id);
            $log_mesg='[HAPUS][KEUANGAN][STOK MASUK]['.$id.'] Menghapus data keuangan dari pembelian '.$n_kom.' sebanyak '.$jl.' '.$sat;
            if ($v) {//log delete kas
                $this->hr->log_admin('0081578813144', $log_mesg, date('Y-m-d'), date('H:i:s'));
                $resp=true;
            }
        }

        // echo json_encode($_POST);

        if ($resp) {
            $s=$this->fm->get_saldo();
            $s = isset($s[0]->ac)?$s[0]->ac:0;
            echo json_encode(['resp'=>200,'sld'=>$s]);
        }

    }

    function form_barang_keluar(){
        $nm = $this->input->post('nama',TRUE);
        $jl = $this->input->post('jumlah',TRUE);
        $nl = $this->input->post('nilai',TRUE);//sumber
        $ct = $this->input->post('keterangan',TRUE);//harga
        $ret['stts'] = 200;
        $ret['msg'] = [];

        for ($i=0; $i < count($_POST['nama']); $i++) { 
            $cat=null;
            $v['status']=200;
            $stat = $this->lm->set_stok_item($nm[$i],$jl[$i],$this->waktu,'OUT');
            if ($stat['status']) {
                $ret['msg'][] = 'Berhasil mengurangi stok item'.$nm[$i];
                $this->lm->set_stok_Keluar($stat['id'], $nl[$i], $ct);
            }
        }
        echo json_encode($ret);
    }

    function set_tambah_komoditas(){
        $nam = $this->input->post('nama');
        $sat = $this->input->post('satuan');
        $hgj = $this->input->post('harga_jual');
        $hgb = $this->input->post('harga_beli');

        $v=$this->am->set_komoditas_baru($nam, $sat, $hgj, $hgb);
        if ($v['resp']) {
            $log_mesg = '[TAMBAH][KOMODITAS]['.$v['id'].'] Penambahan komoditas baru '.$nam;
            $this->hr->log_admin('0081578813144', $log_mesg, date('Y-m-d'), date('H:i:s'));
            echo '200';
        }

    }

    function hapus_stok_masuk(){
        
        $id = $this->input->post('id',true);
        $nama = $this->input->post('nm',true);
        $v = $this->lm->hapus_rekap_stok($id);
        $log_mesg = '[HAPUS][STOK MASUK]['.$id.'] Menghapus data stok/logistik masuk untuk barang '.$nama;
        if ($v) {
            $this->hr->log_admin('0081578813144', $log_mesg, date('Y-m-d'), date('H:i:s'));
            $v=$this->fm->del_keuangan($id);
            if ($v['res']) {
                $log_mesg = '[HAPUS][KEUANGAN][STOK MASUK]['.$v['id'].']['.$id.'] Menghapus transaksi dari pembelian logistik dagang';
                $this->hr->log_admin('0081578813144', $log_mesg, date('Y-m-d'), date('H:i:s'));
            }
            $tahun = $this->input->post('tahun',true);
            $bulan = $this->input->post('bulan',true);
            $data=$this->lm->total_belanja_barang($tahun,$bulan);
            $g = $this->fm->get_grafik_belanja_barang($tahun);
            $g = json_decode($g);
            $data = isset($data->hg)?$data->hg:0;
            echo json_encode(['res'=>200,'val'=>$data,'grafik'=>$g]);
            // echo $v;
        }else{
            echo json_encode(['res'=>100]);
        }
    }

    function hapus_stok_keluar(){
        $id = $this->input->post('id',true);
        $nama = $this->input->post('nm',true);
        $v = $this->lm->hapus_rekap_stok($id);
        $log_mesg = '[HAPUS][STOK KELUAR / DISTRIBUSI]['.$id.'] Menghapus rekap stok keluar/distribusi untuk barang '.$nama;
        
        if ($v) {
            $this->hr->log_admin('0081578813144', $log_mesg, date('Y-m-d'), date('H:i:s'));
            $v=$this->fm->del_keuangan($id);
            if ($v['res']) {
                $log_mesg = '[HAPUS][KEUANGAN][STOK KELUAR / DISTRIBUSI]['.$v['id'].']['.$id.'] Menghapus transaksi penjualan/distribusi barang';
                $this->hr->log_admin('0081578813144', $log_mesg, date('Y-m-d'), date('H:i:s'));
            }
            $tahun = $this->input->post('tahun',true);
            $bulan = $this->input->post('bulan',true);
            $data = $this->tm->get_total_penjualan($tahun,$bulan);
            $data = isset($data->hg)?$data->hg:0;
            echo json_encode(['res'=>200,'val'=>$data]);
            // echo $v;
        }else{
            echo json_encode(['res'=>100]);
        }
    }

    function edit_komoditas_dagang(){
        $id = $this->input->post('id',true);
        $nama = $this->input->post('nama',true);
        $har_beli = $this->input->post('har_beli',true);
        $har_jual = $this->input->post('har_jual',true);
        $sat = $this->input->post('sat',true);

        
        $log_mesg='[EDIT][KOMODITAS]['.$id.'] Perubahan data barang dagang '.$nama;

        $v = $this->lm->edit_kom_dagang($id, $nama, $har_beli, $har_jual, $sat);
        if ($v) {//log delete kas
            $this->hr->log_admin('0081578813144', $log_mesg, date('Y-m-d'), date('H:i:s'));
            $resp=true;
        }
    }
}
