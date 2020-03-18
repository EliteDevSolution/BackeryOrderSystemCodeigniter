<div class="main">
    <div class="container">
      <span class="inline-control">
        <h2>Standing Order for:
            <?php if(USERROLE == 1) { ?>
            <select id="userlist" name="userlist">
              <?php 
                if(!empty($userlst))
                { foreach ($userlst as $key => $value) { ?>
                  <option value="<?=$value->id?>" priceband="<?=$value->priceband?>">
                    <?=$value->name.'  ['.$value->deliveryaddress.']'?></option>    
               <?php }} ?>
          </select>
            <?php } else { ?>
              <select id="userlist" name="userlist" disabled>
              <?php 
                if(!empty($userlst))
                { foreach ($userlst as $key => $value) { ?>
                  <option value="<?=$value['id']?>" priceband="<?=$value['priceband']?>">
                    <?=$value['name'].'  ['.$value['deliveryaddress'].']'?></option>    
               <?php }} ?>
              </select>
            <?php } ?> 
          &nbsp;&nbsp;
          <button class="btn btn-success btnpos" id="stand-btnsave"><i class="icon-ok" aria-hidden="true"></i> Save Standing Order</button>
        </h2>        
      </span>
      <br><br>
      <span class="inline-control">
        <select id="product-item" name="product-item">
        </select>
        &nbsp;&nbsp;
        <span>
            <input min="0" type="number" name="mon" id="week_1" placeholder="Mon" style="width: 50px;" />
            <input min="0" type="number" name="tue" id="week_2" placeholder="Tue" style="width: 50px;" />
            <input min="0" type="number" name="wed" id="week_3" placeholder="Wed" style="width: 50px;" />
            <input min="0" type="number" name="thu" id="week_4" placeholder="Thu" style="width: 50px;" />
            <input min="0" type="number" name="fri" id="week_5" placeholder="Fri" style="width: 50px;" />
            <input min="0" type="number" name="sat" id="week_6" placeholder="Sat" style="width: 50px;" />
            <input min="0" type="number" name="sun" id="week_7" placeholder="Sun" style="width: 50px;" />
      </span>&nbsp;
      <button class="btn btn-success btnpos" id="stand-additem"><i class="icon-plus-sign" aria-hidden="true"></i> Add Item</button>
      <hr />
      </span>
    </div>
    <div class="container" style="overflow: auto;">
    <table class="table" id="main-table">
      <thead>
        <th>
          <input placeholder="Item" id='find-product' name='product' style="width:200px;" class="selector_input" />
        </th>
        <th> Mon </th><th> Tue </th><th> Wed </th><th> Thu </th><th> Fri </th><th> Sat </th><th> Sun </th><th> Total </th><th> Cost </th>
        <th> Action </th>
      </thead>
      <tbody id="table-content">
        <?php 
          if(!empty($orderlst)) { 
            foreach ($orderlst as $key => $value) {
            ?> 
            <tr proid="<?=$value->proid?>" price="<?=$value->price?>">    
              <td><?=$value->proname?></td>
              <td><input min="0" type="number" index="1" value="<?=$value->mon?>" style="width: 50px;" onchange="javascript:sumcalculator('table-content',2,8);"></td>
              <td><input min="0" type="number" index="1" value="<?=$value->tue?>" style="width: 50px;" onchange="javascript:sumcalculator('table-content',2,8);"></td>
              <td><input min="0" type="number" index="1" value="<?=$value->wed?>" style="width: 50px;" onchange="javascript:sumcalculator('table-content',2,8);"></td>
              <td><input min="0" type="number" index="1" value="<?=$value->thu?>" style="width: 50px;" onchange="javascript:sumcalculator('table-content',2,8);"></td>
              <td><input min="0" type="number" index="1" value="<?=$value->fri?>" style="width: 50px;" onchange="javascript:sumcalculator('table-content',2,8);"></td>
              <td><input min="0" type="number" index="1" value="<?=$value->sat?>" style="width: 50px;" onchange="javascript:sumcalculator('table-content',2,8);"></td>
              <td><input min="0" type="number" index="1" value="<?=$value->sun?>" style="width: 50px;" onchange="javascript:sumcalculator('table-content',2,8);"></td>  
              <td></td>
              <td></td>
              <td><button onclick="javascript:removeRow(this)" class="btn btn-danger btn-small"><i class="btn-icon-only icon-trash"> </i>
              </button></td>
           </tr>   
        <?php } }
        ?>
      </tbody>  
      <tfoot>
        <tr>
          <td><b>Cost per Day</b></td>
          <td id='persum_1'></td>
          <td id='persum_2'></td>
          <td id='persum_3'></td>
          <td id='persum_4'></td>
          <td id='persum_5'></td>
          <td id='persum_6'></td>
          <td id='persum_7'></td>
          <td id='persum_8'></td>
          <td id='persum_9'></td>
        </tr>
      </tfoot>
    </table>
</div>
</div>
<style type="text/css">
  .account-container{margin-top: 10px;padding-bottom: 15px;}
  .btnpos 
  {
    margin-top: -9px;    
  }
  hr
  {
    border-top: 1px solid #ccc;
  }
  th
  {
    vertical-align: middle !important;    
  }
  .table td {
    vertical-align: baseline !important;
  }
  .selector_input {
    background-image: url(https://qsf.fs.quoracdn.net/-3-images.new_grid.QuoraSearch.png-26-86c32b1ac26e4161.png);
    background-repeat: no-repeat;
    background-position: right;
  }
  .select2 {
    margin-top: -9px;   
    font-size: 14px;
  }

</style>
