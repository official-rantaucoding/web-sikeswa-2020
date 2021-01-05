<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_admin extends CI_Model
{
    public function getlayanan_datapasien($tindakan, $get = "")
    {
        $this->db->select('*');
        $this->db->from('tb_assesment as a');
        $this->db->join('tb_pasien as b', 'a.id_pasien = b.id_pasien');
        $this->db->where('a.tindakan', $tindakan);
        if (!empty($get)) $this->db->where('a.id_assesment', $get);
        return $this->db->get();
    }

    public function getlayanan_datapasien_assement($id_pasien)
    {
        $this->db->select('*');
        $this->db->from('tb_assesment as a');
        $this->db->where('a.id_pasien', $id_pasien);
        $this->db->order_by('a.id', 'DESC');
        return $this->db->get();
    }

    public function getlayanan_datapasien_assesment_all($id_pasien)
    {
        $this->db->select('*');
        $this->db->from('tb_assesment as a');
        $this->db->where('a.id_pasien', $id_pasien);
        $this->db->order_by('a.no_urut_assesment', 'DESC');
        return $this->db->get();
    }

    public function getlayanan_datapasien_rekamedis($id_pasien)
    {
        $this->db->select('*');
        $this->db->from('tb_rekammedis as a');
        $this->db->where('a.id_pasien', $id_pasien);
        $this->db->order_by('a.no_urut_rekam', 'ASC');
        return $this->db->get();
    }

    public function getlayanan_rujukan_admin($id_menindak, $get = "")
    {
        $this->db->select('*');
        $this->db->from('tb_assesment as a');
        $this->db->join('tb_pasien as b', 'a.id_pasien = b.id_pasien');
        $this->db->where('a.id_menindak', $id_menindak);
        if (!empty($get)) $this->db->where('a.id_assesment', $get);
        return $this->db->get();
    }
    public function getrujukan_psikolog_dokter($tindakan)
    {
        $this->db->select('month(tgl_assesment) as bulan');
        $this->db->select('year(tgl_assesment) as tahun');
        $this->db->from('tb_assesment as a');
        $this->db->where('a.tindakan', $tindakan);
        $this->db->group_by('month(tgl_assesment)');
        $this->db->group_by('year(tgl_assesment)');
        $this->db->order_by('year(tgl_assesment)', 'asc');
        $this->db->order_by('month(tgl_assesment)', 'asc');
        return $this->db->get();
    }

    public function getLaporanBulanan()
    {
        $this->db->select('month(tgl_assesment) as bulan');
        $this->db->select('year(tgl_assesment) as tahun');
        $this->db->from('tb_assesment');
        $this->db->group_by('month(tgl_assesment)');
        $this->db->group_by('year(tgl_assesment)');
        $this->db->order_by('year(tgl_assesment)', 'asc');
        $this->db->order_by('month(tgl_assesment)', 'asc');
        return $this->db->get();
    }

    public function getPasienLaporanBulanan($bulan_apa, $tahun_apa, $getid = "", $tindakan = "")
    {
        $this->db->select('*');
        $this->db->from('tb_assesment as a');
        $this->db->join('tb_pasien as b', 'a.id_pasien = b.id_pasien');
        $this->db->where('month(tgl_assesment)', $bulan_apa);
        $this->db->where('year(tgl_assesment)', $tahun_apa);

        if ($getid == "bulan") {
            $this->db->where('a.id_menindak', $tindakan);
        } else if ($getid == "rujuk") {
            $this->db->where('a.tindakan', $tindakan);
        }

        $this->db->order_by('month(tgl_assesment)', 'desc');
        $this->db->order_by('year(tgl_assesment)', 'desc');
        return $this->db->get();
    }


    public function getLaporanTahun()
    {
        $this->db->select('year(tgl_assesment) as tahun');
        $this->db->from('tb_assesment');
        $this->db->group_by('year(tgl_assesment)');
        $this->db->order_by('year(tgl_assesment)', 'asc');
        return $this->db->get();
    }

    public function getPasienLaporanTahunan($tahun_apa, $tindakan = "")
    {
        $this->db->select('*');
        $this->db->from('tb_assesment as a');
        $this->db->join('tb_pasien as b', 'a.id_pasien = b.id_pasien');
        $this->db->where('year(tgl_assesment)', $tahun_apa);
        if (!empty($tindakan)) $this->db->where('a.id_menindak', $tindakan);
        $this->db->order_by('year(tgl_assesment)', 'asc');
        return $this->db->get();
    }

    public function getGrafikrujukUser($user_rujuk, $tindakan)
    {
        $this->db->select('*');
        $this->db->from('tb_assesment');
        $this->db->where('id_menindak', $user_rujuk);
        $this->db->where('tindakan', $tindakan);
        return $this->db->get()->num_rows();
    }

    public function getGrafikrujukBln($bulan, $tahun, $field, $nilai)
    {
        $this->db->select('*');
        $this->db->from('tb_assesment as a');
        $this->db->join('tb_pasien as b', 'a.id_pasien = b.id_pasien');
        $this->db->where('month(tgl_assesment)', $bulan);
        $this->db->where('year(tgl_assesment)', $tahun);
        $this->db->where($field, $nilai);

        return $this->db->get()->num_rows();
    }

    public function cekgetGrafikdiagnosaBln($bulan, $tahun)
    {
        $this->db->select('*');
        $this->db->from('tb_assesment as a');
        $this->db->join('tb_pasien as b', 'a.id_pasien = b.id_pasien');
        $this->db->where('month(tgl_assesment)', $bulan);
        $this->db->where('year(tgl_assesment)', $tahun);
        $this->db->group_by('a.diagnosa');

        return $this->db->get();
    }

    public function getGrafikdiagnosaBln($bulan, $tahun, $nilai)
    {
        $this->db->select('*');
        $this->db->from('tb_assesment as a');
        $this->db->join('tb_pasien as b', 'a.id_pasien = b.id_pasien');
        $this->db->where('month(tgl_assesment)', $bulan);
        $this->db->where('year(tgl_assesment)', $tahun);
        $this->db->like('a.diagnosa', $nilai, 'both');

        return $this->db->get();
    }

    public function cekgetGrafikdiagnosaThn($tahun)
    {
        $this->db->select('*');
        $this->db->from('tb_assesment as a');
        $this->db->join('tb_pasien as b', 'a.id_pasien = b.id_pasien');
        $this->db->where('year(tgl_assesment)', $tahun);
        $this->db->group_by('a.diagnosa');

        return $this->db->get();
    }

    public function getGrafikdiagnosaThn($tahun, $nilai)
    {
        $this->db->select('*');
        $this->db->from('tb_assesment as a');
        $this->db->join('tb_pasien as b', 'a.id_pasien = b.id_pasien');
        $this->db->where('year(tgl_assesment)', $tahun);
        $this->db->like('a.diagnosa', $nilai, 'both');

        return $this->db->get();
    }

    public function getGrafikrujukThn($tahun, $field, $nilai)
    {
        $this->db->select('*');
        $this->db->from('tb_assesment as a');
        $this->db->join('tb_pasien as b', 'a.id_pasien = b.id_pasien');
        $this->db->where('year(tgl_assesment)', $tahun);
        $this->db->where($field, $nilai);

        return $this->db->get()->num_rows();
    }


    // tambahan ubah asessment
    public function getdatapasienassesment($id_pasien)
    {
        $this->db->select('*');
        $this->db->from('tb_pasien as a');
        $this->db->join('tb_assesment as b', 'a.id_pasien = b.id_pasien');
        $this->db->where('a.id_pasien', $id_pasien);
        $this->db->order_by('b.role_assesment', 'DESC');
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

    public function cekRekamSebelumnya($id_pasien)
    {
        $this->db->where('id_pasien', $id_pasien);
        $this->db->order_by('role_rekam', 'DESC');
        return $this->db->get('tb_rekammedis');
    }

    // cetak aktifitas
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
        $this->db->order_by('c.nm_lengkap', 'ASC');
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
    //tutup cetak
}
