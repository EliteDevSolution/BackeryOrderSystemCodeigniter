<div class="main">
    <div class="container">
      <h2 style="text-align: center;">#<?=$orderinfo->orderid?> Invoice 
      </h2>
      <span class="">
        <br>
        <h3>Ordering Date: <?=$orderinfo->date?>, Customer: <?=$orderinfo->name?>, Email: <?=$orderinfo->email?>
        </h3>
        <h3> DeliveryAddress: <?=$orderinfo->deliveryaddress?>,  Satus: <?=$orderinfo->state?></h3>       
      </span>
      <br>
    <div class="container" style="overflow: auto;">
    <hr />
    <table class="table">
      <thead>
        <th>
          Group
        </th>
        <th>
          Product
        </th>
        <th> Price </th>
        <th> Tax </th>
        <th> Quantity </th>
        <th> Total </th>
      </thead>
      <tbody id="table-content">
      <?php $sumtatal = 0;
      foreach($orderlist as $value){ 
        $sumtatal += $value->total;
        ?>
        <tr>
          <td><?=$value->groupname?></td>
          <td><?=$value->productname?></td>
          <td>$<?=$value->realprice?></td>
          <td><?=$value->tax?></td>
          <td><?=$value->qty?></td>
          <td>$<?=$value->total?></td>
        </tr>  
      <?php } ?>
      </tbody>  
      <tfoot>
        <tr align="right">
          <td colspan="7" style="text-align: right"><b><i class="icon-shopping-cart" aria-hidden="true"></i> Total: $<b id="total-sum">
            <?=$sumtatal?></b></b></td>
        </tr>
      </tfoot>
    </table>
    <p>
</div>
<div class="pull-right"><button class="btn btn-primary btnpos" id="btn-print"><i class="icon-print" aria-hidden="true"></i> Print </button></td></div>
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
