<div class="account-container" style="margin: 0 auto;">
	
	<div class="content clearfix">
		
		<form action="/employee/edit/<?=$data->id?>" method="post">
		
			<h1>Edit User</h1>		
				
			<div class="add-fields">

				<div class="field">
					<label for="name">Name:</label>
					<input type="text" id="name" name="name" required value="<?=$data->name?>" placeholder="Username"/>
				</div> <!-- /field -->

				<div class="field">
					<label for="password">Password:</label>
					<input type="text" id="password" name="password" required placeholder="Password" value="<?=$data->password?>" />
				</div> <!-- /password -->

				<div class="field">
					<label for="bussname">Bussiness Name:</label>
					<input type="text" id="bussname" name="bussname" value="<?=$data->businessname?>" placeholder="Bussiness Name"/>
				</div> <!-- /field -->
				
				<div class="field">
					<label for="email">Email:</label>
					<input type="email" id="email" name="email" required value="<?=$data->email?>" placeholder="Email"/>
				</div> <!-- /field -->

				<div class="field">
					<label for="abn">ABN:</label>
					<input type="number" id="abn" name="abn"  value="<?=$data->abn?>" placeholder="ABN"/>
				</div> <!-- /password -->

				<div class="field">
					<label for="priceband">Price Band:</label>
					<select id="priceband" name="priceband">
                    	<?php if($data->priceband == 'A') { ?>
	                    	<option value="A" selected> A </option>
	                    	<option value="B"> B </option>
	                    	<option value="C"> C </option>
	                    	<option value="D"> D </option>
	                    <?php } else if($data->priceband  == 'B'){ ?>	
	                    	<option value="A"> A </option>
	                    	<option value="B" selected> B </option>
	                    	<option value="C"> C </option>
	                    	<option value="D"> D </option>
	                   <?php } else if($data->priceband == 'C'){ ?> 
	                   		<option value="A"> A </option>
	                    	<option value="B"> B </option>
	                    	<option value="C" selected> C </option>
	                    	<option value="D"> D </option>
	                   <?php } else if($data->priceband == 'D'){ ?> 
	                   		<option value="A"> A </option>
	                    	<option value="B"> B </option>
	                    	<option value="C"> C </option>
	                    	<option value="D" selected> D </option>
	                   <?php } ?>
                    </select>
				</div> <!-- /field -->

				<div class="field">
					<label for="deliveryaddress">Delivery Address:</label>
					<input type="text" id="address" name="address" value="<?=$data->deliveryaddress?>" placeholder="Delivery Address"/>
				</div> <!-- /field -->

				<div class="field">
					<label for="role">Role:</label>
					<select id="role" name="role">
                    	<?php if($data->role == '0') { ?>
	                    	<option value="1"> Admin </option>
	                    	<option value="0" selected> Customer </option>
                    	<?php } else if($data->role == '1'){ ?> 
                    		<option value="1" selected="" d> Admin </option>
	                    	<option value="0"> Customer </option>
	                    <?php } ?>
                    </select>
				</div> <!-- /field -->
			</div> <!-- /login-fields -->
			
			<div class="login-actions">
				<button class="button btn btn-success btn-large">Update</button>
			</div> <!-- .actions -->
		
		</form>
		
	</div> <!-- /content -->
	
</div> <!-- /account-container -->
<br>