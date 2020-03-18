<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span12">
			<a href="/employee/add" class="btn btn-small btn-primary"><i class="btn-icon-only icon-ok"></i>Add User</a>
			<br><br>
			<table class="table table-striped table-bordered dt-responsive nowrap" id="usertable">
				<thead>
				  <tr>
				    <th> Name </th>
				    <th> Business Name </th>
				    <th> Email </th>
				    <th> ABN </th>
				    <th> Price Band </th>
				    <th> Delivery Address </th>
				    <th> Password </th>
				    <th> Role </th>
				    <th class="td-actions"> Actions </th>
				  </tr>
				</thead>
				<tbody>
				<?php
				foreach ($employees as $emp) {
				?>
				  <tr>
				    <td> <?=$emp->name?> </td>
				    <td> <?=$emp->businessname ?> </td>
				    <td> <?=$emp->email ?> </td>
				    <td> <?=$emp->abn ?> </td>
				    <td> <?=$emp->priceband ?> </td>
				    <td> <?=$emp->deliveryaddress ?> </td>
				    <td> <?=$emp->password ?> </td>
				    <td> <?php echo $emp->role == 0 ? 'Customer' : 'Admin'; ?> </td>
				    <td class="td-actions"><a href="/employee/edit/<?=$emp->id?>" class="btn btn-small btn-primary"><i class="btn-icon-only icon-edit"> </i></a> <a href="/employee/delete/<?=$emp->id?>" onclick="return confirm('Are you sure ?')" class="btn btn-danger btn-small"><i class="btn-icon-only icon-remove"> </i></a></td>
				  </tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
	  </div>
	</div>
  </div>
</div>