<div class="account-container" style="margin: 0 auto;">
	
	<div class="content clearfix">
		
		<form action="/product_group/add" method="post">
		
			<h1>Add Group</h1>		
			<?php if(isset($error)) {?>
				<div class="alert alert-danger">
	              <button type="button" class="close" data-dismiss="alert">×</button>
	              <strong>Error!</strong> <?=$error?>
	            </div>
			<?php } ?>		
			<div class="add-fields">

				<div class="field">
					<label for="group_name">Group Name:</label>
					<input type="text" id="group_name" name="group_name" required value="" placeholder="Group Name"/>
				</div> <!-- /field -->
				
			</div> <!-- /login-fields -->
			
			<div class="login-actions">
				
				<button class="button btn btn-success btn-large">Add</button>
				
			</div> <!-- .actions -->
			
		</form>
		
	</div> <!-- /content -->
	
</div> <!-- /account-container -->
<br>