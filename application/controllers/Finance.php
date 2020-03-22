<?php

require_once APPPATH.'..\asset\fpdf\fpdf.php';
class Finance extends CI_controller{
    function __construct(){
        parent:: __construct();
		date_default_timezone_set('Asia/Jakarta');
        $this->page = 'MenuPage';
        // $this->page = 'MenuPageGov';
        $this->PDF = new FPDF();
        $this->bulan = ['01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember'];
        $this->waktu = date('Y-m-d H:i:s');
        $this->admin = 'Tiyo';
        if (true) {
            $this->ret['ses']=true;
        }else{
            $this->ret['ses']=false;
        }
    }

    function index(){
        $data['page']=$this->page;
        $data['title'] = 'Homepage';
        //echo $this->input->get('tipe');
        $this->load->view('General/home',$data);
    }

    function weekly_report($type='html'){//=============ada view
        $data['page']=$this->page;
        $data['title'] = 'Laporan mingguan';
        //echo $this->input->get('tipe');
        $data['mg'] = [1,2,3,4];
        if (date('d')>=1&&date('d')<=7) {
            $data['minggu']=1;
        }elseif (date('d')>=8&&date('d')<=14) {
            $data['minggu']=2;
        }elseif (date('d')>=15&&date('d')<=21) {
            $data['minggu']=3;
        }else {
            $data['minggu']=4;
        }
        
        $data['bln'] = $this->bulan;
        $data['tahun'] = date('Y');
        $data['bulan'] = date('m');
        if (isset($_GET['tahun'])) {
            $data['tahun'] = $this->input->get('tahun',TRUE);
            $data['bulan'] = $this->input->get('bulan',TRUE);
            $data['minggu'] = $this->input->get('minggu',TRUE);
        }
        $data['thn'] = $this->fm->get_tahun_fin();
        $data['value']=$this->fm->get_keuangan_mingguan($data['tahun'],$data['bulan'],$data['minggu']);
        $data['kd']=$this->fm->get_kredit_debit_mingguan($data['tahun'],$data['bulan'],$data['minggu']);
        $data['s']=$this->fm->get_saldo();
        $data['v_grafik']=$this->fm->get_grafik_keuangan_mingguan($data['tahun'],$data['bulan']);
        // echo $data['v_grafik'];
        if ($type=='html') {
            $this->load->view('MenuPage/Main/weekly_report',$data);
            // echo $data['value'];
            // echo $data['minggu'];
            // echo json_encode($data['thn']);
        }else{
            if ($this->ret) {
                $val['ses']='Ok';
                $val['tabel']=$data['value'];
                $val['kd']=$data['kd'];
                $val['grafik'] = json_decode($data['v_grafik']);
                
            }else{
                $val['ses']='Off';
            }
            echo json_encode($val);
        }
    }

    function monthly_report($type='html'){//=============ada view
        $data['page']=$this->page;
        $data['title'] = 'Laporan bulanan';
        //echo $this->input->get('tipe');
        $data['bln'] = $this->bulan;
        $data['tahun'] = date('Y');
        $data['bulan'] = date('m');
        if (isset($_GET['tahun'])) {
            $data['tahun'] = $this->input->get('tahun',TRUE);
            $data['bulan'] = $this->input->get('bulan',TRUE);
        }
        $data['thn'] = $this->fm->get_tahun_fin();
        $data['value']=$this->fm->get_keuangan_bulanan($data['tahun'],$data['bulan']);
        $data['kd']=$this->fm->get_kredit_debit_bulanan($data['tahun'],$data['bulan']);
        $data['s']=$this->fm->get_saldo();
        $data['v_grafik']=$this->fm->get_grafik_keuangan_bulanan($data['tahun']);
        // echo $data['v_grafik'];
        if ($type=='html') {
            $this->load->view('MenuPage/Main/monthly_report',$data);
        }else{
            if ($this->ret) {
                $val['ses']='Ok';
                $val['tabel']=$data['value'];
                $val['kd']=$data['kd'];
                $val['grafik'] = json_decode($data['v_grafik']);
            }else{
                $val['ses']='Off';
            }
            echo json_encode($val);
        }
    }

