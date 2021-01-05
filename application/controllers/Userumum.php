<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Userumum extends CI_Controller
{
	function __construct(){
        parent::__construct();
        if($this->session->userdata('status') <> "login"){
            redirect('auth/log_in');
        }else{

            if ($this->session->userdata('lock') == "false") {
                 if (($this->session->userdata('level') <> 1) && ($this->session->userdata('level') <> 7))  redirect('other/page_403');
            }else{
                redirect('auth/lockpage');
            }
        }
    }

    public function dashboard()
    {
        $data['setting'] = $this->model_all->getAll('tb_setting')->result_array();
        $this->load->view('teamplate/v_header',$data);
        $this->load->view('teamplate/v_topbar',$data);
        $this->load->view('teamplate/v_sidebar',$data);
        $this->load->view('userumum/v_informasiterkini',$data);
        $this->load->view('teamplate/v_footer',$data);
    }

    // fungsi
}
