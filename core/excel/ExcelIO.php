<?php
namespace excel;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ExcelIO {

    static function getSheetdata($fileType, $fileName, $sheetname)
    {
        $fileName = $_SERVER['DOCUMENT_ROOT'] . '/tt-parser/docs/' . $fileName;

        $reader = IOFactory::createReader($fileType);
        $reader->setLoadSheetsOnly($sheetname);
        $spreadsheet = $reader->load($fileName);
        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        return $sheetData;
    }
    
}