    function annual_report($type='html'){//=============ada view
        $data['page']=$this->page;
        $data['title'] = 'Laporan tahunan';
        //echo $this->input->get('tipe');
        $data['tahun'] = date('Y');
        if (isset($_GET['tahun'])) {
            $data['tahun'] = $this->input->get('tahun',TRUE);
        }
        $data['thn'] = $this->fm->get_tahun_fin();
        $data['value']=$this->fm->get_keuangan_tahunan($data['tahun']);
        $data['kd']=$this->fm->get_kredit_debit_tahunan($data['tahun']);
        $data['s']=$this->fm->get_saldo();
        $data['v_grafik']=$this->fm->get_grafik_keuangan_tahunan();
        // echo $data['v_grafik'];
        if ($type=='html') {
            $this->load->view('MenuPage/Main/annual_report',$data);
            // echo $data['value'];
        }else{
            if ($this->ret) {
                $val['ses']='Ok';
                $val['tabel']=$data['value'];
                $val['kd']=$data['kd'];
                $val['grafik'] = json_decode($data['v_grafik']);
            }else{
                $val['ses']='Off';
            }
            echo json_encode($val);
        }
    }

    function corp_profits(){//================= OK
        $data['page']=$this->page;
        $data['title'] = 'Laporan tahunan';
        //echo $this->input->get('tipe');
        $data['bln'] = $this->bulan;
        $data['tahun'] = date('Y');
        $data['bulan'] = date('m');
        if (isset($_GET['tahun'])) {
            $data['tahun'] = $this->input->get('tahun',TRUE);
            $data['bulan'] = $this->input->get('bulan',TRUE);
        }
        $data['thn'] = $this->lm->get_tahun('OUT');
        $data['v'] = $this->fm->get_laba_usaha($data['tahun'], $data['bulan']);
        $data['v_grafik']=$this->fm->get_grafik_laba_dagang($data['tahun']);
        $data['v2']=$this->tm->get_jual_profits($data['tahun']);
        // echo $data['v_grafik'];
        $this->load->view('MenuPage/Main/corp_profits',$data);
    }

