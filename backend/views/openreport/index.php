<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use backend\models\Menu;
?>

<?php    ActiveForm::begin(['id'=>'myform','action'=>'index.php?r=invoicerefsale/addsale'])?>
       
     <div class="form-group">  
         <div class="box box-danger">
             <div class="box-header">
                 All saleorders
             </div>
             <div class="box-body">
                 <?php if($rowcount >0):?>  
      <table class="table table-striped table-bordered" style="margin-top: 10px">
      <thead>
        <tr>
          <th width="15px"></th>
          <th>Sale No.</th>
          <th>Customer</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($model as $data): ?>
        <tr>
          <td width="15px" style="text-align: center">
              <input type='checkbox' name="sales[]" value="<?=$data->recid;?>" />
          </td>
          <td><?php echo $data->saleno; ?></td>
          <td><?php echo $data->customers->Cus_Name; ?></td>
          
        </tr>
      </tbody>
      <?php endforeach; ?>
    </table>
             <?php endif;?>  
             </div>
             <div class="box-footer">
                 <div class="pull-right">
                   
               <button type='submit' name='search' id='search-btn' class="btn btn-primary">ตกลง
                </button> 
              </div>
       </div> 
             </div>
         </div>
      
        
<?php ActiveForm::end();?>
 