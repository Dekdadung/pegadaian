<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\PegadaianModel;
use FontLib\Table\Type\head;
use PHPExcel;
use PHPExcel_IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Excel extends Controller
{
    public function index()
    {
        return view('excel');
    }

    public function export()
    {
        $datagadai = new PegadaianModel();
        $gadai = $datagadai->findAll();

        $spreadsheet = new Spreadsheet();

        $spreadsheet->getProperties()->setCreator("FLOBAMORA GADAI");
        $spreadsheet->getProperties()->setLastModifiedBy("FLOBAMORA GADAI");
        $spreadsheet->getProperties()->setTitle("Data Pegadaian");


        //header/nama kolom
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Kode Pinjaman')
            ->setCellValue('B1', 'Nama Nasabah')
            ->setCellValue('C1', 'Tgl Gadai')
            ->setCellValue('D1', 'Jatuh Tempo')
            ->setCellValue('E1', 'Tgl Lelang')
            ->setCellValue('F1', 'Jumlah Pinjaman')
            ->setCellValue('G1', 'Kode Cabang');

        $column = 2;

        //data gadai ke cell
        foreach ($gadai as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $data['kode_pinjaman'])
                ->setCellValue('B' . $column, $data['id_nasabah'])
                ->setCellValue('C' . $column, $data['tgl_gadai'])
                ->setCellValue('D' . $column, $data['tgl_jatuh_tempo'])
                ->setCellValue('E' . $column, $data['tgl_lelang'])
                ->setCellValue('F' . $column, $data['jumlah_pinjaman'])
                ->setCellValue('G' . $column, $data['kode_cabang']);

            $column++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'Data Pegadaian';

        header('Conten-Type: application/vnd.openxmlformats-officedocument.soreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
