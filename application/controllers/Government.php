<?php

class Government extends CI_Controller{
    
    function __construct(){
        parent:: __construct();
        $this->bulan = ['01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember'];
        $this->waktu = date('Y-m-d H:i:s');
        if (true) {
            $this->ret['ses']=true;
        }else{
            // $this->ret['ses']=false;
        }
        $this->page = 'MenuPageGov';
    }
    
    function gov_stok_masuk($type='h'){//=================OK
        $dt['page']=$this->page;
        $dt['bln'] = $this->bulan;
        $dt['nam_bulan'] = $this->bulan[date('m')];
        $dt['title'] = 'Info belanja logistik';
        $dt['y'] = date('Y');
        $dt['m'] = date('m');
        if (isset($_GET['tahun'])) {
            $dt['y'] = $this->input->get('tahun',TRUE);
            $dt['m'] = $this->input->get('bulan',TRUE);
        }
        $dt['thn'] = $this->lm->get_tahun('IN');
        $dt['v'] = $this->lm->get_sum_log_in($dt['y'], $dt['m']);
        $dt['v_grafik']=$this->fm->get_grafik_belanja_barang($dt['y']);
        if ($type=='h') {
            $this->load->view('MenuPage/Main/gov_stok_masuk',$dt);
        }else {
            $dt['v_grafik'] = json_decode($dt['v_grafik']);
            $dt['tbm'] = isset($dt['v']->jl)?$dt['v']->jl:0;
            $dt['tnb'] = isset($dt['v']->nl)?$dt['v']->nl:0;
            echo json_encode($dt);
        }
        // echo json_encode($dt['v2']);
        // echo 'test';
    }

    function gov_logistik(){
        $dt['page']=$this->page;
        $dt['title'] = '';
        $dt['tahun'] = date('Y');
        $dt['val'] = $this->lm->get_komoditas('json');
        $this->load->view('MenuPage/Main/gov_kom_dagang',$dt);
    }

    function gov_penyewaan(){
        $dt['page']=$this->page;
        $dt['bln'] = $this->bulan;
        $dt['title'] = 'Pencatatan penjualan';
        $dt['y'] = date('Y');
        $dt['m'] = date('m');
        if (isset($_GET['tahun'])) {
            $dt['y'] = $this->input->get('tahun',TRUE);
            $dt['m'] = $this->input->get('bulan',TRUE);
        }
        $dt['thn'] = $this->rm->get_tahun();
        $dt['v'] = $this->rm->get_info_penyewaan($dt['y'], $dt['m']);
        $this->load->view('MenuPage/Main/gov_penyewaan',$dt);
        // echo json_encode($dt);
    }

    function gov_asset(){
        $dt['page']=$this->page;
        $dt['title'] = 'Pencatatan penjualan';
        $dt['v'] = $this->am->get_aset_gov();
        $dt['v1'] = $this->am->get_aset_umum('json');
        $dt['v2'] = $this->am->get_aset_disewakan('json');
        $dt['v3'] = $this->am->get_aset_bagi_hasil('json');
        $this->load->view('MenuPage/Main/gov_asset',$dt);
    }
    
    function gov_kerjasama_bgh(){
        $dt['page']=$this->page;
        $dt['bln'] = $this->bulan;
        $dt['title'] = 'Pencatatan penjualan';
        $dt['y'] = date('Y');
        $dt['m'] = date('m');
        if (isset($_GET['tahun'])) {
            $dt['y'] = $this->input->get('tahun',TRUE);
            $dt['m'] = $this->input->get('bulan',TRUE);
        }
        $dt['v'] = $this->fm->get_total_bagi_hasil($dt['y']);
        $dt['thn'] = $this->fm->get_tahun_bgh();
        $dt['vt'] = $this->fm->get_info_bgh($dt['y'], $dt['m']);
        $dt['va'] = $this->fm->get_info_bgh();
        $dt['v_grafik']=$this->fm->get_grafik_bagi_hasil($dt['y']);
        $this->load->view('MenuPage/Main/gov_kerjasama_bgh',$dt);
        // echo json_encode($dt['v']);
    }

    function gov_finansial(){
        $dt['page']=$this->page;
        $dt['title'] = 'Pencatatan penjualan';
        $dt['nam_bulan'] = $this->bulan[date('m')];
        $dt['bln'] = $this->bulan;
        $dt['y'] = date('Y');
        $dt['m'] = date('m');
        if (isset($_GET['tahun'])) {
            $dt['y'] = $this->input->get('tahun',TRUE);
            $dt['m'] = $this->input->get('bulan',TRUE);
        }
        $dt['thn'] = $this->fm->get_tahun_fin();
        $dt['v'] = '';
        $dt['v1'] = $this->fm->get_saldo();
        $dt['v2'] = $this->fm->get_kredit_debit_bulanan($dt['y'],$dt['m']);
        $dt['v3'] = $this->am->get_aset_bagi_hasil('json');
        $dt['v_grafik1']=$this->fm->get_grafik_keuangan_mingguan($dt['y'],$dt['m']);
        $dt['v_grafik2']=$this->fm->get_grafik_keuangan_bulanan($dt['y']);
        $dt['v_grafik3']=$this->fm->get_grafik_keuangan_tahunan();
        $this->load->view('MenuPage/Main/gov_finansial',$dt);
    }

    function gov_dividen(){
        $dt['page']=$this->page;
        $dt['title'] = 'Pencatatan penjualan';
        $dt['y'] = date('Y');
        if (isset($_GET['tahun'])) {
            $dt['y'] = $this->input->get('tahun',true);
        }
        $dt['val'] = $this->fm->get_daftar_dividen('json');
        $this->load->view('MenuPage/Main/gov_bagi_dividen',$dt);
        // echo json_encode($dt['tahun']);
    }
        
    function gov_penjualan($type='html'){
        $dt['page']=$this->page;
        $dt['bln'] = $this->bulan;
        $dt['title'] = 'Info perdagangan BUMDes';
        $dt['y'] = date('Y');
        $dt['m'] = date('m');
        if (isset($_GET['tahun'])) {
            $dt['y'] = $this->input->get('tahun',TRUE);
            $dt['m'] = $this->input->get('bulan',TRUE);
        }
        $dt['thn'] = $this->tm->get_tahun();
        $dt['dst'] = $this->tm->info_dagang_cepat($dt['y'], $dt['m'], 'Distribusi');
        $dt['ndt'] = $this->tm->info_dagang_cepat($dt['y'], $dt['m'], 'Non-distribusi');
        $dt['v_grafik']=$this->fm->get_grafik_laba_dagang($dt['y']);
        // echo json_encode($dt['dst']);
        if ($type=='html') {
            $this->load->view('MenuPage/Main/gov_penjualan',$dt);
        }else {
            $dt['v_grafik'] = json_decode($dt['v_grafik']);
            
        }
    }

}


