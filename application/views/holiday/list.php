<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span12">
			<a href="/holiday/add" class="btn btn-small btn-primary"><i class="btn-icon-only icon-ok"></i>Add Dates</a>
			<br><br>
			<table class="table table-striped table-bordered dt-responsive nowrap" id='holiday_table' style="width:100%;cursor: pointer;">
				<thead>
				  <tr>
				    <th> No. </th>
				    <th> User Name </th>
				    <th> Email </th>
				    <th> Title </th>
				    <th> Date Range </th>
				    <th class="td-actions"> Actions </th>
				  </tr>
				</thead>
				<tbody>
				<?php
					if(!empty($holidaylist))
					{
						foreach ($holidaylist as $key=>$row) {
				?>
				  <tr>
				    <td> <?=$key+1?> </td>
				    <td> <?=$row->name?> </td>
				    <td> <?=$row->email?> </td>
				    <td> <?=$row->title?> </td>
				    <td> <?=$row->firstdate.' - '.$row->lastdate?> </td>
				    <td class="td-actions"><a href="/holiday/edit/<?=$row->id?>" class="btn btn-small btn-primary"><i class="btn-icon-only icon-edit"> </i></a> <a href="/holiday/delete/<?=$row->id?>" onclick="return confirm('Are you sure ?')" class="btn btn-danger btn-small"><i class="btn-icon-only icon-remove"> </i></a></td>
				  </tr>
				<?php } }?>
				</tbody>
			</table>
		</div>
	  </div>
	</div>
  </div>
</div>
