<div class="account-container" style="margin: 0 auto;">
	
	<div class="content clearfix">
		
		<form action="/holiday/add" method="post">
		
			<h1>Add Dates</h1>
			<?php if(isset($error)) {?>
			<div class="alert alert-danger">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <strong>Error!</strong> <?=$error?>
            </div>
			<?php } ?>		
			<div class="field">
				<label for="userlist">User List:</label>
				<?php if(USERROLE == 1) { ?>
		            <select id="userlist" name="userlist">
		              <?php 
		                if(!empty($userlst))
		                { foreach ($userlst as $key => $value) { ?>
		                  <option value="<?=$value->id?>" priceband="<?=$value->priceband?>">
		                    <?=$value->name.'  ['.$value->deliveryaddress.']'?></option>    
		               <?php }} ?>
		          </select>
		            <?php } else { ?>
		              <select id="userlist" name="userlist" disabled>
		              <?php 
		                if(!empty($userlst))
		                { foreach ($userlst as $key => $value) { ?>
		                  <option value="<?=$value['id']?>" priceband="<?=$value['priceband']?>">
		                    <?=$value['name'].'  ['.$value['deliveryaddress'].']'?></option>    
		               <?php }} ?>
		              </select>
		            <?php } ?> 
				</div>
				<p>

				<div class="field">
					<label for="holiday_title">Title:</label>
					<textarea type="text" id="holiday_title" name="holiday_title" style="height: 80px;" required value="" placeholder="Holiday Title"></textarea>
				</div> <!-- /field -->
				<div class="field">
					<label for="date_range">Date Range:</label>
					<input id="date_range" name="date_range" required value="" placeholder="Date Range"/>
				</div> <!-- /field -->

				<div class="login-actions">
					<button class="button btn btn-success btn-large">Add</button>
				</div> <!-- .actions -->
			</div> <!-- /login-fields -->
			
			
			
		</form>
		
	</div> <!-- /content -->
	
</div> <!-- /account-container -->
<br>
