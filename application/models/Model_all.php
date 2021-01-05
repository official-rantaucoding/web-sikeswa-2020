<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_all extends CI_Model
{
	public function _kode_otomatis($tabelName, $orderby, $field, $huruf)
	{

		$this->db->select('Right(' . $tabelName . '.' . $field . ',5) as kode ', false);
		$this->db->order_by($orderby, 'DESC');
		$this->db->limit(1);

		$query = $this->db->get($tabelName);
		if ($query->num_rows() <> 0) {
			$data = $query->row();
			$kode = intval($data->kode) + 1;
		} else {
			$kode = 1;
		}

		$kodemax = str_pad($kode, 5, "0", STR_PAD_LEFT);
		$hasil_kode  = $huruf . $kodemax;
		return $hasil_kode;
	}

	public function _kode_otomatis_rekamedis()
	{

		$this->db->select('Right(tb_pasien.no_rekam_medis,5) as kode ', false);
		$this->db->like('no_rekam_medis', 'RMS-', 'both');
		$this->db->order_by('id', 'DESC');
		$this->db->limit(1);

		$query = $this->db->get('tb_pasien');
		if ($query->num_rows() <> 0) {
			$data = $query->row();
			$kode = intval($data->kode) + 1;
		} else {
			$kode = 1;
		}

		$huruf = 'RMS-' . date('Ymd');
		$kodemax = str_pad($kode, 5, "0", STR_PAD_LEFT);
		$hasil_kode  = $huruf . $kodemax;
		return $hasil_kode;
	}


	public function getAll($tabel)
	{
		return $this->db->get($tabel);
	}

	public function getWhere($tabel, $where)
	{
		return $this->db->get_where($tabel, $where);
	}

	public function getGroup($tabel, $field)
	{
		$this->db->group_by($field);
		return $this->db->get($tabel);
	}

	public function insertData($tabel, $data)
	{
		return $this->db->insert($tabel, $data);
	}

	public function updateData($tabel, $data, $where)
	{
		$this->db->where($where);
		return $this->db->update($tabel, $data);
	}

	public function deleteData($tabel, $where)
	{
		$this->db->where($where);
		return $this->db->delete($tabel);
	}

	// grafik

	public function getGrafik_dashboard($field, $nilai)
	{
		$this->db->select($field);
		$this->db->from('tb_pasien');
		$this->db->where($field, $nilai);
		return $this->db->get()->num_rows();
	}

	public function getGrafik_dashboard_umur($paramI, $nilaiI, $paramII = "", $nilaiII = "")
	{
		$this->db->select('usia');
		$this->db->from('tb_pasien');
		if (empty($paramII) && empty($nilaiII)) $this->db->where($paramI, $nilaiI);
		else {
			$this->db->where($paramI, $nilaiI);
			$this->db->where($paramII, $nilaiII);
		}

		return $this->db->get()->num_rows();
	}
}
