<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span12">
        	<h2> Order History </h2>
			<br>
			<table class="table table-striped table-bordered dt-responsive nowrap" id="orderlist_table">
				<thead>
				  <tr>
				    <th> No. </th>
				    <th> Order Date </th>
				    <th> Username </th>
				    <th> Email </th>
				    <th> BusinessName </th>
				    <th> Price Band </th>
				    <th> Status </th>
				    <th class="td-actions"> Actions </th>
				  </tr>
				</thead>
				<tbody>
				<?php
				$disable = '';
				foreach ($orderlist as $key => $value) {
				?>
				  <tr>
				    <td> <?=($key+1)?> </td>
				    <td> <?=$value->orderdate ?> </td>
				    <td> <?=$value->username ?> </td>
				    <td> <?=$value->email ?> </td>
				    <td> <?=$value->businessname ?> </td>
				    <td> <?=$value->priceband ?> </td>
				    <?php if(USERROLE == 1)
				    { ?>
				    <td><?php if($value->state == 'PENDING') { ?>
				    	<button class="btn btn-small btn-primary" orderid='<?=$value->id?>' onclick="javascript:state_change(this);"><?=$value->state?></button></td>
				    	<?php } else { $disable ='disabled';?>
				    	<button class="btn btn-small btn-success"  disabled><?=$value->state?></button></td>
				    <?php } ?>	
					<?php } else { ?>
					<td><?=$value->state?></td>
					<?php } ?>	
				    <td class="td-actions"><a href="/orderlist/view/<?=$value->id?>" class="btn btn-small btn-success"><i class="btn-icon-only icon-eye-open"> </i></a> <?php if($value->state !='COMPLETE') {?><a href="/order/edit/<?=$value->id?>/<?=$value->customer_id?>/<?=$value->orderdate?>" class="btn btn-small btn-primary"><i class="btn-icon-only icon-edit"> </i></a> <a href="/orderlist/delete/<?=$value->id?>" onclick="return confirm('Are you sure ?')" class="btn btn-danger btn-small"><i class="btn-icon-only icon-remove"> </i></a><?php } else {?>
				    <a class="btn btn-small btn-primary" disabled><i class="btn-icon-only icon-edit"> </i></a> <a class="btn btn-danger btn-small" disabled><i class="btn-icon-only icon-remove"> </i></a><?php } ?></td>
				  </tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
	  </div>
	</div>
  </div>
</div>