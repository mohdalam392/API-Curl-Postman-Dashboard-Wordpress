<?php
	$html_ = "";
	if(!empty($datasets) && count($datasets)>0){
		echo  "<div class='datasets_lists'> List Format";
		foreach ($datasets as $key => $value){
			$subdatasets = $value;
			echo  "<div id='".$key."' style='width:250px;border: 1px solid #d3cfcf;hedight: 250px;border-radius: 20px;margin:5px;float:left;padding:10px'>
				<p style='text-align: center;font-weight: bold'>".$key."</p>";

					if(!empty($selected_columns)){
						print_columns($selected_columns,$subdatasets);
					}else{
						print_array($subdatasets);
					}
					
					/*if(is_array($subdatasets)){
						foreach ($subdatasets as $sd){
							if(is_array($sd)){
								foreach ($sd as $key=>$value){
									if(is_array($sd)){
										foreach ($sd as $keys=>$values){
											print $keys.':'.$values.'<br/>';
										}
									}else{
										print $key.':'.$value.'<br/>';
									}
								}
							}else{
								print $sd;
							}
						}
					}else{
						print $subdatasets;
					}*/
			echo  '</div>';
		}
		echo  '</div>';
	}else{
		echo  '<div>No Result Found or Invalid Keys Given</div>';
	}
?>