<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span12">
        	<h2> Order Analysis </h2>
			<br>
			<span><b>Order date range: </b><input id='order_date_range' /><b>&nbsp;&nbsp; Customer List: </b>
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
			</span>
			<table class="table table-striped table-bordered dt-responsive nowrap" style="cursor: pointer;" id="sumery_table">
				<thead>
				  <tr>
				    <th> No. </th>
				    <th> Order Date </th>
				    <th> Product Name </th>
				    <th> Price </th>
				    <th> Quantity </th>
				    <th> Total </th>
				  </tr>
				</thead>
				<tbody id="sumery_content">
				</tbody>
				<tfoot>
					<tr>
						<td colspan="6" style="text-align: right"><b><i class="icon-shopping-cart" aria-hidden="true"></i> Total: $<b id="total-sum">0.00</b></b></td>
					</tr>
				</tfoot>
			</table>
		</div>
	  </div>
	</div>
  </div>
</div>
<style type="text/css">
	b{
		font-size: 15px;
	}
	.select2 {
    margin-top: -9px;   
    font-size: 14px;
  }
</style>