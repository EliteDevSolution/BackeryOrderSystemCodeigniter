<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span12">
			<a href="/product/add" class="btn btn-small btn-primary"><i class="btn-icon-only icon-ok"></i>Add Product</a>
			<br><br>
			<table class="table table-striped table-bordered dt-responsive nowrap" id='product_table' style="width:100%">
				<thead>
				  <tr>
				    <th> No. </th>
				    <th>Product Name</th>
				    <th>Product Group</th>
				    <th>Price A</th>
				    <th>Price B</th>
				    <th>Price C</th>
				    <th>Price D</th>
				    <th>TAX</th>
				    <th>Description</th>
				    <th class="td-actions"> Actions </th>
				  </tr>
				</thead>
				<tbody>
				<?php
					if(!empty($product))
					{
						$index = 0;
						foreach ($product as $row) {
							$index++;
				?>
				  <tr style="cursor: pointer;" id='<?=$row->id?>'>
				    <td> <?=$index?> </td>
				    <td> <?=$row->proname?> </td>
				    <td> <?=$row->groupname?> </td>
				    <td class='price_val' filedname='pricea'> <?=$row->pricea?> </td>
				    <td class='price_val' filedname='priceb'> <?=$row->priceb?> </td>
				    <td class='price_val' filedname='pricec'> <?=$row->pricec?> </td>
				    <td class='price_val' filedname='priced'> <?=$row->priced?> </td>
				    <td> <?php echo $row->gst == '1' ? "TRUE" : "FALSE";?> </td>
					<td> <?=$row->description?> </td>
				    <td class="td-actions"><a href="/product/edit/<?=$row->id?>" class="btn btn-small btn-primary"><i class="btn-icon-only icon-edit"> </i></a> <a href="/product/delete/<?=$row->id?>" onclick="return confirm('Are you sure ?')" class="btn btn-danger btn-small"><i class="btn-icon-only icon-remove"> </i></a></td>
				  </tr>
				<?php } }?>
				</tbody>
			</table>
		</div>
	  </div>
	</div>
  </div>
</div>
