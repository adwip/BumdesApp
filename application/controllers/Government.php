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
        $dt['title'] = '';
        $dt['tahun'] = date('Y');
        $dt['val'] = $this->lm->get_komoditas('json');
        $this->load->view('MenuPage/Main/gov_kom_dagang',$dt);
    }

    function gov_penyewaan($type='html'){
        $dt['bln'] = $this->bulan;
        $dt['title'] = 'Pencatatan penjualan';
        $dt['y'] = date('Y');
        $dt['m'] = date('m');
        if (isset($_GET['tahun'])) {
            $dt['y'] = $this->input->get('tahun',TRUE);
            $dt['m'] = $this->input->get('bulan',TRUE);
        }
        $dt['thn'] = $this->rm->get_tahun();
        $dt['v'] = $this->rm->get_jumlah_penyewaan($dt['y'], $dt['m']);
        $dt['v2'] = $this->rm->get_pendapatan_sewa($dt['y'], $dt['m']);
        $dt['v_grafik']=$this->fm->get_grafik_penyewaan($dt['y']);
        if ($type=='html') {
            $this->load->view('MenuPage/Main/gov_penyewaan',$dt);
        }else{
            $dt['v_grafik'] = json_decode($dt['v_grafik']);
            $dt['jpn'] = $dt['v']?$dt['v']->tp:0;
            $dt['tps'] = $dt['v2']?$dt['v2']->tps:0;
            echo json_encode($dt);
        }
        // echo json_encode($dt);
    }

    function gov_asset(){
        $dt['title'] = 'Pencatatan penjualan';
        $dt['y'] = date('Y');
        $dt['m'] = date('m');
        $dt['v'] = $this->am->get_aset_gov();
        $dt['v1'] = $this->am->get_aset_umum('json');
        $dt['v2'] = $this->rm->get_jumlah_penyewaan($dt['y'], $dt['m']);
        $dt['v3'] = $this->am->get_aset_bagi_hasil('json');
        $this->load->view('MenuPage/Main/gov_asset',$dt);
    }
    
    function gov_kerjasama_bgh($type='html'){
        $dt['bln'] = $this->bulan;
        $dt['nb'] = $this->bulan[date('m')];
        $dt['title'] = 'Pencatatan penjualan';
        $dt['y'] = date('Y');
        $dt['m'] = date('m');
        if (isset($_GET['tahun'])) {
            $dt['y'] = $this->input->get('tahun',TRUE);
            $dt['m'] = $this->input->get('bulan',TRUE);
            $dt['nb'] = $this->bulan[$dt['m']];
        }
        $dt['pby'] = $this->fm->get_total_bagi_hasil($dt['y']);
        $dt['pbm'] = $this->fm->get_pemb_bagi_hasil_bulan($dt['y'],$dt['m']);
        $dt['thn'] = $this->fm->get_tahun_bgh();
        $dt['vt'] = $this->fm->get_info_aset_bgh($dt['y'], $dt['m']);
        $dt['va'] = $this->fm->get_info_aset_bgh();
        $dt['v_grafik']=$this->fm->get_grafik_bagi_hasil($dt['y']);
        if ($type=='html') {
            $this->load->view('MenuPage/Main/gov_kerjasama_bgh',$dt);
        }else{
            $dt2['v_grafik'] = json_decode($dt['v_grafik']);
            $dt2['pbgh-m'] = isset($dt['pbm']->pnb)?$dt['pbm']->pnb:0;
            $dt2['pbgh-y'] = isset($dt['pby']->pnb)?$dt['pby']->pnb:0;
            $dt2['nbgh-m'] = isset($dt['pbm']->hg)?$dt['pbm']->hg:0;
            $dt2['nbgh-y'] = isset($dt['pby']->hg)?$dt['pby']->hg:0;
            
            $dt2['int-m'] = isset($dt['vt']->jints)?$dt['vt']->jints:0;
            $dt2['ext-m'] = isset($dt['vt']->exts)?$dt['vt']->exts:0;
            $dt2['int-y'] = isset($dt['va']->jints)?$dt['va']->jints:0;
            $dt2['ext-y'] = isset($dt['va']->exts)?$dt['va']->exts:0;

            $dt2['nb'] = $dt['nb'];
            $dt2['y'] = $dt['y'];
            echo json_encode($dt2);
        }
    }

    function gov_finansial($type='html'){
        $dt['title'] = 'Pencatatan penjualan';
        $dt['nam_bulan'] = $this->bulan[date('m')];
        $dt['bln'] = $this->bulan;
        if (date('d')>=1&&date('d')<=7) {
            $dt['w']=1;
        }elseif (date('d')>=8&&date('d')<=14) {
            $dt['w']=2;
        }elseif (date('d')>=15&&date('d')<=21) {
            $dt['w']=3;
        }else {
            $dt['w']=4;
        }
        $dt['y'] = date('Y');
        $dt['m'] = date('m');
        if (isset($_GET['tahun'])) {
            $dt['y'] = $this->input->get('tahun',TRUE);
            $dt['m'] = $this->input->get('bulan',TRUE);
            $dt['w'] = $this->input->get('minggu',TRUE);
            $dt['nam_bulan'] = $this->bulan[$dt['m']];
        }
        $dt['thn'] = $this->fm->get_tahun_fin();
        $dt['blc'] = $this->fm->get_saldo();
        $dt['dkw']=$this->fm->get_kredit_debit_mingguan($dt['y'],$dt['m'],$dt['w']);
        $dt['dkm'] = $this->fm->get_kredit_debit_bulanan($dt['y'],$dt['m']);
        $dt['dky']=$this->fm->get_kredit_debit_tahunan($dt['y']);
        $dt['gf_w']=$this->fm->get_grafik_keuangan_mingguan($dt['y'],$dt['m']);
        $dt['gf_m']=$this->fm->get_grafik_keuangan_bulanan($dt['y']);
        $dt['gf_y']=$this->fm->get_grafik_keuangan_tahunan();
        if ($type=='html') {
            $this->load->view('MenuPage/Main/gov_finansial',$dt);
        }else{
            $dt2['gf_w']=json_decode($dt['gf_w']);
            $dt2['gf_m']=json_decode($dt['gf_m']);
            $dt2['gf_y']=json_decode($dt['gf_y']);
            
            $dt2['dkw_d'] = isset($dt['dkw'][0]->dbt)?$dt['dkw'][0]->dbt:0;
            $dt2['dkw_k'] = isset($dt['dkw'][0]->kdt)?$dt['dkw'][0]->kdt:0;
            
            $dt2['dkm_d'] = isset($dt['dkm'][0]->dbt)?$dt['dkm'][0]->dbt:0;
            $dt2['dkm_k'] = isset($dt['dkm'][0]->kdt)?$dt['dkm'][0]->kdt:0;
            
            $dt2['dky_d'] = isset($dt['dky'][0]->dbt)?$dt['dky'][0]->dbt:0;
            $dt2['dky_k'] = isset($dt['dky'][0]->kdt)?$dt['dky'][0]->kdt:0;
            $dt2['nb'] = $dt['nam_bulan'];
            $dt2['y'] = $dt['y'];
            echo json_encode($dt2);
        }
    }

    function gov_dividen(){
        $dt['title'] = 'Pencatatan penjualan';
        $dt['y'] = date('Y');
        if (isset($_GET['tahun'])) {
            $dt['y'] = $this->input->get('tahun',true);
        }
        $dt['val'] = $this->fm->get_daftar_dividen('json');
        $dt['v_grafik'] = $this->fm->get_grafik_bagi_dividen();
        $this->load->view('MenuPage/Main/gov_bagi_dividen',$dt);
        // echo $dt['v_grafik'];
    }
        
    function gov_penjualan($type='html'){
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
        $dt['v_grafik2']=$this->fm->get_grafik_nilai_distribusi($dt['y']);
        $dt['v_grafik3']=$this->fm->get_grafik_nilai_non_distribusi($dt['y']);
        // echo json_encode($dt['dst']);
        if ($type=='html') {
            $this->load->view('MenuPage/Main/gov_penjualan',$dt);
            // echo $dt['v_grafik'];
        }else {
            $dt['v_grafik'] = json_decode($dt['v_grafik']);
            $dt['v_grafik2'] = json_decode($dt['v_grafik2']);
            $dt['v_grafik3'] = json_decode($dt['v_grafik3']);
            $dt['jdb'] = isset($dt['dst']->cnt)?$dt['dst']->cnt:0;
            $dt['ndb'] = isset($dt['dst']->jlh)?$dt['dst']->jlh:0;
            $dt['jndb'] = isset($dt['ndt']->cnt)?$dt['ndt']->cnt:0;
            $dt['nndb'] = isset($dt['ndt']->jlh)?$dt['ndt']->jlh:0;

            echo json_encode($dt);

        }
    }

    function gov_det_bghu($id){
        $dt['title'] = 'Info perdagangan BUMDes';
        $dt['v'] = $this->fm->detail_bagi_hasil_usaha($id);
        $dt['tabel_ent'] = $this->fm->detail_entitas_bagi_usaha($id);
        $dt['id'] = $id;
        $this->load->view('MenuPage/Detail_print/detail_gov_bagi_dividen',$dt);
        // echo json_encode($dt['v']);
    }

}


