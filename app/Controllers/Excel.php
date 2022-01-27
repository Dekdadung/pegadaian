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
    public function index()
    {
        return view('excel');
    }

    public function export()
    {
        helper('currency');

        $datagadai = new PegadaianModel();
        $cek_cabang_user = session('kode_cabang');
        $kode_cabang = (!empty($_GET['kode_cabang'])) ? $_GET['kode_cabang'] : $cek_cabang_user;

        $gadai = $datagadai->getDataGadai($kode_cabang);

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
            ->setCellValue('A1', 'LAPORAN GADAI');

        //MERGE HEADING
        $spreadsheet->getActiveSheet()->mergeCells("A1:G1");

        //SET FONT STYLE
        $spreadsheet->getActiveSheet()->setCellValue('A1', 'LAPORAN GADAI');

        //MERGE HEADING
        $spreadsheet->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);

        //SET CELL ALIGNMENT
        $spreadsheet->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        //SET COLUMN WIDTH
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(15);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(33);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(13);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(13);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(13);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(13);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(14);


        //header/nama kolom
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A2', "Kode Pinjaman")
            ->setCellValue('B2', 'Nama Nasabah')
            ->setCellValue('C2', 'Tgl Gadai')
            ->setCellValue('D2', 'Jatuh Tempo')
            ->setCellValue('E2', "Tgl Lelang")
            ->setCellValue('F2', 'Jumlah Pinjaman')
            ->setCellValue('F2', 'Bunga')
            ->setCellValue('G2', 'Kode Cabang');

        $spreadsheet->getActiveSheet()->getStyle('A2:G2')->getFont()->setSize(12);
        $spreadsheet->getActiveSheet()->getStyle('A2:G2')->getFont()->setBold(true);

        //SET FONT STYLE AND BACKGROUND
        $spreadsheet->getActiveSheet()->getStyle('A2:G2')->applyFromArray($tableHead);

        $row = 3;
        //data gadai ke cell
        foreach ($gadai as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $row, $data->kode_pinjaman)
                ->setCellValue('B' . $row, $data->nama)
                ->setCellValue('C' . $row, $data->tgl_gadai)
                ->setCellValue('D' . $row, $data->tgl_jatuh_tempo)
                ->setCellValue('E' . $row, $data->tgl_lelang)
                ->setCellValue('F' . $row, rupiah($data->jumlah_pinjaman))
                ->setCellValue('F' . $row, rupiah($data->bunga))
                ->setCellValue('G' . $row, $data->kode_cabang);

            //SET row STYLE
            if ($row % 2 == 0) {
                //even row
                $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':G' . $row)->applyFromArray($evenRow);
            } else {
                //odd row
                $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':G' . $row)->applyFromArray($oddRow);
            }

            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'Data Pegadaian';

        header('Conten-Type: application/vnd.openxmlformats-officedocument.soreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}