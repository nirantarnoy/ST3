<?php

namespace backend\controllers;

use yii\web\Controller;
use yii\web\Session;

$session = new Session();
$session->open();

class OpenreportController extends Controller {

    public function init() {
//        $session = new Session();
//        $session->open();
//        if (empty($_SESSION['userid'])) {
//            return $this->redirect('index.php?r=login');
//        }
    }

    public function actionIndex() {
        
    }
    public function actionViewpdf()
    {
        echo "OK";
    }

    public function actionExecreport() {
        
        if($_POST && $_SESSION['module']==2)
        {
            $params = $_POST['yyyy'];
             return $this->redirect('http://27.254.108.108:83/testjasper.php?reportid=2&params='.$params);
        }
         if($_POST && $_SESSION['module']==3)
        {
            $params = $_POST['yyyy'];
            $params2 = $_POST['yyyyy'];
            $params3 = $_POST['sale_id'];
             return $this->redirect('http://27.254.108.108:83/testjasper.php?reportid=3&params='.$params.'&params2='.$params2.'&params3='.$params3);
        }
        
       // return $this->redirect('http://localhost:81/yii2-st/reports/viewreport.php');
      // return $this->redirect('http://27.254.108.108:83/testjasper.php?reportid=1');
        
        
//        $answer = exec("D:/MY_WORK/Reports/STreport/rpt_invocecompare_graph.exe");
//        echo $answer;
//
//        define('JAVA_INC_URL', 'http://localhost:85/JavaBridge/java/Java.inc');
//        require_once(JAVA_INC_URL);
//       // require_once("http://127.0.0.1:85/JavaBridge/java/Java.inc");
//
//        $system = new Java('java.lang.System');
//        $class = new JavaClass("java.lang.Class");
//        $class->forName("com.microsoft.sqlserver.jdbc.SQLServerDriver");
////$class->forName("com.mysql.jdbc.Driver");
//        $driverManager = new JavaClass("java.sql.DriverManager");
////$conn = $driverManager->getConnection("jdbc:mysql://localhost/stdb?user=sa&password=Tamakogi2012");
//        $conn = $driverManager->getConnection("jdbc:sqlserver://127.0.0.1;databaseName=st;user=sa;password=Tamakogi2012");
//
////compliler
//
//        $compileManager = new JavaClass("net.sf.jasperreports.engine.JasperCompileManager");
//        $viewer = new JavaClass("net.sf.jasperreports.view.JasperViewer");
//       // $report = $compileManager->compileReport("C:/inetpub/wwwroot/report2.jrxml");
//   $report = $compileManager->compileReport("C:/xampp/htdocs/yii2-st/reports/report1.jrxml");
//
////fill
//        $fillManager = new JavaClass("net.sf.jasperreports.engine.JasperFillManager");
//        $params = new Java("java.util.HashMap");
////$params->put("text", "Text");
//      //  $params->put("M", 5.00);
////$params->put("date", convertValue("2007-12-31 0:0:0", "java.sql.Timestamp"));
//
//        $emptyDatasource = new JavaClass("net.sf.jasperreports.engine.JREmptyDataSource");
//        $jasperPrint = $fillManager->fillReport($report, $params, $conn);
//
//        $exportManager = new JavaClass("net.sf.jasperreports.engine.JasperExportManager");
//        $outputPath = realpath(".") . "/" . "output.pdf";
//
////$exportManager->exportReportToHtml($jasperPrint,$outputPath);
////header("Content-type: application/html");
//
//        $exportManager->exportReportToPdfFile($jasperPrint, $outputPath);
//        header("Content-type: application/pdf");
//
//        readfile($outputPath);
//        unlink($outputPath);
    }
   
}
