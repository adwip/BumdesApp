<?php

require_once APPPATH.'..\asset\fpdf\fpdf.php';
class Rent extends CI_Controller{

    function __construct(){
        parent:: __construct();
		date_default_timezone_set('Asia/Jakarta');
        $this->page = 'MenuPage';
        // $this->page = 'MenuPageGov';
        $this->bulan = ['01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember'];
        $this->PDF = new FPDF();
        $this->waktu = date('Y-m-d H:i:s');
        if (true) {
            $this->ret['ses']=true;
        }else{
            $this->ret['ses']=false;
        }

        // echo 'Not';
        // return false;
    }

    function index(){
        $data['page']=$this->page;
        $data['title'] = 'Homepage';
        //echo $this->input->get('tipe');
        $this->load->view('General/home',$data);
    }

    function rentalling($type='html'){//=================OK
        $data['page']=$this->page;
        $data['title'] = 'Laporan penyewaan';
        $data['bln'] = $this->bulan;
        $data['tahun'] = date('Y');
        $data['bulan'] = date('m');
        if (isset($_GET['tahun'])) {
            $data['tahun'] = $this->input->get('tahun',TRUE);
            $data['bulan'] = $this->input->get('bulan',TRUE);
        }
        $data['thn'] = $this->rm->get_tahun();
        $data['value']=$this->rm->get_penyewaan($data['tahun'],$data['bulan']);
        $data['v_grafik']=$this->fm->get_grafik_penyewaan($data['tahun']);
        if ($type=='html') {
            $this->load->view('MenuPage/Main/penyewaan',$data);
        }else{
            if ($this->ret) {
                $val['ses']='Ok';
                $val['tabel']=$data['value'];
            }else{
                $val['ses']='Off';
            }
            echo json_encode($val);
        }
        // echo $data['v_grafik'];
    }

    function rent_price(){//=================OK
        $data['page']=$this->page;
        $data['title']='Daftar harga sewa';
        $data['tanggal']=date('d/m/Y');
        $data['value']=$this->rm->get_list_harga_sewa();
        $this->load->view('MenuPage/Main/rent_price',$data);
        // echo json_encode($data['value']);
    }

    function form_tambah_jadwal(){//=============ada view
        $data['page']=$this->page;
        $data['title']='Daftar harga sewa';
        $data['v']=$this->am->get_aset_disewakan('json');
        $this->load->view('MenuPage/Form/tambah_jadwal',$data);
    }

    function form_tambah_aset_sewa(){//=============ada view
        $data['page']=$this->page;
        $data['title']='Daftar harga sewa';
        $data['tanggal']=date('d/m/Y');
        $data['v']=$this->am->get_aset_umum('json');
        $this->load->view('MenuPage/Form/tambah_aset_sewa',$data);
        // echo json_encode($data['v']);
    }

    function form_edit_penyewaan($id){//=============ada view
        $data['page']=$this->page;
        $data['title']='Daftar harga sewa';
        $data['tanggal']=date('d/m/Y');
        $data['v'] = $this->rm->get_edit_penyewaan($id);
        $this->load->view('MenuPage/Form/edit_penyewaan',$data);
        // echo json_encode($data['v']);
    }

    function form_edit_aset_sewa($id){//=============ada view
        $data['page']=$this->page;
        $data['title']='Edit aset disewakan';
        $data['tanggal']=date('d/m/Y');
        $data['id'] = $id;
        $data['v'] = $this->rm->get_edit_aset_sewa($id);
        $this->load->view('MenuPage/Form/edit_aset_sewa',$data);
        // echo json_encode($data['v']);
    }

    function detail_aset_sewa($id){//=============ada view
        $data['page']=$this->page;
        $data['title'] = '';
        $data['tanggal'] = date('d/m/Y');
        $data['id'] = $id;
        $data['v'] = $this->rm->get_detail_aset_sewa($id);
        $data['v_histori_sewa'] = $this->rm->get_detail_histori_sewa($id);
        $data['v_histori_harga_sewa'] = $this->rm->get_perubahan_harga_sewa($id);
        $this->load->view('MenuPage/Detail_Print/detail_aset_sewa',$data);
        // echo json_encode($data['v_histori_harga_sewa']);
    }

