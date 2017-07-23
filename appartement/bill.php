<?php
// var_dump($_GET);
// if(1){
//   for($i = 0;$i<sizeOf($_GET);$i++){
//     echo $_GET[$i].'<br/>';
//   }
// }

require $_SERVER['DOCUMENT_ROOT'].'/plugin/fpdf/fpdf.php';
define('EURO',chr(128));

$blockOwner = array(
  $_GET['ownerName'],
  $_GET['ownerAddress'],
  $_GET['ownerZip']." ".$_GET['ownerCity'],
  $_GET['ownerPhone'],
  $_GET['ownerCell'],
  $_GET['ownerMail'],
);
$blockTenant = array(
  $_GET['tenantName'],
  $_GET['tenantAddress'],
  $_GET['tenantZip']." ".$_GET['tenantCity'],
  $_GET['tenantPhone']
);

$pdf = new FPDF();
$pdf->AddPage();
if(0){
  /*LINES*/
  //vertical
  $pdf->Line(105, 0, 105, 300);
  $pdf->Line(52.5, 0, 52.5, 300);
  $pdf->Line(157.5, 0, 157.5, 300);

  //horizon
  $pdf->Line(0, 150, 210, 150);
  $pdf->Line(0, 75, 210, 75);
  $pdf->Line(0, 225, 210, 225);

  $pdf->SetDrawColor(255,0,0);
  $pdf->Line(0, 60, 210, 60);
  $pdf->Line(0, 80, 210, 80);
  $pdf->SetDrawColor(0);
}

/*TITLE*/
$pdf->SetFont('Arial','B',12);
$pdf->SetXY(77,8);
$pdf->Cell(56,10,utf8_decode("Avis d'échéance n° " .$_GET['billNumber']));
$pdf->SetFont('Arial','',12);
$pdf->SetXY(68,13);
$pdf->Cell(13,10,utf8_decode("Période du " . $_GET['startPeriode'] . " au " . $_GET['endPeriode']));
$pdf->SetXY(76,18);
$pdf->Cell(13,10,utf8_decode("Pont de Claix le ".date('d/m/o')));
/*BLOCK OWNER*/
$y = 7;
for($i = 0; $i<sizeof($blockOwner);$i++){
  $y += 5;
  $pdf->SetXY(10,$y);
  if($i == 0) $pdf->SetFont('Arial','B',12);
  else $pdf->SetFont('Arial','',12);
  $pdf->Cell(13,10,utf8_decode($blockOwner[$i]));
}
/*BLOCK TENANT*/
$y = 48.5;
for($i = 0; $i<sizeof($blockTenant);$i++){
  $y += 5;
  $pdf->SetXY(150,$y);
  if($i == 0) $pdf->SetFont('Arial','B',12);
  else $pdf->SetFont('Arial','',12);
  $pdf->Cell(13,10,utf8_decode($blockTenant[$i]));
}
/*FLAT INFO*/
/*RECT*/
$pdf->Rect(10,55,37,25);
$pdf->Rect(10,55,37,8);
$pdf->Rect(47,55,37,25);
$pdf->Rect(47,55,37,8);
$pdf->SetXY(17,55);
$pdf->Cell(13,10,utf8_decode("Locataire(s)"));
$pdf->SetXY(59,55);
$pdf->Cell(13,10,utf8_decode("Local"));
/*RECT FILL*/
$pdf->SetFont('Arial','',10);
$pdf->SetXY(11,65);
$pdf->Cell(13,10,utf8_decode($_GET['tenantName']));
$pdf->SetXY(48,65);
$pdf->Cell(13,10,utf8_decode("Appart. " . $_GET['flatNumber']));
/*INFO RECT*/
$pdf->Rect(10,90,190,30);
$pdf->SetXY(10,90);
$pdf->MultiCell(190,5,utf8_decode($_GET['comment']));

/*BILL DETAILS*/

$pdf->Rect(10,130,190,100);
$pdf->Rect(10,130,190,8);

$pdf->SetFont('Arial','',12);

$pdf->SetXY(10,129);
$pdf->Cell(13,10,utf8_decode("Date"));
$pdf->Line(45,130,45,230);
$pdf->SetXY(50,129);
$pdf->Cell(13,10,utf8_decode("Intitulé"));
$pdf->Line(155,130,155,230);
$pdf->SetXY(160,129);
$pdf->Cell(13,10,utf8_decode("Montant"));

//detail
$i = 0;
$j = 0;
$total = $_GET['stillToPay'];
$isStillToPay;
if($total != 0){
    $pdf->SetXY(10,143);
    $pdf->Cell(13,10,utf8_decode($_GET['startPeriode']));
    $pdf->SetXY(45,143);
    $pdf->Cell(13,10,utf8_decode("Reste à payer"));
    $pdf->SetXY(155,143);
    $pdf->Cell(13,10,utf8_decode($_GET['stillToPay']).EURO);

    $isStillToPay = true;
}
else{$isStillToPay = false;}

