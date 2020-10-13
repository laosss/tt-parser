<?php

require "core/bootstrap.php";

$cntrprts_data = $app['database']->getAll('counterparty');
$cnt = count( $cntrprts_data );
for( $i = 0; $i < $cnt; $i++ ) {

    if( $cntrprts_data[$i]['EDRPOU_code'] != null  && $cntrprts_data[$i]['ind'] == null ) {
        $array = getCompanyDataFromApi( $cntrprts_data[$i]['EDRPOU_code'] );
        $cntrprts_data[$i]['ind'] = $array['index'];
    } else if( $cntrprts_data[$i]['legal_entity'] != null && $cntrprts_data[$i]['EDRPOU_code'] == null ) {
        $q = str_replace( ' ', '+', $cntrprts_data[$i]['legal_entity'] );
        $array = getCompanyDataFromApi( $q );        
        $cntrprts_data[$i]['ind'] = $array['index'];
        $cntrprts_data[$i]['EDRPOU_code'] = $array['edrpou'];
    }

}

try {
    foreach( $cntrprts_data as $cntrprt ) {
        $res = update( $app['pdo'], $cntrprt, $cntrprt['id'] ); 
    }
} catch( PDOException $ex ) {
    echo $ex;
}

if( $res === false )
    echo 'error';
else echo 'done'; 


function getCompanyDataFromApi( $query ) {
    $url = 'https://ring.org.ua/search?q='.$query.'&clearall=on&datasources=tax_reg&format=json';
    $json = file_get_contents($url);
    $array = json_decode($json, true);

    $company_data['edrpou'] = $array['search_results']['object_list'][0]['company_edrpou'];
    $company_data['index'] = substr( $array['search_results']['object_list'][0]['company_address'], 16, 5 );    
    
    return $company_data;
}

function update( $db, $data, $id ) {
    if( empty( $db ) ) return false;

    return $db->query("update counterparty set EDRPOU_code = ".$data['EDRPOU_code'].", ind = ".$data['ind']." where id = $id");
}