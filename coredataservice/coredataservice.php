<?php 
/**
 * Plugin Name:Core Data Services
 * Description: Description
 * Plugin URI: http://#
 * Author: Mohd Alam
 * Author URI: http://facebook.com/alamdeveloper
 * Version: 1.0.0
 * License: GPL2
 * Text Domain: text-domain
 * Domain Path: http://facebook.com/alamdeveloper
 */
?>
<?php
/** core functions file*/
require_once('core_functions.php');


function admin_enqueue_scripts_func() {
    wp_enqueue_script( 'jsonpath_js', plugin_dir_url( __FILE__ ) . 'js/json-viewer/jquery.json-viewer.js', array('jquery'), '1.0' );
    wp_enqueue_style('jsonpath_css', plugin_dir_url(__FILE__).'js/json-viewer/jquery.json-viewer.css');

    wp_enqueue_style( 'dataTables_css', plugin_dir_url( __FILE__ ) .'js/datatable/jquery.dataTables.min.css', '', '1.0', true );
    wp_enqueue_script( 'dataTables_js', plugin_dir_url( __FILE__ ) .'js/datatable/jquery.dataTables.min.js' , array('jquery'), '1.0', true );

    wp_enqueue_script( 'jqueryvalidation_js', plugin_dir_url( __FILE__ ) .'js/jquery-validation/jquery.validate.js' , array('jquery'), '1.0', true );
     wp_enqueue_script( 'jqueryvalidation_add_js', plugin_dir_url( __FILE__ ) .'js/jquery-validation/additional-methods.js' , array('jquery'), '1.0', true );
    
}
add_action( 'admin_enqueue_scripts', 'admin_enqueue_scripts_func' );

function coredataservices_deactivation(){
}
function coredataservices_activation(){
	global $wpdb;
 	$table_name = $wpdb->prefix . 'coredataservices';
 	$wpdb_collate = $wpdb->collate;
 	$sql =
     	"CREATE TABLE {$table_name} (
		id int(11) unsigned NOT NULL auto_increment ,
		cds_name varchar(255) NULL,
		cds_url_link varchar(255) NULL,
		cds_displayformat varchar(255) NULL,
		cds_method varchar(255) NULL,
		cds_headers longtext NULL,
		cds_postfields_value longtext NULL,
		cds_responsetypes varchar(255) NULL,
     	cds_selected_columns text NULL,
     	cds_shortcode varchar(255) NULL,
     	cds_is_active varchar(255) NULL,
     	cds_created_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
		cds_updated_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
         PRIMARY KEY (id)
         )
         COLLATE {$wpdb_collate}";
 
 	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
 	dbDelta( $sql );
}

