<div class="account-container" style="margin: 0 auto;">
	
	<div class="content clearfix">
		
		<form action="/address/add" method="post">
		
			<h1>Add Address</h1>
			<?php if(isset($error)) {?>
			<div class="alert alert-danger">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <strong>Error!</strong> <?=$error?>
            </div>
			<?php } ?>		
			<div class="add-fields">

				<div class="field">
					<label for="address_name">Address Name:</label>
					<input type="text" id="address_name" name="address_name" required value="" placeholder="Address Name"/>
				</div> <!-- /field -->
				<div class="field">
					<label for="price">Delivery Price:</label>
					<input type="number" step="0.01" min="0" id="price" name="price" required value="" placeholder="Delivery Price"/>
				</div> <!-- /field -->

			</div> <!-- /login-fields -->
			
			<div class="login-actions">
				
				<button class="button btn btn-success btn-large">Add</button>
				
			</div> <!-- .actions -->
			
		</form>
		
	</div> <!-- /content -->
	
</div> <!-- /account-container -->
<br>