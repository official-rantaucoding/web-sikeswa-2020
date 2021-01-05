<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

function getDiagnosaKode_chart() {
	return array('F00 – F09','F10','F12','F13','F14','F15','F16','F17','F18','F19','F20.1','F20.2','F20.3','F20.4','F21','F22','F23','F24','F25.0','F25.1','F25.2','F30','F31','F32.0','F32.1','F32.2','F32.3','F33','F40.0','F40.1','F41.0','F41.1','F41.2','F42','F43.0','F43.1','F43.8','F44','F45.0','F45.1','F45.2','F50','F51','F54','F60.0','F60.1','F60.2','60.3','F60.4','F60.5','F60.5','F60.6','F60.7','F60.8','F70','F71','F72',' F73','F80','F81',' F82',' F83','F84','F91.0','F91.1',' F91.2','F91.3','F93.0','F93.1','F93.2','F93.3','F93.8','F98.0','F98.1','F98.2','F98.3','F98.4','F98.5','F98.6');
}

function getJenisKelamin_chart() {
    return array("Laki-Laki","Perempuan","Transeksual","Tidak diketahui","Tidak menentukan");
}

function getTindakan_chart() {
    return array('Konseling Individu','Konseling Kelompok','Rujuk ke Dokter','Rujuk Psikolog');
}

function getPendidikan_chart() {
    return array('SD','SMP','SMA','DI','DII','DIII','DIV','S1','S2','S3','Tidak Sekolah','Belum Sekolah');
}

function getPosition($pieX, $pieY, $r, $legendX, $legendY, $labelY, $captionLabelY)
{
	return array(
        'pieX' => $pieX, 
        'pieY' => $pieY, 
        'r' => $r, 
        'legendX' => $legendX, 
        'legendY' => $legendY, 
        'labelY' => $labelY,
        'captionLabelY' => $captionLabelY,
    );
}

function getColor_chart($num) {
    $hash = md5('color' . $num);
    return array(
        hexdec(substr($hash, 5, 2)), // r
        hexdec(substr($hash, 2, 2)), // g
        hexdec(substr($hash, 4, 2))); //b
}