function coredataservices_add_adminmenu() {
 	add_menu_page(
        __( 'Coredata Services', 'textdomain' ),
        __( 'Coredata Services','textdomain' ),
        'manage_options',
        'coredataservices',
        'coredataservices_callback',
        'dashicons-store'
    );

    add_submenu_page(
        'coredataservices',
        __( "Api's List", 'textdomain' ),
        __( "Api's List", 'textdomain' ),
        'manage_options',
        'cds_apis_list',
        'coredataservices_list_callback'
    );
	
}
function coredataservices_list_callback() { 
	global $wpdb;
 	$table_name = $wpdb->prefix . 'coredataservices';
 	$result = $wpdb->get_results ( "
					    SELECT  id, 
					    		cds_name ,
					    		cds_url_link ,
					    		cds_displayformat,
					    		cds_method,
					    		cds_headers,
					    		cds_postfields_value,
					    		cds_responsetypes,
					    		cds_selected_columns,
					    		cds_shortcode,
					    		cds_is_active,
					    		cds_created_date,
				    			cds_updated_date
					    FROM {$table_name}
					" );
 	
?>
    <div class="wrap">
        <h1 style="text-align: center;"><?php _e( "Coredataservices Api's List", 'textdomain' ); ?></h1>
        <?php if(!empty($result)){ ?>
        		<table id='apislisttable' class="display">
        			<caption>Api's List</caption>
        			<thead>
        				<tr>
        					<th>ID</th>
        					<th>API Name</th>
        					<th>API URL</th>
        					<th>Display Format/Template</th>
        					<th>Method</th>
        					<th>Headers</th>
        					<th>Post Fields</th>
        					<th>Response Type</th>
        					<th>Coloumns</th>
        					<th>Shortcode</th>
        					<th>Created Date</th>
        					<th>Updated Date</th>
        					<th>Edit</th>
        					<th>Delete</th>
        				</tr>
        			</thead>
        			<tbody>
        				<?php foreach ($result as $api) { ?>
	        				<tr>
	        					<td><?php echo $api->id; ?></td>
	        					<td><?php echo $api->cds_name; ?></td>
	        					<td><?php echo $api->cds_url_link; ?></td>
	        					<td><?php echo $api->cds_displayformat; ?></td>
	        					<td><?php echo $api->cds_method; ?></td>
	        					<td><?php echo $api->cds_headers; ?></td>
	        					<td><?php echo stripslashes($api->cds_postfields_value); ?></td>
	        					<td><?php echo $api->cds_responsetypes; ?></td>
	        					<td><?php echo $api->cds_selected_columns; ?></td>
	        					<td><input type="textfield" name="" value="<?php echo $api->cds_shortcode; ?>" editable=false/></td>
	        					<td><?php echo $api->cds_created_date; ?></td>
	        					<td><?php echo $api->cds_updated_date; ?></td>
	        					<td><a href="<?php echo admin_url('admin.php?page=coredataservices&action=edit&cdsid='.$api->id) ?>">Edit</a></td>
	        					<td><a href="<?php echo admin_url('admin.php?page=coredataservices&action=delete&cdsid='.$api->id) ?>">Delete</a></td>
	        				</tr>
        				<?php } ?>
        			</tbody>
        			<tfoot>
        				<tr>
        					<th>ID</th>
        					<th>API Name</th>
        					<th>API URL</th>
        					<th>Display Format</th>
        					<th>Method</th>
        					<th>Headers</th>
        					<th>Post Fields</th>
        					<th>Response Type</th>
        					<th>Coloumns</th>
        					<th>Shortcode</th>
        					<th>Created Date</th>
        					<th>Updated Date</th>
        					<th>Edit</th>
        				</tr>
        			</tfoot>
        		</table>
        <?php
        }else{
        	echo 'There is no api available.....';
        } ?>
    </div>
    <?php
}

function coredataservices_callback(){
	$cdsid = sanitize_text_field($_GET['cdsid']);
	$action = sanitize_text_field($_GET['action']);

	global $wpdb;
	$table_name = $wpdb->prefix . 'coredataservices';

	if(!empty($cdsid) && $action=='delete'){
		$wpdb->delete( $table_name, array( 'id' => $cdsid ) );
			echo "<script>
					alert('Api Deleted Successfully');
					window.location.href='".admin_url('admin.php?page=cds_apis_list')."';
				</script>";
	}	
	else if(!empty($cdsid) && $action=='edit'){
		global $wpdb;
	 	$table_name = $wpdb->prefix . 'coredataservices';
	 	$result = $wpdb->get_results ( "
					    SELECT  id, 
					   			cds_name,
					    		cds_url_link ,
					    		cds_displayformat,
					    		cds_method,
					    		cds_headers,
					    		cds_postfields_value,
					    		cds_responsetypes,
					    		cds_selected_columns,
					    		cds_shortcode,
					    		cds_is_active,
					    		cds_created_date,
				    			cds_updated_date
					    FROM {$table_name}
					    where id='".$cdsid."'
					" );
	 	if(!empty($result)){
	 		$apiid = $result[0]->id;
	 		$coredataservice_name = $result[0]->cds_name;
	 		$coredataservice_url = $result[0]->cds_url_link;
	 		$coredataservice_method = json_decode($result[0]->cds_method,true);
	 		$coredataservice_headers = json_decode($result[0]->cds_headers,true);

	 		

	 	
	 		if($coredataservice_method['bodytype']=='raw'){
	 			$coredataservice_postfields = ($result[0]->cds_postfields_value);
	 			$coredataservice_rawbodytype = $coredataservice_postfields;
	 		}else{
	 			$coredataservice_postfields = json_decode($result[0]->cds_postfields_value,true);
	 			$coredataservice_postfields_keys  = $coredataservice_postfields?array_keys($coredataservice_postfields):array();
	 			$coredataservice_postfields_values = $coredataservice_postfields?array_values($coredataservice_postfields):array();
	 		}

	 		
	 		
	 		$coredataservice_responsetypes = json_decode($result[0]->cds_responsetypes,true);
	 		$selected_columns = json_decode($result[0]->cds_selected_columns,true);
	 		$cds_active = $result[0]->cds_is_active;

	 		$coredataservice_displayformat = $result[0]->cds_displayformat;
	 		


	 		require_once('forms/html_form_post_update.php');
			require_once('forms/html_form.php');
	 	}else{
	 		echo 'Invalid Id';
	 	}
		
	}else{
		require_once('forms/html_form_post.php');
		require_once('forms/html_form.php');
	}

	require_once('testapi.php');
}
function coredataservices_uninstall(){
	flush_rewrite_rules();
}


add_action('admin_menu', 'coredataservices_add_adminmenu');

add_action('admin_footer','admin_footer_css');
function admin_footer_css(){?>
		<style type='text/css'>
			.coredataservice_form{
				
			}
			.fset{
				border:1px solid #c1bdbd;
				padding:10px;
				margin:5px;
			}
			.fset input[type="text"] {
			    margin: 1px;
			}

			.error{color: red}

			input[type='text'].error,
			input[type='url'].error,
			input[type='radio'].error,
			input[type='select'].error,
			input[type='checkbox'].error
		  	{
			    border:1px solid red;
			}
			

		</style>
		<script>
			jQuery(document).ready(function($) {
				var options = {
			      collapsed:false,
			      rootCollapsable: false,
			      withQuotes: true,
			      withLinks: false
			    };
			    jQuery('#json-renderer').jsonViewer(eval('(' + jQuery('#api_res').html()+ ')'),options);

			    // data table
			    jQuery('#apislisttable').DataTable();


			    // validation
			    jQuery( "#api_form_cds" ).validate({
			  		rules: {
			  			"coredataservice_name": { required: true},
					    "coredataservice_url": { required: true},
					    "coredataservice_method": { required: true},
					    "coredataservice_headers[]": { required: false},
					    "coredataservice_postfields_key[]": { required: false},
					    "coredataservice_rpk[]": { required: false},
					    "selected_columns[]": { required: false},
					    "coredataservice_displayformat": { required: true},
				    }
				});
			});

			function setApiMethod(method){
				if(method=='POST' || method=='GET'){
					jQuery('.postfields').show();
					if(method=='POST'){
						jQuery("input[type=radio][value='raw']").prop("disabled",false);
					}else{
						jQuery("input[type=radio][value='raw']").prop("disabled",true);
					}
				}else{
					jQuery('.postfields').hide();
				}
			}
			function showhideposttype(showposttype){
				if(showposttype=='raw'){
					jQuery('#rawbodydiv').show();
					jQuery('#keyvaluediv').hide();
				}else{
					jQuery('#rawbodydiv').hide();
					jQuery('#keyvaluediv').show();
				}
			}

			function setDisplayFormat(format='list'){

			}
		</script>
<?php
}

register_activation_hook( __FILE__, 'coredataservices_activation' );
register_deactivation_hook( __FILE__, 'coredataservices_deactivation' );
register_uninstall_hook(__FILE__, 'coredataservices_uninstall');


function coredataservices_admininit() {
    global $wpdb;
 	$table_name = $wpdb->prefix . 'coredataservices';
 	$result = $wpdb->get_results ( "
				    SELECT  id, 
				    		cds_url_link ,
				    		cds_displayformat,
				    		cds_method,
				    		cds_headers,
				    		cds_postfields_value,
				    		cds_responsetypes,
				    		cds_selected_columns,
				    		cds_shortcode,
				    		cds_is_active,
				    		cds_created_date,
			    			cds_updated_date
				    FROM {$table_name}
				" );
 	if(!empty($result)){
 		foreach ($result as $rs) {
 			add_shortcode( "$rs->cds_shortcode", function() use ($rs) {
 				$result = $rs;

 				$apiid = $result->id;
		 		$coredataservice_url = $result->cds_url_link;
		 		$coredataservice_method = json_decode($result->cds_method,true);

		 		$coredataservice_headers = json_decode($result->cds_headers,true);
		 		$coredataservice_postfields = json_decode($result->cds_postfields_value,true);


		 		$coredataservice_postfields_keys  = $coredataservice_postfields?array_keys($coredataservice_postfields):array();
		 		$coredataservice_postfields_values = $coredataservice_postfields?array_values($coredataservice_postfields):array();
		 		
		 		$coredataservice_responsetypes = json_decode($result->cds_responsetypes,true);
		 		$selected_columns = json_decode($result->cds_selected_columns,true);
		 		$cds_active = $result->cds_is_active;

		 		//$coredataservice_displayformat = $result->cds_displayformat;

 				
 				$template = $rs->cds_displayformat;

 				$result = coredataservice_curlrequest($coredataservice_url,$coredataservice_method['method'],$coredataservice_postfields,$coredataservice_headers);
				$result_decoded = json_decode( $result, true );


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
		    });
 		}
 	}
}

add_action( 'init', 'coredataservices_admininit' );
//add_action( 'admin_init', 'coredataservices_admininit' );
?>