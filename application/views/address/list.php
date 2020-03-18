<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span12">
			<a href="/address/add" class="btn btn-small btn-primary"><i class="btn-icon-only icon-ok"></i>Add Address</a>
			<br><br>
			<table class="table table-striped table-bordered dt-responsive nowrap" id='address_table' style="width:100%">
				<thead>
				  <tr>
				    <th> ID </th>
				    <th> Address Name </th>
				    <th> Delivery Price </th>
				    <th class="td-actions"> Actions </th>
				  </tr>
				</thead>
				<tbody>
				<?php
					if(!empty($address))
					{
						foreach ($address as $row) {
				?>
				  <tr>
				    <td> <?=$row->id?> </td>
				    <td> <?=$row->address?> </td>
				    <td> <?=$row->price?> </td>
				    <td class="td-actions"><a href="/address/edit/<?=$row->id?>" class="btn btn-small btn-primary"><i class="btn-icon-only icon-edit"> </i></a> <a href="/address/delete/<?=$row->id?>" onclick="return confirm('Are you sure ?')" class="btn btn-danger btn-small"><i class="btn-icon-only icon-remove"> </i></a></td>
				  </tr>
				<?php } }?>
				</tbody>
			</table>
		</div>
	  </div>
	</div>
  </div>
</div>
