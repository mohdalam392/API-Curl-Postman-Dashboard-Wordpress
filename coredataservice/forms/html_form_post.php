<?php
if (isset($_POST) && !empty($_POST) && isset($_POST['coredataservice_submit'])){


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
	// is active
	$coredataservice_is_active = sanitize_text_field($_POST['is_active']);


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


		global $wpdb;
		$table_name = $wpdb->prefix . 'coredataservices';
		
		$wpdb->insert( 
			$table_name, 
			array(
				'cds_name' => $name, 
				'cds_url_link' => $url, 
				'cds_displayformat' => $coredataservice_displayformat, 
				'cds_method' =>  json_encode(array('method'=>$coredataservice_method,'bodytype'=>$coredataservice_post_method_body_type)),
				'cds_headers' =>  json_encode($headers),
				'cds_postfields_value' => json_encode($getpostfields),
				'cds_responsetypes' => json_encode($responsetypes),
				'cds_selected_columns' => json_encode($selected_columns),
				'cds_shortcode' => 'cds_'.time(),
				'cds_is_active'=>$coredataservice_is_active
			) 
		);
		echo "<script>
				alert('Api Added Successfully');
				window.location.href='".admin_url('admin.php?page=cds_apis_list')."';
			</script>";
}