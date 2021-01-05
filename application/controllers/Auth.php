<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function log_in()
    {
        if ($this->session->userdata('status') == "login") {
            if ($this->session->userdata('lock') == "false") redirect($this->session->userdata('dashboard'));
            else redirect('auth/lockpage');
        } else {
            $data['setting'] = $this->model_all->getAll('tb_setting')->result_array();
            $this->load->view('v_login', $data);
        }
        
    }
    
     public function perbaikan_web()
    {
        if ($this->session->userdata('status') == "login") {
            if ($this->session->userdata('lock') == "false") redirect($this->session->userdata('dashboard'));
            else redirect('auth/lockpage');
        } else {
            $data['setting'] = $this->model_all->getAll('tb_setting')->result_array();
            $this->load->view('perbaikan', $data);
        }
    }
    
    public function verifikasi_log()
    {
        $dashboard = "";
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $verifikasi = $this->model_log->in_verifikasi($username, md5($password));
        if ($verifikasi->num_rows() > 0) {
            $data_log = $verifikasi->result_array();
            $data_sesi = array(
                'id_pengguna' => $data_log[0]['id_pengguna'],
                'nama_lengkap' => $data_log[0]['fullname'],
                'jabatan' => $data_log[0]['jabatan'],
                'username' => $data_log[0]['username'],
                'level' => $data_log[0]['level'],
                'foto' => $data_log[0]['foto'],
                'lock' => 'false',
                'status' => "login",
            );

            if ($data_log[0]['level'] == 1) $dashboard = "superadmin/dashboard";
            else if ($data_log[0]['level'] == 2) $dashboard = "admin/dashboard";
            else if (($data_log[0]['level'] == 3) || ($data_log[0]['level'] == 4) || ($data_log[0]['level'] == 5) || ($data_log[0]['level'] == 6)) $dashboard = "user/dashboard";
            else if ($data_log[0]['level'] == 7) $dashboard = "userumum/dashboard";
            else $dashboard = "auth/log_in";

            $data_sesi['dashboard'] = $dashboard;
            $this->session->set_userdata($data_sesi);
        } else {
            $dashboard = "auth/log_in";
        }

        redirect($dashboard);
    }

    public function get_lock()
    {
        $this->session->set_userdata(array("lock" => "true",));
        $this->lockpage();
    }

    public function lockpage()
    {
        if ($this->session->userdata('lock') == "true") {
            $data['setting'] = $this->model_all->getAll('tb_setting')->result_array();
            $this->load->view('v_lockhalaman', $data);
        } else {
            redirect('auth/log_in');
        }
    }

    public function unlockpage()
    {
        $username = $this->session->userdata('username');
        $password = $this->input->post('password_lock');
        $verifikasi = $this->model_log->in_verifikasi($username, md5($password));
        if ($verifikasi->num_rows() > 0) {
            $this->session->set_userdata(array("lock" => "false",));
            redirect($this->session->userdata('dashboard'));
        } else {
            redirect('auth/lockpage');
        }
    }

    public function log_out()
    {
        $this->session->sess_destroy();
        redirect('auth/log_in');
    }
}
