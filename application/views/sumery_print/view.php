<div class="main">
    <div class="container">
      <h2 style="text-align: center;">On Order for <b id='date_title'></b>
      </h2>
      <span class="inline">
        <h4>Date: <input name='orderdate' id='orderdate' class="datepicker" style="width: 130px;" />
        <button class="btn btn-primary btnpos pull-right" id="btn-print"><i class="icon-print" aria-hidden="true"></i> Print </button></h4>
    <div class="container">
    <hr />
    <table class="table">
      <thead>
        <th>
          No.
        </th>
        <th>
          Product
        </th>
        <th> Price </th>
        <th> Quantity </th>
        <th> Total </th>
      </thead>
      <tbody id="table-content">
        <tr>
        </tr>  
      </tbody>  
      <tfoot>
        <tr align="right">
          <td colspan="5" style="text-align: right"><b><i class="icon-shopping-cart" aria-hidden="true"></i> Total: $<b id="total-sum">0.00
          </b></td>
        </tr>
      </tfoot>
    </table>
    <p>
    <h2 style="text-align: center;">Order By Customer <b id='date_title'></b><p>
    <div class="container" id="customer_orders">
    </div>
</div>
</div>
<style type="text/css">
  .btnpos 
  {
    margin-top: 3px;
  }
  hr
  {
    border-top: 1px solid #ccc;
  }
  th
  {
    vertical-align: middle !important;    
    font-size: 13px;
  }
  .table td {
    vertical-align: baseline !important;
  }
  #date_title{color:#2254b9;}

  .selector_input {
    background-image: url(https://qsf.fs.quoracdn.net/-3-images.new_grid.QuoraSearch.png-26-86c32b1ac26e4161.png);
    background-repeat: no-repeat;
    background-position: right;
  }
  thead
  {
    background-color: #606069;
    color: white;
  }

</style>
