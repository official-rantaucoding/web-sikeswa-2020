<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_user extends CI_Model
{
    public function getlayananKonseling($id)
    {
        $this->db->select('*');
        $this->db->from('tb_assesment as a');
        $this->db->join('tb_pasien as b', 'a.id_pasien = b.id_pasien');
        $this->db->where('a.tindakan', $id);
        return $this->db->get();
    }

    public function cekidasessment($id_asessment)
    {
        $this->db->where('id_assesment', $id_asessment);
        return $this->db->get('tb_assesment')->num_rows();
    }

    public function getlayananrujukan($id)
    {
        $this->db->select('*');
        $this->db->from('tb_assesment as a');
        $this->db->join('tb_pasien as b', 'a.id_pasien = b.id_pasien');
        $this->db->where('a.tindakan_assement', 0);
        $this->db->where('a.tindakan', $id);
        return $this->db->get();
    }

    public function getlayananrujukanDokter_konseling()
    {
        $this->db->select('b.id_assesment');
        $this->db->select('b.id_pasien');
        $this->db->select('b.tindakan');
        $this->db->select('b.diagnosa');
        $this->db->select('a.hasil_akhir');
        $this->db->select('a.catatan as catatankonseling');
        $this->db->select('c.no_rekam_medis');
        $this->db->select('c.nm_lengkap');
        $this->db->select('c.alamat');
        $this->db->select('c.tgl_lahir');
        $this->db->from('tb_rekammedis as a');
        $this->db->join('tb_assesment as b', 'a.id_assesment = b.id_assesment');
        $this->db->join('tb_pasien as c', 'b.id_pasien = c.id_pasien');
        $this->db->where('a.hasil_akhir', 'Rujukan ke Dokter / Dokter Spesialis');
        $this->db->where('b.tindakan_assement', 0);
        return $this->db->get();
    }

    public function getdataAsessment_rekammedis($id_asessment)
    {
        $this->db->select('*');
        $this->db->from('tb_assesment as a');
        $this->db->join('tb_pasien as b', 'a.id_pasien = b.id_pasien');
        $this->db->where('a.id_assesment', $id_asessment);
        return $this->db->get();
    }

    public function getdatapasienassesment($id_pasien)
    {
        $this->db->select('*');
        $this->db->from('tb_pasien as a');
        $this->db->join('tb_assesment as b', 'a.id_pasien = b.id_pasien');
        $this->db->where('a.id_pasien', $id_pasien);
        $this->db->order_by('b.role_assesment', 'DESC');
        return $this->db->get();
    }

    public function getdata_konseling($id_pasien, $id_konseling)
    {
        $this->db->select('*');
        $this->db->from('tb_pasien as a');
        $this->db->join('tb_assesment as b', 'a.id_pasien = b.id_pasien');
        $this->db->where('a.id_pasien', $id_pasien);
        $this->db->where('b.tindakan', $id_konseling);
        $this->db->order_by('b.role_assesment', 'DESC');
        return $this->db->get();
    }

    public function getdata_aktifitas($id_aktifitas)
    {
        $this->db->select('*');
        $this->db->from('tb_aktivitas as a');
        $this->db->where('a.kd_aktiv', $id_aktifitas);
        return $this->db->get();
    }

    public function getdata_pesertaaktifitas($id_aktifitas)
    {
        $this->db->select('c.no_pendaftaran');
        $this->db->select('c.nm_lengkap');
        $this->db->select('c.agama');
        $this->db->select('c.alamat');
        $this->db->select('c.pendidikan');
        $this->db->select('c.pekerjaan');
        $this->db->select('c.usia');
        $this->db->from('tb_aktivitas as a');
        $this->db->join('aktivitas_nmpeserta as b', 'a.id_peserta = b.kode_peserta');
        $this->db->join('tb_pendaftaran as c', 'b.id_pendaftaran = c.id_pendaftaran');
        $this->db->where('a.kd_aktiv', $id_aktifitas);
        return $this->db->get();
    }

    public function getdata_dokumentasiaktifitas($id_aktifitas)
    {
        $this->db->select('*');
        $this->db->from('tb_aktivitas as a');
        $this->db->join('aktivitas_dokumentasi as b', 'a.id_dokumentasi = b.id_dokumentasi');
        $this->db->where('a.kd_aktiv', $id_aktifitas);
        return $this->db->get();
    }

    public function getdatajudultor_aktifitas($judul_tor)
    {
        $this->db->like('judul_tor', $judul_tor, 'both');
        return $this->db->get('tb_tor');
    }

    public function cekAssesmentSebelumnya($id_pasien)
    {
        $this->db->where('id_pasien', $id_pasien);
        $this->db->order_by('role_assesment', 'DESC');
        return $this->db->get('tb_assesment');
    }

    public function cekRekamSebelumnya($id_pasien)
    {
        $this->db->where('id_pasien', $id_pasien);
        $this->db->order_by('role_rekam', 'DESC');
        return $this->db->get('tb_rekammedis');
    }

    public function cekselesaiKonseling($id_pasien)
    {
        $this->db->where('id_pasien', $id_pasien);
        $this->db->where('hasil_akhir', 'Selesai');
        return $this->db->get('tb_rekammedis')->num_rows();
    }

    public function cekpernahKonseling($id_pasien)
    {
        $this->db->where('id_pasien', $id_pasien);
        return $this->db->get('tb_rekammedis')->num_rows();
    }

    public function cekpernahKonselingdua($id_pasien, $type)
    {
        $tabel = '';
        $this->db->where('id_pasien', $id_pasien);
        if ($type == "rekam") {
            $tabel = "tb_rekammedis";
        } elseif ($type = "assesment") {
            $tabel = "tb_assesment";
            $this->db->where('tindakan', "Konseling Individu");
            $this->db->or_where('tindakan', "Konseling Kelompok");
        }

        return $this->db->get($tabel)->num_rows();
    }


    // notifikasi rujukan

    public function count_rujukan($id_rujuk)
    {
        $this->db->where('tindakan', $id_rujuk);
        $this->db->where('tindakan_assement', 0);
        return $this->db->get('tb_assesment')->num_rows();
    }

    public function delete_pasien($id_pasien, $tabel)
    {
        $this->db->where('id_pasien', $id_pasien);
        return $this->db->delete($tabel);
    }

    public function cek_pasien($id_pasien, $tabel)
    {
        $this->db->where('id_pasien', $id_pasien);
        return $this->db->get($tabel)->num_rows();
    }

    public function search_pasien_lama($key)
    {
        $this->db->like('nm_lengkap', $key, 'both');
        $this->db->order_by('id', 'DESC');
        return $this->db->get('tb_pasien');
    }
}
