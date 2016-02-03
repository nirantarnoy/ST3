<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UdashboardSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dashboard';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="udashboard-index">
    <div class="row">
        <div class="col-md-6">
            <div class="small-box bg-blue-gradient">
                <div class="inner">
                    <div style="text-align: center;">
                        <p style="text-align: right;"><h2>Sale orders</h2></p>
                        <h2><?php echo $salecount; ?></h2>
                    </div>

                </div>
                <div class="icon">
                    <i class="glyphicon glyphicon-barcode"></i>
                </div>
                <a href="index.php?r=saleorder/index" class="small-box-footer">รายละเอียด <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <div style="text-align: center;">
                        <p style="text-align: right;"><h2>Invoices</h2></p>
                        <h2><?php echo $invoicecount; ?></h2>
                    </div>

                </div>
                <div class="icon">
                    <i class="glyphicon glyphicon-equalizer"></i>
                </div>
                <a href="index.php?r=saleorderinvoice/index" class="small-box-footer">รายละเอียด <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

    </div>
<!--    <div class="box">
        <div class="box-header">
            <h3 class="box-title">สินค้าที่มียอดขายสูงสุด </h3>
            <div class="box-tools">
                <ul class="pagination pagination-sm no-margin pull-right">

                </ul>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
        </div> /.box-header 
        <div class="box-body no-padding">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-inline">
                    <label class="control-label col-sm-1" for="inputSuccess3">Year</label>
                    <div class="col-sm-5">
                        <select class="select-node">
                            <option>2010</option>
                            <option>2011</option>
                            <option>2012</option>
                            <option>2013</option>
                            <option>2014</option>

                        </select>
                    </div> <label class="control-label col-sm-1" for="inputSuccess3">Month</label>
                    <div class="col-sm-5">
                        <select>
                            <option>Jan</option>
                            <option>Feb</option>
                            <option>Mar</option>
                            <option>Apl</option>
                            <option>May</option>

                        </select>
                    </div>
                    </div>
                </div>

            </div>

        </div> /.box-body 
    </div> /.box -->
<div class="panel panel-success">
    <div class="panel-heading">
       <h3>ประวัติการทำรายการใบ Saleorder ล่าสุด</h3> 
    </div>
    <div class="panel-body">
        <table class="table table-striped">
    <thead>
        <tr>
            <td>เลขที่</td>
            <td>ลูกค้า</td>
            <td>วันที่</td>
            <td>ผู้ดำเนินการ</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach($lastsale as $data):?>
        <tr>
            <td><?=$data->saleno;?></td>
             <td><?=$data->customername->Cus_Name;?></td>
            <td><?=$data->createdate;?></td>
            <td><?=$data->createby;?></td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
    </div>
</div>


<div class="panel panel-success">
    <div class="panel-heading">
       <h3>ประวัติการทำรายการใบ Invoice ล่าสุด</h3> 
    </div>
    <div class="panel-body">
        <table class="table table-striped">
    <thead>
        <tr>
            <td>เลขที่</td>
<!--            <td>ลูกค้า</td>-->
            <td>วันที่</td>
            <td>ผู้ดำเนินการ</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach($lastinv as $data):?>
        <tr>
            <td><?=$data->invoiceno;?></td>

           <td><?=$data->createdate;?></td>
            <td><?=$data->createby;?></td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
    </div>
</div>
</div>
