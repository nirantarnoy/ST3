<?php
set_time_limit(0);
//if(isset($_GET['id']))
//{
//$id = $_GET['id'];
//} else {
//die('Please specify an ID');
//}

$path = "D:\\MYrep";
//$file = $chemin."\\bill_".$id.".pdf";
$app_obj = new COM("CrystalRuntime.Application") or Die ("Did not open");
$report= $path."\\1234.rpt";

$rpt_obj= $app_obj->OpenReport($report,1);
$app_obj->LogOnServer("p2ssql.dll","host","bdd","userbd","passwordbd");
$rpt_obj->EnableParameterPrompting = FALSE;
$rpt_obj->RecordSelectionFormula = "{F_DOCLIGNE.DO_Piece}='$id'";

$rpt_obj->ExportOptions->DiskFileName =  $file;
$rpt_obj->ExportOptions->PDFExportAllPages = true;
$rpt_obj->ExportOptions->DestinationType = 1;
$rpt_obj->ExportOptions->FormatType = 31; 
$rpt_obj->Export(false);

header("Content-Type: application/pdf");
readfile($file);
?>