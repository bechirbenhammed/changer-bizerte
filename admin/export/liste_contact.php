<?

/*
//# report all errors
error_reporting(E_ALL);
ini_set('display_errors', '1');
*/

include_once '../inc/connexion.php';


// require the PHPExcel file 
require 'classes/PHPExcel.php';

$query = "SELECT * from personne";
$headings = array('Num ',  'Nom', 'Prénom', 'Cin' );

$cellNumber = sizeof($headings);
$result = mysql_query($query) or die(mysql_error());
// Create a new PHPExcel object 
$objPHPExcel = new PHPExcel();
$objPHPExcel->getActiveSheet()->setTitle('Liste des Personnes');

$styleArray = array(
    'font' => array(
        'bold' => true
    )
);

$rowNumber = 1;
$col = 'A';
foreach ($headings as $heading) {
    $objPHPExcel->getActiveSheet()->setCellValue($col . $rowNumber, $heading);
    $objPHPExcel->getActiveSheet()->getStyle($col . $rowNumber)->applyFromArray($styleArray);
    $col++;
}

// Loop through the result set 
$rowNumber = 2;
while ($row = mysql_fetch_array($result)) {
    $info['0'] = $row["id"];  
    $info['1'] = $row['Nom'];
    $info['2'] = $row['Prenom'];
    $info['3'] = $row['cin'];

    $col = 'A';
    foreach ($info as $cell) {
        $objPHPExcel->getActiveSheet()->setCellValue($col . $rowNumber, $cell);
        $col++;
    }
    $rowNumber++;
}

$objPHPExcel->getActiveSheet()->getStyle('A1:D' . $rowNumber)->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('A1:D' . $rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
for ($i = 0; $i <= $cellNumber; $i++) {
    $objPHPExcel->getActiveSheet()->getColumnDimension(chr(65 + $i))->setAutoSize(true);
}

// Save as an Excel BIFF (xls) file 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

$file_name = 'Liste des Personnes_' . strftime("%d-%m-%Y-%HH:%M", time()) . '.xls';

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="' . $file_name . '"');
header('Cache-Control: max-age=0');
$objWriter->save('php://output');
exit();
?>