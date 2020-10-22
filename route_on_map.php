<?php

require "core/bootstrap.php";

$storages = excel\ExcelIO::getSheetdata('Xlsx', 'parser_way24.xlsx', 'склад');

$addresses = [];
$length = count( $storages );
for( $i = 1; $i < $length; $i++ ) {
    $addresses[] = $storages[$i][1]; 
}

// определение и обработка нужной точки отправления
$origin = str_replace( ' ', '+', trim( $addresses[3] ) );  // пока что топорно


$inds = $app['database']->getAllFromColumn( 'ind', 'counterparty' );
// определение и обработка нужной точки назначения
$destination = $inds[5]['ind'];  // пока что топорно

?>

<iframe
  width="600"
  height="450"
  frameborder="0" style="border:0"
  src="https://www.google.com/maps/embed/v1/directions?key=AIzaSyBoXcWOfHjGD_m6NFkBg_hrQVwLSxaeNPs&origin=<?=$origin?>&destination=<?=$destination?>" allowfullscreen>
</iframe>