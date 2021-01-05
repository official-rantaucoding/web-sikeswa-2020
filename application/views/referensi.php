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
            $pdf->MultiCell(0,7,konversiChar(substr($data_aktifivitas['nm_aktivitas'], 7)),0,'C',0,0);

            $pdf->Ln(7);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(0, 7, 'A. Nama Kegiatan ', 0, 1, 'L');
            $pdf->SetFont('Times', '', 12);
            $pdf->MultiCell(0,7,konversiChar(substr($data_aktifivitas['nm_aktivitas'], 7)),0,'J',0,15); 

            $pdf->Ln(6);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(0, 7, 'B. Latar Belakang ', 0, 1, 'L');
            $pdf->SetFont('Times', '', 12);
            $pdf->MultiCell(0,7,($data_tor <> null) ? konversiChar($data_tor[0]['ltr_belakang']): '-',0,'J',0,15);
            
            $pdf->Ln(6);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(0, 7, 'C. Tujuan ', 0, 1, 'L');
            $pdf->SetFont('Times', '', 12);
            $pdf->MultiCell(0,7,($data_tor <> null) ? konversiChar($data_tor[0]['tujuan']): '-',0,'J',0,15);

            $pdf->Ln(6);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(0, 7, 'D. Waktu Pelaksanaan', 0, 1, 'L');
            $pdf->Cell(0, 7, 'Tanggal Mulai', 0, 1, 'L');
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(0, 7, $data_aktifivitas['tgl'], 0, 1, 'L');
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(0, 7, 'Tanggal Selesai', 0, 1, 'L');
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(0, 7, $data_aktifivitas['tgl_selesai'], 0, 1, 'L');

            $pdf->Ln(6);
            $pdf->SetFont('Times', 'B', 12);    
            $pdf->Cell(0, 7, 'E. Peserta ', 0, 1, 'L');
            $pdf->SetFont('Times', '', 12);
            $pdf->MultiCell(0,7,konversiChar(substr($data_aktifivitas['jml_peserta'], 7))."8 Orang",0,'J',0,0);

            $pdf->Ln(6);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(0, 7, 'F. Hasil Kegiatan ', 0, 1, 'L');
            $pdf->SetFont('Times', '', 12);
            $pdf->MultiCell(0,7,konversiChar(substr($data_aktifivitas['notulensi'], 7)),0,'J',0,15);

            $pdf->Ln(6);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(0, 7, 'G. Alokasi Dana ', 0, 1, 'L');
            $pdf->SetFont('Times', '', 12);
            $pdf->MultiCell(0,7,konversiChar(substr($data_aktifivitas['dana'], 7)),0,'J',0,15);

            $pdf->AddPage('P', 'A4');
            $pdf->SetMargins(20, 47, 20);
            $pdf->SetAutoPageBreak(true, 40);
            $pdf->SetFont('Times', 'B', 14);
            $pdf->Cell(0, 7, 'LAMPIRAN', 0, 1, 'C');

            $pdf->Ln(7);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(0, 7, 'H. Data Peserta Kegiatan :', 0, 1, 'L');
            
            $pdf->Ln(3);
            $pdf->SetFont('Times', '', 12);
            $pdf->SetWidths(array(8, 32, 30, 20, 22, 23, 21, 14));
            $pdf->SetAligns(array("L", "L", "L", "L", "L", "L","L","Ln"));
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
            $pdf->Cell(0, 7, 'I. Dokumentasi Kegiatan :', 0, 1, 'L');
            $pdf->Ln(3);

            $positionX = 20;
            $positionY = 70;
            $pX = 20;
            // $rows = $dokumentasi->num_rows();
            $rows = 0;
            foreach ($dokumentasi->result_array() as $value) {
                $rows++;
                if ($rows > 0 && $rows <= 2) {
                    $pdf->Image(base_url('assets/image/img_dok_aktivitas/'.$value['gambar']), $positionX, $positionY, 84, 64, 'png');
                    $positionX += 87;
                }

                if ($rows > 2 && $rows <= 4) {
                    $pY = $positionY + 67;
                    $pdf->Image(base_url('assets/image/img_dok_aktivitas/'.$value['gambar']), $pX, $pY, 84, 64, 'png');
                    $pX += 87;
                }

                if ($rows == 5) {
                    $positionX = 20;
                    $pY = $positionY + 134;
                    $pdf->Image(base_url('assets/image/img_dok_aktivitas/'.$value['gambar']), $positionX, $pY, 84, 64, 'png');
                }
            }

            $pdf->Output("Laporan-Kegiatan.pdf", "I");


            psikolog :

            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>Usia</th>
                    <th>Jenis Kelamin</th>
                    <th>Tindakan</th>
                    <th>Diagnosa</th>
                    <th>Tanggal Inputan Pasien</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php $no = 1;
                foreach ($rujukan_psikolog as $value) { ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $value['nm_lengkap'] ?></td>
                        <td><?= $value['usia'] ?></td>
                        <td><?= $value['jk'] ?></td>
                        <td><?= $value['tindakan'] ?></td>
                        <td><?= $value['diagnosa'] ?></td>
                        <td><?= $value['tgl_assesment'] ?></td>
                        <td>
                            <a href="<?= base_url('admin/cetak_psikolog/') . encrypt_url($value['id_assesment']); ?>" target="_blank" class="btn btn-danger btn-sm"><i class="fas fa-print"></i> Cetak</a>
                        </td>
                    </tr>
                <?php $no++;
                } ?>
            </tbody>

            Dokter : 

             <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>Usia</th>
                    <th>Jenis Kelamin</th>
                    <th>Tindakan</th>
                    <th>Diagnosa</th>
                    <th>Tanggal Inputan Pasien</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php $no = 1;
                foreach ($rujukan_dokter as $value) { ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $value['nm_lengkap'] ?></td>
                        <td><?= $value['usia'] ?></td>
                        <td><?= $value['jk'] ?></td>
                        <td><?= $value['tindakan'] ?></td>
                        <td><?= $value['diagnosa'] ?></td>
                        <td><?= $value['tgl_assesment'] ?></td>
                        <td>
                            <a href="<?= base_url('admin/cetak_dokter/') . encrypt_url($value['id_assesment']); ?>" target="_blank" class="btn btn-danger btn-sm"><i class="fas fa-print"></i> Cetak</a>
                        </td>
                    </tr>
                <?php $no++;
                } ?>
            </tbody>