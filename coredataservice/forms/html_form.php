<h1 style="text-align: center;text-decoration: underline;font-size: 40px;">Data Services</h1>
<div classs='coredataservice_form' style="margin: 50px 50px 100px 50px;">
	<form id='api_form_cds'action="" method="post" accept-charset="utf-8">
		<input type="hidden" name="apiid" value="<?php echo $apiid; ?>">
		<div>
			<fieldset class='fset'>
				<legend>Enter Api Name</legend>
				<input type="text" name="coredataservice_name" style="width:100%" value="<?php echo $coredataservice_name; ?>">
			</fieldset>

			<fieldset class='fset'>
				<legend>Enter Api Url</legend>
				<input type="text" name="coredataservice_url" style="width:100%" value="<?php echo $coredataservice_url; ?>">
			</fieldset>
		</div>
		
		<div class='postmethod'>
			<fieldset class='fset'>
				<legend>Api Method</legend>
				<input type='radio' name='coredataservice_method' value='PUT' onclick="setApiMethod('PUT')" <?php if($coredataservice_method['method']=='PUT'){echo "checked='checked'";}?> />PUT
				<input type='radio' name='coredataservice_method' value='POST' onclick="setApiMethod('POST')" <?php if($coredataservice_method['method']=='POST'){echo "checked='checked'";}?>/>POST
				<input type='radio' name='coredataservice_method' value='GET' onclick="setApiMethod('GET')" <?php if($coredataservice_method['method']=='GET' || $coredataservice_method['method']==""){echo "checked='checked'";}?>/>GET

				<input type='radio' name='coredataservice_method' value='DELETE' onclick="setApiMethod('DELETE')" <?php if($coredataservice_method['method']=='DELETE'){echo "checked='checked'";}?>/>DELETE
			</fieldset>
		</div>

		<div class='postheaders'>
			<fieldset class='fset'>
				<legend>Api Headers</legend>
			
				<input type='text' name='coredataservice_headers[]' placeholder="header key: value" value="<?php echo $coredataservice_headers[0];?>"/>
				<input type='text' name='coredataservice_headers[]' placeholder="header key: value" value="<?php echo $coredataservice_headers[1];?>"/>
				<input type='text' name='coredataservice_headers[]' placeholder="header key: value" value="<?php echo $coredataservice_headers[2];?>"/>
				<input type='text' name='coredataservice_headers[]' placeholder="header key: value" value="<?php echo $coredataservice_headers[3];?>"/>
				<input type='text' name='coredataservice_headers[]' placeholder="header key: value" value="<?php echo $coredataservice_headers[4];?>"/>
				<input type='text' name='coredataservice_headers[]' placeholder="header key: value" value="<?php echo $coredataservice_headers[5];?>"/>
			</fieldset>
		</div>

		<div class='postfields' style="<?php if($coredataservice_method['method']=="DELETE" || $coredataservice_method['method']=='PUT'){echo 'display:none';}?>">
			<fieldset class='fset'>
				<legend>Api Post/Get Fields</legend>

				<div id='posttype' style='margin-bottom:20px'>
					<input type="radio" name="post_method_body_type" value="keyvalue" placeholder="" onclick="showhideposttype('keyvalue')" <?php if($coredataservice_method['bodytype']=='keyvalue' || $coredataservice_method['bodytype']==''){echo "checked";} ?>/>Key Value
					<input type="radio" name="post_method_body_type" value="raw" placeholder="" onclick="showhideposttype('raw')" <?php if($coredataservice_method['bodytype']=='raw'){echo "checked";} ?>/>Raw
				</div>

				<div id='rawbodydiv' style="<?php if($coredataservice_method['bodytype']=='raw'){echo 'display:block';}else{echo 'display:none';} ?>" >
					<textarea name="postbodyraw" cols="10" rows="10" style="width:100%"><?php echo stripslashes($coredataservice_rawbodytype); ?></textarea>
				</div>

				<div id='keyvaluediv' style="<?php if($coredataservice_method['bodytype']=='raw'){echo 'display:none';} ?>">
					<div style="margin-bottom:0px">
						Key<input type='text' name='coredataservice_postfields_key[]' placeholder="post/get key" value="<?php echo $coredataservice_postfields_keys[0];?>"/>
						Value<input type='text' name='coredataservice_postfields_value[]' placeholder="post/get value" value="<?php echo $coredataservice_postfields_values[0];?>"/>
					</div>
					<div style="margin-bottom:3px">
						Key<input type='text' name='coredataservice_postfields_key[]' placeholder="post/get key" value="<?php echo $coredataservice_postfields_keys[1];?>"/>
						Value<input type='text' name='coredataservice_postfields_value[]' placeholder="post/get value" value="<?php echo $coredataservice_postfields_values[1];?>"/>
					</div>
					<div style="margin-bottom:3px">
						Key<input type='text' name='coredataservice_postfields_key[]' placeholder="post/get key" value="<?php echo $coredataservice_postfields_keys[2];?>"/>
						Value<input type='text' name='coredataservice_postfields_value[]' placeholder="post/get value" value="<?php echo $coredataservice_postfields_values[2];?>"/>
					</div>
					<div style="margin-bottom:3px">
						Key<input type='text' name='coredataservice_postfields_key[]' placeholder="post key" value="<?php echo $coredataservice_postfields_keys[3];?>" />
						Value<input type='text' name='coredataservice_postfields_value[]' placeholder="post/get value" value="<?php echo $coredataservice_postfields_values[3];?>"/>
					</div>
					<div style="margin-bottom:3px">
						Key<input type='text' name='coredataservice_postfields_key[]' placeholder="post/get key" value="<?php echo $coredataservice_postfields_keys[4];?>"/>
						Value<input type='text' name='coredataservice_postfields_value[]' placeholder="post/get value" value="<?php echo $coredataservice_postfields_values[4];?>"/>
					</div>
					<div style="margin-bottom:3px">
						Key<input type='text' name='coredataservice_postfields_key[]' placeholder="post/get key" value="<?php echo $coredataservice_postfields_keys[5];?>"/>
						Value<input type='text' name='coredataservice_postfields_value[]' placeholder="post/get value" value="<?php echo $coredataservice_postfields_values[5];?>"/>
					</div>
					<div style="margin-bottom:3px">
						Key<input type='text' name='coredataservice_postfields_key[]' placeholder="post/get key" value="<?php echo $coredataservice_postfields_keys[6];?>"/>
						Value<input type='text' name='coredataservice_postfields_value[]' placeholder="post/get value" value="<?php echo $coredataservice_postfields_values[6];?>"/>
					</div>
					<div style="margin-bottom:3px">
						Key<input type='text' name='coredataservice_postfields_key[]' placeholder="post/get key" value="<?php echo $coredataservice_postfields_keys[7];?>"/>
						Value<input type='text' name='coredataservice_postfields_value[]' placeholder="post/get value" value="<?php echo $coredataservice_postfields_values[7];?>"/>
					</div>
					<div style="margin-bottom:3px">
						Key<input type='text' name='coredataservice_postfields_key[]' placeholder="post/get key" value="<?php echo $coredataservice_postfields_keys[8];?>"/>
						Value<input type='text' name='coredataservice_postfields_value[]' placeholder="post/get value" value="<?php echo $coredataservice_postfields_values[8];?>"/>
					</div>
					<div style="margin-bottom:3px">
						Key<input type='text' name='coredataservice_postfields_key[]' placeholder="post/get key" value="<?php echo $coredataservice_postfields_keys[9];?>"/>
						Value<input type='text' name='coredataservice_postfields_value[]' placeholder="post/get value" value="<?php echo $coredataservice_postfields_values[9];?>"/>
					</div>
				</div>
			</fieldset>
		</div>

		<div class='response_format'>
			<fieldset class='fset'>
				<legend>Display format/template</legend>
				<!-- <input type='radio' name='coredataservice_displayformat' value='list' onclick="setDisplayFormat('list')" <?php //if($coredataservice_displayformat=='list'){echo "checked='checked'";} ?> />List
				<input type='radio' name='coredataservice_displayformat' value='tabular' onclick="setDisplayFormat('tabular')" <?php //if($coredataservice_displayformat=='tabular'){echo "checked='checked'";} ?>/>Tabular
				<input type='radio' name='coredataservice_displayformat' value='widget' onclick="setDisplayFormat('widget')" <?php //if($coredataservice_displayformat=='widget' || $coredataservice_displayformat==""){echo "checked='checked'";} ?>/>Widget -->
				<select name='coredataservice_displayformat'>
					<option value="list" <?php if($coredataservice_displayformat=='list'){echo "selected='true'";} ?>>List</option>
					<option value="tabular" <?php if($coredataservice_displayformat=='tabular'){echo "selected='true'";} ?>>Tabular</option>
					<option value="singlepost" <?php if($coredataservice_displayformat=='singlepost'){echo "selected='true'";} ?>>Single Post</option>
					<option value="keyindex" <?php if($coredataservice_displayformat=='keyindex'){echo "selected='true'";} ?>>Key Index</option>
					<!-- <option value="list">List</option>
					<option value="list">List</option>
					<option value="list">List</option>
					<option value="list">List</option> -->
				</select>
			</fieldset>
		</div>

		<div class='response_process_keys'>
			<fieldset class='fset'>
				<legend>Response Process Keys</legend>
			
				<div>
					<input type='radio' name='coredataservice_rpk_indexkey_0' value='index' <?php if($coredataservice_responsetypes[0][0]=='index'){echo "checked='checked'";} ?> />Index
					<input type='radio' name='coredataservice_rpk_indexkey_0' value='key' <?php if($coredataservice_responsetypes[0][0]=='key' || $coredataservice_responsetypes[0][0]==''){echo "checked='checked'";} ?> />Key
					<input type='text' name='coredataservice_rpk[]' placeholder="index/key" value="<?php echo $coredataservice_responsetypes[0][1];?>"/>
				</div>
				<div>
					<input type='radio' name='coredataservice_rpk_indexkey_1' value='index' <?php if($coredataservice_responsetypes[1][0]=='index'){echo "checked='checked'";} ?> />Index
					<input type='radio' name='coredataservice_rpk_indexkey_1' value='key' <?php if($coredataservice_responsetypes[1][0]=='key' || $coredataservice_responsetypes[1][0]==''){echo "checked='checked'";} ?> />Key
					<input type='text' name='coredataservice_rpk[]' placeholder="index/key" value="<?php echo $coredataservice_responsetypes[1][1];?>"/>
				</div>
				<div>
					<input type='radio' name='coredataservice_rpk_indexkey_2' value='index' <?php if($coredataservice_responsetypes[2][0]=='index'){echo "checked='checked'";} ?> />Index
					<input type='radio' name='coredataservice_rpk_indexkey_2' value='key' <?php if($coredataservice_responsetypes[2][0]=='key' || $coredataservice_responsetypes[2][0]==''){echo "checked='checked'";} ?> />Key
					<input type='text' name='coredataservice_rpk[]' placeholder="index/key" value="<?php echo $coredataservice_responsetypes[2][1];?>"/>
				</div>
				<div>
					<input type='radio' name='coredataservice_rpk_indexkey_3' value='index' <?php if($coredataservice_responsetypes[3][0]=='index'){echo "checked='checked'";} ?> />Index
					<input type='radio' name='coredataservice_rpk_indexkey_3' value='key' <?php if($coredataservice_responsetypes[3][0]=='key' || $coredataservice_responsetypes[3][0]==''){echo "checked='checked'";} ?> />Key
					<input type='text' name='coredataservice_rpk[]' placeholder="index/key" value="<?php echo $coredataservice_responsetypes[3][1];?>"/>
				</div>
				<div>
					<input type='radio' name='coredataservice_rpk_indexkey_4' value='index' <?php if($coredataservice_responsetypes[4][0]=='index'){echo "checked='checked'";} ?> />Index
					<input type='radio' name='coredataservice_rpk_indexkey_4' value='key' <?php if($coredataservice_responsetypes[4][0]=='key' || $coredataservice_responsetypes[4][0]==''){echo "checked='checked'";} ?> />Key
					<input type='text' name='coredataservice_rpk[]' placeholder="index/key" value="<?php echo $coredataservice_responsetypes[4][1];?>"/>
				</div>
				<div>
					<input type='radio' name='coredataservice_rpk_indexkey_5' value='index' <?php if($coredataservice_responsetypes[5][0]=='index'){echo "checked='checked'";} ?> />Index
					<input type='radio' name='coredataservice_rpk_indexkey_5' value='key' <?php if($coredataservice_responsetypes[5][0]=='key' || $coredataservice_responsetypes[5][0]==''){echo "checked='checked'";} ?> />Key
					<input type='text' name='coredataservice_rpk[]' placeholder="index/key" value="<?php echo $coredataservice_responsetypes[5][1];?>"/>
				</div>
				<div>
					<input type='radio' name='coredataservice_rpk_indexkey_6' value='index' <?php if($coredataservice_responsetypes[6][0]=='index'){echo "checked='checked'";} ?> />Index
					<input type='radio' name='coredataservice_rpk_indexkey_6' value='key' <?php if($coredataservice_responsetypes[6][0]=='key' || $coredataservice_responsetypes[6][0]==''){echo "checked='checked'";} ?> />Key
					<input type='text' name='coredataservice_rpk[]' placeholder="index/key" value="<?php echo $coredataservice_responsetypes[6][1];?>"/>
				</div>
				<div>
					<input type='radio' name='coredataservice_rpk_indexkey_7' value='index' <?php if($coredataservice_responsetypes[7][0]=='index'){echo "checked='checked'";} ?> />Index
					<input type='radio' name='coredataservice_rpk_indexkey_7' value='key' <?php if($coredataservice_responsetypes[7][0]=='key' || $coredataservice_responsetypes[7][0]==''){echo "checked='checked'";} ?> />Key
					<input type='text' name='coredataservice_rpk[]' placeholder="index/key" value="<?php echo $coredataservice_responsetypes[7][1];?>"/>
				</div>
			</fieldset>
		</div>

		
		<div class='selected_columns'>
			<fieldset class='fset'>
				<legend>Add columns to select</legend>
			
				<input type='text' name='selected_columns[]' placeholder="column name" value="<?php echo $selected_columns[0];?>"/>
				<input type='text' name='selected_columns[]' placeholder="column name" value="<?php echo $selected_columns[1];?>"/>
				<input type='text' name='selected_columns[]' placeholder="column name" value="<?php echo $selected_columns[2];?>"/>
				<input type='text' name='selected_columns[]' placeholder="column name" value="<?php echo $selected_columns[3];?>"/>
				<input type='text' name='selected_columns[]' placeholder="column name" value="<?php echo $selected_columns[4];?>"/>
				<input type='text' name='selected_columns[]' placeholder="column name" value="<?php echo $selected_columns[5];?>"/>
				<input type='text' name='selected_columns[]' placeholder="column name" value="<?php echo $selected_columns[6];?>"/>
				<input type='text' name='selected_columns[]' placeholder="column name" value="<?php echo $selected_columns[7];?>"/>
				<input type='text' name='selected_columns[]' placeholder="column name" value="<?php echo $selected_columns[8];?>"/>
				<input type='text' name='selected_columns[]' placeholder="column name" value="<?php echo $selected_columns[9];?>"/>
				<input type='text' name='selected_columns[]' placeholder="column name" value="<?php echo $selected_columns[10];?>"/>
				<input type='text' name='selected_columns[]' placeholder="column name" value="<?php echo $selected_columns[11];?>"/>
				<input type='text' name='selected_columns[]' placeholder="column name" value="<?php echo $selected_columns[12];?>"/>
				<input type='text' name='selected_columns[]' placeholder="column name" value="<?php echo $selected_columns[13];?>"/>
				<input type='text' name='selected_columns[]' placeholder="column name" value="<?php echo $selected_columns[14];?>"/>
				<input type='text' name='selected_columns[]' placeholder="column name" value="<?php echo $selected_columns[15];?>"/>
				<input type='text' name='selected_columns[]' placeholder="column name" value="<?php echo $selected_columns[16];?>"/>
				<input type='text' name='selected_columns[]' placeholder="column name" value="<?php echo $selected_columns[17];?>"/>
			</fieldset>
		</div>

		<div style="margin-bottom:10px">
			<input type='checkbox' name='is_active' value='yes' <?php if($cds_active=='yes'){ echo "checked='checked'";} ?>/>Active
		</div>

		<div>
			<input type="submit" value="Test Api" name='coredataservice_test_submit'>
			<?php if(!empty($result)){ ?>
				<input type="submit" value="Update Api" name='coredataservice_update_submit'>
			<?php }else{ ?>
				<input type="submit" value="Save Api" name='coredataservice_submit'>	
			<?php } ?>
		</div>
	</form>
</div>


