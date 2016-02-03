<?php
//set_time_limit(0);
ob_start();
$id = 12345;
$filename = "12345.pdf";
$params = 2015.00;
$params2 = 12;
$path = "D:\\MYrep";
//$file = $chemin."\\bill_".$id.".pdf";
$file = $path."\\".$id.".pdf";
$app_obj = new COM("CrystalRuntime.Application") or Die ("Did not open");
$report= $path."\\1234.rpt";

$rpt_obj= $app_obj->OpenReport($report,1);
$app_obj->LogOnServer("p2ssql.dll","localhost","st_data","sa","Tamakogi2012");
$rpt_obj->EnableParameterPrompting = FALSE;
$rpt_obj->RecordSelectionFormula = "{rptinvoicesummarybysale.Year} = $params " ;

$rpt_obj->ExportOptions->DiskFileName = $file;
$rpt_obj->ExportOptions->PDFExportAllPages = true;
$rpt_obj->ExportOptions->DestinationType = 1;
$rpt_obj->ExportOptions->FormatType = 31; 
$rpt_obj->Export(false);

 //header("location: http://localhost:81/yii2-st/backend/web/index.php?r=openreport/viewpdf");
header('Content-Type: application/pdf');
//header('Content-Disposition: attachment; filename="'.$filename2.'"');        
readfile($file);
?>