<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

function konversiBulan($angka)
{
    $bulan = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
    $index = $angka - 1;
    return $bulan[$index];
}

function konversiTanggaleng($tanggal)
{
    return date('d F Y', strtotime($tanggal));
}

function konversiTanggalid($tanggal){
	$bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);
	
	// variabel pecahkan 0 = tahun
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tanggal

	return ($tanggal != '0000-00-00') ? $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0] : $tanggal;
}

function konversiChar($char)
{
    return iconv('UTF-8', 'windows-1252', $char);
}
