<?php

require_once APPPATH.'..\asset\fpdf\fpdf.php';
class Homepage extends CI_Controller{
    
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
        $this->PDF = new FPDF();
        $this->bulan = ['01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember'];
        $this->waktu = date('Y-m-d H:i:s');
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
        $data['Y'] = date('Y');
        $data['v_graf'] = $this->lm->get_grafik_penjualan($data['Y'], date('m'));
        $data['v'] = $this->rm->get_total_penyewaan($data['Y']);
        $data['v2'] = $this->tm->get_total_penjualan($data['Y'],date('m'));
        $data['v3'] = $this->fm->get_total_bagi_hasil($data['Y']);
        $data['nam_bulan'] = $this->bulan[date('m')];
        $data['tahun'] = date('Y');
        // echo json_encode($data['v3']);
        // echo $data['v_graf'];
        if (true) {
            $this->load->view('General/home',$data);
        }else{
            $this->load->view('General/home',$data);
        }
    }

    function login_page(){
        $data['title'] = 'BUMDes Indrakila | Silahkan masuk';
        $this->load->view('General/Login_page',$data);
    }
    
    function not_found(){
        $data['page']=$this->page;
        $this->load->view('General/not_found',$data);
    }

    function send() {
        // $this->load->config('email');
        $this->load->library('email');
        $from = $this->config->item('smtp_user');
        
        $to = 'prabowoa63@gmail.com';//$this->input->post('to');
        $subject = 'Ganti password '.time();//$this->input->post('subject');
        $message = "";//$this->input->post('message');

        $this->email->set_newline("\r\n");
        $this->email->from($from);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
        
        if ($this->email->send()) {
            echo 'Your Email has successfully been sent.';
        } else {
            show_error($this->email->print_debugger());
        }

        // echo json_encode($this->config->item());
    }

    function reg_admin($id){
        $data['page']=$this->page;
        $data['title'] = 'Registrasi admin baru';
        
        $data['v'] = $this->hr->get_url_confirm($id);
        if ($data['v']&&waktu_data($id)&&!isset($_POST['sub'])) {
            $data['v']= explode('|',$data['v']->nt);
            $this->load->view('General/registrasi_admin',$data);
        }else if (isset($_POST['sub'])&&$data['v']) {
            $res= explode('|',$data['v']->nt);
            $kontak = $this->input->post('kontak',true);
            $password = $this->input->post('pass',true);
            
            $type = $_FILES['foto']['type'];
            $type = $type=='image/jpeg'||$type=='image/png'||$type=='image/jpg'?explode('/',$type):false;
            $nf = $type&&$_FILES['foto']['size']<(5*1048576)?'800'.time().'.'.$type[1]:null;

            $v = $this->hr->set_admin_baru($res[0], $res[1], $password, $res[3], $kontak, $nf);
            
            $config = [
                'upload_path'=> 'media/admin/',
                'allowed_types'=> 'jpeg|png|jpg',
                'max_size'=> 5*1048576,//in KB, 0 = unlimit
                'max_width'=>0,
                'min_width'=>0,
                'file_name'=> $nf
            ];
            if ($v['res']) {
                $this->load->library('upload', $config);
                echo '200|'.$this->upload->do_upload('foto');
                $this->hr->set_r_url_confirm($id);
            }else{
                echo '100| ';
            }
        }else{
            $this->load->view('General/general_404',$data);
        }
    }

    function general_req($id){
        $data = $this->hr->get_url_conf($id);
        redirect(site_url());
    }
}
