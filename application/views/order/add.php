<div class="main">
    <div class="container">
      <span class="inline-control">
        <input type="hidden" id='orderid' value="0" />
        <h2>Cart for:
          <?php 
          if(USERROLE == 1 && !isset($orderdate)) { ?>
            <select id="userlist" name="userlist">
              <?php 
                if(!empty($userlst))
                { foreach ($userlst as $key => $value) { ?>
                  <option value="<?=$value->id?>" priceband="<?=$value->priceband?>">
                    <?=$value->name.'  ['.$value->deliveryaddress.']'?></option>    
               <?php }} ?>
          </select>
           <?php } else if(USERROLE == 1 && isset($orderdate)) { ?>
            <select id="userlist" name="userlist" disabled>
              <?php 
                if(!empty($userlst))
                { foreach ($userlst as $key => $value) { ?>
                  <option value="<?=$value->id?>" priceband="<?=$value->priceband?>">
                    <?=$value->name.'  ['.$value->deliveryaddress.']'?></option>    
               <?php }} ?>
            </select>
            <?php } else if(USERROLE == 0 && isset($orderdate)) { ?>
              <select id="userlist" name="userlist" disabled>
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
          <input name='orderdate' id='orderdate' class="datepicker" style="width: 130px;" />
          &nbsp;&nbsp;
          <button class="btn btn-danger btnpos" id="reset-cart"><i class="icon-undo" aria-hidden="true"></i> Reset Cart</button>
          <button class="btn btn-success btnpos" id="btn-order"><i class="icon-ok" aria-hidden="true"></i> Place Order</a>
        </h2>        
      </span>
      <br>
      <!-- <span class="inline-control">
        <select id="cart-item" name="cart-item">
        </select>
        <b style="font-size: 20px;color: blue;cursor: pointer;display: none;" id="remove-cart"><i class="btn-icon-only icon-trash"> </i></b>
        &nbsp;&nbsp;
        <span class="">
            <input id="cart-name" placeholder="Cart Name" style="width: 250px;" />
            
      </span>&nbsp;
      <button class="btn btn-success btnpos" id="add-cart"><i class="icon-ok" aria-hidden="true"></i> Save Cart</button>
      <br> -->
      <span>
        <br>
        <label>New Item</label>
        <select id="product-item" name="product-item">
        </select>
        &nbsp;&nbsp;
        <span class="">
            <input min="0" type="number" name="count" id="count" placeholder="" style="width: 50px;" />
      </span>&nbsp;
      <button class="btn btn-success btnpos" id="add-item"><i class="icon-plus-sign" aria-hidden="true"></i> Add Item</button>
    </span>
    </div>
    <div class="container">
      <hr />
    </div>
    <div class="container" style="overflow: auto;">
    <table class="table">
      <thead>
        <th width="5%" style="display: none;">
          <input class="selector_input" type="text" placeholder="Group" id='find-group' name='group' style="width:100px;">
        </th>
        <th width="25%">
          <input placeholder="Item" id='find-product' name='product' style="width:200px;" class="selector_input" />
        </th>
        <th> Price </th>
        <th> Tax </th>
        <th> Quantity </th>
        <th> Total </th>
        <th> Action </th>
      </thead>
      <tbody id="table-content">
      </tbody>  
      <tfoot>
        <tr align="right">
          <td colspan="7" style="text-align: right"><b><i class="icon-shopping-cart" aria-hidden="true"></i> Total: $<b id="total-sum">0.00</b></b></td>
        </tr>
      </tfoot>
    </table>
    <p>
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
