<?php

class Homepage extends CI_Controller{
    
    function __construct(){
        parent:: __construct();
		date_default_timezone_set('Asia/Jakarta');
        if ($this->ses->tp=='MNG') {
            $this->page = 'MenuPage';
        }elseif ($this->ses->tp=='GOV') {
            $this->page = 'MenuPageGov';
        }else {
            $data['page'] = 'MenuPageSys';
        }
        $this->bulan = ['01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember'];
        $this->waktu = date('Y-m-d H:i:s');
        if (true) {
            $this->ret['ses']=true;
        }else{
            $this->ret['ses']=false;
        }
    }

    function index(){
        $data['title'] = 'BUMDes Indrakila | Silahkan masuk';
        if ($this->ses->log_s=='Ok') {
			redirect(site_url('home'));
        }else{
            $this->load->view('General/Login_page',$data);
        }
    }
    
        // $val = ['tp'=>'MNG','nu'=>'0081585629042','log_s'=>'Ok'];
        // $this->ses->set_userdata($val);
        // $data2 = $this->ses->userdata();
        // $this->ses->sess_destroy();
        // echo json_encode($data2);
        // echo $this->ses->__ci_last_regenerate;

    function home(){
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
        
        $this->load->view('General/home',$data);
    }


    function login_process(){
        $email = $this->input->post('email',true);
        $password = $this->input->post('password',true);

        $v = $this->hr->login_process($email, $password);
        $log_mesg = '[PRIVATE] Masuk ke sistem web pada '.date('d-m-Y H:i:s');
        if ($v) {
            $this->hr->log_admin($v->id, $log_mesg, date('Y-m-d'), date('H:i:s'));
            $ses=['nu'=>$v->id,'nm'=>$v->nm,'tp'=>$v->tp,'img'=>$v->img,'log_s'=>'Ok'];
            $this->ses->set_userdata($ses);
            $res=['stat'=>200,'url'=>base_url()];
            echo json_encode($res);
        }else{
            $res=['stat'=>100];
            echo json_encode($res);
        }
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

    function req_forget_pass($type='view'){
        $data['title'] = 'BUMDes Indrakila | Lupa password';
        if ($type=='view') {
            $this->load->view('General/Lupa_password',$data);
        }else if ($type=='submit'){
            $email = $this->input->post('email',true);
            $user = $this->hr->get_detail_user($email);
            
            $email = $user?$user->un:null;
            $nama =  $user?$user->nm:null;
            $id = $user?$user->id:null;
            $this->load->library('email');
            $from = $this->config->item('smtp_user');
            
            $v=$this->hr->set_url_confirm($nama.'|'.$email.'|'.$id);
            $log_mesg = '[PRIVATE][REQ][GANTI PASSWORD]['.$v['id'].'] Request lupa password';

            if ($v['res']) {
                $this->hr->log_admin('0081578813144', $log_mesg, date('Y-m-d'), date('H:i:s'));

                $subject = 'Ganti password admin sistem manajemen BUMDes Indrakila Jaya '.date('d-m-Y');
                $message = 'Silahkan klik <a href="'.site_url('ganti-password/'.$v['id']).'" target="_blank">tautan</a> ini untuk mengganti password';
        
                $this->email->set_newline("\r\n");
                $this->email->from($from, 'Sistem Web BUMDes');
                $this->email->to($email);
                $this->email->subject($subject);
                $this->email->message($message);
                $this->email->send();
                // show_error($this->email->print_debugger());
                echo 200;
            }
        }
    }

    function forget_password($id){
        $data['page']=$this->page;
        $data['title'] = 'Registrasi admin baru';
        
        $data['v'] = $this->hr->get_url_confirm($id);
        if ($data['v']&&waktu_data($id)&&!isset($_POST['sub'])) {
            $data['v']= explode('|',$data['v']->nt);
            $this->load->view('General/ganti_password',$data);
        }else if (isset($_POST['sub'])&&$data['v']) {
            $id= explode('|',$data['v']->nt);
            $id = $id[2];
            $password = $this->input->post('password',true);
            $password2 = $this->input->post('password2',true);
            
        $v = $this->hr->ganti_password($id, $password, $password2);
        echo $v?200:100;
        }else{
            $this->load->view('General/general_404',$data);
        }
    }

    function general_req($id){
        $data = $this->hr->get_url_conf($id);
        redirect(site_url());
    }
}
