<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Superadmin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('status') <> "login") {
            redirect('auth/log_in');
        } else {

            if ($this->session->userdata('lock') == "false") {
                if ($this->session->userdata('level') <> 1) redirect('other/page_403');
            } else {
                redirect('auth/lockpage');
            }
        }
    }

    private function autokode($tabel, $field, $text)
    {
        return $this->model_all->_kode_otomatis($tabel, 'id', $field, $text . date('dmY'));
    }

    public function dashboard()
    {
        $data['setting'] = $this->model_all->getAll('tb_setting')->result_array();
        $this->load->view('teamplate/v_header', $data);
        $this->load->view('teamplate/v_topbar', $data);
        $this->load->view('teamplate/v_sidebar', $data);
        $this->load->view('super_admin/v_dashboard', $data);
        $this->load->view('teamplate/v_footer', $data);
    }

    public function settingtema()
    {
        $data['setting'] = $this->model_all->getAll('tb_setting')->result_array();
        $this->load->view('teamplate/v_header', $data);
        $this->load->view('teamplate/v_topbar', $data);
        $this->load->view('teamplate/v_sidebar', $data);
        $this->load->view('super_admin/v_setting', $data);
        $this->load->view('teamplate/v_footer', $data);
    }

    public function akunpengguna()
    {
        $data['setting'] = $this->model_all->getAll('tb_setting')->result_array();
        $data['data_pengguna'] = $this->model_all->getAll('tb_pengguna')->result_array();
        $this->load->view('teamplate/v_header', $data);
        $this->load->view('teamplate/v_topbar', $data);
        $this->load->view('teamplate/v_sidebar', $data);
        $this->load->view('super_admin/v_akunpengguna', $data);
        $this->load->view('teamplate/v_footer', $data);
    }

    private function _uploadimage($file_name)
    {
        $config['upload_path']          = './assets/image/img_pengguna/';
        $config['allowed_types']        = 'gif|jpg|jpeg|png';
        $config['file_name']            = $file_name;
        $config['overwrite']            = true;
        $config['max_size']             = 1024; // 1MB
        $config['width']                = 132;
        $config['height']               = 106;
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('photo')) {
            return $this->upload->data("file_name");
        }

        return "default.png";
    }

    private function _deleteImage($tabel, $field, $where, $directory)
    {
        $photo = $this->model_all->getWhere($tabel, $where)->result_array();
        if ($photo[0][$field] != "default.png") {
            $filename = explode(".", $photo[0][$field])[0];
            return array_map('unlink', glob(FCPATH . "assets/image/" . $directory . "/$filename.*"));
        }
    }

    public function tambah_pengguna()
    {
        $data = array('success' => false, 'pesan' => '', 'text' => '', 'message' => array());
        $allowed_mime_type_arr = array('image/png', 'image/jpg', 'image/jpeg');
        $mime = get_mime_by_extension($_FILES['photo']['name']);
        $max_size_img = 4194304; // 4194304B - 4096KB - 4MB - 0.00391GB

        $name = $_FILES['photo']['name'];
        $size = $_FILES['photo']['size'];
        $path_upload_photo = "./assets/image/img_pengguna/";

        $this->form_validation->set_rules("fullname", "full name", "trim|required", ["required" => "Fullname tidak boleh kosong"]);
        $this->form_validation->set_rules("username", "username", "trim|required", ["required" => "Username tidak boleh kosong"]);
        $this->form_validation->set_rules("password", "password", "trim|required", ["required" => "Password tidak boleh kosong"]);
        $this->form_validation->set_rules("level", "level", "trim|required", ["required" => "Level tidak boleh kosong"]);
        $this->form_validation->set_rules("status", "status", "trim|required", ["required" => "Status tidak boleh kosong"]);
        $this->form_validation->set_error_delimiters('<p class="text-danger" style="font-size: 14px;">', '</p>');

        if ($this->form_validation->run()) {
            foreach ($_POST as $key => $value) {
                $data['message'][$key] = "";
            }

            if (!empty($name)) {
                if (in_array($mime, $allowed_mime_type_arr)) {
                    if ($size <= $max_size_img) {

                        $data['success'] = true;
                        $id_pengguna = $this->autokode('tb_pengguna', 'id_pengguna', 'PGGN');

                        $config['tmb_akun']['upload_path'] = $path_upload_photo;
                        $config['tmb_akun']['allowed_types'] = 'png|jpg|jpeg';
                        $config['tmb_akun']['max_size'] = 4096;
                        $config['tmb_akun']['file_name'] = $id_pengguna;

                        $this->load->library('upload');
                        $this->upload->initialize($config['tmb_akun']);

                        if ($this->upload->do_upload('photo')) {
                            $data_insert = array(
                                'id_pengguna' => $id_pengguna,
                                'fullname' => $this->input->post('fullname'),
                                'jabatan' => $this->input->post('jabatan'),
                                'username' => $this->input->post('username'),
                                'password' => md5($this->input->post('password')),
                                'level' => $this->input->post('level'),
                                'status' => $this->input->post('status'),
                                'foto' => $this->db->escape_str($this->upload->data('file_name')),
                            );

                            if ($this->model_all->insertData('tb_pengguna', $data_insert)) $pesan = "success";
                            else $pesan = "error";
                            $data['pesan'] = $pesan;
                        } else {
                            $data['message']['photo'] = '<p class="text-danger" style="font-size: 14px;">Gagal mengupload gambar ini [ ' . $this->upload->display_errors() . ' ]</p>';
                        }
                    } else {
                        $data['message']['photo'] = '<p class="text-danger" style="font-size: 14px;">Ukuran file melebihi 4MB</p>';
                    }
                } else {
                    $data['message']['photo'] = '<p class="text-danger" style="font-size: 14px;">File photo harus berekstensi *.jpg|*.png|*.jpeg </p>';
                }
            } else {
                $data['message']['photo'] = '<p class="text-danger" style="font-size: 14px;">Photo tidak boleh kosong </p>';
            }
        } else {
            foreach ($_POST as $key => $value) {
                $data['message'][$key] = form_error($key);
            }
            if (empty($name)) $data['message']['photo'] = '<p class="text-danger" style="font-size: 14px;">Photo tidak boleh kosong </p>';
        }

        $data['text'] = "tersimpan";
        // sleep(1);
        echo json_encode($data);
    }


    public function ubahpengguna()
    {
        $id_pengguna = $this->input->post('id');
        $ambilpengguna = $this->model_all->getWhere('tb_pengguna', array('id_pengguna' => $id_pengguna))->result_array();
        $data_pengguna['data_pengguna'] = $ambilpengguna;
        $data_pengguna['base_url'] = base_url('superadmin/do_ubahpengguna');
        sleep(1);
        echo json_encode($data_pengguna);
    }


    public function do_ubahpengguna()
    {
        $data = array('success' => false, 'pesan' => '', 'text' => '', 'message' => array());
        $allowed_mime_type_arr = array('image/png', 'image/jpg', 'image/jpeg');
        $mime = get_mime_by_extension($_FILES['photo']['name']);
        $max_size_img = 4194304; // 4194304B - 4096KB - 4MB - 0.00391GB

        $name = $_FILES['photo']['name'];
        $size = $_FILES['photo']['size'];
        $path_upload_photo = "./assets/image/img_pengguna/";

        $this->form_validation->set_rules("fullname", "full name", "trim|required", ["required" => "Fullname tidak boleh kosong"]);
        $this->form_validation->set_rules("username", "username", "trim|required", ["required" => "Username tidak boleh kosong"]);
        $this->form_validation->set_rules("level", "level", "trim|required", ["required" => "Level tidak boleh kosong"]);
        $this->form_validation->set_rules("status", "status", "trim|required", ["required" => "Status tidak boleh kosong"]);
        $this->form_validation->set_error_delimiters('<p class="text-danger" style="font-size: 14px;">', '</p>');

        if ($this->form_validation->run()) {
            foreach ($_POST as $key => $value) {
                $data['message'][$key] = "";
            }
            $id_pengguna = $this->input->post('kd_pggn');

            if (!empty($name)) {
                if (in_array($mime, $allowed_mime_type_arr)) {
                    if ($size <= $max_size_img) {

                        $config['ubh_akun']['upload_path'] = $path_upload_photo;
                        $config['ubh_akun']['overwrite'] = TRUE;
                        $config['ubh_akun']['allowed_types'] = 'png|jpg|jpeg';
                        $config['ubh_akun']['max_size'] = 4096;
                        $config['ubh_akun']['file_name'] = $id_pengguna;

                        $this->load->library('upload', $config['ubh_akun']);

                        if ($this->upload->do_upload('photo')) {
                            $data['success'] = true;
                            $data_insert['id_pengguna'] = $id_pengguna;
                            $data_insert['fullname'] = $this->input->post('fullname');
                            $data_insert['jabatan'] = $this->input->post('jabatan');
                            $data_insert['username'] = $this->input->post('username');
                            if ($this->input->post('password') <> "") $data_insert['password'] = md5($this->input->post('password'));
                            $data_insert['level'] = $this->input->post('level');
                            $data_insert['status'] = $this->input->post('status');
                            $data_insert['foto'] = $this->db->escape_str($this->upload->data('file_name'));

                            if ($this->model_all->updateData('tb_pengguna', $data_insert, array('id_pengguna' => $id_pengguna,))) $pesan = "success";
                            else $pesan = "error";
                            $data['pesan'] = $pesan;
                        } else {
                            $data['message']['photo'] = '<p class="text-danger" style="font-size: 14px;">Gagal mengupload gambar ini</p>';
                        }
                    } else {
                        $data['message']['photo'] = '<p class="text-danger" style="font-size: 14px;">Ukuran file melebihi 4MB</p>';
                    }
                } else {
                    $data['message']['photo'] = '<p class="text-danger" style="font-size: 14px;">File photo harus berekstensi *.jpg|*.png|*.jpeg </p>';
                }
            } else {

                $data['success'] = true;

                $data_insert['id_pengguna'] = $id_pengguna;
                $data_insert['fullname'] = $this->input->post('fullname');
                $data_insert['jabatan'] = $this->input->post('jabatan');
                $data_insert['username'] = $this->input->post('username');
                if ($this->input->post('password') <> "") $data_insert['password'] = md5($this->input->post('password'));
                $data_insert['level'] = $this->input->post('level');
                $data_insert['status'] = $this->input->post('status');


                if ($this->model_all->updateData('tb_pengguna', $data_insert, array('id_pengguna' => $id_pengguna,))) $pesan = "success";
                else $pesan = "error";
                $data['pesan'] = $pesan;
            }
        } else {
            foreach ($_POST as $key => $value) {
                $data['message'][$key] = form_error($key);
            }
        }

        $data['text'] = "diubah";
        sleep(1);
        echo json_encode($data);
    }


    public function hapuspengguna()
    {
        $data = array('success' => false, 'pesan' => '',);
        $id_pengguna = $this->input->post('id');
        $getfoto = $this->model_all->getWhere('tb_pengguna', ['id_pengguna' => $id_pengguna])->result_array()[0];
        $filename = explode(".", $getfoto['foto'])[0];
        array_map('unlink', glob(FCPATH . "assets/image/img_pengguna/$filename.*"));
        if ($this->model_all->deleteData('tb_pengguna', ['id_pengguna' => $id_pengguna])) {
            $pesan = "success";
            $data['success'] = true;
        } else {
            $pesan = "error";
        }

        $data['pesan'] = $pesan;
        echo json_encode($data);
    }


    public function ubah_tema_header()
    {
        $pesan = "";
        $getid = $this->model_all->getAll('tb_setting')->result_array();
        $id_warna = $this->input->post('id_warna_header');
        if ($this->model_all->updateData('tb_setting', array('color_header' => $id_warna), array('id' => $getid[0]['id']))) $pesan = "Success";
        else $pesan = "Gagal";
        echo json_encode($pesan);
    }

    public function ubah_tema_sidebar()
    {
        $pesan = "";
        $getid = $this->model_all->getAll('tb_setting')->result_array();
        $id_warna_sidebar = $this->input->post('id_warna_sidebar');
        $id_warna_profile = $this->input->post('id_warna_profile');
        if ($this->model_all->updateData('tb_setting', array('color_sidebar' => $id_warna_sidebar), array('id' => $getid[0]['id']))) $pesan = "Success";
        else $pesan = "Gagal";

        echo json_encode($pesan);
    }

    public function ubah_tema_logobar()
    {
        $pesan = "";
        $getid = $this->model_all->getAll('tb_setting')->result_array();
        $id_warna = $this->input->post('id_warna');
        if ($this->model_all->updateData('tb_setting', array('color_logobar' => $id_warna), array('id' => $getid[0]['id']))) $pesan = "Success";
        else $pesan = "Gagal";

        echo json_encode($pesan);
    }

    public function ubah_logo()
    {
        $getid = $this->model_all->getAll('tb_setting')->result_array();

        $this->_deleteImage('tb_setting', 'img_logo', array('id' => $getid[0]['id'],), 'img_logo');
        $logo = $this->_uploadimage("img_logo", "logo_caritas" . date('dmYhmsa'));

        $this->model_all->updateData('tb_setting', array('img_logo' => $logo), array('id' => $getid[0]['id']));
        redirect('superadmin/settingtema');
    }

    public function ubah_tema_profile()
    {
        $pesan = "";
        $getid = $this->model_all->getAll('tb_setting')->result_array();
        $id_warna_profile = $this->input->post('id_warna_profile');

        if ($this->model_all->updateData('tb_setting', array('color_profile' => $id_warna_profile), array('id' => $getid[0]['id']))) {
            $pesan = "Success";
        } else $pesan = "Gagal";

        echo json_encode($pesan);
    }
}
