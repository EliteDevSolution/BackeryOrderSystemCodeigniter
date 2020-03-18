<div class="account-container" style="margin: 0 auto;">
	<div class="content clearfix">
		<form action="/product/edit/<?=$data->id?>" method="post">
			<h1>Update Proudct</h1>		
			<div class="add-fields">
				<div class="field">
					<label for="group_name">Group Name:</label>
					<select id="group_name" name="group_name">
                        <?php 
                        	if(!empty($grouplst))
                        	{ foreach ($grouplst as $key => $value) { 
                        		if($value->id == $data->groupid)	{?>
                        		<option value="<?=$value->id?>" selected><?=$value->name?></option>		
                        	<?php } else { ?>
                        	 	<option value="<?=$value->id?>"><?=$value->name?></option>		
                         <?php }
                        }} ?>
                     </select>
				</div> <!-- /field -->
				<div class="field">
					<label for="product_name">Product Name:</label>
					<input type="text" id="product_name" name="product_name" required value="<?=$data->name?>" placeholder="Product Name"/>
				</div> <!-- /field -->
				<div class="field">
					<label for="price_a">Price A:</label>
					<input type="number" step="0.01" min="0" id="price_a" name="price_a" required value="<?=$data->pricea?>" 
					placeholder="Price A"/>
				</div> <!-- /field -->
				<div class="field">
					<label for="price_b">Price B:</label>
					<input type="number" step="0.01" min="0" id="price_b" name="price_b" required value="<?=$data->priceb?>" 
					placeholder="Price B"/>
				</div> <!-- /field -->
				<div class="field">
					<label for="price_c">Price C:</label>
					<input type="number" step="0.01" min="0" id="price_c" name="price_c" required value="<?=$data->pricec?>" 
					placeholder="Price C"/>
				</div> <!-- /field -->

				<div class="field">
					<label for="price_d">Price D:</label>
					<input type="number" step="0.01" min="0" id="price_d" name="price_d" required value="<?=$data->priced?>" 
					placeholder="Price D"/>
				</div> <!-- /field -->
				<div class="field">
					<label for="tax">TAX:</label>
					<select id="tax" name="tax">
						<?php if($data->gst == '1') { ?>
	                        <option value="1" selected>TRUE</option>
	                        <option value="0">FALSE</option>
                    	<?php } else { ?>
                    		<option value="1">TRUE</option>
	                        <option value="0" selected>FALSE</option>
                    	<?php } ?>	
                    </select>
				</div> <!-- /field -->

				<div class="field">
					<label for="desc">Description:</label>
					<textarea name='desc' id='desc' placeholder="Description" rows="4"><?=$data->description?></textarea>
				</div> <!-- /field -->
			
			</div> <!-- /login-fields -->
			
			<div class="login-actions">
				
				<button class="button btn btn-success btn-large">Save</button>
				
			</div> <!-- .actions -->
			
		</form>
		
	</div> <!-- /content -->
	
</div> <!-- /account-container -->
<br>