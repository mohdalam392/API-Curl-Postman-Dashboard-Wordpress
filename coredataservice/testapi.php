<?php 
	if (isset($_POST) && !empty($_POST) && isset($_POST['coredataservice_test_submit'])){

		/** headers starts **/	
		$headers = array();
		$coredataservice_headers = $_POST['coredataservice_headers'];
		if(!empty($coredataservice_headers)){
			foreach ($coredataservice_headers as $value) {
				if(!empty($value)){
					$headers[] = sanitize_text_field($value);
				}
			}
		}
		/** headers ends **/	


		/** headers starts **/
		$getpostfields = array();	
		$coredataservice_postfields_key = $_POST['coredataservice_postfields_key'];
		$coredataservice_postfields_value = $_POST['coredataservice_postfields_value'];
		if(!empty($coredataservice_postfields_key) && count($coredataservice_postfields_key)>0){
			for($i=0;$i<count($coredataservice_postfields_key);$i++){
				$key = sanitize_text_field($coredataservice_postfields_key[$i]);
				$value = sanitize_text_field($coredataservice_postfields_value[$i]);
				if(!empty($key) && !empty($value)){
					$getpostfields[$key] = $value;
				}
				
			}
		}
		/** headers ends **/	


		/** response process keys starts **/	
		$responsetypes = array();
		$coredataservice_rpk = $_POST['coredataservice_rpk'];
		if(!empty($coredataservice_rpk)){
			$i=0;
			foreach ($coredataservice_rpk as $value) {
				if(!empty($value)){
					$coredataservice_rpk_indexkey = sanitize_text_field($_POST["coredataservice_rpk_indexkey_{$i}"]);
					$responsetypes[] = array(
											$coredataservice_rpk_indexkey,
											sanitize_text_field($value)
										);
				}
				$i++;
			}
		}
		
		/** response process keys starts **/


		// api method
		$coredataservice_method = sanitize_text_field($_POST['coredataservice_method']);

		// api method post body raw
		$coredataservice_postbodyraw = sanitize_textarea_field($_POST['postbodyraw']);

		
		
		// api method post body type
		$coredataservice_post_method_body_type = sanitize_text_field($_POST['post_method_body_type']);


		// api method
		$coredataservice_displayformat = sanitize_text_field($_POST['coredataservice_displayformat']);
		

		// url
		$url = sanitize_text_field($_POST['coredataservice_url']);


		// url
		$name = sanitize_text_field($_POST['coredataservice_name']);
		

		/** selected_columns starts **/	
		$selected_columns = array();
		$coredataservice_selected_columns = $_POST['selected_columns'];
		if(!empty($coredataservice_selected_columns)){
			foreach ($coredataservice_selected_columns as $value) {
				if(!empty($value)){
					$selected_columns[] = sanitize_text_field($value);
				}
			}
		}
		/** selected_columns ends **/


		if($coredataservice_method=='raw'){
			$getpostfields = $coredataservice_postbodyraw;
		}

		// curl request
		$result = coredataservice_curlrequest($url,$coredataservice_method,$getpostfields,$headers);
		$result_decoded = json_decode( $result, true );

		if(!empty($result)){?>
			<fieldset class='fset'>
				<legend>Api Response is</legend>
				<textarea id='api_res' name='api_res' cols='100' rows='100' style='display:nonee;width:90%;height:200px'><?php echo $result; ?></textarea>
				<pre id="json-renderer" style='background:white;height:200px;overflow:scroll'></pre>
			</fieldset>
		<?php
			//print_r($result);
			$template = $coredataservice_displayformat;


			/* ---------------------------------------------------------------------  */
			$ds = array();
			$datasets = array();

			if(!empty($coredataservice_responsetypes[0][1])){
				// if not empty zero
				if(!empty($coredataservice_responsetypes[0][1])){
					if($coredataservice_responsetypes[0][0]=='key'){
						$ds = $result_decoded[$coredataservice_responsetypes[0][1]];
					}elseif($coredataservice_responsetypes[0][0]=='index'){
						$ds = getArrayByIndexKey($coredataservice_responsetypes[0][1],$result_decoded);
					}
				}

				// if not empty first index
				if(!empty($coredataservice_responsetypes[1][1])){
					if($coredataservice_responsetypes[1][0]=='key'){
						$ds = $ds[$coredataservice_responsetypes[1][1]];
					}elseif($coredataservice_responsetypes[1][0]=='index'){
						$ds = getArrayByIndexKey($coredataservice_responsetypes[1][1],$ds);
					}
				}

				// if not empty second index
				if(!empty($coredataservice_responsetypes[2][1])){
					if($coredataservice_responsetypes[2][0]=='key'){
						$ds = $ds[$coredataservice_responsetypes[2][1]];
					}elseif($coredataservice_responsetypes[2][0]=='index'){
						$ds = getArrayByIndexKey($coredataservice_responsetypes[2][1],$ds);
					}
				}

				// if not empty third index
				if(!empty($coredataservice_responsetypes[3][1])){
					if($coredataservice_responsetypes[3][0]=='key'){
						$ds = $ds[$coredataservice_responsetypes[3][1]];
					}elseif($coredataservice_responsetypes[3][0]=='index'){
						$ds = getArrayByIndexKey($coredataservice_responsetypes[3][1],$ds);
					}
				}

				// if not empty fourth index
				if(!empty($coredataservice_responsetypes[4][1])){
					if($coredataservice_responsetypes[4][0]=='key'){
						$ds = $ds[$coredataservice_responsetypes[4][1]];
					}elseif($coredataservice_responsetypes[4][0]=='index'){
						$ds = getArrayByIndexKey($coredataservice_responsetypes[4][1],$ds);
					}	
				}

				$datasets = $ds;
			}else{
				$datasets = $result_decoded;
			}
			/* ---------------------------------------------------------------------  */
			
			require_once('views/display_'.$template.'.php');
		}else{
			echo '<p>No Response Returned....</p>';
		}
	}
?>