<?php
    define('JAVA_INC_URL','http://localhost:85/JavaBridge/java/Java.inc');
    require_once(JAVA_INC_URL);
  //require_once("http://127.0.0.1:85/JavaBridge/java/Java.inc");

$system = new Java('java.lang.System');
$class = new JavaClass("java.lang.Class");
$class->forName("com.microsoft.sqlserver.jdbc.SQLServerDriver");
//$class->forName("com.mysql.jdbc.Driver");
$driverManager = new JavaClass("java.sql.DriverManager");
//$conn = $driverManager->getConnection("jdbc:mysql://localhost/stdb?user=sa&password=Tamakogi2012");
$conn = $driverManager->getConnection("jdbc:sqlserver://127.0.0.1;databaseName=st;user=sa;password=Tamakogi2012");

//compliler

$compileManager = new JavaClass("net.sf.jasperreports.engine.JasperCompileManager");
$viewer = new JavaClass("net.sf.jasperreports.view.JasperViewer");
$report = $compileManager->compileReport("C:/inetpub/wwwroot/inv_01.jrxml");

//fill
$fillManager = new JavaClass("net.sf.jasperreports.engine.JasperFillManager");
$params =  new Java("java.util.HashMap");
//$params->put("text", "Text");
$params->put("ofYear",2015.00);
//$params->put("date", convertValue("2007-12-31 0:0:0", "java.sql.Timestamp"));

$emptyDatasource = new JavaClass("net.sf.jasperreports.engine.JREmptyDataSource");
$jasperPrint = $fillManager->fillReport($report,$params,$conn);

$exportManager = new JavaClass("net.sf.jasperreports.engine.JasperExportManager");
$outputPath = realpath(".")."/"."output.pdf";

//$exportManager->exportReportToHtml($jasperPrint,$outputPath);
//header("Content-type: application/html");

$exportManager->exportReportToPdfFile($jasperPrint,$outputPath);
header("Content-type: application/pdf");

readfile($outputPath);
unlink($outputPath);
?>