    function set_tambah_penyewaan(){
        $aset = $this->input->post('aset',true);
        $n_aset = $this->input->post('n_aset',TRUE);
        $penyewa = $this->input->post('penyewa',true);
        $kontak = $this->input->post('kontak',true);
        $tanggal_mul = $this->input->post('tanggal',true);
        $tanggal_mul = date('Y-m-d',strtotime($tanggal_mul));
        $hari = $this->input->post('jumlah_hari',true);
        $tanggal_sel = date('Y-m-d',strtotime($tanggal_mul.'+'.$hari.'days'));
        $harga = $this->input->post('harga',true);
        $fin_mesg = 'Penerimaan dari sewa aset '.$n_aset.' mulai dari '.date('d-m-Y',strtotime($tanggal_mul)).' selama '.$hari.' oleh '.$penyewa;
        
        $v = $this->rm->set_penyewaan($aset, $penyewa, $kontak, $tanggal_mul, $tanggal_sel, $harga);
        if ($v['stat']) {
            $log_mesg = '[TAMBAH][PENYEWAAN]['.$v['id'].'] Penyewaan aset '.$n_aset.' mulai dari '.date('d-m-Y',strtotime($tanggal_mul)).' selama '.$hari.' hari oleh '.$penyewa;
            $this->hr->log_admin('0081578813144', $log_mesg, date('Y-m-d'), date('H:i:s'));
            echo '200';
        }

        
        if ($v['stat']&&$harga!=null&&isset($_POST['tambah_trans'])) {
            $v2=$this->fm->set_arus_kas('IN', $fin_mesg, $harga, date('Y-m-d',strtotime($tanggal_mul)), 'System', $v['id']);
            if ($v2['res']) {
                $log_mesg = '[TAMBAH][KEUANGAN][PENYEWAAN]['.$v['id'].']['.$v2['id'].'] Pemasukan dari penyewaan '.$n_aset.' oleh '.$penyewa;
                $this->hr->log_admin('0081578813144', $log_mesg, date('Y-m-d'), date('H:i:s'));
            }
        }
    }

    function set_tambah_aset_sewaan(){
        $aset = $this->input->post('aset',true);
        $n_aset = $this->input->post('n_aset',true);
        $harga = $this->input->post('harga',true);
        $v = $this->rm->set_aset_sewa($aset, $harga);
        $log_mesg = '[TAMBAH][ASET SEWA]['.$v['id'].'] Menambah aset '.$n_aset.' untuk disewakan';

        if ($v['res']) {
            $this->hr->log_admin('0081578813144', $log_mesg, date('Y-m-d'), date('H:i:s'));
            echo '200';
        }
    }
    
