<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span12">
			<a href="/product_group/add" class="btn btn-small btn-primary"><i class="btn-icon-only icon-ok"></i>Add Group</a>
			<br><br>
			<table class="table table-striped table-bordered dt-responsive nowrap" id='group_table' style="width:100%">
				<thead>
				  <tr>
				    <th> ID </th>
				    <th> Group Name </th>
				    <th class="td-actions"> Actions </th>
				  </tr>
				</thead>
				<tbody>
				<?php
					if(!empty($group))
					{
						foreach ($group as $row) {
				?>
				  <tr>
				    <td> <?=$row->id?> </td>
				    <td> <?=$row->name?> </td>
				    <td class="td-actions"><a href="/product_group/edit/<?=$row->id?>" class="btn btn-small btn-primary"><i class="btn-icon-only icon-edit"> </i></a> <a href="/product_group/delete/<?=$row->id?>" onclick="return confirm('Are you sure ?')" class="btn btn-danger btn-small"><i class="btn-icon-only icon-remove"> </i></a></td>
				  </tr>
				<?php } }?>
				</tbody>
			</table>
		</div>
	  </div>
	</div>
  </div>
</div>
