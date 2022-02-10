<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\PegadaianModel;
use FontLib\Table\Type\head;
use PHPExcel;
use PHPExcel_IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Excel extends Controller
{
    protected $PegadaianModel;

    public function __construct()
    {
        $this->PegadaianModel = new PegadaianModel();
    }


    public function index()
    {
        // return view('excel');
    }

    public function tes()
    {
        $datagadai = new PegadaianModel();
        $cek_cabang_user = session('kode_cabang');
        $kode_cabang = (!empty($_GET['kode_cabang'])) ? $_GET['kode_cabang'] : $cek_cabang_user;

        $data_gadai = $datagadai->getDataGadaiLaporan($kode_cabang);
        foreach ($data_gadai as $key) {
            $cek_ = '';
            // SELECT * FROM `pinjamangadai` WHERE tgl_jatuh_tempo >= date(NOW()) && tgl_jatuh_tempo <= date(NOW()) + 1
            // $cek_ = $key->tgl_jatuh_tempo == date('Y-m-d') ? 'mark' : 'none';

            $hari_esok = date('Y-m-d', strtotime("+1 day"));
            if ($key->tgl_jatuh_tempo == date('Y-m-d')) {
                $cek_ = 'danger text-white';
            } elseif ($key->tgl_jatuh_tempo == $hari_esok) {
                $cek_ = 'warning text-white';
            } elseif ($key->tgl_jatuh_tempo < date('Y-m-d') && $key->status_bayar != 'Lunas') {
                $cek_ = 'dark';
            } elseif ($key->status_bayar == 'Lunas') {
                $cek_ = 'success';
            } else {
                $cek_ = 'default';
            }
            $key->pendapatan_denda = $datagadai->cek_pendapatan_peminjaman('Denda', $key->kode_pinjaman)->jumlah_untung;
            $key->pendapatan_lelang = $datagadai->cek_pendapatan_peminjaman('Lelang', $key->kode_pinjaman)->jumlah_untung;
            $key->total_pendapatan_bersih = $key->bunga + $key->pendapatan_denda + $key->pendapatan_lelang;
            $key->jatuh_tempo_now = $cek_;
        }
        $data = [
            'title' => 'Data gadai tes',
            'gadai' => $data_gadai,
        ];
        return view('Laporan/tes', $data);
    }

    public function export()
    {
        helper('currency');

        $datagadai = new PegadaianModel();
        $cek_cabang_user = session('kode_cabang');
        $kode_cabang = (!empty($_GET['kode_cabang'])) ? $_GET['kode_cabang'] : $cek_cabang_user;
        // http: //localhost:8080/laporanexcel/export?key=&tanggal_start=2022-01-01&tanggal_end=2022-01-01
        $tanggal_start = @$_GET['tanggal_start'];
        $tanggal_end = @$_GET['tanggal_end'];
        $gadai = $datagadai->getDataGadai($kode_cabang, '', $tanggal_start, $tanggal_end);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $spreadsheet->getProperties()->setCreator("FLOBAMORA GADAI");
        $spreadsheet->getProperties()->setLastModifiedBy("FLOBAMORA GADAI");
        $spreadsheet->getProperties()->setTitle("Data Pegadaian");

        //STYLING ARRAY
        //TABLE HEAD STYLE 
        $tableHead = [
            'font' => [
                'color' => [
                    'rgb' => 'FFFFFF'
                ],
                'bold' => true,
                'size' => 12
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => '538ED5'
                ]
            ],
        ];

        //EVEN ROW
        $evenRow = [
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => '00BDFF'
                ]
            ]
        ];

        $oddRow = [
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => '00EAFF'
                ]
            ]
        ];
        //STYLING END

        //HEADING
        $spreadsheet->getActiveSheet()
            ->setCellValue('A1', 'LAPORAN BARANG TERLELANG');

        //MERGE HEADING
        $spreadsheet->getActiveSheet()->mergeCells("A1:M1");
        $spreadsheet->getActiveSheet()->mergeCells("O1:P1");

        //SET FONT STYLE
        $spreadsheet->getActiveSheet()->setCellValue('A1', 'LAPORAN BARANG TERLELANG');
        $spreadsheet->getActiveSheet()->setCellValue('O1', 'TOTAL SEMUA');

        //MERGE HEADING
        $spreadsheet->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
        $spreadsheet->getActiveSheet()->getStyle('O1')->getFont()->setSize(20);

        //SET CELL ALIGNMENT
        $spreadsheet->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()->getStyle('O1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()->getStyle('A2:2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        //SET COLUMN WIDTH
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(15);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')G->setWidth(15);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(25);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(15);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(18);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(18);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(14);

        //header/nama kolom
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A2', "No")
            ->setCellValue('B2', "Kode Pinjaman")
            ->setCellValue('C2', 'Nama Nasabah')
            ->setCellValue('D2', 'Jenis Barang')
            ->setCellValue('E2', "Tgl Lelang")
            ->setCellValue('F2', 'Total Pendapatan')
            ->setCellValue('G2', 'Kode Cabang');

        $spreadsheet->getActiveSheet()->getStyle('A2:G2')->getFont()->setSize(12);
        $spreadsheet->getActiveSheet()->getStyle('A2:G2')->getFont()->setBold(true);

        //SET FONT STYLE AND BACKGROUND
        $spreadsheet->getActiveSheet()->getStyle('A2:G2')->applyFromArray($tableHead);

        $row = 3;
        //data gadai ke cell
        foreach ($gadai as $key => $data) {
            $data_cek_dendanya = $this->PegadaianModel->cek_pendapatan_peminjaman('Denda', $data->kode_pinjaman)->jumlah_untung;
            $data_cek_lelangya = $this->PegadaianModel->cek_pendapatan_peminjaman('Lelang', $data->kode_pinjaman)->jumlah_untung;

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $row, $key + 1)
                ->setCellValue('B' . $row, $data->kode_pinjaman)
                ->setCellValue('C' . $row, $data->nama)
                ->setCellValue('D' . $row, $data->nama_barang)            
                ->setCellValue('E' . $row, $data->tgl_lelang)
                ->setCellValue('F' . $row, ($data->bunga + $data_cek_dendanya + $data_cek_lelangya))
                ->setCellValue('G' . $row, $data->kode_cabang);

            //SET row STYLE
            if ($row % 2 == 0) {
                //even row
                $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':G' . $row)->applyFromArray($evenRow);
                $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':G' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            } else {
                //odd row
                $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':G' . $row)->applyFromArray($oddRow);
                $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':G' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            }

            $row++;
        }

        //COLUMN SUM Kolom L Dan M
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('O2', "TOTAL PENDAPATAN Lelang =")
            ->setCellValue('P2', '=SUM(F3:F' . ($row - 1) . ')');

        $writer = new Xlsx($spreadsheet);
        $filename = 'Data Pegadaian';

        header('Conten-Type: application/vnd.openxmlformats-officedocument.soreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}