    function edit_penyewaan(){
        $aset = $this->input->post('aset',true);
        $id = $this->input->post('id',true);
        $penyewa = $this->input->post('penyewa',true);
        $kontak = $this->input->post('kontak',true);
        $tanggal_mul = $this->input->post('tanggal',true);
        $tanggal_mul = date('Y-m-d',strtotime($tanggal_mul));
        $hari = $this->input->post('jumlah_hari',true);
        $tanggal_sel = date('Y-m-d',strtotime($tanggal_mul.'+'.$hari.'days'));
        $harga = $this->input->post('harga',true);
        $ps = $this->input->post('potong_saldo',true);

        $log_mesg = '[EDIT][PENYEWAAN]['.$id.'] Perubahan data penyewaan aset '.$aset.' oleh '.$penyewa.' selama '.$hari.' hari, dimulai dari tanggal '.date('d-m-Y',strtotime($tanggal_mul));
        $resp=false;

        $v = $this->rm->edit_penyewaan($id, $penyewa, $kontak, $tanggal_mul, $tanggal_sel, $harga);
        if ($v) {//perubahan data stok
            $this->hr->log_admin('0081578813144', $log_mesg, date('Y-m-d'), date('H:i:s'));
            $resp =true;
        }

        if ($ps) {//perubahan data keuangan
            $ket_kas = 'Penerimaan dari penyewaan aset '.$aset.' oleh '.$penyewa.' selama '.$hari.' hari, dimulai dari tanggal '.date('d-m-Y',strtotime($tanggal_mul));
            $v = $this->fm->set_arus_kas('IN', $ket_kas, $harga, $tanggal_mul, 'System', $id);
            if ($v['res']) {
                $log_mesg='[TAMBAH][KEUANGAN][PENYEWAAN]['.$v['id'].']['.$id.'] Menambah catatan keuangan dari penyewaan aset '.$aset.' oleh '.$penyewa.' selama '.$hari.' hari, dimulai dari tanggal '.date('d-m-Y',strtotime($tanggal_mul));
                $this->hr->log_admin('0081578813144', $log_mesg, date('Y-m-d'), date('H:i:s'));
                $resp = true;
            }else{
                $v=$this->fm->edit_arus_kas($id, $harga, 'Debit', $tanggal_mul, $ket_kas);
                if ($v['resp']) {
                    $log_mesg='[EDIT][KEUANGAN][PENYEWAAN]['.$v['id'].']['.$id.'] Perubahan catatan keuangan dari penyewaan aset '.$aset.' oleh '.$penyewa.' selama '.$hari.' hari, dimulai dari tanggal '.date('d-m-Y',strtotime($tanggal_mul));
                    $this->hr->log_admin('0081578813144', $log_mesg, date('Y-m-d'), date('H:i:s'));
                    $resp = true;
                }
            }
        }else {//perubahan data keuangan
            $v = $this->fm->del_keuangan($id);
            $log_mesg='[HAPUS][KEUANGAN][PENYEWAAN]['.$v['id'].']['.$id.'] Menghapus data keuangan dari penyewaan aset '.$aset.' oleh '.$penyewa.' selama '.$hari.' hari, dimulai dari tanggal '.date('d-m-Y',strtotime($tanggal_mul));
            if ($v) {//log delete kas
                $this->hr->log_admin('0081578813144', $log_mesg, date('Y-m-d'), date('H:i:s'));
                $resp=true;
            }
        }

        if ($resp) {
            echo 200;
        }
    }

    function edit_aset_disewakan(){
        $nama = $this->input->post('nama',true);
        $id = $this->input->post('id',true);
        $harga = $this->input->post('harga',true);
        $v = $this->rm->edit_aset_disewakan($id, $harga);
        $log_mesg = '[EDIT][ASET DISEWAKAN]['.$id.'] Perubahan harga sewa '.$nama.' menjadi Rp. '.$harga;
        if ($v) {
            $this->hr->log_admin('0081578813144', $log_mesg, date('Y-m-d'), date('H:i:s'));
            echo 200;
        }
    }

    //=============ada view
    function pdf_sewa(){
        $tahun = $this->input->get('tahun');
        $bulan = $this->input->get('bulan');
        $r = $this->rm->get_penyewaan($tahun,$bulan,'JSON');
        // membuat halaman baru
        $this->PDF->AddPage();
        // setting jenis font yang akan digunakan
        $this->PDF->SetFont('Arial','B',16);
        $logo = base_url().'logo.jpeg';
        $this->PDF->Cell(30,30,$this->PDF->Image($logo, ($this->PDF->GetX()-1), $this->PDF->GetY()-12, 33.58),0);
        // mencetak string 
        $this->PDF->Cell(130,7,'DAFTAR PENYEWAAN ASET',0,1,'C');
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
        $this->PDF->Cell(10,10,'Daftar jadwal sewa',0,1);
        $this->PDF->SetFont('Arial','B',11);
        $this->PDF->Cell(10,6,'No',1,0);
        $this->PDF->Cell(50,6,'Aset',1,0);
        $this->PDF->Cell(30,6,'Waktu mulai',1,0);
        $this->PDF->Cell(30,6,'Waktu selesai',1,0);
        $this->PDF->Cell(35,6,'Penyewa',1,0);
        $this->PDF->Cell(35,6,'Harga',1,1);
        $this->PDF->SetFont('Arial','',9);
        
        foreach ($r as $key => $v) {
            $this->PDF->Cell(10,6,($key+1),1,0);
            $this->PDF->Cell(50,6,$v->ast,1,0);
            $this->PDF->Cell(30,6,date('d/m/Y',strtotime($v->wml)),1,0);
            $this->PDF->Cell(30,6,date('d/m/Y',strtotime($v->wsl)),1,0);
            $this->PDF->Cell(35,6,$v->pnw,1,0);
            $this->PDF->Cell(35,6,$v->nom,1,1);
        }
        $this->PDF->Output('I','Daftar_barang_'.date('d_m_Y').'.pdf');
    }

