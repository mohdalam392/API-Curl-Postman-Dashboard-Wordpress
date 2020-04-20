<?php
	/** curl request */
	function coredataservice_curlrequest($url='',$method='GET',$getpostfields=array(),$headers=array()){
		$ch = curl_init();
		$curlConfig = array();
		$getfields = "";

		
		if($method=='PUT'){
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
		}
		elseif($method=='DELETE'){
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
		}elseif($method=='POST'){
			curl_setopt($ch, CURLOPT_POST, true);
			$curlConfig['CURLOPT_POSTFIELDS'] = $getpostfields;
		}elseif($method=='GET'){
			//curl_setopt($ch, CURLOPT_POST, 0);
			$getfields=http_build_query($getpostfields, '', '&'); 
		}

		$curlConfig = array(
		    CURLOPT_URL            => $url.'?'.$getfields,
		    //CURLOPT_POST           => true,
		    CURLOPT_RETURNTRANSFER => true,
		   /* CURLOPT_POSTFIELDS     => array(
		        'field1' => 'some date',
		        'field2' => 'some other data',
		    )*/
		    CURLOPT_HTTPHEADER =>$headers
		);
		
		curl_setopt_array($ch, $curlConfig);
		$result = curl_exec($ch);

		curl_close($ch);
		return $result;
	}

	/** get array index key */
	function getArrayByIndexKey($indexkey='',$data = array()){
		$newdata = array();

		if(!empty($data)){
			switch ($indexkey){
					case "first":
						$newdata = $data[0];
						break;
					case "second":
						$newdata = $data[1];
						break;
					case "third":
						$newdata = $data[2];
						break;
					case "fourth":
						$newdata = $data[3];
						break;
					case "fifth":
						$newdata = $data[4];
						break;
					case "sixth":
						$newdata = $data[5];
						break;
					case "seventh":
						$newdata = $data[6];
						break;
					case "eight":
						$newdata = $data[7];
						break;
					case "ninth":
						$newdata = $data[8];
						break;
					case "tenth":
						$newdata = $data[9];
						break;
					default:
						$newdata =  array();
						break;
			}

		}

		return $newdata;
	}


	/** is multi dimn */
	function is_multidimensional($a) {
	    $rv = array_filter($a,'is_array');
	    if(count($rv)>0) return true;
	    return false;
	}


	/** print columns */
	function print_columns($columns = array(),$data=array()){
		if(!empty($columns) && !empty($data)){
			if(is_multidimensional($data)){
				//foreach ($data as $dat) {
					foreach ($columns as $col) {
						echo  $col.'  -- '.$data[$col]."<br/>";
					}
					echo "---------------------------------------<br/><br/>";
				//}
			}else{
				foreach ($columns as $col) {
					echo  $col.'  -- '.$data[$col]."<br/>";
				}
			}
			
		}
	}

	function print_array($data=array()){
		if(!empty($data) && count($data)>0){
			foreach ($data as $key=>$value) {
				if(is_array($value)){
					//print_array($value);
					echo $key.' : ';
					print_r($value);
					echo '<br/>';
				}else{
					print $key.':'.$value.'<br/>';
				}
			}
			echo "-----------------------------------------<br/><br/>";
		}
	}
?>