    function bagi_hasil($type='html'){//=================OK
        $data['page']=$this->page;
        $data['title'] = 'Aset bagi hasil';
        //echo $this->input->get('tipe');
        $data['tahun'] = date('Y');
        if (isset($_GET['tahun'])) {
            $data['tahun'] = $this->input->get('tahun',TRUE);
        }
        $data['thn'] = $this->fm->get_tahun();
        $data['value'] = $this->fm->get_aset_bagi_hasil($data['tahun']);
        $data['v'] = $this->fm->get_total_bagi_hasil($data['tahun']);
        $data['v_grafik']=$this->fm->get_grafik_bagi_hasil(2019);
        if ($type=='html') {
            // echo json_encode($data['value']);
            $this->load->view('MenuPage/Main/bagi_hasil',$data);
            // echo $data['tahun'];
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
    }

    function bagi_dividen(){
        $data['page']=$this->page;
        $data['title'] = 'Pembagian dividen';
        $data['v'] = $this->fm->get_daftar_dividen();
        $data['v_grafik'] = $this->fm->get_grafik_dividen();
        $this->load->view('MenuPage/Main/Pembagian_dividen',$data);
        // echo json_encode($data['v']);
        // echo $data['v_grafik'];
    }

    function form_tabah_dividen(){
        $tanggal = '"'.date('Y-m').'"';
        $data['page']=$this->page;
        $data['title'] = '';
        $data['id'] = '';
        // $data['tahun'] = $this->fm->get_tahun_keuangan();
        $this->load->view('MenuPage/Form/tambah_bagi_hasil_usaha',$data);
        // echo json_encode($data['tahun']);
        // echo json_encode($data['s']);
    }

    function saldo_dividen(){
        $tahun = $this->input->get('tahun',true);
        $saldo = $this->fm->get_saldo($tahun);
        $saldo=isset($saldo[0])?$saldo[0]->ac:null;
        echo $saldo;
    }

    function add_cat_fin(){//=============ada view
        $data['page']=$this->page;
        $data['title'] = '';
        $data['tanggal'] = date('d/m/Y');
        $data['b']=$this->fm->get_saldo();
        $this->load->view('MenuPage/Form/tambah_cat_keuangan',$data);
    }

    function form_edit_finansial($id){//=============ada view
        $data['var']=$id;
        $data['page']=$this->page;
        $data['title'] = '';
        $data['id'] = '';
        $data['tanggal'] = date('d/m/Y');
        $data['v'] = $this->fm->get_edit_keuangan($id);
        $data['s']=$this->fm->get_saldo();
        $this->load->view('MenuPage/Form/edit_finansial',$data);
        // echo json_encode($data['v']);
    }

    function form_tambah_pemb_bgh(){
        $data['page']=$this->page;
        $data['title'] = 'Penerimaan bagi hasil';
        $data['v']= $this->fm->get_aset_bagi_hasil(date('Y'),'json');
        $this->load->view('MenuPage/Form/tambah_pemb_bgh',$data);
    }

    function form_tambah_aset_bagi_hasil(){//=============ada view
        $data['page']=$this->page;
        $data['title'] = '';
        $data['id'] = '';
        $data['tanggal'] = date('d/m/Y');
        $data['v2'] = $this->am->get_rekanan('JSON');
        $data['v3'] = $this->am->get_aset_umum('JSON');
        $this->load->view('MenuPage/Form/tambah_aset_bagi_hasil',$data);

        // echo json_encode($data['v3']);
    }

    function form_edit_aset_bagi_hasil($id){//=============ada view
        $data['page']=$this->page;
        $data['title'] = '';
        $data['id'] = '';
        $data['tanggal'] = date('d/m/Y');
        $data['v'] = $this->fm->get_edit_bagi_hasil($id);
        $this->load->view('MenuPage/Form/edit_bagi_hasil',$data);
        // echo json_encode($data['v']);
    }

    function form_edit_bagi_dividen($id){
        $data['page']=$this->page;
        $data['title'] = 'Bagi hasil usaha';
        $data['id'] = '';
        $data['v'] = $this->fm->get_edit_bagi_dividen($id);
        $data['v2'] = $this->fm->get_edit_ent_bagi_dividen($id);
        $this->load->view('MenuPage/Form/edit_bagi_dividen',$data);
    }
    
    function detail_bagi_hasil($id){//=============ada view
        $data['page']=$this->page;
        $data['title'] = '';
        $data['tanggal'] = date('d/m/Y');
        $data['id'] = $id;
        $data['v'] = $this->fm->get_detail_bagi_hasil($id);
        $data['v_histori_bgh'] = $this->fm->get_detail_histori_bagi_hasil($id);
        $data['v_histori_harga_sewa'] = $this->rm->get_perubahan_harga_sewa($id);
        $this->load->view('MenuPage/Detail_Print/detail_bagi_hasil',$data);
        // echo json_encode($data['v_histori_bgh']);
    }

    function set_tambah_bagi_hasil(){
        $aset = $this->input->post('aset',true);
        $sumber = $this->input->post('sumber',true);
        $mitra = $this->input->post('mitra',true);
        $pers_bumdes = $this->input->post('pers_bumdes',true);
        $pers_mitra = $this->input->post('pers_mitra',true);
        $n_mitra = $this->input->post('n_mitra',true);
        $n_aset = $this->input->post('n_aset',true);
        $n_aset = $sumber=='Internal'?$n_aset:$aset;
        $tangmul = $this->input->post('tanggal',true);
        $bulan = $this->input->post('bulan',true);
        // $tangsel = $this->input->post('tanggal_sel',true);
        $tangmul = date('Y-m-d',strtotime($tangmul));
        $tangsel = date('Y-m-d',strtotime($tangmul.' +'.$bulan.' months'));
        
        $v=$this->am->set_bagi_hasil($aset,$mitra,$tangmul,$tangsel, $pers_bumdes, $pers_mitra, $sumber);

        $log_mesg = '[TAMBAH][BAGI HASIL]['.$v['id'].'] Menambah kerja sama bagi hasil untuk aset '.$n_aset.' dari aset '.$sumber.' dengan '.$n_mitra.' mulai tanggal '.$tangmul.' selama '.$bulan.' bulan';

        if ($v['resp']) {
            $this->hr->log_admin('0081578813144', $log_mesg, date('Y-m-d'), date('H:i:s'));
            echo '200';
        }
    }

    function set_tambah_pemb_bgh(){
        $id = $this->input->post('id',true);
        $jumlah = $this->input->post('jumlah',true);
        $cat = $this->input->post('cat',true);
        $tanggal = $this->input->post('tanggal',true);
        $tanggal = date('Y-m-d',strtotime($tanggal));


        $v = $this->fm->set_pemb_bagi_hasil($id, $jumlah, $cat, $tanggal);
        echo $v;
    }

    function set_arus_kas(){
        $jenis = $this->input->post('jenis',true);
        $ket = $this->input->post('ket',true);
        $jumlah = $this->input->post('jumlah',true);
        $tanggal = $this->input->post('tanggal',true);
        $tanggal = date('Y-m-d',strtotime($tanggal));
        $jenis2 = $jenis=='IN'?'Debit':'Kredit';
        $jenis3 = $jenis=='IN'?'Masuk':'Keluar';

        $v = $this->fm->set_arus_kas($jenis, $ket, $jumlah, $tanggal, 'User');

        if ($v['res']) {
            $log_mesg = '[TAMBAH][KEUANGAN]['.$v['id'].'] Menambah transaksi kas '.$jenis3.' ('.$jenis2.') sebesar Rp. '.$jumlah;
            $this->hr->log_admin('0081578813144', $log_mesg, date('Y-m-d'), date('H:i:s'));
            echo '200';
        }
    }

    function edit_arus_kas(){
        $ket = $this->input->post('ket',true);
        $id = $this->input->post('id',true);
        $jumlah = $this->input->post('jumlah',true);
        $jenis = $this->input->post('jenis',true);
        $trans = $this->input->post('trans',true);
        $tanggal = $this->input->post('tanggal',true);
        $tanggal = date('Y-m-d',strtotime($tanggal));
        $log_mesg = '[EDIT][KEUANGAN]['.$id.'] Perubahan keuangan pada transaksi '.$trans.' sebesar Rp. '.$jumlah;
        $v = $this->fm->edit_arus_kas($id, $jumlah, $jenis, $tanggal, $ket);
        if ($v) {
            $this->hr->log_admin('0081578813144', $log_mesg, date('Y-m-d'), date('H:i:s'));
            $s=$this->fm->get_saldo();
            $s = isset($s[0]->ac)?$s[0]->ac:0;
            echo json_encode(['resp'=>200,'b'=>$s]);
        }

        // echo json_encode($_POST);
    }

    function edit_bagi_hasil(){
        $aset = $this->input->post('aset',true);
        $id = $this->input->post('id',true);
        $mitra = $this->input->post('mitra',true);
        $pb = $this->input->post('pb',true);
        $pm = $this->input->post('pm',true);
        $tanggal = $this->input->post('tanggal',true);
        $bulan = $this->input->post('bulan',true);
        $tangsel = date('Y-m-d',strtotime($tanggal.' +'.$bulan.' months'));

        $v = $this->fm->edit_bagi_hasil($id, $pb, $pm, $tangsel);
        $log_mesg = '[EDIT][BAGI HASIL]['.$id.'] Perubahan kerjasama bagi hasil '.$aset.' dengan '.$mitra. ' dengan pembagian BUMDes '.$pb.'% dan Mitra '.$pm.'% mulai dari tanggal '.$tanggal.' selama '.$bulan. ' bulan';
        if ($v) {
            $this->hr->log_admin('0081578813144', $log_mesg, date('Y-m-d'), date('H:i:s'));
            echo 200;
        }
    }

    //=============ada view
    function pdf_daftar_bagi_hasil(){
        $tahun = $this->input->get('tahun',true);
        $r = $this->fm->get_aset_bagi_hasil($tahun,'json');
        $row = $this->fm->get_total_bagi_hasil($tahun);
        $row = isset($row->hg)?$row->hg:0;
        // membuat halaman baru
        $this->PDF->AddPage();
        // setting jenis font yang akan digunakan
        $this->PDF->SetFont('Arial','B',16);
        $logo = base_url().'logo.jpeg';
        $this->PDF->Cell(30,30,$this->PDF->Image($logo, ($this->PDF->GetX()-1), $this->PDF->GetY()-12, 33.58),0);
        // mencetak string 
        $this->PDF->Cell(130,7,'DAFTAR BAGI HASIL ASET',0,1,'C');
        $this->PDF->SetFont('Arial','B',12);
        $this->PDF->Cell(180,8,'BUMDES Indrakila Jaya',0,1,'C');
        $this->PDF->Cell(190,0,'',1,1);
        // Memberikan space kebawah agar tidak terlalu rapat
        $this->PDF->Cell(10,7,'',0,1);
        $this->PDF->SetFont('Arial','',15);
        $this->PDF->Cell(190,7,date('d/m/Y'),0,1,'R');
        
        $this->PDF->SetFont('Arial','',12);
        $this->PDF->Cell(80,10,'Total pemasukan bagi hasil',0,1);
        $this->PDF->SetFont('Arial','B',20);
        $this->PDF->Cell(190,10,'Rp. '.$row,0,1,'C');
        $this->PDF->Cell(10,10,'',0,1);

        $this->PDF->SetFont('Arial','',15);
        $this->PDF->Cell(10,10,'Daftar bagi hasil',0,1);

        $this->PDF->SetFont('Arial','B',11);
        $this->PDF->Cell(8,6,'No',1,0);
        $this->PDF->Cell(55,6,'Aset',1,0);
        $this->PDF->Cell(67,6,'Mitra',1,0);
        $this->PDF->Cell(30,6,'Tanggal mulai',1,0);
        $this->PDF->Cell(30,6,'Tanggal selesai',1,1);

        $this->PDF->SetFont('Arial','',9);     
        foreach ($r as $key => $v) {/*
            $this->PDF->Cell(15,6,($key+1),1,0);
            $this->PDF->Cell(130,6,$v->nm,1,0);
            $this->PDF->Cell(45,6,$v->hs,1,1);*/
            $this->PDF->Cell(8,6,($key+1),1,0);
            $this->PDF->Cell(55,6,$v->na,1,0);
            $this->PDF->Cell(67,6,$v->nm,1,0);
            $this->PDF->Cell(30,6,date('d-m-Y',strtotime($v->tm)),1,0);
            $this->PDF->Cell(30,6,date('d-m-Y',strtotime($v->ts)),1,1);
        }
        $this->PDF->Output('I','Daftar_barang_'.date('d_m_Y').'.pdf');
    }

    //=============ada view
    function pdf_keuangan($type){
        $r=[];
        if ($type==1) {
            $tahun = $this->input->get('tahun',true);
            $bulan = $this->input->get('bulan',true);
            $minggu = $this->input->get('minggu',true);
            $title = 'MINGGU-AN';
            $tanggal = 'Minggu ke-'.$minggu.' '.$this->bulan[$bulan].' '.$tahun;
            $r = $this->fm->get_keuangan_mingguan($tahun,$bulan,$minggu,'JSON');
            $dk=$this->fm->get_kredit_debit_mingguan($tahun,$bulan,$minggu);
            $s=$this->fm->get_saldo();
            $ket='minggu-an';
        }elseif ($type==2) {
            $tahun = $this->input->get('tahun',true);
            $bulan = $this->input->get('bulan',true);
            $title = 'BULAN-AN';
            $tanggal = $this->bulan[$bulan].' '.$tahun;
            $r = $this->fm->get_keuangan_bulanan($tahun,$bulan,'JSON');
            $dk=$this->fm->get_kredit_debit_bulanan($tahun,$bulan);
            $s=$this->fm->get_saldo();
            $ket='bulan-an';
        }else {
            $tahun = $this->input->get('tahun',true);
            $title = 'TAHUN-AN';
            $tanggal = $tahun;
            $r = $this->fm->get_keuangan_tahunan($tahun,'JSON');
            $dk=$this->fm->get_kredit_debit_tahunan($tahun);
            $s=$this->fm->get_saldo();
            $ket='tahun-an';
        }
        // membuat halaman baru
        $this->PDF->AddPage();
        // setting jenis font yang akan digunakan
        $this->PDF->SetFont('Arial','B',16);
        $logo = base_url().'logo.jpeg';
        $this->PDF->Cell(30,30,$this->PDF->Image($logo, ($this->PDF->GetX()-1), $this->PDF->GetY()-12, 33.58),0);
        // mencetak string 
        $this->PDF->Cell(130,7,'LAPORAN KEUANGAN '.$title,0,1,'C');
        $this->PDF->SetFont('Arial','B',12);
        $this->PDF->Cell(180,8,'BUMDES Indrakila Jaya',0,1,'C');
        $this->PDF->Cell(190,0,'',1,1);
        // Memberikan space kebawah agar tidak terlalu rapat
        $this->PDF->Cell(10,7,'',0,1);
        $this->PDF->SetFont('Arial','',15);
        $this->PDF->Cell(190,7,$tanggal,0,1,'R');
        
        $this->PDF->SetFont('Arial','B',12);
        $this->PDF->Cell(80,10,'Saldo',0,1);
        $this->PDF->SetFont('Arial','',20);
        $this->PDF->Cell(190,10,isset($s[0])?'Rp. '.$s[0]->ac:0,0,1,'C');

        $this->PDF->SetFont('Arial','B',12);
        $this->PDF->Cell(95,10,'Debit',0,0);
        $this->PDF->Cell(95,10,'Kredit',0,1);
        $this->PDF->SetFont('Arial','',20);
        $this->PDF->Cell(95,10,isset($dk[0])?'Rp. '.$dk[0]->dbt:0,'R',0,'C');
        $this->PDF->Cell(95,10,isset($dk[0])?'Rp. '.$dk[0]->kdt:0,'L',1,'C');
        $this->PDF->Cell(10,10,'',0,1);

        $this->PDF->SetFont('Arial','',15);
        $this->PDF->Cell(10,10,'Rincian keuangan',0,1);

        $this->PDF->SetFont('Arial','B',11);
        $this->PDF->Cell(8,6,'No',1,0);
        $this->PDF->Cell(20,6,'Tanggal',1,0);
        $this->PDF->Cell(78,6,'Keterangan',1,0);
        $this->PDF->Cell(30,6,'Debit',1,0);
        $this->PDF->Cell(30,6,'Kredit',1,0);
        $this->PDF->Cell(30,6,'Saldo',1,1);

        $this->PDF->SetFont('Arial','',9);     
        foreach ($r as $key => $v) {
            $lebar_sel = 78;
            $tinggi_sel=6;
            if ($this->PDF->GetStringWidth($v->nt)<$lebar_sel) {
                $line=1;
            }else {
                $text_l = strlen($v->nt);
                $er_marg = 2;
                $startChar = 0;
                $max_char = 0;
                $text_arr=[];
                $tmp_string=null;
                while($startChar < $text_l){
                    while($this->PDF->GetStringWidth($tmp_string) < ($lebar_sel-$er_marg)&&($startChar+$max_char)<$text_l){
                        $max_char++;
                        $tmp_string=substr($v->nt, $startChar,$max_char);
                    }
                    $startChar=$startChar+$max_char;
                    array_push($text_arr,$tmp_string);
                    $max_char=0;
                    $tmp_string=null;
                }
                $line=count($text_arr);
            }
            $this->PDF->Cell(8,($line * $tinggi_sel),($key+1),1,0);
            $this->PDF->Cell(20,($line * $tinggi_sel),date('d/m/Y',strtotime($v->dt)),1,0);
            $xPos=$this->PDF->GetX();
            $yPos=$this->PDF->GetY();
            $this->PDF->MultiCell($lebar_sel,$tinggi_sel,$v->nt,1);
            $this->PDF->SetXY($xPos+$lebar_sel,$yPos);
            $this->PDF->Cell(30,($line * $tinggi_sel),isset($v->db)?'Rp. '.$v->db:null,1,0);
            $this->PDF->Cell(30,($line * $tinggi_sel),isset($v->kd)?'Rp. '.$v->kd:null,1,0);
            $this->PDF->Cell(30,($line * $tinggi_sel),'Rp. '.$v->bc,1,1);
        }
        
        $this->PDF->Output('I','Daftar_transaksi_'.$ket.'_'.date('d_m_Y').'.pdf');
    }

    //=============ada view
    function pdf_laporan_laba(){

        $r = $this->fm->get_laba_usaha('All','All','JSON');
        // membuat halaman baru
        $this->PDF->AddPage();
        // setting jenis font yang akan digunakan
        $this->PDF->SetFont('Arial','B',16);
        $logo = base_url().'logo.jpeg';
        $this->PDF->Cell(30,30,$this->PDF->Image($logo, ($this->PDF->GetX()-1), $this->PDF->GetY()-12, 33.58),0);
        // mencetak string 
        $this->PDF->Cell(130,7,'LAPORAN LABA DAGANG PERUSAHAAN',0,1,'C');
        $this->PDF->SetFont('Arial','B',12);
        $this->PDF->Cell(180,8,'BUMDES Indrakila Jaya',0,1,'C');
        $this->PDF->Cell(190,0,'',1,1);
        // Memberikan space kebawah agar tidak terlalu rapat
        $this->PDF->Cell(10,7,'',0,1);
        $this->PDF->SetFont('Arial','',15);
        $this->PDF->Cell(190,7,'Semua tahun, semua bulan',0,1,'R');

        $this->PDF->Cell(10,7,'',0,1);
        $this->PDF->SetFont('Arial','B',12);
        $this->PDF->Cell(95,10,'Penjualan',0,0);
        $this->PDF->Cell(95,10,'Keuntungan',0,1);
        $this->PDF->SetFont('Arial','',20);
        $this->PDF->Cell(95,10,'Rp. 5,000,000','R',0,'C');
        $this->PDF->Cell(95,10,'Rp. 5,000,000','L',1,'C');
        $this->PDF->Cell(10,10,'',0,1);

        $this->PDF->SetFont('Arial','',15);
        $this->PDF->Cell(10,10,'Rincian keuangan',0,1);

        $this->PDF->SetFont('Arial','B',11);
        $this->PDF->Cell(10,6,'No',1,0);
        $this->PDF->Cell(60,6,'Komoditas',1,0);
        $this->PDF->Cell(30,6,'Penjualan',1,0);
        $this->PDF->Cell(30,6,'Harga',1,0);
        $this->PDF->Cell(30,6,'Terjual',1,0);
        $this->PDF->Cell(30,6,'Keuntungan',1,1);

        $this->PDF->SetFont('Arial','',9);     
        foreach ($r as $key => $v) {
            $this->PDF->Cell(10,6,($key+1),1,0);
            $this->PDF->Cell(60,6,$v->nk,1,0);
            $this->PDF->Cell(30,6,$v->ot,1,0);
            $this->PDF->Cell(30,6,'Rp. '.$v->pl,1,0);
            $this->PDF->Cell(30,6,'Rp. '.$v->sl,1,0);
            $this->PDF->Cell(30,6,'Rp. '.$v->pf,1,1);
        }
        
        $this->PDF->Output('I','Daftar_barang_'.date('d_m_Y').'.pdf');
    }

    function hapus_keuangan(){
        $id = $this->input->post('id',true);

        $v = $id?$this->fm->del_keuangan($id):false;

        if ($v['res']) {
            $log_mesg = '[HAPUS][KEUANGAN]['.$v['id'].'] Menghapus transaksi keuangan';
            $this->hr->log_admin('0081578813144', $log_mesg, date('Y-m-d'), date('H:i:s'));
            echo 200;
            // echo $v;
        }else{
            echo 100;
        }
    }
    
    function hapus_bagi_hasil(){
        $id = $this->input->post('id',true);

        $v = $this->fm->del_bagi_hasil($id);
        if ($v['res']) {
            $log_mesg = '['.$v['log'].'][BAGI HASIL]['.$id.'] '.$v['mesg'].' kerjasama bagi hasil';
            $this->hr->log_admin('0081578813144', $log_mesg, date('Y-m-d'), date('H:i:s'));
            echo json_encode(['res'=>200,'stat'=>$v['log']]);
        }else{
            echo json_encode(['res'=>100]);
        }
    }

    function set_bagi_dividen(){
        $tahun = $this->input->post('tahun',true);
        $nilai = $this->input->post('nilai',true);
        $entitas = $this->input->post('entitas',true);
        $jumlah = $this->input->post('jumlah',true);
        $cat = $this->input->post('cat',true);

        $v = $this->fm->set_bagi_hasil_usaha($tahun, $nilai, $entitas, $jumlah, $cat);
        /*
        if ($v['resp']&&isset($_POST['potong_saldo'])) {
            $pesan = 'Kas keluar untuk pembagian bagi hasil usaha tahun '.$tahun;
            $v1=$this->fm->set_arus_kas('OUT', $pesan, $nilai, date('Y-m-d'), 'System', $v['id']);
            if ($v1['res']) {
                $log_mesg = '[TAMBAH][KEUANGAN][BAGI HASIL USAHA]['.$v['id'].'] kas keluar untuk bagi hasil tahunan tahun '.$tahun;
                $this->hr->log_admin('0081578813144', $log_mesg, date('Y-m-d'), date('H:i:s'));
            }
        }
        */
        if ($v['resp']) {
            $log_mesg = '[TAMBAH][BAGI HASIL USAHA]['.$v['id'].'] Menambah bagi hasil usaha tahunan tahun '.$tahun.' untuk sebanyak '.count($entitas).' entitas';
            $this->hr->log_admin('0081578813144', $log_mesg, date('Y-m-d'), date('H:i:s'));
            echo 200;
        }

        // echo json_encode($entitas);
    }
    
    function detail_bagi_dividen($id){
        $data['page']=$this->page;
        $data['title'] = 'Detail bagi hasil usaha';
        $data['tanggal'] = date('d/m/Y');
        $data['v'] = $this->fm->detail_bagi_hasil_usaha($id);
        $data['tahun_dividen'] = 2020;
        $data['id']=$id;
        $data['tabel_ent'] = $this->fm->detail_entitas_bagi_usaha($id);
        $this->load->view('MenuPage/Detail_Print/detail_bagi_dividen',$data);
        // echo json_encode($data['v']);
    }

    function edit_bagi_hasil_div(){
        $tahun = $this->input->post('tahun',true);
        $id = $this->input->post('id',true);
        $nilai = $this->input->post('nilai',true);
        $ent = $this->input->post('entitas',true);
        $juml = $this->input->post('jumlah',true);
        $cat = $this->input->post('cat',true);
        $cat = $cat?$cat:null;

        $this->fm->edit_bagi_dividen($id, $tahun, $nilai, $cat);
        $this->fm->del_edit_ent_dividen($id);
        $this->fm->edit_ent_dividen($id, $ent, $juml);

        $log_mesg = '[EDIT][BAGI HASIL USAHA]['.$id.'] Perubahan bagi hasil usaha tahun '.$tahun.' dengan '.count($ent).' penerima, dengan nilai Rp. '.$nilai;
        $this->hr->log_admin('0081578813144', $log_mesg, date('Y-m-d'), date('H:i:s'));
        echo 200;

    }

    function hapus_bagi_dividen_g(){
        $id = $this->input->post('id',true);
        $tahun =  $this->input->post('nm',true);
        $log_mesg='[HAPUS][BAGI HASIL USAHA]['.$id.'] Menghapus pembagian hasil usaha tahun '.$tahun;
        $v = $this->fm->del_bagi_dividen_g($id);
        if ($v['stat']) {
            $this->hr->log_admin('0081578813144', $log_mesg, date('Y-m-d'), date('H:i:s'));
            foreach ($v['val'] as $key => $v) {
                $v2=$this->fm->del_keuangan($v->id);
                if ($v2['res']) {
                    $log_mesg = '[HAPUS][KEUANGAN]['.$v2['id'].']['.$v->id.'] Menghapus pembayaran bagi hasil usaha';
                    $this->hr->log_admin('0081578813144', $log_mesg, date('Y-m-d'), date('H:i:s'));
                }
            }
            echo 200;
        }
    }

    function hapus_pembayaran(){
        $id=$this->input->post('id',true);
        $ent = $this->input->post('ent',true);
        $thn = $this->input->post('nm',true);
        $log_mesg = '[BATAL][BAGI HASIL USAHA] Pembatalan pembayaran bagi hasil usaha tahun '.$thn.' untuk '.$ent;
        $v = $this->fm->del_bayar_dividen($id);
        if ($v) {
            $this->hr->log_admin('0081578813144', $log_mesg, date('Y-m-d'), date('H:i:s'));
            $v = $this->fm->del_keuangan($id);
            if ($v['res']) {
                $log_mesg = '[HAPUS][KEUANGAN]['.$v['id'].']['.$id.'] Menghapus pembayaran bagi hasil usaha';
                $this->hr->log_admin('0081578813144', $log_mesg, date('Y-m-d'), date('H:i:s'));
            }
            echo 200;
        }
        // echo $log_mesg;
    }

    function set_pembayaran_ent_bhu(){
        $id = $this->input->post('id',true);
        $idm = $this->input->post('idm',true);
        $ent =  $this->input->post('nm',true);
        $fin = $this->input->post('fin',true);
        $hg = $this->input->post('hg',true);
        $hg = str_replace(['Rp. ',','],null,$hg);
        $log_mesg = '[TAMBAH][PEMBAYARAN][BAGI HASIL USAHA]['.$id.'] Menambah pembayaran bagi hasil usaha untuk '.$ent;
        $pesan ='['.$id.'] Pembayaran bagi hasil usaha untuk '.$ent;
        $v = $this->fm->set_bayar_dividen($id);

        if ($v) {
            $this->hr->log_admin('0081578813144', $log_mesg, date('Y-m-d'), date('H:i:s'));
            if ($fin==1) {
                $v=$this->fm->set_arus_kas('OUT', $pesan, $hg, date('Y-m-d'), 'System', $id);
                $log_mesg = '[TAMBAH][KEUANGAN][KELUAR]['.$v['id'].'] Menambah pembayaran bagi hasil usaha untuk '.$ent;
                if ($v['res']) {
                    $this->hr->log_admin('0081578813144', $log_mesg, date('Y-m-d'), date('H:i:s'));
                }
            }
            echo 200;
        }
    }
    
    function gov_finansial(){
        $data['page']=$this->page;
        $data['title'] = 'Pencatatan penjualan';
        $data['bln'] = $this->bulan;
        $data['tahun'] = date('Y');
        $data['bulan'] = date('m');
        if (isset($_GET['tahun'])) {
            $data['tahun'] = $this->input->get('tahun',TRUE);
            $data['bulan'] = $this->input->get('bulan',TRUE);
        }
        $data['thn'] = $this->fm->get_tahun_fin();
        $data['v'] = '';
        $data['v1'] = $this->fm->get_saldo();
        $data['v2'] = $this->fm->get_kredit_debit_bulanan($data['tahun'],$data['bulan']);
        $data['v3'] = $this->am->get_aset_bagi_hasil('json');
        $this->load->view('MenuPage/Main/gov_finansial',$data);
        // echo json_encode($data['v2']);
    }
}
