<div class="account-container" style="margin: 0 auto;">
	
	<div class="content clearfix">
		
		<form action="/address/edit/<?=$data->id?>" method="post">
		
			<h1>Update Address's Information</h1>		
			<div class="add-fields">

				<div class="field">
					<label for="address_name">Address Name:</label>
					<input type="text" id="address_name" name="address_name" required value="<?=$data->address?>" placeholder="Address Name"/>
				</div> <!-- /field -->

				<div class="field">
					<label for="address_name">Delivery Price:</label>
					<input type="number" step="0.01" min="0" id="price" name="price" required value="<?=$data->price?>" placeholder="Delivery Price"/>
				</div> <!-- /field -->

			</div> <!-- /login-fields -->
			
			<div class="login-actions">
				
				<button class="button btn btn-success btn-large">Save</button>
				
			</div> <!-- .actions -->
			
			
			
		</form>
		
	</div> <!-- /content -->
	
</div> <!-- /account-container -->
<br>