$transactions = "";
while(array_key_exists('date'.$i, $_GET)){
  if(!$isStillToPay){$j=$i-1;}else{$j=$i;}

  $pdf->SetXY(10,153+($j*10));
  $pdf->Cell(13,10,utf8_decode($_GET['date'.$i]));

  $pdf->SetXY(45,153+($j*10));
  $pdf->Cell(13,10,utf8_decode($_GET['name'.$i]));

  $pdf->SetXY(155,153+($j*10));
  $pdf->Cell(13,10,utf8_decode($_GET['amount'.$i]).EURO);

  $total += $_GET['amount'.$i];

  $transactions .= utf8_decode($_GET['date'.$i])."|".utf8_decode($_GET['name'.$i])."|".utf8_decode($_GET['amount'.$i])."|";
  $i++;

}

//total
$pdf->Line(10,221,200,221);
$pdf->SetFont('Arial','B',12);
$pdf->SetXY(10,221);
$pdf->Cell(13,10,utf8_decode("Total"));
$pdf->SetXY(155,221);
$pdf->Cell(13,10,utf8_decode($total).EURO);
/*PAYMENT*/
$pdf->Rect(10,240,90,40);
$pdf->SetFont('Arial','u',10);
$pdf->SetXY(10,240);
$pdf->Cell(13,10,utf8_decode("Modalités de règlement"));
$pdf->SetFont('Arial','',10);
$pdf->SetXY(10,250);
$pdf->Cell(13,10,utf8_decode("- Par chèque"));
$pdf->SetXY(50,250);
$pdf->Cell(13,10,utf8_decode(": à l'ordre de " . $_GET['ownerName'] ));
$pdf->SetXY(10,255);
$pdf->Cell(13,10,utf8_decode("- Par virement bancaire"));
$pdf->SetXY(50,255);
$pdf->Cell(13,10,utf8_decode(": ". $_GET['bankName']));
$pdf->SetFont('Arial','b',10);
$pdf->SetXY(10,260);
$pdf->Cell(13,10,utf8_decode("IBAN"));
$pdf->SetXY(25,260);
$pdf->SetFont('Arial','',10);
$pdf->Cell(13,10,utf8_decode($_GET['ownerIBAN']));
$pdf->SetFont('Arial','b',10);
$pdf->SetXY(10,265);
$pdf->Cell(13,10,utf8_decode("BIC"));
$pdf->SetXY(25,265);
$pdf->SetFont('Arial','',10);
$pdf->Cell(13,10,utf8_decode($_GET['ownerBIC']));

/*LAST PAYMENT*/
$pdf->SetFont('Arial','',10);
if($_GET['lastAmount'] > 0){
  $pdf->SetXY(110,250);
  $pdf->Cell(13,10,utf8_decode("Dernier " . $_GET['lastType'] . " le : " . $_GET['lastDate'] . " de " . $_GET['lastAmount'] . ' euros' ));
  $pdf->SetXY(110,255);
  $pdf->Cell(13,10,utf8_decode($_GET['lastBankName']));
  $pdf->SetXY(110,260);
  $pdf->Cell(13,10,utf8_decode($_GET['lastTenantIBAN']));
  $pdf->SetXY(110,265);
  $pdf->Cell(13,10,utf8_decode($_GET['lastTenantBIC']));
}
else if($_GET['lastType'] == "virementSepa"){
  $pdf->SetXY(110,250);
  $pdf->Cell(13,10,utf8_decode("Dernier virement : Virement SEPA par mobile"));
}
else{
  $pdf->SetXY(110,250);
  $pdf->Cell(13,10,utf8_decode("Dernier " . $_GET['lastType'] . " : Référence non transmise"));
}


$query = 'INSERT INTO Owner (billNumber,startPeriode,endPeriode,editDate,ownerName,ownerAddress,ownerZip,ownerCity,ownerPhone,ownerCell,ownerMail,bankName,ownerIBAN,ownerBIC,flatNumber,tenantName,tenantAddress,tenantZip,tenantCity,tenantPhone,stillToPay,transactions,comment) VALUES
("'.$_GET['billNumber'].'","'.$_GET['startPeriode.'].'","'.$_GET['endPeriode'].'","'.date('d/m/o').'",
"'.$_GET['ownerName'].'","'.$_GET['ownerAddress'].'","'.$_GET['ownerZip'].'","'.$_GET['ownerCity'].'","'.$_GET['ownerPhone'].'","'.$_GET['ownerCell'].'","'.$_GET['ownerMail'].'",
"'.$_GET['bankName'].'","'.$_GET['ownerIBAN'].'","'.$_GET['ownerBIC'].'",
"'.$_GET['flatNumber'].'","'.$_GET['tenantName'].'","'.$_GET['tenantAddress'].'","'.$_GET['tenantZip'].'","'.$_GET['tenantCity'].'","'.$_GET['tenantPhone'].'",
"'.$_GET['stillToPay'].'","'.$transactions.'","'.$_GET['comment'].'")
';

// $pdf->Output();
// var_dump($_GET);
echo $query;
?>
