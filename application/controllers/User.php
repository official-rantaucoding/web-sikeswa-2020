<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('print_rekap');
        $this->load->helper('chart_laporan');

        if ($this->session->userdata('status') <> "login") {
            redirect('auth/log_in');
        } else {
            if ($this->session->userdata('lock') == "false") {
                if ($this->session->userdata('level') <> 3  && $this->session->userdata('level') <> 4 && $this->session->userdata('level') <> 5 && $this->session->userdata('level') <> 6  && $this->session->userdata('level') <> 1) redirect('other/page_403');
            } else {
                redirect('auth/lockpage');
            }
        }
    }

    private function autokode($tabel, $field, $text)
    {
        return $this->model_all->_kode_otomatis($tabel, 'id', $field, $text . date('dmY'));
    }
    
      public function getautokode($tabel, $field, $text)
    {
        echo json_encode($this->model_all->_kode_otomatis($tabel, 'id', $field, $text . date('dmY')));
    }

    public function dashboard()
    {
        $data['setting'] = $this->model_all->getAll('tb_setting')->result_array();
        $this->load->view('teamplate/v_header', $data);
        $this->load->view('teamplate/v_topbar', $data);
        $this->load->view('teamplate/v_sidebar', $data);
        $this->load->view('user/v_dashboard', $data);
        $this->load->view('teamplate/v_footer', $data);
    }

    public function assesment($link, $id_pasien = "", $id_assesment = "")
    {
        $data_kegiatan = '';
        $link_kembali = '';
        $text_kembali = '';
        $id_asessmenold = '';
        $daftar_link = array('br', 'lm', 'rd', 'rp', 'sel');
        $cek_link = decrypt_url($link);
        $jabatan = $this->session->userdata('jabatan');
        $data_id_pasien = decrypt_url($id_pasien);
        if (!empty($id_assesment)) {
            $id_assesment = decrypt_url($id_assesment);
            if ($this->model_user->cekidasessment($id_assesment) > 0) {
                $id_asessmenold = $id_assesment;
            } else {
                if ($jabatan == "Dokter") redirect('user/rujukandokter');
                elseif ($jabatan == "Psikolog") redirect('user/rujukanpsikolog');
            }
        }

        if ((in_array($cek_link, $daftar_link)) && !empty($id_pasien)) {

            if ($cek_link == "br") {
                $link_kembali = "pasienbaru";
                $text_kembali = "Pasien Baru";
            } else if ($cek_link == "lm") {
                $link_kembali = "get_hapus_pasien_assesment/" . encrypt_url($data_id_pasien);
                $text_kembali = "Data Pasien Lama";
            } else if ($cek_link == "rd") {
                $link_kembali = "rujukandokter";
                $text_kembali = "Rujukan Dokter";
            } else if ($cek_link == "rp") {
                $link_kembali = "rujukanpsikolog";
                $text_kembali = "Rujukan Psikolog";
            } else if ($cek_link == "sel") {
                $link_kembali = "datapasien";
                $text_kembali = "Data seluruh pasien";
            }

            $cekDataassesment = $this->model_user->getdatapasienassesment($data_id_pasien);
            if ($cekDataassesment->num_rows() > 0) {
                $no = $cekDataassesment->num_rows();
                $data_pasien = $cekDataassesment->result_array();
                foreach ($data_pasien as $value) {
                    $data_kegiatan .= $no . ". " . $value['no_urut_assesment'] . ", " . $value['tgl_assesment'] . "\n";
                    $no--;
                }

                $cek_selesai_konseling = $this->model_user->cekselesaiKonseling($data_id_pasien);
                if ($cek_selesai_konseling > 0) $selesai_asessmnt = false;
                else $selesai_asessmnt = true;

                $cek_pernah_tindakan_rekam1 = $this->model_user->cekpernahKonselingdua($data_id_pasien, "rekam");
                $cek_pernah_tindakan_rekam2 = $this->model_user->cekpernahKonselingdua($data_id_pasien, "assesment");
                if ($cek_pernah_tindakan_rekam1 == 0  && $cek_pernah_tindakan_rekam2 > 0) $pernah_asessmntdua = true;
                else $pernah_asessmntdua = false;

                $cek_pernah_konseling = $this->model_user->cekpernahKonseling($data_id_pasien);
                if ($cek_pernah_konseling > 0) $pernah_asessmnt = true;
                else $pernah_asessmnt = false;

                $data['role_assesment'] = $data_pasien[0]['role_assesment'] + 1;
                $data['selesai_assesment'] = $selesai_asessmnt;
                $data['pernah_assesment'] = $pernah_asessmnt;
                $data['pernah_assesmentdua'] = $pernah_asessmntdua;
                $data['id_assesment'] = $data_pasien[0]['id_assesment'];
                $data['id_pasien'] = $data_pasien[0]['id_pasien'];
                $data['id_assesment_old'] = $id_asessmenold;
                $data['kegiatan_assesment'] = $data_kegiatan;
                $data['data_pasien'] = $data_pasien;
                $data['link_kembali'] = array('link' => $link_kembali, 'text' => $text_kembali);
                $data['setting'] = $this->model_all->getAll('tb_setting')->result_array();
                $this->load->view('teamplate/v_header', $data);
                $this->load->view('teamplate/v_topbar', $data);
                $this->load->view('teamplate/v_sidebar', $data);
                $this->load->view('user/v_assesment', $data);
                $this->load->view('teamplate/v_footer', $data);
            } else {
                $getDatapasien = $this->model_all->getWhere('tb_pasien', ['id_pasien' => $data_id_pasien]);
                if ($getDatapasien->num_rows() > 0) {
                    $data['role_assesment'] = 1;
                    $data['data_pasien'] = $getDatapasien->result_array();
                    $data['link_kembali'] = array('link' => $link_kembali, 'text' => $text_kembali);
                    $data['setting'] = $this->model_all->getAll('tb_setting')->result_array();
                    $this->load->view('teamplate/v_header', $data);
                    $this->load->view('teamplate/v_topbar', $data);
                    $this->load->view('teamplate/v_sidebar', $data);
                    $this->load->view('user/v_assesment', $data);
                    $this->load->view('teamplate/v_footer', $data);
                } else {
                    redirect('user/datapasien');
                }
            }
        } else {
            redirect($this->session->userdata('dashboard'));
        }
    }
    public function get_hapus_pasien_assesment($id_pasien)
    {
        $cek_pasien = decrypt_url($id_pasien);
        $get_datapasien = $this->model_all->getWhere('tb_assesment', ["id_pasien" => $cek_pasien])->num_rows();

        if ($get_datapasien == 0) {
            $this->model_all->deleteData('tb_pasien', ['id_pasien' => $cek_pasien]);
        }
        redirect('user/datapasien');
    }



    public function assesment_baru($id_pasien)
    {
        $cek_pasien = decrypt_url($id_pasien);
        $get_datapasien = $this->model_all->getWhere('tb_pasien', ["id_pasien" => $cek_pasien])->result_array();
        $id_pasien_baru = $this->autokode('tb_pasien', 'id_pasien', 'PSN');
        $data_pasien_baru = array(
            'id_pasien' => $id_pasien_baru,
            'no_rekam_medis' => $this->model_all->_kode_otomatis_rekamedis(),
            'nm_lengkap' => $get_datapasien[0]['nm_lengkap'],
            'nm_panggilan' => $get_datapasien[0]['nm_panggilan'],
            'tempat_lahir' => $get_datapasien[0]['tempat_lahir'],
            'tgl_lahir' => $get_datapasien[0]['tgl_lahir'],
            'jk' => $get_datapasien[0]['jk'],
            'usia' => $get_datapasien[0]['usia'],
            'agama' => $get_datapasien[0]['agama'],
            'status' => $get_datapasien[0]['status'],
            'alamat' => $get_datapasien[0]['alamat'],
            'kabupaten' => $get_datapasien[0]['kabupaten'],
            'kecamatan' => $get_datapasien[0]['kecamatan'],
            'desa' => $get_datapasien[0]['desa'],
            'no_hp' => $get_datapasien[0]['no_hp'],
            'pendidikan' => $get_datapasien[0]['pendidikan'],
            'pekerjaan' => $get_datapasien[0]['pekerjaan'],
            'nm_ortu' => $get_datapasien[0]['nm_ortu'],
        );

        if ($this->model_all->insertData('tb_pasien', $data_pasien_baru)) {
            redirect('user/assesment/' . encrypt_url('lm') . '/' . encrypt_url($id_pasien_baru));
        } else {
            redirect('user/pasienlama');
        }
    }

    public function rekammedis($link, $id_assesment)
    {
        $data = [];
        $data_konseling = '';
        $role_rekam = 1;
        $daftar_link = array('assm', 'lyi', 'lyk');
        $cek_link = decrypt_url($link);
        $link_kembali = '';

        if ((in_array($cek_link, $daftar_link)) && !empty($id_assesment)) {
            if ($cek_link == "assm") $link_kembali = "datapasien";
            else if ($cek_link == "lyi") $link_kembali = "layananindividu";
            else if ($cek_link == "lyk") $link_kembali = "layanankelompok";

            $id_assesment = decrypt_url($id_assesment);
            $cek_data_assesment = $this->model_user->getdataAsessment_rekammedis($id_assesment);

            if ($cek_data_assesment->num_rows() > 0) {
                $data_assesment = $cek_data_assesment->result_array();
                $id_pasien = $data_assesment[0]['id_pasien'];

                $checkpasienrekam = $this->model_user->cekRekamSebelumnya($id_pasien);
                if ($checkpasienrekam->num_rows() > 0) {
                    $data_rekam = $checkpasienrekam->result_array();
                    $role_rekam = $data_rekam[0]['role_rekam'] + 1;

                    $no = $checkpasienrekam->num_rows();
                    foreach ($data_rekam as $value) {
                        $data_konseling .= $no . ". " . $value['no_urut_rekam'] . ", " . $value['tgl_rekam'] . "\n";
                        $no--;
                    }

                    $cek_selesai_konseling = $this->model_user->cekselesaiKonseling($id_pasien);
                    if ($cek_selesai_konseling > 0) $selesai_konseling = false;
                    else $selesai_konseling = true;

                    $data['role_rekam'] = $role_rekam;
                    $data['selesai_konseling'] = $selesai_konseling;
                    $data['kegiatan_rekam'] = $data_konseling;
                    $data['pasien'] = $id_pasien;
                    $data['data_assesment'] = $data_assesment;
                    $data['data_rekam'] = $data_rekam;
                } else {
                    $data['role_rekam'] = $role_rekam;
                    $data['pasien'] = $id_pasien;
                    $data['data_assesment'] = $data_assesment;
                }

                $data['link_kembali'] = $link_kembali;
                $data['setting'] = $this->model_all->getAll('tb_setting')->result_array();
                $this->load->view('teamplate/v_header', $data);
                $this->load->view('teamplate/v_topbar', $data);
                $this->load->view('teamplate/v_sidebar', $data);
                $this->load->view('user/v_rekammedis', $data);
                $this->load->view('teamplate/v_footer', $data);
            } else {
                redirect('user/datapasien');
            }
        } else {
            redirect($this->session->userdata('dashboard'));
        }
    }

    public function layananindividu()
    {
        $data['data_layanan_individu'] = $this->model_user->getlayananKonseling('Konseling Individu')->result_array();
        $data['setting'] = $this->model_all->getAll('tb_setting')->result_array();
        $this->load->view('teamplate/v_header', $data);
        $this->load->view('teamplate/v_topbar', $data);
        $this->load->view('teamplate/v_sidebar', $data);
        $this->load->view('user/v_layananindividu', $data);
        $this->load->view('teamplate/v_footer', $data);
    }


    public function layanankelompok()
    {
        $data['data_layanan_kelompok'] = $this->model_user->getlayananKonseling('Konseling Kelompok')->result_array();
        $data['setting'] = $this->model_all->getAll('tb_setting')->result_array();
        $this->load->view('teamplate/v_header', $data);
        $this->load->view('teamplate/v_topbar', $data);
        $this->load->view('teamplate/v_sidebar', $data);
        $this->load->view('user/v_layanankelompok', $data);
        $this->load->view('teamplate/v_footer', $data);
    }

    public function rujukanpsikolog()
    {
        $data['data_rujukan_psikolog'] = $this->model_user->getlayananrujukan('Rujuk Psikolog')->result_array();
        $data['setting'] = $this->model_all->getAll('tb_setting')->result_array();
        $this->load->view('teamplate/v_header', $data);
        $this->load->view('teamplate/v_topbar', $data);
        $this->load->view('teamplate/v_sidebar', $data);
        $this->load->view('user/v_rujukanpsikolog', $data);
        $this->load->view('teamplate/v_footer', $data);
    }

    public function rujukandokter()
    {
        $data['data_rujukan_dokter'] = $this->model_user->getlayananrujukan('Rujuk ke Dokter')->result_array();
        $data['data_rujukan_dokter_konseling'] = $this->model_user->getlayananrujukanDokter_konseling()->result_array();
        $data['setting'] = $this->model_all->getAll('tb_setting')->result_array();
        $this->load->view('teamplate/v_header', $data);
        $this->load->view('teamplate/v_topbar', $data);
        $this->load->view('teamplate/v_sidebar', $data);
        $this->load->view('user/v_rujukandokter', $data);
        $this->load->view('teamplate/v_footer', $data);
    }

    public function kader()
    {
        $data['data_rujukan_kader'] = $this->model_user->getlayananrujukan('Rujuk ke Kader')->result_array();
        $data['setting'] = $this->model_all->getAll('tb_setting')->result_array();
        $this->load->view('teamplate/v_header', $data);
        $this->load->view('teamplate/v_topbar', $data);
        $this->load->view('teamplate/v_sidebar', $data);
        $this->load->view('user/v_kader', $data);
        $this->load->view('teamplate/v_footer', $data);
    }

    public function perawatjiwa()
    {
        $data['data_rujukan_perawat_jiwa'] = $this->model_user->getlayananrujukan('Rujuk ke Perawat Jiwa')->result_array();
        $data['setting'] = $this->model_all->getAll('tb_setting')->result_array();
        $this->load->view('teamplate/v_header', $data);
        $this->load->view('teamplate/v_topbar', $data);
        $this->load->view('teamplate/v_sidebar', $data);
        $this->load->view('user/v_perawatjiwa', $data);
        $this->load->view('teamplate/v_footer', $data);
    }

    public function pasienbaru()
    {
        $kode = '';
        if ($this->session->userdata('jabatan') == 'Kader') $kode = $this->model_all->_kode_otomatis_rekamedis();
        $data['setting'] = $this->model_all->getAll('tb_setting')->result_array();
        $data['kode_rekammedis'] = $kode;
        $this->load->view('teamplate/v_header', $data);
        $this->load->view('teamplate/v_topbar', $data);
        $this->load->view('teamplate/v_sidebar', $data);
        $this->load->view('user/v_pasienbaru', $data);
        $this->load->view('teamplate/v_footer', $data);
    }

    public function pasienlama()
    {
        $data = [];
        $tampil_tabel = 1;
        $pasien_lama = $this->input->post('search');
        if ($pasien_lama == null) {
            $data['tampil_tabel'] = $tampil_tabel;
        } else {
            $cek_pasien = $this->model_user->search_pasien_lama($pasien_lama);
            if ($cek_pasien->num_rows() > 0) {
                $data['tampil_tabel'] = 3;
                $data['data_pasienlama'] = $cek_pasien->result_array();
            } else {
                $data['tampil_tabel'] = 2;
                $data['nama_pasien'] = '<b>"' . $pasien_lama . '"</b>';
            }
        }


        $data['setting'] = $this->model_all->getAll('tb_setting')->result_array();
        $this->load->view('teamplate/v_header', $data);
        $this->load->view('teamplate/v_topbar', $data);
        $this->load->view('teamplate/v_sidebar', $data);
        $this->load->view('user/v_pasienlama', $data);
        $this->load->view('teamplate/v_footer', $data);
    }

    public function pendaftaranpeserta()
    {
        $data['kode_pendaftaran'] = $this->autokode('tb_pendaftaran', 'id_pendaftaran', 'PPS');
        $data['setting'] = $this->model_all->getAll('tb_setting')->result_array();
        $this->load->view('teamplate/v_header', $data);
        $this->load->view('teamplate/v_topbar', $data);
        $this->load->view('teamplate/v_sidebar', $data);
        $this->load->view('user/v_pendaftaranpeserta', $data);
        $this->load->view('teamplate/v_footer', $data);
    }

    public function datapeserta()
    {
        $data['setting'] = $this->model_all->getAll('tb_setting')->result_array();
        $data['data_peserta'] = $this->model_all->getAll('tb_pendaftaran')->result_array();
        $this->load->view('teamplate/v_header', $data);
        $this->load->view('teamplate/v_topbar', $data);
        $this->load->view('teamplate/v_sidebar', $data);
        $this->load->view('user/v_datapeserta', $data);
        $this->load->view('teamplate/v_footer', $data);
    }
    public function inputaktivitas()
    {
        $data['setting'] = $this->model_all->getAll('tb_setting')->result_array();
        $data['dataAktifitas'] = $this->model_all->getGroup('tb_pendaftaran', 'aktivitas')->result_array();
        $this->load->view('teamplate/v_header', $data);
        $this->load->view('teamplate/v_topbar', $data);
        $this->load->view('teamplate/v_sidebar', $data);
        $this->load->view('user/v_inputaktivitas', $data);
        $this->load->view('teamplate/v_footer', $data);
    }

    public function laporanaktivitas()
    {
        $data['data_laporan_aktivitas'] = $this->model_all->getAll('tb_aktivitas')->result_array();
        $data['setting'] = $this->model_all->getAll('tb_setting')->result_array();
        $this->load->view('teamplate/v_header', $data);
        $this->load->view('teamplate/v_topbar', $data);
        $this->load->view('teamplate/v_sidebar', $data);
        $this->load->view('user/v_laporanaktivitas', $data);
        $this->load->view('teamplate/v_footer', $data);
    }

    public function inputantor()
    {
        $data['setting'] = $this->model_all->getAll('tb_setting')->result_array();
        $data['kode_tor'] = $this->autokode('tb_tor', 'kode_tor', 'TOR-');
        $this->load->view('teamplate/v_header', $data);
        $this->load->view('teamplate/v_topbar', $data);
        $this->load->view('teamplate/v_sidebar', $data);
        $this->load->view('user/v_inputantor', $data);
        $this->load->view('teamplate/v_footer', $data);
    }

    public function daftartor()
    {
        $data['setting'] = $this->model_all->getAll('tb_setting')->result_array();
        $data['daftar_tor'] = $this->model_all->getAll('tb_tor')->result_array();
        $this->load->view('teamplate/v_header', $data);
        $this->load->view('teamplate/v_topbar', $data);
        $this->load->view('teamplate/v_sidebar', $data);
        $this->load->view('user/v_daftartor', $data);
        $this->load->view('teamplate/v_footer', $data);
    }

    public function datapasien()
    {
        $data['setting'] = $this->model_all->getAll('tb_setting')->result_array();
        $data['data_pasien'] = $this->model_all->getAll('tb_pasien')->result_array();
        $this->load->view('teamplate/v_header', $data);
        $this->load->view('teamplate/v_topbar', $data);
        $this->load->view('teamplate/v_sidebar', $data);
        $this->load->view('user/v_datapasien', $data);
        $this->load->view('teamplate/v_footer', $data);
    }

    // cetak 

    public function cetak_aktifitas($id_cetak)
    {
        $id_cetak = decrypt_url($id_cetak);
        $cekdataaktifitas = $this->model_user->getdata_aktifitas($id_cetak);
        if ($cekdataaktifitas->num_rows() > 0) {
            $data_aktifivitas = $cekdataaktifitas->result_array()[0];
            $peserta = $this->model_user->getdata_pesertaaktifitas($id_cetak);
            $dokumentasi = $this->model_user->getdata_dokumentasiaktifitas($id_cetak);

            $panjangKarakter = strlen($data_aktifivitas['nm_aktivitas']);
            $stringKarakter = $panjangKarakter - 14;
            $judulTor = substr($data_aktifivitas['nm_aktivitas'], 0, $stringKarakter);
            $data_tor = $this->model_user->getdatajudultor_aktifitas($judulTor)->result_array();

            /* Print Using FPDF */
            $pdf = new Reportbulan();
            $pdf->AddPage('P', 'A4');
            $pdf->SetMargins(20, 47, 20);
            $pdf->SetAutoPageBreak(true, 40);
            $pdf->setTitle("Laporan Kegiatan");
            $pdf->SetAuthor('SIKESWA');

            $pdf->Ln(35);
            $pdf->SetFont('Times', 'B', 14);
            $pdf->Cell(0, 7, 'LAPORAN KEGIATAN', 0, 1, 'C');
            $pdf->SetFont('Times', 'B', 12);
            $pdf->MultiCell(0, 7, konversiChar(substr($data_aktifivitas['nm_aktivitas'], 7)), 0, 'C', 0, 0);

            $pdf->Ln(7);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(0, 7, 'A. Nama Kegiatan ', 0, 1, 'L');
            $pdf->SetFont('Times', '', 12);
            $pdf->MultiCell(0, 7, konversiChar(substr($data_aktifivitas['nm_aktivitas'], 7)), 0, 'J', 0, 15);

            $pdf->Ln(6);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(0, 7, 'B. Latar Belakang ', 0, 1, 'L');
            $pdf->SetFont('Times', '', 12);
            $pdf->MultiCell(0, 7, ($data_tor <> null) ? konversiChar($data_tor[0]['ltr_belakang']) : '-', 0, 'J', 0, 15);

            $pdf->Ln(6);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(0, 7, 'C. Tujuan ', 0, 1, 'L');
            $pdf->SetFont('Times', '', 12);
            $pdf->MultiCell(0, 7, ($data_tor <> null) ? konversiChar($data_tor[0]['tujuan']) : '-', 0, 'J', 0, 15);

            $pdf->Ln(6);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(0, 7, 'D. Waktu Pelaksanaan', 0, 1, 'L');
            $pdf->Cell(0, 7, 'Tanggal Mulai', 0, 1, 'L');
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(0, 7, konversiTanggalid($data_aktifivitas['tgl']), 0, 1, 'L');
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(0, 7, 'Tanggal Selesai', 0, 1, 'L');
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(0, 7, konversiTanggalid($data_aktifivitas['tgl_selesai']), 0, 1, 'L');

            $pdf->Ln(6);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(0, 7, 'E. Lokasi ', 0, 1, 'L');
            $pdf->SetFont('Times', '', 12);
            $pdf->MultiCell(0, 7, konversiChar($data_aktifivitas['lokasi']), 0, 'J', 0, 0);

            $pdf->Ln(6);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(0, 7, 'F. Peserta ', 0, 1, 'L');
            $pdf->SetFont('Times', '', 12);
            $pdf->MultiCell(0, 7, konversiChar($data_aktifivitas['jml_peserta']) . " Peserta", 0, 'J', 0, 0);

            $pdf->Ln(6);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(0, 7, 'G. Hasil Kegiatan ', 0, 1, 'L');
            $pdf->SetFont('Times', '', 12);
            $pdf->MultiCell(0, 7, ($data_aktifivitas['notulensi'] <> '') ? konversiChar($data_aktifivitas['notulensi']) : '-', 0, 'J', 0, 15);

            $pdf->Ln(6);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(0, 7, 'H. Alokasi Dana ', 0, 1, 'L');
            $pdf->SetFont('Times', '', 12);
            $pdf->MultiCell(0, 7, konversiChar($data_aktifivitas['dana']), 0, 'J', 0, 15);

            $pdf->Ln(6);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(0, 7, 'I. Perlengkapan ', 0, 1, 'L');
            $pdf->SetFont('Times', '', 12);
            $pdf->MultiCell(0, 7, ($data_tor <> null) ? konversiChar($data_tor[0]['perlengkapan']) : '-', 0, 'J', 0, 0);

            $pdf->Ln(6);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(0, 7, 'J. Penutup ', 0, 1, 'L');
            $pdf->SetFont('Times', '', 12);
            $pdf->MultiCell(0, 7, ($data_aktifivitas['kesimpulan'] <> '') ? konversiChar($data_aktifivitas['kesimpulan']) : '-', 0, 'J', 0, 15);

            /* Tanda tangan */
            $pdf->Ln(20);
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(87, 7, '', 0, 0, 'C');
            $pdf->Cell(87, 7, konversiTanggalid(date('Y-m-d')), 0, 0, 'C');
            $pdf->Ln();

            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(87, 7, 'Menyetujui,', 0, 0, 'C');
            $pdf->Cell(87, 7, 'Mengetahui,', 0, 0, 'C');

            $pdf->Ln();
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(87, 7, 'Director', 0, 0, 'C');
            $pdf->Cell(87, 7, 'Project Officer', 0, 0, 'C');

            $pdf->Ln(35);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(87, 7, 'Eriek Aristya Pradana Putra, MT', 0, 0, 'C');
            $pdf->Cell(87, 7, 'Novi Inriyanny Suwendro, SKM., MPH', 0, 0, 'C');
            /* Akhir tanda tangan */

            $pdf->AddPage('P', 'A4');
            $pdf->SetMargins(20, 47, 20);
            $pdf->SetAutoPageBreak(true, 40);
            $pdf->SetFont('Times', 'B', 14);
            $pdf->Cell(0, 7, 'LAMPIRAN', 0, 1, 'C');

            $pdf->Ln(7);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(0, 7, 'K. Data Peserta Kegiatan :', 0, 1, 'L');

            $pdf->Ln(3);
            $pdf->SetFont('Times', '', 12);
            $pdf->SetWidths(array(8, 32, 30, 20, 22, 23, 21, 14));
            $pdf->SetAligns(array("L", "L", "L", "L", "L", "L", "L", "Ln"));
            $pdf->SetFont('Times', '', 12);
            $pdf->Ln(2);

            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(8, 7, 'No.', 1, 0, 'L');
            $pdf->Cell(32, 7, 'No Pendaftaran', 1, 0, 'L');
            $pdf->Cell(30, 7, 'Nama Lengkap', 1, 0, 'L');
            $pdf->Cell(20, 7, 'Agama', 1, 0, 'L');
            $pdf->Cell(22, 7, 'Alamat', 1, 0, 'L');
            $pdf->Cell(23, 7, 'Pendidikan', 1, 0, 'L');
            $pdf->Cell(21, 7, 'Pekerjaan', 1, 0, 'L');
            $pdf->Cell(14, 7, 'Usia', 1, 0, 'L');
            $pdf->Ln(7);

            if ($peserta->num_rows() > 0) {
                $data_peserta = $peserta->result_array();
                $pdf->SetFont('Times', '', 12);
                $no = 0;
                foreach ($data_peserta as $value) {
                    $no++;
                    $pdf->Row_Aktifitas(array(($no) . ".", $value['no_pendaftaran'], $value['nm_lengkap'], $value['agama'], $value['alamat'], $value['pendidikan'], $value['pekerjaan'], $value['usia']));
                }
            } else {
                $pdf->SetFont('Times', '', 10);
                $pdf->Cell(174, 7, 'Tidak ada data peserta', 1, 0, 'C');
            }

            $pdf->AddPage('P', 'A4');
            $pdf->SetFont('Times', 'B', 14);
            $pdf->Cell(0, 7, 'LAMPIRAN', 0, 1, 'C');

            $pdf->Ln(7);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(0, 7, 'L. Dokumentasi Kegiatan :', 0, 1, 'L');
            $pdf->Ln(3);

            $positionX = 20;
            $positionY = 70;
            $pX = 20;
            // $rows = $dokumentasi->num_rows();
            $rows = 0;
            foreach ($dokumentasi->result_array() as $value) {
                $rows++;
                if ($rows > 0 && $rows <= 2) {
                    $pdf->Image(base_url('assets/image/img_dok_aktivitas/' . $value['gambar']), $positionX, $positionY, 84, 64);
                    $positionX += 87;
                }

                if ($rows > 2 && $rows <= 4) {
                    $pY = $positionY + 67;
                    $pdf->Image(base_url('assets/image/img_dok_aktivitas/' . $value['gambar']), $pX, $pY, 84, 64);
                    $pX += 87;
                }

                if ($rows == 5) {
                    $positionX = 20;
                    $pY = $positionY + 134;
                    $pdf->Image(base_url('assets/image/img_dok_aktivitas/' . $value['gambar']), $positionX, $pY, 84, 64);
                }
            }

            $pdf->Output("Laporan-Kegiatan.pdf", "I");
        } else {
            redirect('user/laporanaktivitas');
        }
    }

    // notifikasi rujukan

    public function cek_rujukan()
    {
        $rujuk_dokter = "Rujuk ke Dokter";
        $rujuk_psikolog = "Rujuk Psikolog";

        $get_count_dokter = $this->model_user->count_rujukan($rujuk_dokter);
        $get_count_psikolog = $this->model_user->count_rujukan($rujuk_psikolog);

        $row_rujukandokter_konseling = $this->model_user->getlayananrujukanDokter_konseling()->num_rows();
        if ($get_count_dokter > 0) $count_dokter = $get_count_dokter + $row_rujukandokter_konseling;
        else $count_dokter =  $row_rujukandokter_konseling;

        if ($get_count_psikolog > 0) $count_psikolog = $get_count_psikolog;
        else $count_psikolog = 0;

        $data_rujukan['count_rujukan_dokter'] = $count_dokter;
        $data_rujukan['count_rujukan_psikolog'] = $count_psikolog;

        echo json_encode($data_rujukan);
    }

    // akhir notifiikasi rujukan

    /*
     * Controller User
     * Tambah pasien baru
    */

    public function tambah_pasien_baru()
    {
        $data = array('success' => false, 'pesan' => '', 'base_url' => '', 'message' => array());

        $this->form_validation->set_rules("no_rekam", "nomor rekam medis", "trim|required", ["required" => "Nomor Rekam Medis tidak boleh kosong"]);
        // $this->form_validation->set_rules("no_hp", "nomor HP", "trim|required", ["required" => "Nomor Handphone tidak boleh kosong"]);
        $this->form_validation->set_rules("nm_lengkap", "nama lengkap", "trim|required", ["required" => "Nama Lengkap tidak boleh kosong"]);
        $this->form_validation->set_rules("alamat", "alamat", "trim|required", ["required" => "Alamat tidak boleh kosong"]);
        $this->form_validation->set_rules("nm_panggilan", "nama panggilan", "trim|required", ["required" => "Nama Panggilan tidak boleh kosong"]);
        $this->form_validation->set_rules("nm_kecamatan", "kecamatan", "trim|required", ["required" => "Kecamatan tidak boleh kosong"]);

        $this->form_validation->set_rules("alamat", "alamat", "trim|required", ["required" => "Alamat tidak boleh kosong"]);
        $this->form_validation->set_rules("kabupaten", "kabupaten", "trim|required", ["required" => "Kabupaten tidak boleh kosong"]);
        $this->form_validation->set_rules("tempat_lahir", "tempat lahir", "trim|required", ["required" => "Tempat lahir tidak boleh kosong"]);
        $this->form_validation->set_rules("desa", "desa", "trim|required", ["required" => "Desa tidak boleh kosong"]);
        $this->form_validation->set_rules("jenis_kelamin", "jenis kelamin", "trim|required", ["required" => "Jenis Kelamin tidak boleh kosong"]);
        $this->form_validation->set_rules("usia", "Usia", "trim|required", ["required" => "Usia tidak boleh kosong"]);
        $this->form_validation->set_rules("pendidikan", "pendidikan", "trim|required", ["required" => "Pendidikan tidak boleh kosong"]);
        $this->form_validation->set_rules("agama", "agama", "trim|required", ["required" => "Agama tidak boleh kosong"]);
        $this->form_validation->set_rules("pekerjaan", "pekerjaan", "trim|required", ["required" => "Pekerjaan tidak boleh kosong"]);
        $this->form_validation->set_rules("status", "status", "trim|required", ["required" => "Status tidak boleh kosong"]);
        $this->form_validation->set_rules("nm_ortu", "nama orang tua", "trim|required", ["required" => "Nama Orang tua tidak boleh kosong"]);
        $this->form_validation->set_error_delimiters('<p class="text-danger" style="font-size: 14px;">', '</p>');

        if ($this->form_validation->run()) {
            $data['success'] = true;

            $id_pasien = $this->autokode('tb_pasien', 'id_pasien', 'PSN');

            $data_pasien = array(
                'id_pasien' => $id_pasien,
                'no_rekam_medis' => $this->input->post('no_rekam'),
                'nm_lengkap' => $this->input->post('nm_lengkap'),
                'nm_panggilan' => $this->input->post('nm_panggilan'),
                'tempat_lahir' => $this->input->post('tempat_lahir'),
                'tgl_lahir' => $this->input->post('tgl_lahir'),
                'jk' => $this->input->post('jenis_kelamin'),
                'usia' => $this->input->post('usia'),
                'agama' => $this->input->post('agama'),
                'status' => $this->input->post('status'),
                'alamat' => $this->input->post('alamat'),
                'kabupaten' => $this->input->post('kabupaten'),
                'kecamatan' => $this->input->post('nm_kecamatan'),
                'desa' => $this->input->post('desa'),
                'no_hp' => $this->input->post('no_hp'),
                'pendidikan' => $this->input->post('pendidikan'),
                'pekerjaan' => $this->input->post('pekerjaan'),
                'nm_ortu' => $this->input->post('nm_ortu'),
            );

            if ($this->model_all->insertData('tb_pasien', $data_pasien)) {
                $pesan = "success";
                $data['base_url'] = base_url('user/assesment/' . encrypt_url('br') . '/' . encrypt_url($id_pasien));
            } else {
                $pesan = "error";
            }

            $data['pesan'] = $pesan;
        } else {
            foreach ($_POST as $key => $value) {
                $data['message'][$key] = form_error($key);
            }
        }

        // sleep(1);
        echo json_encode($data);
    }


    /*
     * akhir Tambah Pasien baru
     * -----------------------------------------------------------------------------
    */

    public function ubah_pasien()
    {
        $data = array('success' => false, 'pesan' => '', 'base_url' => '', 'message' => array());

        $this->form_validation->set_rules("no_rekam", "nomor rekam medis", "trim|required", ["required" => "Nomor Rekam Medis tidak boleh kosong"]);
        // $this->form_validation->set_rules("no_hp", "nomor HP", "trim|required", ["required" => "Nomor Handphone tidak boleh kosong"]);
        $this->form_validation->set_rules("nm_lengkap", "nama lengkap", "trim|required", ["required" => "Nama Lengkap tidak boleh kosong"]);
        $this->form_validation->set_rules("alamat", "alamat", "trim|required", ["required" => "Alamat tidak boleh kosong"]);
        $this->form_validation->set_rules("nm_panggilan", "nama panggilan", "trim|required", ["required" => "Nama Panggilan tidak boleh kosong"]);
        $this->form_validation->set_rules("nm_kecamatan", "kecamatan", "trim|required", ["required" => "Kecamatan tidak boleh kosong"]);

        $this->form_validation->set_rules("alamat", "alamat", "trim|required", ["required" => "Alamat tidak boleh kosong"]);
        $this->form_validation->set_rules("kabupaten", "kabupaten", "trim|required", ["required" => "Kabupaten tidak boleh kosong"]);
        $this->form_validation->set_rules("tempat_lahir", "tempat lahir", "trim|required", ["required" => "Tempat lahir tidak boleh kosong"]);
        $this->form_validation->set_rules("desa", "desa", "trim|required", ["required" => "Desa tidak boleh kosong"]);
        $this->form_validation->set_rules("jenis_kelamin", "jenis kelamin", "trim|required", ["required" => "Jenis Kelamin tidak boleh kosong"]);
        $this->form_validation->set_rules("usia", "Usia", "trim|required", ["required" => "Usia tidak boleh kosong"]);
        $this->form_validation->set_rules("pendidikan", "pendidikan", "trim|required", ["required" => "Pendidikan tidak boleh kosong"]);
        $this->form_validation->set_rules("agama", "agama", "trim|required", ["required" => "Agama tidak boleh kosong"]);
        $this->form_validation->set_rules("pekerjaan", "pekerjaan", "trim|required", ["required" => "Pekerjaan tidak boleh kosong"]);
        $this->form_validation->set_rules("status", "status", "trim|required", ["required" => "Status tidak boleh kosong"]);
        $this->form_validation->set_rules("nm_ortu", "nama orang tua", "trim|required", ["required" => "Nama Orang tua tidak boleh kosong"]);
        $this->form_validation->set_error_delimiters('<p class="text-danger" style="font-size: 14px;">', '</p>');

        if ($this->form_validation->run()) {
            $data['success'] = true;

            $id_pasien =  $this->input->post('id_pasien');

            $data_pasien = array(
                'no_rekam_medis' => $this->input->post('no_rekam'),
                'nm_lengkap' => $this->input->post('nm_lengkap'),
                'nm_panggilan' => $this->input->post('nm_panggilan'),
                'tempat_lahir' => $this->input->post('tempat_lahir'),
                'tgl_lahir' => $this->input->post('tgl_lahir'),
                'jk' => $this->input->post('jenis_kelamin'),
                'usia' => $this->input->post('usia'),
                'agama' => $this->input->post('agama'),
                'status' => $this->input->post('status'),
                'alamat' => $this->input->post('alamat'),
                'kabupaten' => $this->input->post('kabupaten'),
                'kecamatan' => $this->input->post('nm_kecamatan'),
                'desa' => $this->input->post('desa'),
                'no_hp' => $this->input->post('no_hp'),
                'pendidikan' => $this->input->post('pendidikan'),
                'pekerjaan' => $this->input->post('pekerjaan'),
                'nm_ortu' => $this->input->post('nm_ortu'),
            );

            if ($this->model_all->updateData('tb_pasien', $data_pasien, ['id_pasien' => $id_pasien])) {
                $pesan = "success";
                $data['base_url'] = base_url('user/pasienlama');
            } else {
                $pesan = "error";
            }

            $data['pesan'] = $pesan;
        } else {
            foreach ($_POST as $key => $value) {
                $data['message'][$key] = form_error($key);
            }
        }

        // sleep(1);
        echo json_encode($data);
    }

    public function hapus_pasien()
    {
        $data_hapus = [];
        $id_pasien = $this->input->post('id_pasien');
        $count = 0;

        if ($this->model_user->cek_pasien($id_pasien, 'tb_pasien') > 0) {
            $this->model_user->delete_pasien($id_pasien, 'tb_pasien');
            $count += 1;
        }
        if ($this->model_user->cek_pasien($id_pasien, 'tb_assesment') > 0) {
            $this->model_user->delete_pasien($id_pasien, 'tb_assesment');
            $count += 1;
        }
        if ($this->model_user->cek_pasien($id_pasien, 'tb_rekammedis') > 0) {
            $this->model_user->delete_pasien($id_pasien, 'tb_rekammedis');
            $count += 1;
        }

        if ($count > 0) $data_hapus['success'] = true;
        else $data_hapus['success'] = false;
        echo json_encode($data_hapus);
    }


    /*
     * Controller User
     * Tambah Pendaftaran peserta
    */

    public function tambah_pendaftaran_peserta()
    {
        $data = array('success' => false, 'pesan' => '', 'base_url' => base_url('user/datapeserta'), 'message' => array());

        $this->form_validation->set_rules("no_pendaftaran", "nomor pendaftaran", "trim|required", ["required" => "Nomor Pendaftaran tidak boleh kosong"]);
        $this->form_validation->set_rules("nm_lengkap", "nomor pendaftaran", "trim|required", ["required" => "Nama Lengkap tidak boleh kosong"]);
        $this->form_validation->set_rules("jenis_kelamin", "jenis Kelamin", "trim|required", ["required" => "Jenis Kelamin tidak boleh kosong"]);
        $this->form_validation->set_rules("agama", "agama", "trim|required", ["required" => "Agama tidak boleh kosong"]);
        $this->form_validation->set_rules("status", "status", "trim|required", ["required" => "Status tidak boleh kosong"]);
        $this->form_validation->set_rules("alamat", "alamat", "trim|required", ["required" => "Alamat tidak boleh kosong"]);
        $this->form_validation->set_rules("kabupaten", "kabupaten", "trim|required", ["required" => "Kabupaten tidak boleh kosong"]);
        $this->form_validation->set_rules("kecamatan", "kecamatan", "trim|required", ["required" => "Kecamatan tidak boleh kosong"]);
        $this->form_validation->set_rules("desa", "desa", "trim|required", ["required" => "Desa tidak boleh kosong"]);
        $this->form_validation->set_rules("pendidikan", "pendidikan", "trim|required", ["required" => "Pendidikan tidak boleh kosong"]);
        $this->form_validation->set_rules("pekerjaan", "pekerjaan", "trim|required", ["required" => "Pekerjaan tidak boleh kosong"]);
        $this->form_validation->set_rules("usia", "Usia", "trim|required", ["required" => "Usia tidak boleh kosong"]);
        $this->form_validation->set_rules("aktivitas", "aktivitas", "trim|required", ["required" => "Aktivitas tidak boleh kosong"]);
        $this->form_validation->set_error_delimiters('<p class="text-danger" style="font-size: 14px;">', '</p>');

        if ($this->form_validation->run()) {
            $data['success'] = true;

            $data_pasien = array(
                'id_pendaftaran' => $this->input->post('no_pendaftaran'),
                'no_pendaftaran' => $this->input->post('no_pendaftaran'),
                'nm_lengkap' => $this->input->post('nm_lengkap'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'agama' => $this->input->post('agama'),
                'status' => $this->input->post('status'),
                'nomor_hp' => $this->input->post('nomor_hp'),
                'alamat' => $this->input->post('alamat'),
                'kabupaten' => $this->input->post('kabupaten'),
                'kecamatan' => $this->input->post('kecamatan'),
                'desa' => $this->input->post('desa'),
                'pendidikan' => $this->input->post('pendidikan'),
                'pekerjaan' => $this->input->post('pekerjaan'),
                'usia' => $this->input->post('usia'),
                'aktivitas' => $this->input->post('aktivitas'),
            );

            if ($this->model_all->insertData('tb_pendaftaran', $data_pasien)) $pesan = "success";
            else $pesan = "error";
            $data['pesan'] = $pesan;
        } else {
            foreach ($_POST as $key => $value) {
                $data['message'][$key] = form_error($key);
            }
        }

        // sleep(1);
        echo json_encode($data);
    }

    /*
     * Akhir Tambah pendaftaran peserta
     * -------------------------------------------------------------------------------------
    */

    public function ubah_peserta()
    {
        $data = array('success' => false, 'pesan' => '', 'message' => array());

        $this->form_validation->set_rules("no_pendaftaran", "nomor pendaftaran", "trim|required", ["required" => "Nomor Pendaftaran tidak boleh kosong"]);
        $this->form_validation->set_rules("nm_lengkap", "nomor pendaftaran", "trim|required", ["required" => "Nama Lengkap tidak boleh kosong"]);
        $this->form_validation->set_rules("jenis_kelamin", "jenis Kelamin", "trim|required", ["required" => "Jenis Kelamin tidak boleh kosong"]);
        $this->form_validation->set_rules("agama", "agama", "trim|required", ["required" => "Agama tidak boleh kosong"]);
        $this->form_validation->set_rules("status", "status", "trim|required", ["required" => "Status tidak boleh kosong"]);
        // $this->form_validation->set_rules("nomor_hp", "nomor HP", "trim|required", ["required" => "Nomor HP tidak boleh kosong"]);
        $this->form_validation->set_rules("alamat", "alamat", "trim|required", ["required" => "Alamat tidak boleh kosong"]);
        $this->form_validation->set_rules("kabupaten", "kabupaten", "trim|required", ["required" => "Kabupaten tidak boleh kosong"]);
        $this->form_validation->set_rules("kecamatan", "kecamatan", "trim|required", ["required" => "Kecamatan tidak boleh kosong"]);
        $this->form_validation->set_rules("desa", "desa", "trim|required", ["required" => "Desa tidak boleh kosong"]);
        $this->form_validation->set_rules("pendidikan", "pendidikan", "trim|required", ["required" => "Pendidikan tidak boleh kosong"]);
        $this->form_validation->set_rules("pekerjaan", "pekerjaan", "trim|required", ["required" => "Pekerjaan tidak boleh kosong"]);
        $this->form_validation->set_rules("usia", "Usia", "trim|required", ["required" => "Usia tidak boleh kosong"]);
        $this->form_validation->set_rules("aktivitas", "aktivitas", "trim|required", ["required" => "Aktivitas tidak boleh kosong"]);
        $this->form_validation->set_error_delimiters('<p class="text-danger" style="font-size: 14px;">', '</p>');

        if ($this->form_validation->run()) {
            $data['success'] = true;

            $data_pasien = array(
                'no_pendaftaran' => $this->input->post('no_pendaftaran'),
                'nm_lengkap' => $this->input->post('nm_lengkap'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'agama' => $this->input->post('agama'),
                'status' => $this->input->post('status'),
                'nomor_hp' => $this->input->post('nomor_hp'),
                'alamat' => $this->input->post('alamat'),
                'kabupaten' => $this->input->post('kabupaten'),
                'kecamatan' => $this->input->post('kecamatan'),
                'desa' => $this->input->post('desa'),
                'pendidikan' => $this->input->post('pendidikan'),
                'pekerjaan' => $this->input->post('pekerjaan'),
                'usia' => $this->input->post('usia'),
                'aktivitas' => $this->input->post('aktivitas'),
            );

            if ($this->model_all->updateData('tb_pendaftaran', $data_pasien, ['id_pendaftaran' => $this->input->post('id_pendaftaran')])) $pesan = "success";
            else $pesan = "error";
            $data['pesan'] = $pesan;
        } else {
            foreach ($_POST as $key => $value) {
                $data['message'][$key] = form_error($key);
            }
        }

        // sleep(1);
        echo json_encode($data);
    }

    public function hapus_peserta()
    {
        $id_pendaftaran = $this->input->post('id_pendaftaran');
        if ($this->model_all->deleteData('tb_pendaftaran', array('id_pendaftaran' => $id_pendaftaran,))) {
            $data['pesan'] = "success";
            $data['data_peserta'] = $this->model_all->getAll('tb_pendaftaran')->result_array();
        } else {
            $data['pesan'] = "gagal";
        }

        echo json_encode($data);
    }

    /*
     * Controller User
     * Tambah Asessment
    */

    public function tambah_assesment()
    {
        $data = array('success' => false, 'pesan' => '', 'base_url' => '', 'message' => array());
        $this->form_validation->set_rules("tgl_assesment", "tgl_assesment", "trim|required", ["required" => "Tanggal asessment tidak boleh kosong"]);
        $this->form_validation->set_rules("keluhan", "keluhan", "trim|required", ["required" => "Keluhan tidak boleh kosong"]);
        $this->form_validation->set_rules("riwayat_penyakit", "riwayat penyakit", "trim|required", ["required" => "Riwayat penyakit tidak boleh kosong"]);
        $this->form_validation->set_rules("pengobatan", "pengobatan", "trim|required", ["required" => "Pengobatan tidak boleh kosong"]);
        $this->form_validation->set_rules("wawancara_psikologis", "wawancara psikologis", "trim|required", ["required" => "Wawancara psikologis tidak boleh kosong"]);
        if ($this->input->post('hasil_psikotest') <> null) $this->form_validation->set_rules("hasil_psikotest", "hasil psikotest", "trim|required", ["required" => "Hasil psikotest tidak boleh kosong"]);
        $this->form_validation->set_rules("tindakan", "tindakan", "trim|required", ["required" => "Tindakan tidak boleh kosong"]);
        if ($this->input->post('catatan') <> null) $this->form_validation->set_rules("catatan", "catatan", "trim|required", ["required" => "Catatan tidak boleh kosong"]);
        $this->form_validation->set_error_delimiters('<p class="text-danger" style="font-size: 14px;">', '</p>');

        if ($this->form_validation->run()) {

            $data['success'] = true;
            $halaman = '';
            $pesan = '';
            $role_assesment = 1;
            $id_assesment = $this->autokode('tb_assesment', 'id_assesment', 'ASSESMENT');

            $id_pasien = $this->input->post('id');
            $get_role_assesment = $this->model_user->cekAssesmentSebelumnya($id_pasien);
            if ($get_role_assesment->num_rows() > 0) {
                $data_assmn = $get_role_assesment->result_array();
                $role_assesment = $data_assmn[0]['role_assesment'] + 1;
            }

            $hasil_psikotes = $this->input->post('hasil_psikotest');
            $catatan = $this->input->post('catatan');
            $tindakan = $this->input->post('tindakan');
            $id_asessmen_old = $this->input->post('id_assesment_old');
            $jabatan = $this->session->userdata('jabatan');

            if ($hasil_psikotes == null) $hasil_psikotes = "";
            if ($catatan == null) $catatan = "";

            if (!empty($id_asessmen_old)) {
                $cekidasessment_old = $this->model_user->cekidasessment($id_asessmen_old);
                if ($cekidasessment_old > 0) {

                    if (($jabatan == "Dokter") || ($jabatan == "Psikolog")) {
                        $dataUpdate['tindakan_assement'] = 1;
                        $whereUpdate['id_assesment'] = $id_asessmen_old;
                        $this->model_all->updateData('tb_assesment', $dataUpdate, $whereUpdate);
                    }

                    $data_assesment = array(
                        'id_assesment' => $id_assesment,
                        'no_urut_assesment' => "ASSESMENT-0" . $role_assesment,
                        'tgl_assesment' => $this->input->post('tgl_assesment'),
                        'id_pasien' => $id_pasien,
                        'keluhan' => $this->input->post('keluhan'),
                        'riwayat_penyakit' => $this->input->post('riwayat_penyakit'),
                        'pengobatan' => $this->input->post('pengobatan'),
                        'wawancara_psikologis' => $this->input->post('wawancara_psikologis'),
                        'psikotest' => $this->input->post('psikotest'),
                        'hasil_psikotes' => $hasil_psikotes,
                        'diagnosa' => $this->input->post('diagnosa'),
                        'diagnosa_khusus' => $this->input->post('diagnosa_khusus'),
                        'diagnosa_penyerta' => $this->input->post('diagnosa_penyerta'),
                        'tindakan' => $tindakan,
                        'id_menindak' => $this->session->userdata('jabatan'),
                        'catatan' => $catatan,
                        'role_assesment' => $role_assesment,
                        'tindakan_assement' => 0,
                    );

                    if ($this->model_all->insertData('tb_assesment', $data_assesment)) {
                        $pesan = 'success';

                        if ($tindakan == 'Konseling Individu') $halaman = base_url('user/rekammedis/' . encrypt_url('assm') . '/' . encrypt_url($id_assesment));
                        else if ($tindakan == 'Konseling Kelompok') $halaman = base_url('user/rekammedis/' . encrypt_url('assm') . '/' . encrypt_url($id_assesment));
                        else if ($tindakan == 'Rujuk Psikolog') $halaman = base_url('user/rujukanpsikolog');
                        else if ($tindakan == 'Rujuk ke Dokter') $halaman = base_url('user/rujukandokter');
                        $data['base_url'] = $halaman;
                    } else {
                        $pesan = 'error';
                    }
                } else {
                    $pesan = 'error';
                }
            } else {

                $data_assesment = array(
                    'id_assesment' => $id_assesment,
                    'no_urut_assesment' => "ASSESMENT-0" . $role_assesment,
                    'tgl_assesment' => $this->input->post('tgl_assesment'),
                    'id_pasien' => $id_pasien,
                    'keluhan' => $this->input->post('keluhan'),
                    'riwayat_penyakit' => $this->input->post('riwayat_penyakit'),
                    'pengobatan' => $this->input->post('pengobatan'),
                    'wawancara_psikologis' => $this->input->post('wawancara_psikologis'),
                    'psikotest' => $this->input->post('psikotest'),
                    'hasil_psikotes' => $hasil_psikotes,
                    'diagnosa' => $this->input->post('diagnosa'),
                    'diagnosa_khusus' => $this->input->post('diagnosa_khusus'),
                    'diagnosa_penyerta' => $this->input->post('diagnosa_penyerta'),
                    'tindakan' => $tindakan,
                    'id_menindak' => $this->session->userdata('jabatan'),
                    'catatan' => $catatan,
                    'role_assesment' => $role_assesment,
                    'tindakan_assement' => 0,
                );

                if ($this->model_all->insertData('tb_assesment', $data_assesment)) {
                    $pesan = 'success';

                    if ($tindakan == 'Konseling Individu') $halaman = base_url('user/rekammedis/' . encrypt_url('assm') . '/' . encrypt_url($id_assesment));
                    else if ($tindakan == 'Konseling Kelompok') $halaman = base_url('user/rekammedis/' . encrypt_url('assm') . '/' . encrypt_url($id_assesment));
                    else if ($tindakan == 'Rujuk Psikolog') $halaman = base_url('user/rujukanpsikolog');
                    else if ($tindakan == 'Rujuk ke Dokter') $halaman = base_url('user/rujukandokter');
                    $data['base_url'] = $halaman;
                } else {
                    $pesan = 'error';
                }
            }

            $data['pesan'] = $pesan;
        } else {
            foreach ($_POST as $key => $value) {
                $data['message'][$key] = form_error($key);
            }
        }

        // sleep(1);
        echo json_encode($data);
    }

    /*
     * Akhir tambah asessment
     * ------------------------------------------------------------------------------
    */


    /*
     * Controller User
     * Tambah Rekam medis
    */

    public function tambah_rekammedis()
    {
        $data = array('success' => false, 'pesan' => '', 'base_url' => '', 'message' => array());
        $this->form_validation->set_rules("tgl_rekam", "tgl_rekam", "trim|required", ["required" => "Tanggal Kegiatan Konseling tidak boleh kosong"]);
        $this->form_validation->set_rules("jns_terapi", "jenis terapi", "trim|required", ["required" => "Jenis terapi tidak boleh kosong"]);
        $this->form_validation->set_rules("kesimpulan", "kesimpulan", "trim|required", ["required" => "Kesimpulan tidak boleh kosong"]);
        $this->form_validation->set_rules("hasil_akhir", "hasil akhir", "trim|required", ["required" => "Hasil akhir tidak boleh kosong"]);
        if ($this->input->post('catt_akhir') <> null) $this->form_validation->set_rules("catt_akhir", "catatan akhir", "trim|required", ["required" => "Catatan akhir tidak boleh kosong"]);

        $this->form_validation->set_error_delimiters('<p class="text-danger" style="font-size: 14px;">', '</p>');

        if ($this->form_validation->run()) {

            $data['success'] = true;
            $halaman = '';
            $id_pasien = '';
            $pesan = '';
            $role_rekam = 1;

            $id_pasien = $this->input->post('id_pasien');
            $id_assesment = $this->input->post('id_assesment');
            $checkpasienrekam = $this->model_user->cekRekamSebelumnya($id_pasien);
            if ($checkpasienrekam->num_rows() > 0) {
                $data_rekam = $checkpasienrekam->result_array();
                $role_rekam = $data_rekam[0]['role_rekam'] + 1;
            }

            $id_rekammedis = $this->autokode('tb_rekammedis', 'id_rekam', 'REKAMMEDIS');
            $catatan_akhir = $this->input->post('catt_akhir');

            if ($catatan_akhir == null) $catatan_akhir = "";

            $data_rekam = array(
                'id_rekam' => $id_rekammedis,
                'no_urut_rekam' => "REKAMMEDIS-0" . $role_rekam,
                'tgl_rekam' => $this->input->post('tgl_rekam'),
                'id_assesment' => $id_assesment,
                'id_pasien' => $id_pasien,
                'jns_terapi' => $this->input->post('jns_terapi'),
                'kesimpulan' => $this->input->post('kesimpulan'),
                'hasil_akhir' => $this->input->post('hasil_akhir'),
                'catatan' => $catatan_akhir,
                'role_rekam' => $role_rekam,
            );

            if ($this->model_all->insertData('tb_rekammedis', $data_rekam)) {
                $pesan = 'success';
                $url = '';
                $cek_tindakan = $this->model_all->getWhere('tb_assesment', ['id_assesment' => $id_assesment])->result_array()[0];
                if ($cek_tindakan['tindakan'] == 'Konseling Individu') {
                    $url = base_url('user/layananindividu');
                } elseif ($cek_tindakan['tindakan'] == 'Konseling Kelompok') {
                    $url = base_url('user/layanankelompok');
                }
                $data['base_url'] = $url;
            } else {
                $pesan = 'error';
            }

            $data['pesan'] = $pesan;
        } else {
            foreach ($_POST as $key => $value) {
                $data['message'][$key] = form_error($key);
            }
        }

        // sleep(1);
        echo json_encode($data);
    }

    /*
     * Akhir tambah rekam medis
     * ------------------------------------------------------------------------------
    */


    public function getTotalrekammedis()
    {
        $data = array('success' => false);
        $get_id_pasien = $this->model_all->getWhere('tb_rekammedis', ['id_pasien' => $this->input->post('id_pasien')]);
        if ($get_id_pasien->num_rows() >= 1) {
            $data['success'] = true;
        }

        echo json_encode($data);
    }

    /*
     * Controller User
     * get Lihat Aktifitas
     * Input Aktivitas
    */

    public function getLihatktifitas()
    {
        $id_aktifitas = $this->input->post('id_aktifitas');
        $data_aktifivitas = $this->model_all->getWhere('tb_aktivitas', array('kd_aktiv' => $id_aktifitas))->result_array();
        $caripeserta = $data_aktifivitas[0]['nm_aktivitas'];
        $caridokumentasi = $data_aktifivitas[0]['id_dokumentasi'];
        $aktifivitas = $this->model_all->getWhere('tb_pendaftaran', array('aktivitas' => $caripeserta))->result_array();
        $dokumentasi = $this->model_all->getWhere('aktivitas_dokumentasi', array('id_dokumentasi' => $caridokumentasi))->result_array();
        $no = 1;
        $nama_aktifivitas = "";
        foreach ($aktifivitas as $value) {
            $nama_aktifivitas .= $no++ . ". " . $value['nm_lengkap'] . "\n";
        }

        $data_kirim[0] = $data_aktifivitas;
        $data_kirim[1] = $nama_aktifivitas;
        $data_kirim[2] = $dokumentasi;
        sleep(0.5);
        echo json_encode($data_kirim);
    }

    public function inputanAktifitas()
    {
        $data_result_aktifitas = array('success' => false, 'pesan' => '', 'message' => array());
        $allowed_mime_type_arr = array('image/png', 'image/jpg', 'image/jpeg', 'image/PNG', 'image/JPG', 'image/jpeg');
        if (isset($_FILES['imageAktifitas'])) {
            $number_of_files = sizeof($_FILES['imageAktifitas']['name']);
            $max_size_img = 4194304; // 4194304B - 4096KB - 4MB - 0.00391GB
            $path_upload_img = "./assets/image/img_dok_aktivitas/";
            $cekempty_img = '';
            $cekekstensi_img = '';
            $ceksize_img = '';
            $pesan = '';
            $mime_array = [];

            $this->form_validation->set_rules("nameAktivitas", "nomor pendaftaran", "trim|required", ["required" => "Nama Aktivitas tidak boleh kosong"]);
            $this->form_validation->set_rules("kodeAktivitas", "kode aktifitas", "trim|required", ["required" => "Kode Aktivitas tidak boleh kosong"]);
            $this->form_validation->set_rules("jmlPeserta", "jumlah peserta", "trim|required", ["required" => "Jumlah Peserta tidak boleh kosong"]);
            $this->form_validation->set_rules("dana", "dana", "trim|required", ["required" => "Dana tidak boleh kosong"]);
            $this->form_validation->set_rules("lht_tgl", "Tanggal Mulai", "trim|required", ["required" => "Tanggal Mulai tidak boleh kosong"]);
            $this->form_validation->set_rules("lihat_tgl_selesai", "Tanggal Selesai", "trim|required", ["required" => "Tanggal Selesai tidak boleh kosong"]);
            $this->form_validation->set_rules("naraSumber", "narasumber", "trim|required", ["required" => "Narasumber tidak boleh kosong"]);
            $this->form_validation->set_rules("lokasi", "lokasi", "trim|required", ["required" => "Lokasi tidak boleh kosong"]);
            $this->form_validation->set_rules("notulensi", "notulensi", "trim|required", ["required" => "Hasil Kegiatan tidak boleh kosong"]);
            $this->form_validation->set_rules("kesimpulan", "Kesimpulan", "trim|required", ["required" => "Kesimpulan tidak boleh kosong"]);
            $this->form_validation->set_error_delimiters('<p class="text-danger" style="font-size: 14px;">', '</p>');

            for ($i = 0; $i < $number_of_files; $i++) {
                $mime = get_mime_by_extension($_FILES['imageAktifitas']['name'][$i]);
                if (!empty($_FILES['imageAktifitas']['name'][$i])) {
                    $cekempty_img .= $_FILES['imageAktifitas']['name'][$i] . ", ";
                }
                if (!in_array($mime, $allowed_mime_type_arr)) {
                    $cekekstensi_img .= $mime;
                }
                if ($_FILES['imageAktifitas']['size'][$i] > $max_size_img) {
                    $ceksize_img .= $_FILES['imageAktifitas']['size'][$i];
                }

                array_push($mime_array, $mime);
            }

            $data_result_aktifitas['mime_selected'] = $mime_array;
            $data_result_aktifitas['mime_checking'] = $cekekstensi_img;
            $data_result_aktifitas['allowed_mime'] = $allowed_mime_type_arr;

            if ($this->form_validation->run() == false) {
                $data_result_aktifitas['message']['imageAktifitas'] = '';
                foreach ($_POST as $key => $value) {
                    $data_result_aktifitas['message'][$key] = form_error($key);
                }
                if ($cekempty_img == '') {
                    $data_result_aktifitas['message']['imageAktifitas'] = '<p class="text-danger" style="font-size: 14px;">Dokumentasi tidak boleh kosong</p>';
                }
                if ($cekekstensi_img <> '') {
                    $data_result_aktifitas['message']['imageAktifitas'] = '<p class="text-danger" style="font-size: 14px;">File dokumentasi harus berekstensi *.jpg|*.png </p>';
                }
                if ($ceksize_img <> '') {
                    $data_result_aktifitas['message']['imageAktifitas'] = '<p class="text-danger" style="font-size: 14px;">Ukuran file melebihi 4 MB </p>';
                }
                if ($number_of_files > 5) {
                    $data_result_aktifitas['message']['imageAktifitas'] = '<p class="text-danger" style="font-size: 14px;">File dokumentasi melebihi 5 gambar </p>';
                }
            } else {
                $data_result_aktifitas['message']['imageAktifitas'] = '';
                foreach ($_POST as $key => $value) {
                    $data_result_aktifitas['message'][$key] = "";
                }
                if ($cekempty_img == '') {
                    $data_result_aktifitas['message']['imageAktifitas'] = '<p class="text-danger" style="font-size: 14px;">Dokumentasi tidak boleh kosong </p>';
                }
                if ($cekekstensi_img <> '') {
                    $data_result_aktifitas['message']['imageAktifitas'] = '<p class="text-danger" style="font-size: 14px;">File dokumentasi harus berekstensi *.jpg|*.png </p>';
                }
                if ($ceksize_img <> '') {
                    $data_result_aktifitas['message']['imageAktifitas'] = '<p class="text-danger" style="font-size: 14px;">Ukuran file melebihi 4 MB </p>';
                }
                if ($number_of_files > 5) {
                    $data_result_aktifitas['message']['imageAktifitas'] = '<p class="text-danger" style="font-size: 14px;">File dokumentasi melebihi 5 gambar </p>';
                }

                if (($cekempty_img <> '') && ($cekekstensi_img == '') && ($number_of_files > 0 && $number_of_files < 6)) {
                    $data_result_aktifitas['success'] = true;
                    $kd_aktiv = $this->autokode('tb_aktivitas', 'kd_aktiv', 'aktivitas');
                    $kd_peserta = $this->autokode('tb_aktivitas', 'id_peserta', 'peserta');
                    $kd_dokumentasi = $this->autokode('tb_aktivitas', 'id_dokumentasi', 'dokumentasi');

                    $data_aktivitas = array(
                        'kd_aktiv' => $kd_aktiv,
                        'nm_aktivitas' => $this->input->post('nameAktivitas'),
                        'kode_aktivitas' => $this->input->post('kodeAktivitas'),
                        'id_peserta' => $kd_peserta,
                        'jml_peserta' => $this->input->post('jmlPeserta'),
                        'dana' => $this->input->post('dana'),
                        'tgl' => $this->input->post('lht_tgl'),
                        'tgl_selesai' => $this->input->post('lihat_tgl_selesai'),
                        'nara_sumber' => $this->input->post('naraSumber'),
                        'lokasi' => $this->input->post('lokasi'),
                        'notulensi' => $this->input->post('notulensi'),
                        'kesimpulan' => $this->input->post('kesimpulan'),
                        'id_dokumentasi' => $kd_dokumentasi,
                    );

                    if ($this->model_all->insertData('tb_aktivitas', $data_aktivitas)) {
                        $no = 1;
                        for ($i = 0; $i < $number_of_files; $i++) {

                            $_FILES['file']['name'] = $_FILES['imageAktifitas']['name'][$i];
                            $_FILES['file']['type'] = $_FILES['imageAktifitas']['type'][$i];
                            $_FILES['file']['tmp_name'] = $_FILES['imageAktifitas']['tmp_name'][$i];
                            $_FILES['file']['size'] = $_FILES['imageAktifitas']['size'][$i];

                            $file_name = "img_" . substr($kd_dokumentasi, 11, 13) . "_" . strval($no);
                            $config['multi']['upload_path'] = $path_upload_img;
                            $config['multi']['allowed_types'] = 'jpg|png|PNG|JPG|jpeg';
                            $config['multi']['max_size'] = 4096;
                            $config['multi']['file_name'] = $file_name;

                            $this->load->library('upload', $config['multi']);
                            if ($this->upload->do_upload('file')) {

                                $data_dokumentasi['id_dokumentasi'] = $kd_dokumentasi;
                                $data_dokumentasi['gambar'] = $this->db->escape_str($this->upload->data('file_name'));
                                $this->model_all->insertData('aktivitas_dokumentasi', $data_dokumentasi);
                            }
                            $no++;
                        }
                        $data_peserta = $this->model_all->getWhere('tb_pendaftaran', array('aktivitas' => $this->input->post('nameAktivitas')))->result_array();

                        foreach ($data_peserta as $value) {
                            $peserta['kode_peserta'] = $kd_peserta;
                            $peserta['id_pendaftaran'] = $value['id_pendaftaran'];
                            $peserta['nm_peserta'] = $value['nm_lengkap'];
                            $this->model_all->insertData('aktivitas_nmpeserta', $peserta);
                        }

                        $pesan = "success";
                    } else {
                        $pesan = "error";
                    }
                    $data_result_aktifitas['pesan'] = $pesan;
                }
            }
        } else {
            $data_result_aktifitas['message']['imageAktifitas'] = '<p class="text-danger" style="font-size: 14px;">Dokumentasi tidak boleh kosong</p>';
        }

        sleep(1);
        echo json_encode($data_result_aktifitas);
    }

    /*
     * Akhir Input Aktivitas
     * ----------------------------------------------------------------------------------
    */

    /*
     * Controller User
     * Input TOR
    */

    public function do_inputanTor()
    {
        $data = array('success' => false, 'pesan' => '', 'base_url' => base_url('user/daftartor'), 'message' => array());
        $max_size_file = 104857600; // 104857600 B - 102400 KB - 100 MB - 0.09766 GB
        $path_upload_file = "./assets/dokumen/tor/";

        $this->form_validation->set_rules("kd_tor", "kode tor", "trim|required", ["required" => "Kode TOR tidak boleh kosong"]);
        $this->form_validation->set_rules("jdl_tor", "judul tor", "trim|required", ["required" => "Judul TOR tidak boleh kosong"]);
        $this->form_validation->set_rules("latar_belakang", "latar belakang", "trim|required", ["required" => "Latar belakang tidak boleh kosong"]);
        $this->form_validation->set_rules("tujuan", "tujuan", "trim|required", ["required" => "Tujuan tidak boleh kosong"]);
        $this->form_validation->set_rules("narasumber", "narasumber", "trim|required", ["required" => "Fasilitator / Narasumber tidak boleh kosong"]);
        $this->form_validation->set_rules("jml_peserta", "Jumlah Peserta", "trim|required", ["required" => "Jumlah Peserta tidak boleh kosong"]);
        $this->form_validation->set_rules("kalender", "kalender", "trim|required", ["required" => "Kalender tidak boleh kosong"]);
        $this->form_validation->set_rules("tgl_selesai", "Tanggal Selesai", "trim|required", ["required" => "Tanggal Selesai tidak boleh kosong"]);
        $this->form_validation->set_rules("lokasi_kegiatan", "lokasi kegiatan", "trim|required", ["required" => "Lokasi kegiatan tidak boleh kosong"]);
        $this->form_validation->set_rules("nm_kecamatan", "kecamatan", "trim|required", ["required" => "Kecamatan tidak boleh kosong"]);
        $this->form_validation->set_rules("nm_desa", "desa", "trim|required", ["required" => "Desa tidak boleh kosong"]);
        $this->form_validation->set_rules("anggaran", "anggaran", "trim|required", ["required" => "Anggaran tidak boleh kosong"]);
        $this->form_validation->set_rules("perlengkapan", "perlengkapan", "trim|required", ["required" => "Perlengkapan tidak boleh kosong"]);
        $this->form_validation->set_rules("penutup", "penutup", "trim|required", ["required" => "Penutup tidak boleh kosong"]);
        $this->form_validation->set_error_delimiters('<p class="text-danger" style="font-size: 14px;">', '</p>');

        if ($this->form_validation->run()) {
            foreach ($_POST as $key => $value) {
                $data['message'][$key] = "";
            }
            $kode_tor = $this->autokode('tb_tor', 'kode_tor', 'TOR-');

            if (isset($_FILES['file_rab']) && !empty($_FILES['file_rab']['name'])) {
                $name = $_FILES['file_rab']['name'];
                $size = $_FILES['file_rab']['size'];
                $mime = get_mime_by_extension($_FILES['file_rab']['name']);

                if ($mime <> "application/pdf") {
                    $data['message']['file_rab'] = '<p class="text-danger" style="font-size: 14px;">File RAB harus berekstensi *.pdf </p>';
                }
                if ($size > $max_size_file) {
                    $data['message']['file_rab'] = '<p class="text-danger" style="font-size: 14px;">File RAB melebihi 100 MB</p>';
                }

                if (($mime == "application/pdf") && ($size <= $max_size_file)) {
                    $config['tor']['upload_path'] = $path_upload_file;
                    $config['tor']['allowed_types'] = 'pdf';
                    $config['tor']['max_size'] = 102400;
                    $config['tor']['file_name'] = $kode_tor;

                    $this->load->library('upload', $config['tor']);
                    if ($this->upload->do_upload('file_rab')) {
                        $data['success'] = true;

                        $data_tor = array(
                            'kode_tor' => $kode_tor,
                            'judul_tor' => $this->input->post('jdl_tor'),
                            'ltr_belakang' => $this->input->post('latar_belakang'),
                            'tujuan' => $this->input->post('tujuan'),
                            'fasilitator' => $this->input->post('narasumber'),
                            'jml_peserta' => $this->input->post('jml_peserta'),
                            'tgl' => $this->input->post('kalender'),
                            'tgl_selesai' => $this->input->post('tgl_selesai'),
                            'lokasi' => $this->input->post('lokasi_kegiatan'),
                            'kecamatan' => $this->input->post('nm_kecamatan'),
                            'desa' => $this->input->post('nm_desa'),
                            'anggaran' => $this->input->post('anggaran'),
                            'perlengkapan' => $this->input->post('perlengkapan'),
                            'penutup' => $this->input->post('penutup'),
                            'rab' => $this->db->escape_str($this->upload->data('file_name')),
                            'role_rab' => 'Proses',
                        );

                        if ($this->model_all->insertData('tb_tor', $data_tor)) $pesan = "success";
                        else $pesan = "error";

                        $data['pesan'] = $pesan;
                    } else {
                        $data['message']['file_rab'] = '<p class="text-danger" style="font-size: 14px;">File RAB tidak dapat diupload</p>';
                    }
                }
            } else {
                $data['success'] = true;
                $data_tor = array(
                    'kode_tor' => $kode_tor,
                    'judul_tor' => $this->input->post('jdl_tor'),
                    'ltr_belakang' => $this->input->post('latar_belakang'),
                    'tujuan' => $this->input->post('tujuan'),
                    'fasilitator' => $this->input->post('narasumber'),
                    'jml_peserta' => $this->input->post('jml_peserta'),
                    'tgl' => $this->input->post('kalender'),
                    'tgl_selesai'  => $this->input->post('tgl_selesai'),
                    'lokasi' => $this->input->post('lokasi_kegiatan'),
                    'kecamatan' => $this->input->post('nm_kecamatan'),
                    'desa' => $this->input->post('nm_desa'),
                    'anggaran' => $this->input->post('anggaran'),
                    'perlengkapan' => $this->input->post('perlengkapan'),
                    'penutup' => $this->input->post('penutup'),
                    'role_rab' => 'Proses',
                );

                if ($this->model_all->insertData('tb_tor', $data_tor)) {
                    $pesan = "success";
                } else {
                    $pesan = "error";
                }
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

    /*
     * akhir input TOR
     * --------------------------------------------------------------------------------------
    */

    /*
     * Controller User
     * ubah TOR
    */

    public function do_ubahTor()
    {
        $data_ubh_tor = array('success' => false, 'pesan' => '', 'message' => array());
        $max_size_file = 104857600; // 104857600 B - 102400 KB - 100 MB - 0.09766 GB
        $path_upload_file = "./assets/dokumen/tor/";
        $name = $_FILES['ubh_file_rab']['name'];
        $size = $_FILES['ubh_file_rab']['size'];
        $mime = get_mime_by_extension($_FILES['ubh_file_rab']['name']);

        $this->form_validation->set_rules("ubh_judul_tor", "judul tor", "trim|required", ["required" => "Judul TOR tidak boleh kosong"]);
        $this->form_validation->set_rules("ubh_ltr_belakang", "latar belakang", "trim|required", ["required" => "Latar belakang tidak boleh kosong"]);
        $this->form_validation->set_rules("ubh_tujuan", "tujuan", "trim|required", ["required" => "Tujuan tidak boleh kosong"]);
        $this->form_validation->set_rules("ubh_fasilitator", "narasumber", "trim|required", ["required" => "Narasumber tidak boleh kosong"]);
        $this->form_validation->set_rules("ubh_jml_peserta", "Jumlah peserta", "trim|required", ["required" => "Jumlah peserta tidak boleh kosong"]);
        $this->form_validation->set_rules("ubh_tanggal", "kalender", "trim|required", ["required" => "Kalender tidak boleh kosong"]);
        $this->form_validation->set_rules("ubh_tgl_selesai", "Tanggal Selesai", "trim|required", ["required" => "Tanggal Selesai tidak boleh kosong"]);
        $this->form_validation->set_rules("ubh_lokasi", "lokasi kegiatan", "trim|required", ["required" => "Lokasi kegiatan tidak boleh kosong"]);
        $this->form_validation->set_rules("ubh_kecamatan", "kecamatan", "trim|required", ["required" => "Kecamatan tidak boleh kosong"]);
        $this->form_validation->set_rules("ubh_desa", "desa", "trim|required", ["required" => "Desa tidak boleh kosong"]);
        $this->form_validation->set_rules("ubh_anggaran", "anggaran", "trim|required", ["required" => "Anggaran tidak boleh kosong"]);
        $this->form_validation->set_rules("ubh_perlengkapan", "perlengkapan", "trim|required", ["required" => "Perlengkapan tidak boleh kosong"]);
        $this->form_validation->set_rules("ubh_penutup", "penutup", "trim|required", ["required" => "Penutup tidak boleh kosong"]);
        $this->form_validation->set_error_delimiters('<p class="text-danger" style="font-size: 14px;">', '</p>');

        if ($this->form_validation->run()) {
            foreach ($_POST as $key => $value) { $data_ubh_tor['message'][$key] = ""; }
            $data_ubh_tor['message']['ubh_file_rab'] = '';
            $kode_tor = $this->input->post('ubh_kode_tor');
            if (!empty($name)) {
                if ($mime == "application/pdf") {
                    if ($size <= $max_size_file) {

                        $config['ubhtor']['upload_path'] = $path_upload_file;
                        $config['ubhtor']['overwrite'] = TRUE;
                        $config['ubhtor']['allowed_types'] = 'pdf';
                        $config['ubhtor']['max_size'] = 102400;
                        $config['ubhtor']['file_name'] = $kode_tor;

                        $this->load->library('upload', $config['ubhtor']);
                        if ($this->upload->do_upload('ubh_file_rab')) {
                            $data_ubh_tor['success'] = true;

                            $data_tor = array(
                                'judul_tor  ' => $this->input->post('ubh_judul_tor'),
                                'ltr_belakang  ' => $this->input->post('ubh_ltr_belakang'),
                                'tujuan  ' => $this->input->post('ubh_tujuan'),
                                'fasilitator  ' => $this->input->post('ubh_fasilitator'),
                                'jml_peserta' => $this->input->post('ubh_jml_peserta'),
                                'tgl  ' => $this->input->post('ubh_tanggal'),
                                'tgl_selesai  ' => $this->input->post('ubh_tgl_selesai'),
                                'lokasi  ' => $this->input->post('ubh_lokasi'),
                                'kecamatan  ' => $this->input->post('ubh_kecamatan'),
                                'desa  ' => $this->input->post('ubh_desa'),
                                'anggaran  ' => $this->input->post('ubh_anggaran'),
                                'perlengkapan  ' => $this->input->post('ubh_perlengkapan'),
                                'penutup  ' => $this->input->post('ubh_penutup'),
                                'rab' => $this->db->escape_str($this->upload->data('file_name')),
                                'role_rab' => 'Proses',
                            );


                            if ($this->model_all->updateData('tb_tor', $data_tor, ['kode_tor' => $kode_tor])) $pesan = "success";
                            else $pesan = "error";

                            $data_ubh_tor['pesan'] = $pesan;
                        } else {
                            $data_ubh_tor['message']['ubh_file_rab'] = '<p class="text-danger" style="font-size: 14px;">File RAB tidak dapat diupload</p>';
                        }
                    } else {
                        $data_ubh_tor['message']['ubh_file_rab'] = '<p class="text-danger" style="font-size: 14px;">File RAB melebihi 100 MB</p>';
                    }
                } else {
                    $data_ubh_tor['message']['ubh_file_rab'] = '<p class="text-danger" style="font-size: 14px;">File RAB harus berekstensi *.pdf </p>';
                }
            } else {
                $data_ubh_tor['success'] = true;
                $data_tor = array(
                    'judul_tor  ' => $this->input->post('ubh_judul_tor'),
                    'ltr_belakang  ' => $this->input->post('ubh_ltr_belakang'),
                    'tujuan  ' => $this->input->post('ubh_tujuan'),
                    'fasilitator  ' => $this->input->post('ubh_fasilitator'),
                    'tgl  ' => $this->input->post('ubh_tanggal'),
                    'tgl_selesai' => $this->input->post('ubh_tgl_selesai'),
                    'lokasi  ' => $this->input->post('ubh_lokasi'),
                    'kecamatan  ' => $this->input->post('ubh_kecamatan'),
                    'desa  ' => $this->input->post('ubh_desa'),
                    'anggaran  ' => $this->input->post('ubh_anggaran'),
                    'perlengkapan  ' => $this->input->post('ubh_perlengkapan'),
                    'penutup  ' => $this->input->post('ubh_penutup'),
                    'rab' => $this->input->post('file_rab_old'),
                    'role_rab' => 'Proses',
                );

                if ($this->model_all->updateData('tb_tor', $data_tor, ['kode_tor' => $kode_tor])) $pesan = "success";
                else $pesan = "error";

                $data_ubh_tor['pesan'] = $pesan;
            }
            
        } else {
            foreach ($_POST as $key => $value) { $data_ubh_tor['message'][$key] = form_error($key);}
            $data_ubh_tor['message']['ubh_file_rab'] = '';
        }

        // sleep(1);
        echo json_encode($data_ubh_tor);
    }

    /*
     * akhir ubah TOR
     * --------------------------------------------------------------------------------------
    */


    /*
     * get aktivitas 
     * dropdown dari menu Inputan aktivitas [pilih aktivitas]
     * user field officer
    */

    public function getAktifitas()
    {
        $id_aktivitas = $this->input->post('id_aktivitas');
        $data_aktifivitas = $this->model_all->getWhere('tb_pendaftaran', array('aktivitas' => $id_aktivitas))->result_array();
        echo json_encode($data_aktifivitas);
    }

    /*
     * akhir get aktivitas 
     * ----------------------------------------------------------------------------------
    */

    /*
     * get TOR 
     * Ubah TOR menu Daftar TOR
     * user field officer
    */

    public function getTor()
    {
        $id_tor = $this->input->post('id_tor');
        $data_tor = $this->model_all->getWhere('tb_tor', array('kode_tor' => $id_tor))->result_array();
        sleep(1);
        echo json_encode($data_tor);
    }

    /*
     * akhir get TOR
     * ----------------------------------------------------------------------------------
    */

    public function getPeserta()
    {
        $id_pendaftaran = $this->input->post('id_daftar');
        $data_peserta = $this->model_all->getWhere('tb_pendaftaran', ['id_pendaftaran' => $id_pendaftaran])->result_array();
        sleep(1);
        echo json_encode($data_peserta);
    }

    public function getlayananUser()
    {
        $data_kegiatan = '';
        $data_id_pasien = $this->input->post('id_pasien');
        $id_konseling = $this->input->post('tindakan');
        $cekDataassesment = $this->model_user->getdata_konseling($data_id_pasien, $id_konseling);
        if ($cekDataassesment->num_rows() > 0) {
            $no = $cekDataassesment->num_rows();
            $data_pasien = $cekDataassesment->result_array();
            foreach ($data_pasien as $value) {
                $data_kegiatan .= $no . ". " . $value['no_urut_assesment'] . ", " . $value['tgl_assesment'] . "\n";
                $no--;
            }

            $data['kegiatan_assesment'] = $data_kegiatan;
            $data['data_pasien'] = $data_pasien;
            echo json_encode($data);
        }
    }

    public function getdatapasien()
    {
        $id_pasien = $this->input->post('id_pasien');
        echo json_encode($this->model_all->getWhere('tb_pasien', ['id_pasien' => $id_pasien])->result_array());
    }
}
