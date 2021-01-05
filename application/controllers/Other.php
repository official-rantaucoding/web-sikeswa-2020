<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Other extends CI_Controller
{
    
    function __construct()
    {
        parent::__construct();
        $this->load->helper('file');
        if($this->session->userdata('status') <> "login")
        {
            redirect('auth/log_in');
        }
    }

    // tampilan
    public function ubah_profile()
    {
        $data['setting'] = $this->model_all->getAll('tb_setting')->result_array();
        $this->load->view('teamplate/v_header',$data);
        $this->load->view('teamplate/v_topbar',$data);
        $this->load->view('teamplate/v_sidebar',$data);
        $this->load->view('v_ubahprofile',$data);
        $this->load->view('teamplate/v_footer',$data);
    }

    public function ubah_sandi()
    { 
        $data['setting'] = $this->model_all->getAll('tb_setting')->result_array();
        $this->load->view('teamplate/v_header',$data);
        $this->load->view('teamplate/v_topbar',$data);
        $this->load->view('teamplate/v_sidebar',$data);
        $this->load->view('v_ubahkatasandi',$data);
        $this->load->view('teamplate/v_footer',$data);
    }

    public function tentang()
    { 
        $data['setting'] = $this->model_all->getAll('tb_setting')->result_array();
        $this->load->view('teamplate/v_header',$data);
        $this->load->view('teamplate/v_topbar',$data);
        $this->load->view('teamplate/v_sidebar',$data);
        $this->load->view('v_tentang',$data);
        $this->load->view('teamplate/v_footer',$data);
    }

    public function bantuan()
    { 
        $data['setting'] = $this->model_all->getAll('tb_setting')->result_array();
        $this->load->view('teamplate/v_header',$data);
        $this->load->view('teamplate/v_topbar',$data);
        $this->load->view('teamplate/v_sidebar',$data);
        $this->load->view('v_bantuan',$data);
        $this->load->view('teamplate/v_footer',$data);
    }

    public function page_404()
    { 
        $data['setting'] = $this->model_all->getAll('tb_setting')->result_array();
        $this->load->view('error_page/v_404page',$data);
    }

    public function page_403()
    {
        $data['setting'] = $this->model_all->getAll('tb_setting')->result_array();
        $this->load->view('teamplate/v_header',$data);
        $this->load->view('teamplate/v_topbar',$data);
        $this->load->view('teamplate/v_sidebar',$data);
        $this->load->view('error_page/v_403',$data);
        $this->load->view('teamplate/v_footer',$data);
    }

    // fungsi
    public function do_ubah_profile()
    {
        $data = array('success' => false, 'pesan' => '', 'nm_lengkap' => '', 'foto' => '', 'message' => array(),);
        $allowed_mime_type_arr = array('image/png', 'image/jpg', 'image/jpeg');
        $max_size_img = 4194304; // 4194304B - 4096KB - 4MB - 0.00391GB
        $name = $_FILES['photo_pengguna_other']['name'];
        $size = $_FILES['photo_pengguna_other']['size'];
        $mime = get_mime_by_extension($name);
        
        $path_upload_photo = "./assets/image/img_pengguna/";
        $this->form_validation->set_rules("fullname_pengguna", "nomor lengkap", "trim|required", ["required" => "Nama lengkap tidak boleh kosong"]);
        $this->form_validation->set_error_delimiters('<p class="text-danger" style="font-size: 14px;">', '</p>');


        if ($this->form_validation->run()) {
            foreach ($_POST as $key => $value) { $data['message'][$key] = "";}

            $nama_lengkap = $this->input->post('fullname_pengguna');
            $id_pengguna = $this->session->userdata('id_pengguna');

            if (!empty($name)) {
                if (in_array($mime, $allowed_mime_type_arr)) {
                    if ($size <= $max_size_img) {
                        
                        $config['profl']['upload_path'] = $path_upload_photo; 
                        $config['profl']['overwrite'] = TRUE;
                        $config['profl']['allowed_types'] = 'png|jpg|jpeg';
                        $config['profl']['max_size'] = 4096;
                        $config['profl']['file_name'] = $id_pengguna;

                        $this->load->library('upload',$config['profl']); 
                        if($this->upload->do_upload('photo_pengguna_other')){
                            $data['success'] = true;
                            $nama_file = $this->upload->data('file_name');
                            $data_pengguna = array(
                                'fullname' => $nama_lengkap, 
                                'foto' => $this->db->escape_str($nama_file), 
                            );

                            if ($this->model_all->updateData('tb_pengguna', $data_pengguna, ['id_pengguna' => $id_pengguna])) { 

                                $pesan = "success";
                                $data['nm_lengkap'] = $nama_lengkap;
                                $data['foto'] = base_url('assets/image/img_pengguna/').$nama_file;

                                $this->session->set_userdata(array("nama_lengkap" => $nama_lengkap, "foto" => $nama_file));
                            }
                            else  { $pesan = "error"; }
                            
                            $data['pesan'] = $pesan;
                        }else{
                            $data['message']['photo_pengguna_other'] = '<p class="text-danger" style="font-size: 14px;">Gagal mengupload gambar ini</p>';
                        }
                    }else{
                        $data['message']['photo_pengguna_other'] = '<p class="text-danger" style="font-size: 14px;">Ukuran file melebihi 4MB</p>';
                    }
                }else{
                    $data['message']['photo_pengguna_other'] = '<p class="text-danger" style="font-size: 14px;">File photo harus berekstensi *.jpg|*.png|*.jpeg </p>';
                }

            }else{
                $data['success'] = true; 
                if ($this->model_all->updateData('tb_pengguna', ['fullname' =>$nama_lengkap], ['id_pengguna' => $id_pengguna]))  {
                    $pesan = "success";
                    $data['nm_lengkap'] = $nama_lengkap;
                    $this->session->set_userdata(array("nama_lengkap" => $nama_lengkap,));
                }
                else  {$pesan = "error";}
                $data['pesan'] = $pesan;
            }

        } else {
            foreach ($_POST as $key => $value) {
                $data['message'][$key] = form_error($key);
            }
        }
        sleep(1);
        echo json_encode($data);
    }

    public function do_ubah_sandi()
    {
        $data = array('success' => false, 'pesan' => '', 'username' => '', 'message' => array(),);
        $this->form_validation->set_rules("nama_pengguna", "Nama pengguna", "trim|required", ["required" => "Nama pengguna tidak boleh kosong"]);
        $this->form_validation->set_rules("sandi_lama", "Sandi lama", "trim|required", ["required" => "Nama lengkap tidak boleh kosong"]);
        $this->form_validation->set_rules("sandi_baru", "Sandi baru", "trim|required", ["required" => "Sandi baru tidak boleh kosong"]);
        $this->form_validation->set_rules("konfir_sandi_baru", "Konfirmasi sandi baru", "trim|required", ["required" => "Konfirmasi sandi baru tidak boleh kosong"]);
        $this->form_validation->set_error_delimiters('<p class="text-danger" style="font-size: 14px;">', '</p>');


        if ($this->form_validation->run()) {

            foreach ($_POST as $key => $value) { $data['message'][$key] = "";}

            $passlama = md5($this->input->post('sandi_lama'));
            $passbaru = $this->input->post('sandi_baru');
            $confpassbaru = $this->input->post('konfir_sandi_baru');
            $cekPass = $this->model_all->getWhere('tb_pengguna', array('password' => $passlama, ))->num_rows();
            if (($cekPass > 0) && ($passbaru == $confpassbaru)) {
                
                $data['success'] = true;
                $data_pengguna = array(
                    'username' => $this->input->post('nama_pengguna'), 
                    'password' => md5($this->input->post('konfir_sandi_baru')),
                ); 

                if ($this->model_all->updateData('tb_pengguna', $data_pengguna, ['id_pengguna' => $this->session->userdata('id_pengguna')])) {
                    $pesan = "success";
                    $data['username'] = $this->input->post('nama_pengguna');
                    $this->session->set_userdata(array("username" => $this->input->post('nama_pengguna')));
                }else{
                    $pesan = "error";
                }   

                $data['pesan'] = $pesan;
            }else{

                if (($cekPass < 1) && ($passbaru <> $confpassbaru)) {
                    $data['message']['sandi_lama'] = '<p class="text-danger" style="font-size: 14px;">Sandi lama tidak sesuai</p>';
                    $data['message']['konfir_sandi_baru'] = '<p class="text-danger" style="font-size: 14px;">Konfirmasi sandi baru tidak sama dengan sandi baru </p>';
                }else {
                    if (($cekPass < 1) && ($passbaru == $confpassbaru)) $data['message']['sandi_lama'] = '<p class="text-danger" style="font-size: 14px;">Sandi lama tidak sesuai</p>';
                    if (($cekPass > 0) && ($passbaru <> $confpassbaru)) $data['message']['konfir_sandi_baru'] = '<p class="text-danger" style="font-size: 14px;">Konfirmasi sandi baru tidak sama dengan sandi baru </p>';
                }
            }
        }else{

            foreach ($_POST as $key => $value) {
                $data['message'][$key] = form_error($key);
            }
        }

        echo json_encode($data);
    }
    
    // grafik dashboard
    public function getGrafikJk_pasien()
    {
        $countLakilaki = $this->model_all->getGrafik_dashboard('jk','Laki-Laki');
        $countPerempuan = $this->model_all->getGrafik_dashboard('jk','Perempuan');
        $countTranseksual = $this->model_all->getGrafik_dashboard('jk','Transeksual');
        $countTidakdiketahui = $this->model_all->getGrafik_dashboard('jk','Tidak diketahui');
        $countTidakmenentukan = $this->model_all->getGrafik_dashboard('jk','Tidak menentukan');
        $rows = [$countLakilaki, $countPerempuan, $countTranseksual, $countTidakdiketahui, $countTidakmenentukan];

        echo json_encode($rows, JSON_NUMERIC_CHECK);   
    }

    public function getGrafikpendidikan_pasien()
    {
        $countsd = $this->model_all->getGrafik_dashboard('pendidikan','SD');
        $countsmp = $this->model_all->getGrafik_dashboard('pendidikan','SMP');
        $countsma = $this->model_all->getGrafik_dashboard('pendidikan','SMA');
        $countdi = $this->model_all->getGrafik_dashboard('pendidikan','DI');
        $countdii = $this->model_all->getGrafik_dashboard('pendidikan','DII');
        $countdiii = $this->model_all->getGrafik_dashboard('pendidikan','DIII');
        $countdiv = $this->model_all->getGrafik_dashboard('pendidikan','DIV');
        $countsi = $this->model_all->getGrafik_dashboard('pendidikan','S1');
        $countsii = $this->model_all->getGrafik_dashboard('pendidikan','S2');
        $countsiii = $this->model_all->getGrafik_dashboard('pendidikan','S3');
        $countsiiii = $this->model_all->getGrafik_dashboard('pendidikan','Tidak Sekolah');
        $countsiiiii = $this->model_all->getGrafik_dashboard('pendidikan','Belum Sekolah');
        $rows = [$countsd, $countsmp, $countsma, $countdi, $countdii, $countdiii, $countdiv, $countsi, $countsii, $countsiii, $countsiiii, $countsiiii];

        echo json_encode($rows, JSON_NUMERIC_CHECK);   
    }

    public function getGrafikumur_pasien()
    {
        $count1 = $this->model_all->getGrafik_dashboard_umur('usia <', 18);
        $count2 = $this->model_all->getGrafik_dashboard_umur('usia >=', 18, 'usia <=', 25, 'range');
        $count3 = $this->model_all->getGrafik_dashboard_umur('usia >=', 26, 'usia <=', 30, 'range');
        $count4 = $this->model_all->getGrafik_dashboard_umur('usia >=', 31, 'usia <=', 35, 'range');
        $count5 = $this->model_all->getGrafik_dashboard_umur('usia >=', 36, 'usia <=', 40, 'range');
        $count6 = $this->model_all->getGrafik_dashboard_umur('usia >=', 41, 'usia <=', 45, 'range');
        $count7 = $this->model_all->getGrafik_dashboard_umur('usia >', 45);

        $rows = [$count1, $count2, $count3, $count4, $count5, $count6, $count7];

        echo json_encode($rows, JSON_NUMERIC_CHECK);   
    }

    public function getGrafikdesa_pasien()
    {
        $countSoluowe = $this->model_all->getGrafik_dashboard('desa','Soluowe');
        $countPotoya = $this->model_all->getGrafik_dashboard('desa','Potoya');
        $countKarawana = $this->model_all->getGrafik_dashboard('desa','Karawana');
        $countSidera = $this->model_all->getGrafik_dashboard('desa','Sidera');
        $rows = [$countSoluowe, $countPotoya, $countKarawana, $countSidera];
        echo json_encode($rows, JSON_NUMERIC_CHECK);   
    }

    public function getGrafikpeta_pasien()
    {
        $countSoluowe = $this->model_all->getGrafik_dashboard('desa','Soulowe');
        $countPotoya = $this->model_all->getGrafik_dashboard('desa','Potoya');
        $countKarawana = $this->model_all->getGrafik_dashboard('desa','Karawana');
        $countSidera = $this->model_all->getGrafik_dashboard('desa','Sidera');
        $rows = [$countSoluowe, $countPotoya, $countKarawana, $countSidera];
        echo json_encode($rows, JSON_NUMERIC_CHECK); 
    }

    public function cek_session_user()
    {
        if ($this->session->userdata('status') <> "login") $data['session'] = false;
        else $data['session'] = true;
        echo json_encode($data);
    }

    public function simpanRekammedis($hasilIntervensi, $kesimpulan, $keluhan)
    {
        $data = array(
            'hasilintervensi' => $hasilIntervensi, 
            'kesimpulan' => $kesimpulan, 
            'keluhan' => $keluhan, 
        );

        $this->session->set_userdata($data);
    }

}