<div class="account-container" style="margin: 0 auto;">
	
	<div class="content clearfix">
		
		<form action="/holiday/edit/<?=$data->id?>" method="post">
		
			<h1>Update Dates</h1>		
			<div class="add-fields">
				<div class="field">
				<label for="userlist">User List:</label>
				<?php if(USERROLE == 1) { ?>
		            <select id="userlist" name="userlist">
		              <?php 
		                if(!empty($userlst))
		                { foreach ($userlst as $key => $value) { 
		                	if($data->customer_id == $value->id) {
		                	?>
		                  <option value="<?=$value->id?>" priceband="<?=$value->priceband?>" selected>
		                    <?=$value->name.'  ['.$value->deliveryaddress.']'?></option>    
		                <?php } else  { ?>
		                <option value="<?=$value->id?>" priceband="<?=$value->priceband?>">
		                    <?=$value->name.'  ['.$value->deliveryaddress.']'?></option>    	
		               <?php }}} ?>
		          </select>
		            <?php } else { ?>
		              <select id="userlist" name="userlist" disabled>
		              <?php 
		                if(!empty($userlst))
		                { foreach ($userlst as $key => $value) { 
		                	if($data->customer_id == $value->id) {
		                	?>
		                  <option value="<?=$value->id?>" priceband="<?=$value->priceband?>" selected>
		                    <?=$value->name.'  ['.$value->deliveryaddress.']'?></option>    
		                <?php } else  { ?>
		                <option value="<?=$value->id?>" priceband="<?=$value->priceband?>">
		                    <?=$value->name.'  ['.$value->deliveryaddress.']'?></option>    	
		               <?php }}} ?>
		              </select>
		            <?php } ?> 
				</div>
				<p>
				<div class="field">
					<label for="holiday_title">Holiday Title:</label>
					<textarea type="text" id="holiday_title" name="holiday_title" style="height: 80px;" required value="" placeholder="Holiday Title"><?=$data->title?></textarea>
				</div> <!-- /field -->

				<div class="field">
					<label for="date_range">Date Range:</label>
					<input id="date_range" name="date_range" required value="<?=$data->firstdate.' - '.$data->lastdate?>" placeholder="
					Date Range"/>
				</div> <!-- /field -->

			</div> <!-- /login-fields -->
			
			<div class="login-actions">
				
				<button class="button btn btn-success btn-large">Save</button>
				
			</div> <!-- .actions -->
			
			
			
		</form>
		
	</div> <!-- /content -->
	
</div> <!-- /account-container -->
<br>