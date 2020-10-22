<?php

require "core/bootstrap.php";

$carriers = excel\ExcelIO::getSheetdata( 'Xlsx', 'parser_way24.xlsx', 'Перевозчик' );  // перевозчики

$vol_of_contnrs = [];  // массив емкостей
$tariffs = [];  // массив тарифов
$size = count( $carriers );
for( $i = 1; $i < $size; $i++ ) {  
    $vol_of_contnrs[] = $carriers[$i][2];
    $tariffs[$carriers[$i][2]] = $carriers[$i][15];
}

sort( $vol_of_contnrs );

$order_vol = 23110;  // !автоматизировать этот момент!

$conteiner_vol = containSearch( $vol_of_contnrs, $order_vol );
echo $tariffs[$conteiner_vol];  // результат (выбранный тариы подходящий объему заказа)


function containSearch( $arr, $search ) {

    $first = 0;
    $orig_first = 0;
    $last = count( $arr );

    while( $first <= $last ) {
        $mid = ($first + $last) / 2;
        if( $arr[$mid] >= $search && $arr[$mid-1] < $search ||
            $arr[$mid] >= $search && $mid == $orig_first ) {
            return $arr[$mid];
        }            
        else if( $arr[$mid] < $search )
            $first = $mid + 1;
        else if( $arr[$mid] > $search )
            $last = $mid + 1;
    }
    return -1;
}