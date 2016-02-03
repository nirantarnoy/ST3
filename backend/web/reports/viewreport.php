<?php

ob_start();
$id = 12345;
$params = 2015.00;
$params2 = 5;
$path = "D:\\MYrep";
//$file = $chemin."\\bill_".$id.".pdf";
$file = $path."\\".$id.".pdf";
$app_obj = new COM("CrystalRuntime.Application.8.5") or Die ("Did not open"); 
$report= $path."\\1234.rpt";

$rpt_obj= $app_obj->OpenReport($report,1);
$app_obj->LogOnServer("p2ssql.dll","localhost","st","sa","Tamakogi2012");
$rpt_obj->EnableParameterPrompting = FALSE;
$rpt_obj->RecordSelectionFormula = "{rptinvoicesummarybysale.Year} = $params ";
$rpt_obj->RecordSelectionFormula = "{rptinvoicesummarybysale.Mount} = $params2 ";
$rpt_obj->ExportOptions->DiskFileName = $file;
$rpt_obj->ExportOptions->PDFExportAllPages = true;
$rpt_obj->ExportOptions->DestinationType = 1;
$rpt_obj->ExportOptions->FormatType = 31; 
$rpt_obj->Export(false);

      
header('Content-Type: application/pdf');
//header('Content-Disposition: attachment; filename="'.$filename2.'"');        
readfile($filename);
?>