    //=============ada view
    function pdf_harga_sewa(){
        $r = $this->rm->get_list_harga_sewa('JSON');
        // membuat halaman baru
        $this->PDF->AddPage();
        // setting jenis font yang akan digunakan
        $this->PDF->SetFont('Arial','B',16);
        // mencetak string 
        $this->PDF->Cell(190,7,'DAFTAR HARGA SEWA ASET',0,1,'C');
        $this->PDF->SetFont('Arial','B',12);
        $this->PDF->Cell(190,7,'BUMDES Pujotirto',0,1,'C');
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
        $this->PDF->Cell(10,10,'Daftar jadwal sewa',0,1);
        $this->PDF->SetFont('Arial','B',11);
        $this->PDF->Cell(15,6,'No',1,0);
        $this->PDF->Cell(130,6,'Aset',1,0);
        $this->PDF->Cell(45,6,'Harga',1,1);
        $this->PDF->SetFont('Arial','',9);
        
        foreach ($r as $key => $v) {/*
            $this->PDF->Cell(50,6,$v->ast,1,0);
            $this->PDF->Cell(30,6,date('d/m/Y',strtotime($v->wml)),1,0);
            $this->PDF->Cell(30,6,date('d/m/Y',strtotime($v->wsl)),1,0);
            $this->PDF->Cell(35,6,$v->pnw,1,0);
            $this->PDF->Cell(35,6,$v->nom,1,1);*/
            $this->PDF->Cell(15,6,($key+1),1,0);
            $this->PDF->Cell(130,6,$v->nm,1,0);
            $this->PDF->Cell(45,6,$v->hs,1,1);
        }
        $this->PDF->Output('I','Daftar_barang_'.date('d_m_Y').'.pdf');
    }

    function hapus_penyewaan(){
        $id = $this->input->post('id',true);
        $log_mesg = '[HAPUS][PENYEWAAN]['.$id.'] Menghapus jadwal penyewaan aset';

        $v = $this->rm->del_penyewaan($id);
        if ($v) {
            $this->hr->log_admin('0081578813144', $log_mesg, date('Y-m-d'), date('H:i:s'));
            $v=$this->fm->del_keuangan($id);
            if ($v['res']) {
                $log_mesg = '[HAPUS][KEUANGAN]['.$v['id'].']['.$id.'] Menghapus transaksi dari penyewaan aset';
                $this->hr->log_admin('0081578813144', $log_mesg, date('Y-m-d'), date('H:i:s'));
            }
            echo 200;
            // echo $v;
        }
    }

    function hapus_aset_sewa(){
        $id = $this->input->post('id',true);
        $nm = $this->input->post('nm',true);
        $log_mesg = '[HAPUS][ASET DISEWAKAN]['.$id.'] Menghapus aset '.$nm.' dari daftar aset disewakan';
        $v = $this->rm->del_aset_sewa($id);
        if ($v) {
            $this->hr->log_admin('0081578813144', $log_mesg, date('Y-m-d'), date('H:i:s'));
            echo 200;
        }
    }

    function gov_penyewaan(){
        $data['page']=$this->page;
        $data['title'] = 'Pencatatan penjualan';
        $this->load->view('MenuPage/Main/gov_penyewaan',$data);
    }

}
