<?php
defined('BASEPATH') or exit('No direct script access allowed');
define('FPDF_FONTPATH', 'font/');

class Admin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('word');
        $this->load->helper('print_rekap');
        $this->load->helper('chart_laporan');

        if ($this->session->userdata('status') <> "login") {
            redirect('auth/log_in');
        } else {

            if ($this->session->userdata('lock') == "false") {
                if ($this->session->userdata('level') <> 2 && $this->session->userdata('level') <> 1) redirect('other/page_403');
            } else {
                redirect('auth/lockpage');
            }
        }
    }

    private function autokode($tabel, $field, $text)
    {
        return $this->model_all->_kode_otomatis($tabel, 'id', $field, $text . date('dmY'));
    }

    // tampilan

    public function dashboard()
    {
        $data['setting'] = $this->model_all->getAll('tb_setting')->result_array();
        $this->load->view('teamplate/v_header', $data);
        $this->load->view('teamplate/v_topbar', $data);
        $this->load->view('teamplate/v_sidebar', $data);
        $this->load->view('admin/v_dashboard', $data);
        $this->load->view('teamplate/v_footer', $data);
    }


    public function konseling()
    {
        $data['setting'] = $this->model_all->getAll('tb_setting')->result_array();
        $this->load->view('teamplate/v_header', $data);
        $this->load->view('teamplate/v_topbar', $data);
        $this->load->view('teamplate/v_sidebar', $data);
        $this->load->view('admin/v_konseling', $data);
        $this->load->view('teamplate/v_footer', $data);
    }

    public function laporanbulan()
    {
        $data['data_laporan_bulan'] = $this->model_admin->getLaporanBulanan()->result_array();
        $data['setting'] = $this->model_all->getAll('tb_setting')->result_array();
        $this->load->view('teamplate/v_header', $data);
        $this->load->view('teamplate/v_topbar', $data);
        $this->load->view('teamplate/v_sidebar', $data);
        $this->load->view('admin/v_laporanbulan', $data);
        $this->load->view('teamplate/v_footer', $data);
    }

    public function laporantahun()
    {
        $data['data_laporan_tahun'] = $this->model_admin->getLaporanTahun()->result_array();
        $data['setting'] = $this->model_all->getAll('tb_setting')->result_array();
        $this->load->view('teamplate/v_header', $data);
        $this->load->view('teamplate/v_topbar', $data);
        $this->load->view('teamplate/v_sidebar', $data);
        $this->load->view('admin/v_laporantahun', $data);
        $this->load->view('teamplate/v_footer', $data);
    }

    public function pasienindividu()
    {
        $data['pasien_individu'] = $this->model_admin->getlayanan_datapasien('Konseling Individu')->result_array();
        $data['setting'] = $this->model_all->getAll('tb_setting')->result_array();
        $this->load->view('teamplate/v_header', $data);
        $this->load->view('teamplate/v_topbar', $data);
        $this->load->view('teamplate/v_sidebar', $data);
        $this->load->view('admin/v_pasienindividu', $data);
        $this->load->view('teamplate/v_footer', $data);
    }

    public function pasienkelompok()
    {
        $data['pasien_kelompok'] = $this->model_admin->getlayanan_datapasien('Konseling Kelompok')->result_array();
        $data['setting'] = $this->model_all->getAll('tb_setting')->result_array();
        $this->load->view('teamplate/v_header', $data);
        $this->load->view('teamplate/v_topbar', $data);
        $this->load->view('teamplate/v_sidebar', $data);
        $this->load->view('admin/v_pasienkelompok', $data);
        $this->load->view('teamplate/v_footer', $data);
    }

    public function rujukandokter()
    {
        $data['data_laporan_bulan'] = $this->model_admin->getrujukan_psikolog_dokter('Rujuk Psikolog')->result_array();
        $data['setting'] = $this->model_all->getAll('tb_setting')->result_array();
        $this->load->view('teamplate/v_header', $data);
        $this->load->view('teamplate/v_topbar', $data);
        $this->load->view('teamplate/v_sidebar', $data);
        $this->load->view('admin/v_rujukandokter', $data);
        $this->load->view('teamplate/v_footer', $data);
    }

    public function rujukanpsikolog()
    {
        $data['data_laporan_bulan'] = $this->model_admin->getrujukan_psikolog_dokter('Rujuk ke Dokter')->result_array();
        $data['setting'] = $this->model_all->getAll('tb_setting')->result_array();
        $this->load->view('teamplate/v_header', $data);
        $this->load->view('teamplate/v_topbar', $data);
        $this->load->view('teamplate/v_sidebar', $data);
        $this->load->view('admin/v_rujukanpsikolog', $data);
        $this->load->view('teamplate/v_footer', $data);
    }
    public function daftartoradmin()
    {
        $data['setting'] = $this->model_all->getAll('tb_setting')->result_array();
        $data['daftar_tor'] = $this->model_all->getAll('tb_tor')->result_array();
        $this->load->view('teamplate/v_header', $data);
        $this->load->view('teamplate/v_topbar', $data);
        $this->load->view('teamplate/v_sidebar', $data);
        $this->load->view('admin/v_daftartoradmin', $data);
        $this->load->view('teamplate/v_footer', $data);
    }

    public function laporanaktifitasadmin()
    {
        $data['setting'] = $this->model_all->getAll('tb_setting')->result_array();
        $data['data_laporan_aktifitas'] = $this->model_all->getAll('tb_aktivitas')->result_array();
        $this->load->view('teamplate/v_header', $data);
        $this->load->view('teamplate/v_topbar', $data);
        $this->load->view('teamplate/v_sidebar', $data);
        $this->load->view('admin/v_laporanaktifitasadmin', $data);
        $this->load->view('teamplate/v_footer', $data);
    }



    public function akunpengguna()
    {
        $data['setting'] = $this->model_all->getAll('tb_setting')->result_array();
        $data['data_pengguna'] = $this->model_all->getAll('tb_pengguna')->result_array();
        $this->load->view('teamplate/v_header', $data);
        $this->load->view('teamplate/v_topbar', $data);
        $this->load->view('teamplate/v_sidebar', $data);
        $this->load->view('admin/v_akunpengguna', $data);
        $this->load->view('teamplate/v_footer', $data);
    }

    public function cetak_aktifitas($id_cetak)
    {
        $id_cetak = decrypt_url($id_cetak);
        $cekdataaktifitas = $this->model_admin->getdata_aktifitas($id_cetak);
        if ($cekdataaktifitas->num_rows() > 0) {
            $data_aktifivitas = $cekdataaktifitas->result_array()[0];
            $peserta = $this->model_admin->getdata_pesertaaktifitas($id_cetak);
            $dokumentasi = $this->model_admin->getdata_dokumentasiaktifitas($id_cetak);

            $panjangKarakter = strlen($data_aktifivitas['nm_aktivitas']);
            $stringKarakter = $panjangKarakter - 14;
            $judulTor = substr($data_aktifivitas['nm_aktivitas'], 0, $stringKarakter);
            $data_tor = $this->model_admin->getdatajudultor_aktifitas($judulTor)->result_array();

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
            $pdf->MultiCell(0, 7, konversiChar(substr($data_aktifivitas['nm_aktivitas'], 7)), 0, 'J', 0, 0);

            $pdf->Ln(6);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(0, 7, 'B. Latar Belakang ', 0, 1, 'L');
            $pdf->SetFont('Times', '', 12);
            $pdf->MultiCell(0, 7, ($data_tor <> null) ? konversiChar($data_tor[0]['ltr_belakang']) : '-', 0, 'J', 0, 0);

            $pdf->Ln(6);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(0, 7, 'C. Tujuan ', 0, 1, 'L');
            $pdf->SetFont('Times', '', 12);
            $pdf->MultiCell(0, 7, ($data_tor <> null) ? konversiChar($data_tor[0]['tujuan']) : '-', 0, 'J', 0, 0);

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
            $pdf->MultiCell(0, 7, ($data_aktifivitas['notulensi'] <> '') ? konversiChar($data_aktifivitas['notulensi']) : '-', 0, 'J', 0, 0);

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
            $pdf->MultiCell(0, 7, ($data_aktifivitas['kesimpulan'] <> '') ? konversiChar($data_aktifivitas['kesimpulan']) : '-', 0, 'J', 0, 0);

            /* Tanda tangan */
            $pdf->Ln(20);
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(87, 7, '', 0, 0, 'C');
            // $pdf->Cell(87, 7, konversiTanggalid(date('Y-m-d')), 0, 0, 'C');
            $pdf->Cell(87, 7, '........./....../.........../.......', 0, 0, 'C');
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
        }
        // else {
        //     redirect('user/laporanaktivitas');
        // }
    }


    public function ubah_asessment()
    {
        $id_pasien = $this->input->post('id_pasien');
        $id_asessment = $this->input->post('id_asessment');
        $data_kegiatan_asessment = '';
        $data_kegiatan_rekam = '';

        /* bagian asessment*/
        $cek_data_asessment = $this->model_admin->getdatapasienassesment($id_pasien);
        if ($cek_data_asessment->num_rows() > 0) {
            $rows_asessment = true;
            $data_pasien_asessment = $cek_data_asessment->result_array();
            $no = $cek_data_asessment->num_rows();
            foreach ($data_pasien_asessment as $value) {
                $data_kegiatan_asessment .= $no . ". " . $value['no_urut_assesment'] . ", " . $value['tgl_assesment'] . "\n";
                $no--;
            }
        } else {
            $rows_asessment = false;
            $data_pasien_asessment = $this->model_all->getWhere('tb_pasien', ['id_pasien' => $id_pasien])->result_array();
        }

        /* bagian rekammedis*/
        $cek_data_asessment = $this->model_admin->cekRekamSebelumnya($id_pasien);
        if ($cek_data_asessment->num_rows() > 0) {
            $rows_rekam = true;
            $data_rekam = $cek_data_asessment->result_array();
            $no = $cek_data_asessment->num_rows();
            foreach ($data_rekam as $value) {
                $data_kegiatan_rekam .= $no . ". " . $value['no_urut_rekam'] . ", " . $value['tgl_rekam'] . "\n";
                $no--;
            }
        } else {
            $rows_rekam = false;
        }

        $data = array(
            'cek_asessment' => $rows_asessment,
            'cek_rekam' => $rows_rekam,
            'data_kegiatan_asessment' => $data_kegiatan_asessment,
            'data_kegiatan_rekam' => $data_kegiatan_rekam,
            'data_asessment' => $data_pasien_asessment,
            'data_rekam' => $data_rekam,
        );

        echo json_encode($data);
    }
 // ubah urut assessment dan rekam medis
    public function ubah_urut_asessment()
    {
        $id_pasien = $this->input->post('id_pasien');
        $id_asessment = $this->input->post('id_assesment');

        $where = array(
            'id_pasien' => $id_pasien,
            'id_assesment' => $id_asessment,
        );

        $get_data_urut_assesment = $this->model_all->getWhere('tb_assesment', $where)->result_array();
        echo json_encode($get_data_urut_assesment);
    }

    public function ubah_urut_rekam()
    {
        $id_pasien = $this->input->post('id_pasien');
        $id_rekam = $this->input->post('id_rekam');

        $where = array(
            'id_pasien' => $id_pasien,
            'id_rekam' => $id_rekam,
        );

        $get_data_urut_rekam = $this->model_all->getWhere('tb_rekammedis', $where)->result_array();
        echo json_encode($get_data_urut_rekam);
    }
    // akhir ubah urut assessment dan rekam medis

    public function do_ubah_asessment()
    {
        /* bagian asessment*/
        $data = array('success' => false, 'pesan' => '', 'message' => array());
        $this->form_validation->set_rules("tgl_assesment", "tgl_assesment", "trim|required", ["required" => "Tanggal asessment tidak boleh kosong"]);
        $this->form_validation->set_rules("keluhan", "keluhan", "trim|required", ["required" => "Keluhan tidak boleh kosong"]);
        $this->form_validation->set_rules("riwayat_penyakit", "riwayat penyakit", "trim|required", ["required" => "Riwayat penyakit tidak boleh kosong"]);
        $this->form_validation->set_rules("pengobatan", "pengobatan", "trim|required", ["required" => "Pengobatan tidak boleh kosong"]);
        $this->form_validation->set_rules("wawancara_psikologis", "wawancara psikologis", "trim|required", ["required" => "Wawancara psikologis tidak boleh kosong"]);
        if ($this->input->post('hasil_psikotest') <> null) $this->form_validation->set_rules("hasil_psikotest", "hasil psikotest", "trim|required", ["required" => "Hasil psikotest tidak boleh kosong"]);
        $this->form_validation->set_rules("tindakan", "tindakan", "trim|required", ["required" => "Tindakan tidak boleh kosong"]);
        if ($this->input->post('catatan') <> null) $this->form_validation->set_rules("catatan", "catatan", "trim|required", ["required" => "Catatan tidak boleh kosong"]);

        /* bagian rekammedis*/
        $this->form_validation->set_rules("tgl_rekam", "tgl_rekam", "trim|required", ["required" => "Tanggal Kegiatan Konseling tidak boleh kosong"]);
        $this->form_validation->set_rules("jns_terapi", "jenis terapi", "trim|required", ["required" => "Jenis terapi tidak boleh kosong"]);
        $this->form_validation->set_rules("kesimpulan", "kesimpulan", "trim|required", ["required" => "Kesimpulan tidak boleh kosong"]);
        $this->form_validation->set_rules("hasil_akhir", "hasil akhir", "trim|required", ["required" => "Hasil akhir tidak boleh kosong"]);
        if ($this->input->post('catt_akhir') <> null) $this->form_validation->set_rules("catt_akhir", "catatan akhir", "trim|required", ["required" => "Catatan akhir tidak boleh kosong"]);

        /* set-text error*/
        $this->form_validation->set_error_delimiters('<p class="text-danger" style="font-size: 14px;">', '</p>');

        if ($this->form_validation->run()) {
            $data['success'] = true;
            $pesan = '';
            $id_asessment = $this->input->post('id_assesment');
            $id_rekammedis = $this->input->post('id_rekam');

            $hasil_psikotes = $this->input->post('hasil_psikotest');
            $catatan = $this->input->post('catatan');

            if ($hasil_psikotes == null) $hasil_psikotes = "";
            if ($catatan == null) $catatan = "";

            $data_assesment = array(
                'tgl_assesment' => $this->input->post('tgl_assesment'),
                'keluhan' => $this->input->post('keluhan'),
                'riwayat_penyakit' => $this->input->post('riwayat_penyakit'),
                'pengobatan' => $this->input->post('pengobatan'),
                'wawancara_psikologis' => $this->input->post('wawancara_psikologis'),
                'psikotest' => $this->input->post('psikotest'),
                'hasil_psikotes' => $hasil_psikotes,
                'diagnosa' => $this->input->post('diagnosa'),
                'diagnosa_khusus' => $this->input->post('diagnosa_khusus'),
                'diagnosa_penyerta' => $this->input->post('diagnosa_penyerta'),
                'tindakan' =>  $this->input->post('tindakan'),
                'id_menindak' => $this->input->post('id_menindak'),
                'catatan' => $catatan,
            );

            $cek_update_asessment = $this->model_all->updateData('tb_assesment', $data_assesment, ['id_assesment' => $id_asessment]);

            if ($id_rekammedis <> null) {
                $catatan_akhir = $this->input->post('catt_akhir');
                if ($catatan_akhir == null) $catatan_akhir = "";

                $data_rekam = array(
                    'tgl_rekam' => $this->input->post('tgl_rekam'),
                    'jns_terapi' => $this->input->post('jns_terapi'),
                    'kesimpulan' => $this->input->post('kesimpulan'),
                    'hasil_akhir' => $this->input->post('hasil_akhir'),
                    'catatan' => $catatan_akhir,
                );

                $cek_update_rekam = $this->model_all->updateData('tb_rekammedis', $data_rekam, ["id_rekam" => $id_rekammedis]);
                if (($cek_update_asessment == true) && ($cek_update_rekam == true)) $pesan = 'success';
                else $pesan = 'error';
            } else {
                if ($cek_update_asessment) $pesan = 'success';
                else $pesan = 'error';
            }

            $data['pesan'] = $pesan;
        } else {
            foreach ($_POST as $key => $value) {
                $data['message'][$key] = form_error($key);
            }
        }

        echo json_encode($data);
    }
    
    // cetak

    public function cetak_bulan($bulan, $tahun)
    {
        $bulan = decrypt_url($bulan);
        $tahun = decrypt_url($tahun);
        $datapendidikan = [];
        $datajk = [];
        $datatindakan = [];
        $datadiagnosa = [];
        $bulanCaption = konversiBulan($bulan) . " " . $tahun;

        $cekdatabulanpsikolog = $this->model_admin->getPasienLaporanBulanan($bulan, $tahun, "bulan", "Psikolog");
        $cekdatabulankader = $this->model_admin->getPasienLaporanBulanan($bulan, $tahun, "bulan", "Kader");

        $pdf = new Reportbulan();
        $pdf->AddPage('P', 'A4');
        $pdf->SetMargins(20, 47, 20);
        $pdf->SetAutoPageBreak(true, 40); //batas bawah halaman
        $pdf->setTitle("Laporan Bulan " . $bulanCaption);

        $pdf->Ln(35);
        $pdf->SetFont('Times', 'B', 14);
        $pdf->Cell(0, 7, 'LAPORAN', 0, 1, 'C');
        $pdf->Ln(1);
        $pdf->Cell(0, 7, 'REKAPITULASI PASIEN', 0, 1, 'C');

        $pdf->Ln(6);
        $pdf->SetFont('Times', 'B', 14);
        $pdf->Cell(0, 7, 'Bulan : ', 0, 1, 'L');
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(0, 7, $bulanCaption, 0, 1, 'L');
        $pdf->Ln(6);

        $pdf->SetFont('Times', 'B', 14);
        $pdf->Cell(0, 7, 'Data Laporan Psikolog : ', 0, 1, 'L');
        $pdf->Ln(3);

        $pdf->SetFont('Times', '', 12);
        $pdf->SetWidths(array(12, 32, 15, 35, 45, 35));
        $pdf->SetAligns(array("L", "L", "L", "L", "L", "Ln"));
        $pdf->SetFont('Times', '', 12);
        $pdf->Ln(2);

        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(12, 7, 'No.', 1, 0, 'L');
        $pdf->Cell(32, 7, 'Nama Lengkap', 1, 0, 'L');
        $pdf->Cell(15, 7, 'Usia', 1, 0, 'L');
        $pdf->Cell(35, 7, 'Jenis Kelamin', 1, 0, 'L');
        $pdf->Cell(45, 7, 'Diagnosa', 1, 0, 'L');
        $pdf->Cell(35, 7, 'Tindakan', 1, 0, 'L');
        $pdf->Ln(7);

        if ($cekdatabulanpsikolog->num_rows() > 0) {
            $data_pasien = $cekdatabulanpsikolog->result_array();
            $pdf->SetFont('Times', '', 12);
            $no = 0;
            foreach ($data_pasien as $value) {
                $no++;
                $pdf->Row(array(($no) . ".", $value['nm_lengkap'], $value['usia'], $value['jk'], str_replace('–', '-', $value['diagnosa']), $value['tindakan']));
            }
        } else {
            $pdf->SetFont('Times', '', 10);
            $pdf->Cell(174, 7, 'Belum ada data data laporan Psikolog', 1, 0, 'C');
        }

        $pdf->AddPage('P', 'A4');
        $pdf->SetFont('Times', 'B', 14);
        $pdf->Cell(0, 7, 'LAPORAN', 0, 1, 'C');
        $pdf->Ln(1);
        $pdf->Cell(0, 7, 'REKAPITULASI PASIEN', 0, 1, 'C');

        $pdf->Ln(6);
        $pdf->SetFont('Times', 'B', 14);
        $pdf->Cell(0, 7, 'Bulan : ', 0, 1, 'L');
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(0, 7, $bulanCaption, 0, 1, 'L');
        $pdf->Ln(6);

        $pdf->SetFont('Times', 'B', 14);
        $pdf->Cell(0, 7, 'Data Laporan Kader : ', 0, 1, 'L');
        $pdf->Ln(3);

        $pdf->SetFont('Times', '', 12);
        $pdf->SetWidths(array(12, 32, 15, 35, 45, 35));
        $pdf->SetAligns(array("L", "L", "L", "L", "L", "Ln"));
        $pdf->SetFont('Times', '', 12);
        $pdf->Ln(2);

        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(12, 7, 'No.', 1, 0, 'L');
        $pdf->Cell(32, 7, 'Nama Lengkap', 1, 0, 'L');
        $pdf->Cell(15, 7, 'Usia', 1, 0, 'L');
        $pdf->Cell(35, 7, 'Jenis Kelamin', 1, 0, 'L');
        $pdf->Cell(45, 7, 'Diagnosa', 1, 0, 'L');
        $pdf->Cell(35, 7, 'Tindakan', 1, 0, 'L');
        $pdf->Ln(7);

        if ($cekdatabulankader->num_rows() > 0) {
            $data_pasien_kader = $cekdatabulankader->result_array();
            $pdf->SetFont('Times', '', 12);
            $no = 0;
            foreach ($data_pasien_kader as $value) {
                $no++;
                $pdf->Row(array(($no) . ".", $value['nm_lengkap'], $value['usia'], $value['jk'], str_replace('–', '-', $value['diagnosa']), $value['tindakan']));
            }
        } else {
            $pdf->SetFont('Times', '', 10);
            $pdf->Cell(174, 7, 'Belum ada data data laporan Kader', 1, 0, 'C');
        }

        /* chart */
        //chart data diagnosa
        $cekdatacountdiagnosa = $this->model_admin->cekgetGrafikdiagnosaBln($bulan, $tahun);
        $cekcountdiagnosa = $cekdatacountdiagnosa->num_rows();
        $cekvaluediagnosa = 0;

        if ($cekcountdiagnosa < 26) {

            $i = 0;
            foreach ($cekdatacountdiagnosa->result_array() as $value) {
                $caption = $value['diagnosa'];
                $countdiagnosa = $this->model_admin->getGrafikdiagnosaBln($bulan, $tahun, $caption)->num_rows();

                if ($countdiagnosa > 0) {
                    $title = $caption . ' (' . $countdiagnosa . ')';
                    $value = [
                        'color' => getColor_chart($i++),
                        'value' => $countdiagnosa
                    ];
                    $datadiagnosa[$title] = $value;
                }

                $cekvaluediagnosa += $countdiagnosa;
            }
        } else {
            $getdiagnosa = getDiagnosaKode_chart();

            for ($i = 0; $i < count($getdiagnosa); $i++) {
                $caption = $getdiagnosa[$i];
                $countdiagnosa = $this->model_admin->getGrafikdiagnosaBln($bulan, $tahun, $caption)->num_rows();

                if ($countdiagnosa > 0) {
                    $title = $caption . ' (' . $countdiagnosa . ')';
                    $value = [
                        'color' => getColor_chart($i),
                        'value' => $countdiagnosa
                    ];
                    $datadiagnosa[$title] = $value;
                }

                $cekvaluediagnosa += $countdiagnosa;
            }
        }

        if ($cekvaluediagnosa == 0) {
            $title = 'Tidak ada data';
            $value = [
                'color' => getColor_chart($i),
                'value' => 1
            ];
            $datadiagnosa[$title] = $value;
        }
        //pieX,pieY,radius,LegendX,LegendY
        $positiondiagnosa = getPosition(50, 88, 30, 90, 58, 40, "Chart Diagnosa :");

        //chart data jenis kelamin
        $getjk = getJenisKelamin_chart();
        $cekvaluejk = 0;
        for ($i = 0; $i < count($getjk); $i++) {
            $caption = $getjk[$i];
            $countjk = $this->model_admin->getGrafikrujukBln($bulan, $tahun, 'jk', $caption);
            $title = $caption . ' (' . $countjk . ')';
            $value = [
                'color' => getColor_chart($i),
                'value' => $countjk
            ];
            $datajk[$title] = $value;

            $cekvaluejk += $countjk;
        }

        if ($cekvaluejk == 0) {
            $title = 'Tidak ada data';
            $value = [
                'color' => getColor_chart($i),
                'value' => 1
            ];
            $datajk[$title] = $value;
        }

        //pieX,pieY,radius,LegendX,LegendY
        $positionjk = getPosition(50, 90, 30, 30, 125, 40, "");

        //chart data tindakan
        $gettindakan = getTindakan_chart();
        $cekvaluetindakan = 0;

        for ($i = 0; $i < count($gettindakan); $i++) {
            $caption = $gettindakan[$i];
            $counttindakan = $this->model_admin->getGrafikrujukBln($bulan, $tahun, 'tindakan', $caption);
            $title = $caption . ' (' . $counttindakan . ')';
            $value = [
                'color' => getColor_chart($i),
                'value' => $counttindakan
            ];
            $datatindakan[$title] = $value;
            $cekvaluetindakan += $counttindakan;
        }

        if ($cekvaluetindakan == 0) {
            $title = 'Tidak ada data';
            $value = [
                'color' => getColor_chart($i),
                'value' => 1
            ];

            $datatindakan[$title] = $value;
        }

        //pieX,pieY,radius,LegendX,LegendY
        $positiontindakan = getPosition(160, 90, 30, 140, 125, 80, "");

        //chart data pendidikan
        $getpendidikan = getPendidikan_chart();
        $cekvaluependidikan = 0;
        for ($i = 0; $i < count($getpendidikan); $i++) {
            $caption = $getpendidikan[$i];
            $countpendidikan = $this->model_admin->getGrafikrujukBln($bulan, $tahun, 'pendidikan', $caption);
            $title = $caption . ' (' . $countpendidikan . ')';
            $value = [
                'color' => getColor_chart($i),
                'value' => $countpendidikan
            ];
            $datapendidikan[$title] = $value;

            $cekvaluependidikan += $countpendidikan;
        }

        if ($cekvaluependidikan == 0) {
            $title = 'Tidak ada data';
            $value = [
                'color' => getColor_chart($i),
                'value' => 1
            ];
            $datapendidikan[$title] = $value;
        }

        //pieX,pieY,radius,LegendX,LegendY
        $positionpendidikan = getPosition(50, 210, 30, 90, 180, 300, "");

        $pdf->AddPage('P', 'A4');
        $pdf->create_chart($datadiagnosa, $positiondiagnosa);

        $pdf->AddPage('P', 'A4');

        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(110, 7, 'Chart Jenis Kelamin :', 0, 0, 'L');
        $pdf->Cell(64, 7, 'Chart Tindakan :', 0, 0, 'L');
        $pdf->SetFont('Times', '', 12);

        $pdf->create_chart($datajk, $positionjk);
        $pdf->create_chart($datatindakan, $positiontindakan);

        $pdf->ln(20);
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(0, 5, "Chart Pendidikan :", 0, 0);
        $pdf->SetFont('Times', '', 12);

        $pdf->create_chart($datapendidikan, $positionpendidikan);
        $pdf->Output("Laporan {$bulanCaption}.pdf", "I");
    }

    public function cetak_tahun($tahun)
    {
        $tahun = decrypt_url($tahun);
        $cekdatatahunpsikolog = $this->model_admin->getPasienLaporanTahunan($tahun, "Psikolog");
        $cekdatatahunkader = $this->model_admin->getPasienLaporanTahunan($tahun, "Kader");
        $tahunCaption = $tahun;

        $pdf = new Reportbulan();
        $pdf->AddPage('P', 'A4');
        $pdf->SetMargins(20, 47, 20);
        $pdf->SetAutoPageBreak(true, 40); //batas bawah halaman
        $pdf->setTitle("Laporan Bulan " . $tahunCaption);

        $pdf->Ln(35);
        $pdf->SetFont('Times', 'B', 14);
        $pdf->Cell(0, 7, 'LAPORAN', 0, 1, 'C');
        $pdf->Ln(1);
        $pdf->Cell(0, 7, 'REKAPITULASI PASIEN', 0, 1, 'C');

        $pdf->Ln(6);
        $pdf->SetFont('Times', 'B', 14);
        $pdf->Cell(0, 7, 'Tahun : ', 0, 1, 'L');
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(0, 7, $tahunCaption, 0, 1, 'L');
        $pdf->Ln(6);

        $pdf->SetFont('Times', 'B', 14);
        $pdf->Cell(0, 7, 'Data Laporan Psikolog : ', 0, 1, 'L');
        $pdf->Ln(3);

        $pdf->SetFont('Times', '', 12);
        $pdf->SetWidths(array(12, 32, 15, 35, 45, 35));
        $pdf->SetAligns(array("L", "L", "L", "L", "L", "Ln"));
        $pdf->SetFont('Times', '', 12);
        $pdf->Ln(2);

        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(12, 7, 'No.', 1, 0, 'L');
        $pdf->Cell(32, 7, 'Nama Lengkap', 1, 0, 'L');
        $pdf->Cell(15, 7, 'Usia', 1, 0, 'L');
        $pdf->Cell(35, 7, 'Jenis Kelamin', 1, 0, 'L');
        $pdf->Cell(45, 7, 'Diagnosa', 1, 0, 'L');
        $pdf->Cell(35, 7, 'Tindakan', 1, 0, 'L');
        $pdf->Ln(7);

        if ($cekdatatahunpsikolog->num_rows() > 0) {
            $data_pasien_psikolog = $cekdatatahunpsikolog->result_array();
            $pdf->SetFont('Times', '', 12);
            $no = 0;
            foreach ($data_pasien_psikolog as $value) {
                $no++;
                $pdf->Row(array(($no) . ".", $value['nm_lengkap'], $value['usia'], $value['jk'], str_replace('–', '-', $value['diagnosa']), $value['tindakan']));
            }
        } else {
            $pdf->SetFont('Times', '', 10);
            $pdf->Cell(174, 7, 'Belum ada data data laporan Psikolog', 1, 0, 'C');
        }

        $pdf->AddPage('P', 'A4');
        $pdf->SetFont('Times', 'B', 14);
        $pdf->Cell(0, 7, 'LAPORAN', 0, 1, 'C');
        $pdf->Ln(1);
        $pdf->Cell(0, 7, 'REKAPITULASI PASIEN', 0, 1, 'C');

        $pdf->Ln(6);
        $pdf->SetFont('Times', 'B', 14);
        $pdf->Cell(0, 7, 'Tahun : ', 0, 1, 'L');
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(0, 7, $tahunCaption, 0, 1, 'L');
        $pdf->Ln(6);

        $pdf->SetFont('Times', 'B', 14);
        $pdf->Cell(0, 7, 'Data Laporan Kader : ', 0, 1, 'L');
        $pdf->Ln(3);

        $pdf->SetFont('Times', '', 12);
        $pdf->SetWidths(array(12, 32, 15, 35, 45, 35));
        $pdf->SetAligns(array("L", "L", "L", "L", "L", "Ln"));
        $pdf->SetFont('Times', '', 12);
        $pdf->Ln(2);

        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(12, 7, 'No.', 1, 0, 'L');
        $pdf->Cell(32, 7, 'Nama Lengkap', 1, 0, 'L');
        $pdf->Cell(15, 7, 'Usia', 1, 0, 'L');
        $pdf->Cell(35, 7, 'Jenis Kelamin', 1, 0, 'L');
        $pdf->Cell(45, 7, 'Diagnosa', 1, 0, 'L');
        $pdf->Cell(35, 7, 'Tindakan', 1, 0, 'L');
        $pdf->Ln(7);

        if ($cekdatatahunkader->num_rows() > 0) {
            $data_pasien_kader = $cekdatatahunkader->result_array();
            $pdf->SetFont('Times', '', 12);
            $no = 0;
            foreach ($data_pasien_psikolog as $value) {
                $no++;
                $pdf->Row(array(($no) . ".", $value['nm_lengkap'], $value['usia'], $value['jk'], str_replace('–', '-', $value['diagnosa']), $value['tindakan']));
            }
        } else {
            $pdf->SetFont('Times', '', 10);
            $pdf->Cell(174, 7, 'Belum ada data data laporan Kader', 1, 0, 'C');
        }

        // chart =============================================================================
        //chart data diagnosa
        $cekdatacountdiagnosa = $this->model_admin->cekgetGrafikdiagnosaThn($tahun);
        $cekcountdiagnosa = $cekdatacountdiagnosa->num_rows();
        $cekvaluediagnosa = 0;

        if ($cekcountdiagnosa < 26) {
            $i = 0;
            foreach ($cekdatacountdiagnosa->result_array() as $value) {
                $caption = $value['diagnosa'];
                $countdiagnosa = $this->model_admin->getGrafikdiagnosaThn($tahun, $caption)->num_rows();

                if ($countdiagnosa > 0) {
                    $title = $caption . ' (' . $countdiagnosa . ')';
                    $value = [
                        'color' => getColor_chart($i++),
                        'value' => $countdiagnosa
                    ];
                    $datadiagnosa[$title] = $value;
                }

                $cekvaluediagnosa += $countdiagnosa;
            }
        } else {
            $getdiagnosa = getDiagnosaKode_chart();
            for ($i = 0; $i < count($getdiagnosa); $i++) {
                $caption = $getdiagnosa[$i];
                $countdiagnosa = $this->model_admin->getGrafikdiagnosaThn($tahun, $caption)->num_rows();

                if ($countdiagnosa > 0) {
                    $title = $caption . ' (' . $countdiagnosa . ')';
                    $value = [
                        'color' => getColor_chart($i),
                        'value' => $countdiagnosa
                    ];
                    $datadiagnosa[$title] = $value;
                }

                $cekvaluediagnosa += $countdiagnosa;
            }
        }

        if ($cekvaluediagnosa == 0) {
            $title = 'Tidak ada data';
            $value = [
                'color' => getColor_chart($i),
                'value' => 1
            ];
            $datadiagnosa[$title] = $value;
        }
        //pieX,pieY,radius,LegendX,LegendY
        $positiondiagnosa = getPosition(50, 88, 30, 90, 58, 40, "Chart Diagnosa :");

        //chart data jenis kelamin
        $getjk = getJenisKelamin_chart();
        $cekvaluejk = 0;
        for ($i = 0; $i < count($getjk); $i++) {
            $caption = $getjk[$i];
            $countjk = $this->model_admin->getGrafikrujukThn($tahun, 'jk', $caption);
            $title = $caption . ' (' . $countjk . ')';
            $value = [
                'color' => getColor_chart($i),
                'value' => $countjk
            ];
            $datajk[$title] = $value;

            $cekvaluejk += $countjk;
        }

        if ($cekvaluejk == 0) {
            $title = 'Tidak ada data';
            $value = [
                'color' => getColor_chart($i),
                'value' => 1
            ];
            $datajk[$title] = $value;
        }
        //pieX,pieY,radius,LegendX,LegendY
        $positionjk = getPosition(50, 90, 30, 30, 125, 40, "");

        //chart data tindakan
        $gettindakan = getTindakan_chart();
        $cekvaluetindakan = 0;

        for ($i = 0; $i < count($gettindakan); $i++) {
            $caption = $gettindakan[$i];
            $counttindakan = $this->model_admin->getGrafikrujukThn($tahun, 'tindakan', $caption);
            $title = $caption . ' (' . $counttindakan . ')';
            $value = [
                'color' => getColor_chart($i),
                'value' => $counttindakan
            ];
            $datatindakan[$title] = $value;
            $cekvaluetindakan += $counttindakan;
        }

        if ($cekvaluetindakan == 0) {
            $title = 'Tidak ada data';
            $value = [
                'color' => getColor_chart($i),
                'value' => 1
            ];

            $datatindakan[$title] = $value;
        }
        //pieX,pieY,radius,LegendX,LegendY
        $positiontindakan = getPosition(160, 90, 30, 140, 125, 80, "");

        $getpendidikan = getPendidikan_chart();
        $cekvaluependidikan = 0;
        for ($i = 0; $i < count($getpendidikan); $i++) {
            $caption = $getpendidikan[$i];
            $countpendidikan = $this->model_admin->getGrafikrujukThn($tahun, 'pendidikan', $caption);
            $title = $caption . ' (' . $countpendidikan . ')';
            $value = [
                'color' => getColor_chart($i),
                'value' => $countpendidikan
            ];
            $datapendidikan[$title] = $value;

            $cekvaluependidikan += $countpendidikan;
        }

        if ($cekvaluependidikan == 0) {
            $title = 'Tidak ada data';
            $value = [
                'color' => getColor_chart($i),
                'value' => 1
            ];
            $datapendidikan[$title] = $value;
        }

        //pieX,pieY,radius,LegendX,LegendY
        $positionpendidikan = getPosition(50, 210, 30, 90, 180, 300, "");

        $pdf->AddPage('P', 'A4');
        $pdf->create_chart($datadiagnosa, $positiondiagnosa);

        $pdf->AddPage('P', 'A4');
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(110, 7, 'Chart Jenis Kelamin :', 0, 0, 'L');
        $pdf->Cell(64, 7, 'Chart Tindakan :', 0, 0, 'L');
        $pdf->SetFont('Times', '', 12);

        $pdf->create_chart($datajk, $positionjk);
        $pdf->create_chart($datatindakan, $positiontindakan);

        $pdf->ln(20);
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(0, 5, "Chart Pendidikan :", 0, 0);
        $pdf->SetFont('Times', '', 12);

        $pdf->create_chart($datapendidikan, $positionpendidikan);
        $pdf->Output("Laporan {$tahunCaption}.pdf", "I");
    }

    public function cetak_dokter($bulan, $tahun)
    {
        $bulan = decrypt_url($bulan);
        $tahun = decrypt_url($tahun);
        $bulanCaption = konversiBulan($bulan) . " " . $tahun;

        $cekdatabulandokter = $this->model_admin->getPasienLaporanBulanan($bulan, $tahun, "rujuk", "Rujuk ke Dokter");

        $pdf = new Reportbulan();
        $pdf->AddPage('P', 'A4');
        $pdf->SetMargins(20, 47, 20);
        $pdf->SetAutoPageBreak(true, 40); //batas bawah halaman
        $pdf->setTitle("Laporan Bulan " . $bulanCaption);

        $pdf->Ln(35);
        $pdf->SetFont('Times', 'B', 14);
        $pdf->Cell(0, 7, 'LAPORAN', 0, 1, 'C');
        $pdf->Ln(1);
        $pdf->Cell(0, 7, 'REKAPITULASI RUJUKAN', 0, 1, 'C');

        $pdf->Ln(6);
        $pdf->SetFont('Times', 'B', 14);
        $pdf->Cell(0, 7, 'Bulan : ', 0, 1, 'L');
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(0, 7, $bulanCaption, 0, 1, 'L');
        $pdf->Ln(6);

        $pdf->SetFont('Times', 'B', 14);
        $pdf->Cell(0, 7, 'Data Laporan Rujukan', 0, 1, 'L');
        $pdf->Ln(3);

        $pdf->SetFont('Times', '', 12);
        $pdf->SetWidths(array(12, 32, 15, 35, 45, 35));
        $pdf->SetAligns(array("L", "L", "L", "L", "L", "Ln"));
        $pdf->SetFont('Times', '', 12);
        $pdf->Ln(2);

        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(12, 7, 'No.', 1, 0, 'L');
        $pdf->Cell(32, 7, 'Nama Lengkap', 1, 0, 'L');
        $pdf->Cell(15, 7, 'Usia', 1, 0, 'L');
        $pdf->Cell(35, 7, 'Jenis Kelamin', 1, 0, 'L');
        $pdf->Cell(45, 7, 'Diagnosa utama', 1, 0, 'L');
        $pdf->Cell(35, 7, 'Diagnosa banding', 1, 0, 'C');
        $pdf->Ln(7);

        if ($cekdatabulandokter->num_rows() > 0) {
            $data_pasien = $cekdatabulandokter->result_array();
            $pdf->SetFont('Times', '', 12);
            $no = 0;
            foreach ($data_pasien as $value) {
                $no++;
                $pdf->Row(array(($no) . ".", $value['nm_lengkap'], $value['usia'], $value['jk'], str_replace('–', '-', $value['diagnosa']), ($value['diagnosa_penyerta'] <> '') ? $value['diagnosa_penyerta'] : "-"));
            }
        } else {
            $pdf->SetFont('Times', '', 10);
            $pdf->Cell(174, 7, 'Belum ada data data laporan Dokter', 1, 0, 'C');
        }

        $pdf->Output("Laporan Rujukan Dokter {$bulanCaption}.pdf", "I");
    }

    public function cetak_psikolog($bulan, $tahun)
    {
        $bulan = decrypt_url($bulan);
        $tahun = decrypt_url($tahun);
        $bulanCaption = konversiBulan($bulan) . " " . $tahun;

        $cekdatabulanpsikolog = $this->model_admin->getPasienLaporanBulanan($bulan, $tahun, "rujuk", "Rujuk Psikolog");

        $pdf = new Reportbulan();
        $pdf->AddPage('P', 'A4');
        $pdf->SetMargins(20, 47, 20);
        $pdf->SetAutoPageBreak(true, 40); //batas bawah halaman
        $pdf->setTitle("Laporan Rujukan Bulan " . $bulanCaption);

        $pdf->Ln(35);
        $pdf->SetFont('Times', 'B', 14);
        $pdf->Cell(0, 7, 'LAPORAN', 0, 1, 'C');
        $pdf->Ln(1);
        $pdf->Cell(0, 7, 'REKAPITULASI RUJUKAN', 0, 1, 'C');

        $pdf->Ln(6);
        $pdf->SetFont('Times', 'B', 14);
        $pdf->Cell(0, 7, 'Bulan : ', 0, 1, 'L');
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(0, 7, $bulanCaption, 0, 1, 'L');
        $pdf->Ln(6);

        $pdf->SetFont('Times', 'B', 14);
        $pdf->Cell(0, 7, 'Data Laporan Rujukan : ', 0, 1, 'L');
        $pdf->Ln(3);

        $pdf->SetFont('Times', '', 12);
        $pdf->SetWidths(array(12, 32, 15, 35, 45, 35));
        $pdf->SetAligns(array("L", "L", "L", "L", "L", "Ln"));
        $pdf->SetFont('Times', '', 12);
        $pdf->Ln(2);

        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(12, 7, 'No.', 1, 0, 'L');
        $pdf->Cell(32, 7, 'Nama Lengkap', 1, 0, 'L');
        $pdf->Cell(15, 7, 'Usia', 1, 0, 'L');
        $pdf->Cell(35, 7, 'Jenis Kelamin', 1, 0, 'L');
        $pdf->Cell(45, 7, 'Diagnosa utama', 1, 0, 'L');
        $pdf->Cell(35, 7, 'Diagnosa banding', 1, 0, 'C');
        $pdf->Ln(7);

        if ($cekdatabulanpsikolog->num_rows() > 0) {
            $data_pasien = $cekdatabulanpsikolog->result_array();
            $pdf->SetFont('Times', '', 12);
            $no = 0;
            foreach ($data_pasien as $value) {
                $no++;
                $pdf->Row(array(($no) . ".", $value['nm_lengkap'], $value['usia'], $value['jk'], str_replace('–', '-', $value['diagnosa']), ($value['diagnosa_penyerta'] <> '') ? $value['diagnosa_penyerta'] : "-"));
            }
        } else {
            $pdf->SetFont('Times', '', 10);
            $pdf->Cell(174, 7, 'Belum ada data data laporan Psikolog', 1, 0, 'C');
        }

        $pdf->Output("Laporan Rujukan Psikolog {$bulanCaption}.pdf", "I");
    }

        public function cetak_individu($id_cetak)
    {
        // dataasessment di ambil keseluruhan dan rekam medis
        $id_cetak = decrypt_url($id_cetak);
        $cekdataindividu = $this->model_admin->getlayanan_datapasien('Konseling Individu', $id_cetak);
        if ($cekdataindividu->num_rows() > 0) {
            $data_laporan = $cekdataindividu->result_array()[0];
            $intervensi = $this->model_admin->getlayanan_datapasien_rekamedis($data_laporan['id_pasien']);
            $assesment = $this->model_admin->getlayanan_datapasien_assesment_all($data_laporan['id_pasien']);

            $pdf = new Reportbulan();
            $pdf->AddPage('P', 'A4');
            $pdf->SetMargins(20, 47, 20);
            $pdf->SetAutoPageBreak(true, 40); //batas bawah halaman
            $pdf->setTitle("Laporan Rujukan Psikolog");
            $pdf->SetAuthor('SIKESWA');

            $pdf->Ln(35);
            $pdf->SetFont('Times', 'B', 14);
            $pdf->Cell(0, 7, 'HASIL PEMERIKSAAN PSIKOLOGIS', 0, 1, 'C');

            $pdf->Ln(7);
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(60, 7, 'No Id', 0, 0, 'L');
            $pdf->Cell(6, 7, ':', 0, 0, 'L');
            $pdf->Cell(50, 7, konversiChar($data_laporan['id_pasien']), 0, 0, 'L');

            $pdf->Ln();
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(60, 7, 'No Rekam Medis', 0, 0, 'L');
            $pdf->Cell(6, 7, ':', 0, 0, 'L');
            $pdf->Cell(50, 7, konversiChar($data_laporan['no_rekam_medis']), 0, 0, 'L');

            $pdf->Ln(12);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(0, 7, 'A. DATA DEMOGRAFI', 0, 1, 'L');

            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(60, 7, 'Nama Lengkap', 0, 0, 'L');
            $pdf->Cell(6, 7, ':', 0, 0, 'L');
            $pdf->Cell(50, 7, konversiChar($data_laporan['nm_lengkap']), 0, 0, 'L');
            $pdf->Ln();
            $pdf->Cell(60, 7, 'Alamat', 0, 0, 'L');
            $pdf->Cell(6, 7, ':', 0, 0, 'L');
            $pdf->Cell(50, 7, konversiChar($data_laporan['alamat']), 0, 0, 'L');
            $pdf->Ln();
            $pdf->Cell(60, 7, 'Desa', 0, 0, 'L');
            $pdf->Cell(6, 7, ':', 0, 0, 'L');
            $pdf->Cell(50, 7, konversiChar($data_laporan['desa']), 0, 0, 'L');
            $pdf->Ln();
            $pdf->Cell(60, 7, 'Kecamatan', 0, 0, 'L');
            $pdf->Cell(6, 7, ':', 0, 0, 'L');
            $pdf->Cell(50, 7, konversiChar($data_laporan['kecamatan']), 0, 0, 'L');
            $pdf->Ln();
            $pdf->Cell(60, 7, 'Tempat Lahir', 0, 0, 'L');
            $pdf->Cell(6, 7, ':', 0, 0, 'L');
            $pdf->Cell(50, 7, konversiChar($data_laporan['tempat_lahir']), 0, 0, 'L');
            $pdf->Ln();
            $pdf->Cell(60, 7, 'Tanggal Lahir', 0, 0, 'L');
            $pdf->Cell(6, 7, ':', 0, 0, 'L');
            $pdf->Cell(50, 7, konversiChar(konversiTanggalid($data_laporan['tgl_lahir'])), 0, 0, 'L');
            $pdf->Ln();
            $pdf->Cell(60, 7, 'Usia', 0, 0, 'L');
            $pdf->Cell(6, 7, ':', 0, 0, 'L');
            $pdf->Cell(50, 7, konversiChar($data_laporan['usia']), 0, 0, 'L');
            $pdf->Ln();
            $pdf->Cell(60, 7, 'Agama', 0, 0, 'L');
            $pdf->Cell(6, 7, ':', 0, 0, 'L');
            $pdf->Cell(50, 7, konversiChar($data_laporan['agama']), 0, 0, 'L');
            $pdf->Ln();
            $pdf->Cell(60, 7, 'Status Menikah', 0, 0, 'L');
            $pdf->Cell(6, 7, ':', 0, 0, 'L');
            $pdf->Cell(50, 7, konversiChar($data_laporan['status']), 0, 0, 'L');
            $pdf->Ln();
            $pdf->Cell(60, 7, 'Pendidikan', 0, 0, 'L');
            $pdf->Cell(6, 7, ':', 0, 0, 'L');
            $pdf->Cell(50, 7, konversiChar($data_laporan['pendidikan']), 0, 0, 'L');
            $pdf->Ln();
            $pdf->Cell(60, 7, 'Pekerjaan ', 0, 0, 'L');
            $pdf->Cell(6, 7, ':', 0, 0, 'L');
            $pdf->Cell(50, 7, konversiChar($data_laporan['pekerjaan']), 0, 0, 'L');

            $pdf->Ln(12);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(60, 7, 'B. KELUHAN', 0, 0, 'L');
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(6, 7, ':', 0, 0, 'L');
            $pdf->Ln();
            $pdf->SetFont('Times', '', 12);
            $no = 1;
            if ($assesment->num_rows() > 0) {
                if ($assesment->num_rows() == 1) {
                    $pdf->MultiCell(0, 7, $assesment->result_array()[0]['keluhan'], 0, 'J', 0, 0);
                } else {
                    foreach ($assesment->result_array() as $value) {
                        $pdf->MultiCell(0, 7, ($no++) . ". " . $value['keluhan'], 0, 'J', 0, 0);
                    }
                }
            } else {
                $pdf->MultiCell(0, 7, '-', 0, 'J', 0, 15);
            }
            // $pdf->MultiCell(0, 7, ($data_laporan['keluhan'] <> '') ? konversiChar($data_laporan['keluhan']) : '-', 0, 'J', 0, 15);

            $pdf->Ln(6);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(60, 7, 'C. RIWAYAT PENYAKIT', 0, 0, 'L');
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(6, 7, ':', 0, 0, 'L');
            $pdf->Ln();
            $pdf->SetFont('Times', '', 12);
            $no = 1;
            if ($assesment->num_rows() > 0) {
                if ($assesment->num_rows() == 1) {
                    $pdf->MultiCell(0, 7, $assesment->result_array()[0]['riwayat_penyakit'], 0, 'J', 0, 0);
                } else {
                    foreach ($assesment->result_array() as $value) {
                        $pdf->MultiCell(0, 7, ($no++) . ". " . $value['riwayat_penyakit'], 0, 'J', 0, 0);
                    }
                }
            } else {
                $pdf->MultiCell(0, 7, '-', 0, 'J', 0, 15);
            }
            // $pdf->MultiCell(0, 7, ($data_laporan['riwayat_penyakit'] <> '') ? konversiChar($data_laporan['riwayat_penyakit']) : '-', 0, 'J', 0, 15);

            $pdf->Ln(6);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(60, 7, 'D. RIWAYAT PENGOBATAN', 0, 0, 'L');
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(6, 7, ':', 0, 0, 'L');
            $pdf->Ln();
            $pdf->SetFont('Times', '', 12);
            $no = 1;
            if ($assesment->num_rows() > 0) {
                if ($assesment->num_rows() == 1) {
                    $pdf->MultiCell(0, 7, $assesment->result_array()[0]['pengobatan'], 0, 'J', 0, 0);
                } else {
                    foreach ($assesment->result_array() as $value) {
                        $pdf->MultiCell(0, 7, ($no++) . ". " . $value['pengobatan'], 0, 'J', 0, 0);
                    }
                }
            } else {
                $pdf->MultiCell(0, 7, '-', 0, 'J', 0, 15);
            }
            $pdf->Ln(6);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(60, 7, 'E. HASIL ASESSMENT', 0, 0, 'L');
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(6, 7, ':', 0, 0, 'L');
            $pdf->Ln();
            $pdf->SetFont('Times', '', 12);
            $no = 1;
            if ($assesment->num_rows() > 0) {
                if ($assesment->num_rows() == 1) {
                    $pdf->MultiCell(0, 7, $assesment->result_array()[0]['wawancara_psikologis'], 0, 'J', 0, 0);
                } else {
                    foreach ($assesment->result_array() as $value) {
                        $pdf->MultiCell(0, 7, ($no++) . ". " . $value['wawancara_psikologis'], 0, 'J', 0, 0);
                    }
                }
            } else {
                $pdf->MultiCell(0, 7, '-', 0, 'J', 0, 15);
            }

            $pdf->Ln(6);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(60, 7, 'F. DIAGNOSIS UTAMA', 0, 0, 'L');
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(6, 7, ':', 0, 0, 'L');
            $pdf->Ln();
            $pdf->SetFont('Times', '', 12);
            $no = 1;
            if ($assesment->num_rows() > 0) {
                if ($assesment->num_rows() == 1) {
                    $pdf->MultiCell(0, 7, $assesment->result_array()[0]['diagnosa'], 0, 'J', 0, 0);
                } else {
                    foreach ($assesment->result_array() as $value) {
                        $pdf->MultiCell(0, 7, ($no++) . ". " . str_replace('–', '-', $value['diagnosa']), 0, 'J', 0, 0);
                    }
                }
            } else {
                $pdf->MultiCell(0, 7, '-', 0, 'J', 0, 15);
            }

            $pdf->Ln(6);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(60, 7, 'G. DIAGNOSIS BANDING', 0, 0, 'L');
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(6, 7, ':', 0, 0, 'L');
            $pdf->Ln();
            $pdf->SetFont('Times', '', 12);
            $no = 1;
            if ($assesment->num_rows() > 0) {
                if ($assesment->num_rows() == 1) {
                    $pdf->MultiCell(0, 7, $assesment->result_array()[0]['diagnosa_penyerta'], 0, 'J', 0, 0);
                } else {
                    foreach ($assesment->result_array() as $value) {
                        $pdf->MultiCell(0, 7, ($no++) . ". " . $value['diagnosa_penyerta'], 0, 'J', 0, 0);
                    }
                }
            } else {
                $pdf->MultiCell(0, 7, '-', 0, 'J', 0, 15);
            }

            $pdf->Ln(6);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(60, 7, 'H. INTERVENSI', 0, 0, 'L');
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(6, 7, ':', 0, 0, 'L');
            $pdf->Ln();
            $pdf->SetFont('Times', '', 12);
            $no = 1;
            if ($intervensi->num_rows() > 0) {
                if ($intervensi->num_rows() == 1) {
                    $pdf->MultiCell(0, 7, $intervensi->result_array()[0]['jns_terapi'], 0, 'J', 0, 0);
                } else {
                    foreach ($intervensi->result_array() as $value) {
                        $pdf->MultiCell(0, 7, ($no++) . ". " . $value['jns_terapi'], 0, 'J', 0, 0);
                    }
                }
            } else {
                $pdf->MultiCell(0, 7, '-', 0, 'J', 0, 15);
            }

            $pdf->Ln(6);

            /* Tanda tangan */
            $pdf->Ln(20);
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(87, 7, '', 0, 0, 'C');
            $pdf->Cell(87, 7, 'Tertanda,', 0, 0, 'C');

            $pdf->Ln();
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(87, 7, '', 0, 0, 'C');
            $pdf->Cell(87, 7, 'Psikolog Klinis', 0, 0, 'C');

            $pdf->Ln(35);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(87, 7, '', 0, 0, 'C');
            $pdf->Cell(87, 7, '-----------------------', 0, 0, 'C');
            /* Akhir tanda tangan */

            $pdf->Output("Laporan-Rujukan-Psikolog.pdf", "I");
        } else {
            redirect('admin/pasienindividu');
        }
    }
    
    public function cetak_kelompok($id_cetak)
    {
        $id_cetak = decrypt_url($id_cetak);
        $cekdatakelompok = $this->model_admin->getlayanan_datapasien('Konseling Kelompok', $id_cetak);
        if ($cekdatakelompok->num_rows() > 0) {
            $data_laporan = $cekdatakelompok->result_array()[0];
            $intervensi = $this->model_admin->getlayanan_datapasien_rekamedis($data_laporan['id_pasien']);
            $assesment = $this->model_admin->getlayanan_datapasien_assesment_all($data_laporan['id_pasien']);

            $pdf = new Reportbulan();
            $pdf->AddPage('P', 'A4');
            $pdf->SetMargins(20, 47, 20);
            $pdf->SetAutoPageBreak(true, 40); //batas bawah halaman
            $pdf->setTitle("Laporan Rujukan Psikolog");
            $pdf->SetAuthor('SIKESWA');

            $pdf->Ln(35);
            $pdf->SetFont('Times', 'B', 14);
            $pdf->Cell(0, 7, 'HASIL PEMERIKSAAN PSIKOLOGIS', 0, 1, 'C');

            $pdf->Ln(7);
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(60, 7, 'No Id', 0, 0, 'L');
            $pdf->Cell(6, 7, ':', 0, 0, 'L');
            $pdf->Cell(50, 7, konversiChar($data_laporan['id_pasien']), 0, 0, 'L');

            $pdf->Ln();
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(60, 7, 'No Rekam Medis', 0, 0, 'L');
            $pdf->Cell(6, 7, ':', 0, 0, 'L');
            $pdf->Cell(50, 7, konversiChar($data_laporan['no_rekam_medis']), 0, 0, 'L');

            $pdf->Ln(12);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(0, 7, 'A. DATA DEMOGRAFI', 0, 1, 'L');

            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(60, 7, 'Nama Lengkap', 0, 0, 'L');
            $pdf->Cell(6, 7, ':', 0, 0, 'L');
            $pdf->Cell(50, 7, konversiChar($data_laporan['nm_lengkap']), 0, 0, 'L');
            $pdf->Ln();
            $pdf->Cell(60, 7, 'Alamat', 0, 0, 'L');
            $pdf->Cell(6, 7, ':', 0, 0, 'L');
            $pdf->Cell(50, 7, konversiChar($data_laporan['alamat']), 0, 0, 'L');
            $pdf->Ln();
            $pdf->Cell(60, 7, 'Desa', 0, 0, 'L');
            $pdf->Cell(6, 7, ':', 0, 0, 'L');
            $pdf->Cell(50, 7, konversiChar($data_laporan['desa']), 0, 0, 'L');
            $pdf->Ln();
            $pdf->Cell(60, 7, 'Kecamatan', 0, 0, 'L');
            $pdf->Cell(6, 7, ':', 0, 0, 'L');
            $pdf->Cell(50, 7, konversiChar($data_laporan['kecamatan']), 0, 0, 'L');
            $pdf->Ln();
            $pdf->Cell(60, 7, 'Tempat Lahir', 0, 0, 'L');
            $pdf->Cell(6, 7, ':', 0, 0, 'L');
            $pdf->Cell(50, 7, konversiChar($data_laporan['tempat_lahir']), 0, 0, 'L');
            $pdf->Ln();
            $pdf->Cell(60, 7, 'Tanggal Lahir', 0, 0, 'L');
            $pdf->Cell(6, 7, ':', 0, 0, 'L');
            $pdf->Cell(50, 7, konversiChar(konversiTanggalid($data_laporan['tgl_lahir'])), 0, 0, 'L');
            $pdf->Ln();
            $pdf->Cell(60, 7, 'Usia', 0, 0, 'L');
            $pdf->Cell(6, 7, ':', 0, 0, 'L');
            $pdf->Cell(50, 7, konversiChar($data_laporan['usia']), 0, 0, 'L');
            $pdf->Ln();
            $pdf->Cell(60, 7, 'Agama', 0, 0, 'L');
            $pdf->Cell(6, 7, ':', 0, 0, 'L');
            $pdf->Cell(50, 7, konversiChar($data_laporan['agama']), 0, 0, 'L');
            $pdf->Ln();
            $pdf->Cell(60, 7, 'Status Menikah', 0, 0, 'L');
            $pdf->Cell(6, 7, ':', 0, 0, 'L');
            $pdf->Cell(50, 7, konversiChar($data_laporan['status']), 0, 0, 'L');
            $pdf->Ln();
            $pdf->Cell(60, 7, 'Pendidikan', 0, 0, 'L');
            $pdf->Cell(6, 7, ':', 0, 0, 'L');
            $pdf->Cell(50, 7, konversiChar($data_laporan['pendidikan']), 0, 0, 'L');
            $pdf->Ln();
            $pdf->Cell(60, 7, 'Pekerjaan ', 0, 0, 'L');
            $pdf->Cell(6, 7, ':', 0, 0, 'L');
            $pdf->Cell(50, 7, konversiChar($data_laporan['pekerjaan']), 0, 0, 'L');

            $pdf->Ln(12);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(60, 7, 'B. KELUHAN', 0, 0, 'L');
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(6, 7, ':', 0, 0, 'L');
            $pdf->Ln();
            $pdf->SetFont('Times', '', 12);
            $no = 1;
            if ($assesment->num_rows() > 0) {
                if ($assesment->num_rows() == 1) {
                    $pdf->MultiCell(0, 7, $assesment->result_array()[0]['keluhan'], 0, 'J', 0, 0);
                } else {
                    foreach ($assesment->result_array() as $value) {
                        $pdf->MultiCell(0, 7, ($no++) . ". " . $value['keluhan'], 0, 'J', 0, 0);
                    }
                }
            } else {
                $pdf->MultiCell(0, 7, '-', 0, 'J', 0, 15);
            }
            // $pdf->MultiCell(0, 7, ($data_laporan['keluhan'] <> '') ? konversiChar($data_laporan['keluhan']) : '-', 0, 'J', 0, 15);

            $pdf->Ln(6);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(60, 7, 'C. RIWAYAT PENYAKIT', 0, 0, 'L');
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(6, 7, ':', 0, 0, 'L');
            $pdf->Ln();
            $pdf->SetFont('Times', '', 12);
            $no = 1;
            if ($assesment->num_rows() > 0) {
                if ($assesment->num_rows() == 1) {
                    $pdf->MultiCell(0, 7, $assesment->result_array()[0]['riwayat_penyakit'], 0, 'J', 0, 0);
                } else {
                    foreach ($assesment->result_array() as $value) {
                        $pdf->MultiCell(0, 7, ($no++) . ". " . $value['riwayat_penyakit'], 0, 'J', 0, 0);
                    }
                }
            } else {
                $pdf->MultiCell(0, 7, '-', 0, 'J', 0, 15);
            }
            // $pdf->MultiCell(0, 7, ($data_laporan['riwayat_penyakit'] <> '') ? konversiChar($data_laporan['riwayat_penyakit']) : '-', 0, 'J', 0, 15);

            $pdf->Ln(6);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(60, 7, 'D. RIWAYAT PENGOBATAN', 0, 0, 'L');
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(6, 7, ':', 0, 0, 'L');
            $pdf->Ln();
            $pdf->SetFont('Times', '', 12);
            $no = 1;
            if ($assesment->num_rows() > 0) {
                if ($assesment->num_rows() == 1) {
                    $pdf->MultiCell(0, 7, $assesment->result_array()[0]['pengobatan'], 0, 'J', 0, 0);
                } else {
                    foreach ($assesment->result_array() as $value) {
                        $pdf->MultiCell(0, 7, ($no++) . ". " . $value['pengobatan'], 0, 'J', 0, 0);
                    }
                }
            } else {
                $pdf->MultiCell(0, 7, '-', 0, 'J', 0, 15);
            }
            $pdf->Ln(6);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(60, 7, 'E. HASIL ASESSMENT', 0, 0, 'L');
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(6, 7, ':', 0, 0, 'L');
            $pdf->Ln();
            $pdf->SetFont('Times', '', 12);
            $no = 1;
            if ($assesment->num_rows() > 0) {
                if ($assesment->num_rows() == 1) {
                    $pdf->MultiCell(0, 7, $assesment->result_array()[0]['wawancara_psikologis'], 0, 'J', 0, 0);
                } else {
                    foreach ($assesment->result_array() as $value) {
                        $pdf->MultiCell(0, 7, ($no++) . ". " . $value['wawancara_psikologis'], 0, 'J', 0, 0);
                    }
                }
            } else {
                $pdf->MultiCell(0, 7, '-', 0, 'J', 0, 15);
            }

            $pdf->Ln(6);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(60, 7, 'F. DIAGNOSIS UTAMA', 0, 0, 'L');
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(6, 7, ':', 0, 0, 'L');
            $pdf->Ln();
            $pdf->SetFont('Times', '', 12);
            $no = 1;
            if ($assesment->num_rows() > 0) {
                if ($assesment->num_rows() == 1) {
                    $pdf->MultiCell(0, 7, $assesment->result_array()[0]['diagnosa'], 0, 'J', 0, 0);
                } else {
                    foreach ($assesment->result_array() as $value) {
                        $pdf->MultiCell(0, 7, ($no++) . ". " . str_replace('–', '-', $value['diagnosa']), 0, 'J', 0, 0);
                    }
                }
            } else {
                $pdf->MultiCell(0, 7, '-', 0, 'J', 0, 15);
            }

            $pdf->Ln(6);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(60, 7, 'G. DIAGNOSIS BANDING', 0, 0, 'L');
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(6, 7, ':', 0, 0, 'L');
            $pdf->Ln();
            $pdf->SetFont('Times', '', 12);
            $no = 1;
            if ($assesment->num_rows() > 0) {
                if ($assesment->num_rows() == 1) {
                    $pdf->MultiCell(0, 7, $assesment->result_array()[0]['diagnosa_penyerta'], 0, 'J', 0, 0);
                } else {
                    foreach ($assesment->result_array() as $value) {
                        $pdf->MultiCell(0, 7, ($no++) . ". " . $value['diagnosa_penyerta'], 0, 'J', 0, 0);
                    }
                }
            } else {
                $pdf->MultiCell(0, 7, '-', 0, 'J', 0, 15);
            }

            $pdf->Ln(6);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(60, 7, 'H. INTERVENSI', 0, 0, 'L');
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(6, 7, ':', 0, 0, 'L');
            $pdf->Ln();
            $pdf->SetFont('Times', '', 12);
            $no = 1;
            if ($intervensi->num_rows() > 0) {
                if ($intervensi->num_rows() == 1) {
                    $pdf->MultiCell(0, 7, $intervensi->result_array()[0]['jns_terapi'], 0, 'J', 0, 0);
                } else {
                    foreach ($intervensi->result_array() as $value) {
                        $pdf->MultiCell(0, 7, ($no++) . ". " . $value['jns_terapi'], 0, 'J', 0, 0);
                    }
                }
            } else {
                $pdf->MultiCell(0, 7, '-', 0, 'J', 0, 15);
            }

            $pdf->Ln(6);

            /* Tanda tangan */
            $pdf->Ln(20);
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(87, 7, '', 0, 0, 'C');
            $pdf->Cell(87, 7, 'Tertanda,', 0, 0, 'C');

            $pdf->Ln();
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(87, 7, '', 0, 0, 'C');
            $pdf->Cell(87, 7, 'Psikolog Klinis', 0, 0, 'C');

            $pdf->Ln(35);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(87, 7, '', 0, 0, 'C');
            $pdf->Cell(87, 7, '-----------------------', 0, 0, 'C');
            /* Akhir tanda tangan */

            $pdf->Output("Laporan-Rujukan-Psikolog.pdf", "I");
        } else {
            redirect('admin/pasienkelompok');
        }
    }

    public function cetak_tor($id_cetak)
    {
        $id_cetak = decrypt_url($id_cetak);
        $cekdatator = $this->model_all->getWhere('tb_tor', ['kode_tor' => $id_cetak]);
        if ($cekdatator->num_rows() > 0) {

            /* FPDF */
            $data_laporan = $cekdatator->result_array()[0];

            $pdf = new Reportbulan();
            $pdf->AddPage('P', 'A4');
            $pdf->SetMargins(20, 47, 20);
            $pdf->SetAutoPageBreak(true, 40); //batas bawah halaman
            $pdf->setTitle("Laporan Term Of References");
            $pdf->SetAuthor('SIKESWA');
            // $pdf->SetLineHeight(5);

            $pdf->Ln(35);
            $pdf->SetFont('Times', 'B', 14);
            $pdf->Cell(0, 7, 'Term Of References', 0, 1, 'C');
            $pdf->SetFont('Times', 'B', 12);
            $pdf->MultiCell(0, 7, konversiChar(substr($data_laporan['judul_tor'], 7)), 0, 'C', 0, 0);

            $pdf->Ln(7);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(0, 7, 'Latar Belakang : ', 0, 1, 'L');
            $pdf->SetFont('Times', '', 12);
            $pdf->MultiCell(0, 7, konversiChar($data_laporan['ltr_belakang']), 0, 'J', 0, 0);

            $pdf->Ln(6);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(0, 7, 'Tujuan : ', 0, 1, 'L');
            $pdf->SetFont('Times', '', 12);
            $pdf->MultiCell(0, 7, konversiChar($data_laporan['tujuan']), 0, 'J', 0, 0);

            $pdf->Ln(6);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(0, 7, 'Narasumber : ', 0, 1, 'L');
            $pdf->SetFont('Times', '', 12);
            $pdf->MultiCell(0, 7, konversiChar($data_laporan['fasilitator']), 0, 'J', 0, 0);

            $pdf->Ln(6);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(0, 7, 'Waktu Pelaksanaan : ', 0, 1, 'L');
            $pdf->Cell(0, 7, 'Tanggal Mulai', 0, 1, 'L');
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(0, 7, konversiTanggalid($data_laporan['tgl']), 0, 1, 'L');
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(0, 7, 'Tanggal Selesai', 0, 1, 'L');
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(0, 7, konversiTanggalid($data_laporan['tgl_selesai']), 0, 1, 'L');

            $pdf->Ln(6);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(0, 7, 'Lokasi :', 0, 1, 'L');
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(0, 7, $data_laporan['lokasi'], 0, 1, 'L');
            $pdf->Cell(0, 7, $data_laporan['desa'], 0, 1, 'L');

            $pdf->Ln(6);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(0, 7, 'Alokasi Anggaran :', 0, 1, 'L');
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(0, 7, $data_laporan['anggaran'], 0, 1, 'L');

            $pdf->Ln(6);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(0, 7, 'Penutup :', 0, 1, 'L');
            $pdf->SetFont('Times', '', 12);
            $pdf->MultiCell(0, 7, konversiChar($data_laporan['penutup']), 0, 'J', 0, 0);

            /* Tanda tangan */
            $pdf->Ln(20);
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(87, 7, '', 0, 0, 'C');
            $pdf->Cell(87, 7, ' ........./....../.........../.......', 0, 0, 'C');
            // $pdf->Cell(87, 7, konversiTanggalid(date('Y-m-d')), 0, 0, 'C');
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

            $pdf->Output("Laporan-tor.pdf", "I");
            /* DOM PDF */
            // $data['data_laporan'] = $cekdatator->result_array()[0];
            // $this->load->view('laporan/v_cetaktor', $data);
            // $html = $this->output->get_output();
            // $this->pdf->set_paper('A4', 'portrait');
            // $this->pdf->load_html($html);
            // $this->pdf->render();
            // $this->pdf->stream("Laporan-tor.pdf", array('Attachment' => 0));
        } else {
            redirect('admin/daftartoradmin');
        }
    }


    public function cetak_word($type, $id_cetak)
    {
        $getData = '';
        $filename = '';

        $id_cetak = decrypt_url($id_cetak);
        if ($type == "INDIVIDU") {
            $getData = "Konseling Individu";
            $filename = 'Cetak_laporan_individu.docx';
        } else if ($type == "KELOMPOK") {
            $getData = "Konseling Kelompok";
            $filename = 'Cetak_laporan_kelompok.docx';
        } else {
            exit;
        }

        $cekdata = $this->model_admin->getlayanan_datapasien($getData, $id_cetak);
        if ($cekdata->num_rows() > 0) {
            $hasil_intervensi = '';
            $data = $cekdata->result_array()[0];
            $get_data_assesment = $this->model_admin->getlayanan_datapasien_assement($data['id_pasien'])->result_array();
            // echo json_encode($get_data_assesment);
            $intervensi = $this->model_admin->getlayanan_datapasien_rekamedis($data['id_pasien'])->result_array();
            if ($intervensi <> null) {
                foreach ($intervensi as $value) {
                    $hasil_intervensi .= $value['jns_terapi'];
                }
            } else {
                $hasil_intervensi = '-';
            }

            foreach ($get_data_assesment as $value) {
                $hasil_keluhan .= $value['keluhan'] . ' ,';
            }

            $PHPWord = $this->word;
            $document = $PHPWord->loadTemplate('assets/image/img_word/TemplateBackup.docx');
            $document->setValue('Value1', $type);
            $document->setValue('Value2', ($data['id_pasien'] <> '') ? $data['id_pasien'] : '-');
            $document->setValue('Value3', ($data['no_rekam_medis'] <> '') ? $data['no_rekam_medis'] : '-');
            $document->setValue('Value4', ($data['id_assesment'] <> '') ? $data['id_assesment'] : '-');
            $document->setValue('Value5', ($data['no_urut_assesment'] <> '') ? $data['no_urut_assesment'] : '-');
            $document->setValue('Value6', ($data['nm_lengkap'] <> '') ? $data['nm_lengkap'] : '-');
            $document->setValue('Value7', ($data['alamat'] <> '') ? $data['alamat'] : '-');
            $document->setValue('Value8', ($data['tempat_lahir'] <> '') ? $data['tempat_lahir'] : '-');
            $document->setValue('Value9', ($data['tgl_lahir'] <> '') ? $data['tgl_lahir'] : '-');
            $document->setValue('Value10', ($data['jk'] <> '') ? $data['jk'] : '-');
            $document->setValue('Value11', ($data['usia'] <> '') ? $data['usia'] : '-');
            $document->setValue('Value12', ($data['agama'] <> '') ? $data['agama'] : '-');
            $document->setValue('Value13', ($data['status'] <> '') ? $data['status'] : '-');
            $document->setValue('Value14', ($data['desa'] <> '') ? $data['desa'] : '-');
            $document->setValue('Value15', ($data['kecamatan'] <> '') ? $data['kecamatan'] : '-');
            $document->setValue('Value16', ($data['kabupaten'] <> '') ? $data['kabupaten'] : '-');
            $document->setValue('Value17', ($data['no_hp'] <> '') ? $data['no_hp'] : '-');
            $document->setValue('Value18', ($data['pendidikan'] <> '') ? $data['pendidikan'] : '-');
            $document->setValue('Value19', ($data['pekerjaan'] <> '') ? $data['pekerjaan'] : '-');
            $document->setValue('Value20', $hasil_keluhan);
            $document->setValue('Value21', ($data['riwayat_penyakit'] <> '') ? $data['riwayat_penyakit'] : '-');
            $document->setValue('Value33', ($data['pengobatan'] <> '') ? $data['pengobatan'] : '-');
            $document->setValue('Value23', ($data['wawancara_psikologis'] <> '') ? $data['wawancara_psikologis'] : '-');
            $document->setValue('Value24', ($data['psikotest'] <> '') ? $data['psikotest'] : '-');
            $document->setValue('Value25', ($data['hasil_psikotes'] <> '') ? $data['hasil_psikotes'] : '-');
            $document->setValue('Value26', ($data['diagnosa'] <> '') ? str_replace('–', '-', $data['diagnosa']) : '-');
            $document->setValue('Value27', ($data['diagnosa_khusus'] <> '') ? $data['diagnosa_khusus'] : '-');
            $document->setValue('Value28', ($data['diagnosa_penyerta'] <> '') ? $data['diagnosa_penyerta'] : '-');
            $document->setValue('Value29', ($data['id_menindak'] <> '') ? $data['id_menindak'] : '-');
            $document->setValue('Value30', ($data['tindakan'] <> '') ? $data['tindakan'] : '-');
            $document->setValue('Value31', ($data['catatan'] <> '') ? $data['catatan'] : '-');
            $document->setValue('Value40', $hasil_intervensi);
            $document->save($filename);
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . $filename);
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filename));
            flush();
            readfile($filename);
            unlink($filename);
            exit;
        } else {
            exit;
        }
        // }
    }

    // akhir cetak

    private function ubahFormatTgl($tgl)
    {
        $convertgl = strtotime($tgl); // Y-m-d => d/m/Y  
        $tgl_ubah = date('d/m/Y', $convertgl);
        return $tgl_ubah;
    }

    private function defaultFormatTgl($tgl)
    {
        $convertgl = explode("/", $tgl); // d/m/Y => Y-m-d
        $tgl_ubah = $convertgl[2] . "-" . $convertgl[1] . "-" . $convertgl[0];
        return $tgl_ubah;
    }

    private function _uploadimage($directori, $file_name)
    {
        $config['upload_path']          = './assets/image/' . $directori . '/';
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

    private function _deleteImage($tabel, $where, $directory)
    {
        $photo = $this->model_adm->getWhere($tabel, $where)->result_array();
        if ($photo[0]['foto'] != "default.png") {
            $filename = explode(".", $photo[0]['foto'])[0];
            return array_map('unlink', glob(FCPATH . "assets/image/" . $directory . "/$filename.*"));
        }
    }

    // aksi

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
                    $$data['message']['photo'] = '<p class="text-danger" style="font-size: 14px;">File photo harus berekstensi *.jpg|*.png|*.jpeg </p>';
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
        echo json_encode($data);
    }


    public function ubahpengguna()
    {
        $id_pengguna = $this->input->post('id');
        $ambilpengguna = $this->model_all->getWhere('tb_pengguna', array('id_pengguna' => $id_pengguna))->result_array();
        $data_pengguna['data_pengguna'] = $ambilpengguna;
        $data_pengguna['base_url'] = base_url('admin/do_ubahpengguna');
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
                    $$data['message']['photo'] = '<p class="text-danger" style="font-size: 14px;">File photo harus berekstensi *.jpg|*.png|*.jpeg </p>';
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

    public function prosesTor()
    {
        $pesan = "";
        if ($this->model_all->updateData('tb_tor', ['role_rab' => $this->input->post('role_tor'), 'cat_rev' => $this->input->post('cat_rev')], ['kode_tor' => $this->input->post('kode_tor')])) $pesan = "success";
        else $pesan = "error";

        sleep(0.5);
        echo json_encode(['pesan' => $pesan]);
    }

    /*
     * get TOR 
     * Ubah TOR menu Daftar TOR
     * user field officer
    */

    public function getTor()
    {
        $id_tor = $this->input->post('id_tor');
        $data_tor = $this->model_all->getWhere('tb_tor', array('kode_tor' => $id_tor))->result_array();
        sleep(0.5);
        echo json_encode($data_tor);
    }

    /*
     * akhir get TOR
     * ----------------------------------------------------------------------------------
    */

    // cetak_bulan

    public function getlaporanbulananadmin()
    {
        $html_data_bulan = '';
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');

        $data_bulan = $this->model_admin->getPasienLaporanBulanan($bulan, $tahun)->result_array();
        $no = 1;
        foreach ($data_bulan as $value) {
            $html_data_bulan .= '<tr>';
            $html_data_bulan .= '<td>' . $no . '</td>';
            $html_data_bulan .= '<td>' . $value['nm_lengkap'] . '</td>';
            $html_data_bulan .= '<td>' . $value['usia'] . '</td>';
            $html_data_bulan .= '<td>' . $value['jk'] . '</td>';
            $html_data_bulan .= '<td>' . $value['diagnosa'] . '</td>';
            $html_data_bulan .= '<td>' . $value['tindakan'] . '</td>';
            $html_data_bulan .= '</tr>';
            $no++;
        }

        $countlakilaki = $this->model_admin->getGrafikrujukBln($bulan, $tahun, 'jk', 'Laki-Laki');
        $countPerempuan = $this->model_admin->getGrafikrujukBln($bulan, $tahun, 'jk', 'Perempuan');
        $countTanseksual = $this->model_admin->getGrafikrujukBln($bulan, $tahun, 'jk', 'Transeksual');
        $countTdkdiketahui = $this->model_admin->getGrafikrujukBln($bulan, $tahun, 'jk', 'Tidak diketahui');
        $countTdkmenentukan = $this->model_admin->getGrafikrujukBln($bulan, $tahun, 'jk', 'Tidak menentukan');
        $countindividu = $this->model_admin->getGrafikrujukBln($bulan, $tahun, 'tindakan', 'Konseling Individu');
        $countkelompok = $this->model_admin->getGrafikrujukBln($bulan, $tahun, 'tindakan', 'Konseling Kelompok');
        $countdokter = $this->model_admin->getGrafikrujukBln($bulan, $tahun, 'tindakan', 'Rujuk ke Dokter');
        $countpsikolog = $this->model_admin->getGrafikrujukBln($bulan, $tahun, 'tindakan', 'Rujuk Psikolog');
        $rowstindakan = [$countindividu, $countkelompok, $countpsikolog, $countdokter];
        $rowsjk = [$countlakilaki, $countPerempuan, $countTanseksual, $countTdkdiketahui, $countTdkmenentukan];

        $data['nm_bulan'] = konversiBulan($bulan) . " " . $tahun;
        $data['cetak'] = $bulan . "+" . $tahun;
        $data['data_bulan'] = $html_data_bulan;
        $data['charttindakan'] = $rowstindakan;
        $data['chartjk'] = $rowsjk;
        echo json_encode($data);
    }

    public function getlaporankasus_tahunadmin()
    {
        $html_data_tahun = '';
        $tahun = $this->input->post('tahun');

        $data_tahun = $this->model_admin->getPasienLaporanTahunan($tahun)->result_array();
        // $no = 1;
        // foreach ($data_tahun as $value) {
        //     $html_data_tahun .= '<tr>';
        //     $html_data_tahun .= '<td>' . $no . '</td>';
        //     $html_data_tahun .= '<td>' . $value['nm_lengkap'] . '</td>';
        //     $html_data_tahun .= '<td>' . $value['usia'] . '</td>';
        //     $html_data_tahun .= '<td>' . $value['jk'] . '</td>';
        //     $html_data_tahun .= '<td>' . $value['diagnosa'] . '</td>';
        //     $html_data_tahun .= '<td>' . $value['tindakan'] . '</td>';
        //     $html_data_tahun .= '</tr>';
        //     $no++;
        // }

        $countlakilaki = $this->model_admin->getGrafikrujukThn($tahun, 'jk', 'Laki-Laki');
        $countPerempuan = $this->model_admin->getGrafikrujukThn($tahun, 'jk', 'Perempuan');
        $countTanseksual = $this->model_admin->getGrafikrujukThn($tahun, 'jk', 'Transeksual');
        $countTdkdiketahui = $this->model_admin->getGrafikrujukThn($tahun, 'jk', 'Tidak diketahui');
        $countTdkmenentukan = $this->model_admin->getGrafikrujukThn($tahun, 'jk', 'Tidak menentukan');
        $countindividu = $this->model_admin->getGrafikrujukThn($tahun, 'tindakan', 'Konseling Individu');
        $countkelompok = $this->model_admin->getGrafikrujukThn($tahun, 'tindakan', 'Konseling Kelompok');
        $countdokter = $this->model_admin->getGrafikrujukThn($tahun, 'tindakan', 'Rujuk ke Dokter');
        $countpsikolog = $this->model_admin->getGrafikrujukThn($tahun, 'tindakan', 'Rujuk Psikolog');
        $rowstindakan = [$countindividu, $countkelompok, $countpsikolog, $countdokter];
        $rowsjk = [$countlakilaki, $countPerempuan, $countTanseksual, $countTdkdiketahui, $countTdkmenentukan];

        $data['nm_tahun'] = $tahun;
        $data['cetak'] = $tahun;
        // $data['data_tahun'] = $html_data_tahun;
        $data['data_tahun'] = $data_tahun;
        $data['charttindakanthn'] = $rowstindakan;
        $data['chartjkthn'] = $rowsjk;
        echo json_encode($data);
    }


    // start grafik

    public function getGrafikpsikolog_rujuk()
    {
        $countkader = $this->model_admin->getGrafikrujukUser('Kader', 'Rujuk Psikolog');
        $rows = [$countkader];
        echo json_encode($rows, JSON_NUMERIC_CHECK);
    }

    public function getGrafikdokter_rujuk()
    {
        $countkader = $this->model_admin->getGrafikrujukUser('Kader', 'Rujuk ke Dokter');
        $countpsikolog = $this->model_admin->getGrafikrujukUser('Psikolog', 'Rujuk ke Dokter');
        $rows = [$countkader, $countpsikolog];

        echo json_encode($rows, JSON_NUMERIC_CHECK);
    }
}
