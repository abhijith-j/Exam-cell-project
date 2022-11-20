<?php
session_start();

include_once 'backend/databaseconnect.php';

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

if(isset($_POST['export_btn'])){
    $extension=$_POST['export_file'];
    $fileName="Duty-sheet".time();

    $selectquery="SELECT * FROM list";
    $runquery=mysqli_query($conn,$selectquery);
    
    if(mysqli_num_rows($runquery)>0)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'STAFF ID');
        $sheet->setCellValue('B1', 'NAME');
        $sheet->setCellValue('C1', 'EXAM DATE');
        $sheet->setCellValue('D1', 'CLASS');

        $rowCount=2;
        foreach($runquery as $data)
        {
            $sheet->setCellValue('A' . $rowCount, $data['empid']);
            $sheet->setCellValue('B' . $rowCount, $data['name']);
            $sheet->setCellValue('C' . $rowCount, $data['exdate']);
            $sheet->setCellValue('D' . $rowCount, $data['exclass']);
            $rowCount++;
        }

        if($extension == 'xlsx')
        {
            $writer = new Xlsx($spreadsheet);
            $final_filename= $fileName.'.xlsx';
        }
        elseif($extension == 'xls')
        {
            $writer = new Xls($spreadsheet);
            $final_filename= $fileName.'.xls';
        }
        elseif($extension == 'csv')
        {
            $writer = new Csv($spreadsheet);
            $final_filename= $fileName.'.csv';
        }

        //$writer->save($final_filename);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.urlencode($final_filename).'"');
        $writer->save('php://output');

    }
    else{
        header("Location: sort.html?UNSUCCESFULL");
    }
}