<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_log extends CI_Model
{

	public function in_verifikasi($username, $password)
	{
		$this->db->select('*');
		$this->db->from('tb_pengguna');
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$this->db->where('status', 'Aktif');
		return $this->db->get();
	}
}