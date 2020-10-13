<?php

require "vendor/autoload.php";
require "core/bootstrap.php";

use PhpOffice\PhpSpreadsheet\IOFactory;

$counterparties = getSheetDataByName( 'Xlsx', 'parser_way24.xlsx', 'контрагент' );
//var_dump( $counterparties[1] );

try {
    for( $i = 1; $i < 9; $i++ ) {
        saveToDB( $counterparties[$i], $app['pdo'] );
    }
} catch( Exception $ex ) {
    echo $ex;
}

echo "successfully";


function getSheetDataByName( $fileType, $fileName, $sheetname ) {
    $fileName = __DIR__ . '/docs/' . $fileName;

    $reader = IOFactory::createReader( $fileType );
    $reader->setLoadSheetsOnly( $sheetname );
    $spreadsheet = $reader->load( $fileName );
    $sheetData = $spreadsheet->getActiveSheet()->toArray();

    return $sheetData;
}

function saveToDB($data, $DB) {
    if( empty( $DB ) ) return false;

    $sql = "INSERT INTO counterparty(
        legal_entity, EDRPOU_code, ind, address, storage_capacity, registration_no_license, latitude, longitude )
        values( ?, ?, ?, ?, ?, ?, ?, ? )";
        
    $prepared = $DB->prepare( $sql ); //$this->DB->prepare( $sql );
    $prepared->execute( [
        $data[0],
        $data[1],
        $data[2],
        $data[3],
        $data[4],
        $data[5],
        $data[6],
        $data[7]
    ] );

}