<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends CI_Controller {

	public function getinfo(){
 		//working
		// Create a cURL handle
		$ch = curl_init('http://restapi-dev.local.zero8.com/api/users/');

		// Execute
		curl_exec($ch);

		// Check if any error occurred
		if (!curl_errno($ch)) {
		  $info = curl_getinfo($ch);
		  echo 'Took ', $info['total_time'], ' seconds to send a request to ', $info['url'], "\n";
		}

		// Close handle
		curl_close($ch);
	}



	public function test2(){

		$ch = curl_init('http://restapi-dev.local.zero8.com/api/users/');

		// Execute
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_exec($ch);

		// Check if any error occurred
		if(curl_errno($ch))
		{
		    echo 'Curl error: ' . curl_error($ch);
		}

		// Close handle
		curl_close($ch);
	}
	public function test(){
  	   $request = curl_init('http://restapi-dev.local.zero8.com/api/users/');
        curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($request, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($request, CURLOPT_POST, true);
        // curl_setopt($request, CURLOPT_POSTFIELDS, $post);
        $returnData = curl_exec($request);
        $accountInfoArray = (array) json_decode($returnData);
        curl_close($request);
        var_dump( $request);
	}
	public function index()
	{
		/*var_dump('test');die();*/
		$method="POST";

		// $method, $url, $data

		$url = 'http://restapi-dev.local.zero8.com/api/users/';
		$data = '';
		$curl = curl_init();
	   switch ($method){
	      case "POST":
	         curl_setopt($curl, CURLOPT_POST, 1);
	         if ($data)
	            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	         break;
	      case "PUT":
	         curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
	         if ($data)
	            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);			 					
	         break;
	      default:
	         if ($data)
	            $url = sprintf("%s?%s", $url, http_build_query($data));
	   }
	   // OPTIONS:
	   curl_setopt($curl, CURLOPT_URL, $url);
	   curl_setopt($curl, CURLOPT_HTTPHEADER, array(
	      'Content-Type: application/json',
	   ));
	   curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	   curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	   // EXECUTE:
	   $result = curl_exec($curl);
	   if(!$result){die("Connection Failure");}
	   curl_close($curl);
	   return $result;
	}


}
