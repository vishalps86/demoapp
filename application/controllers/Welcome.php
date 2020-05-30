<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->helper('url');
		
		$this->load->view('welcome_message');		
	}

	public function api() {		

		$zillow_response = $this->getZillowResponse($_POST);
		$estated_response = $this->getEstatedResponse($_POST);		
		$resp['zillow_response'] = $zillow_response;
		$resp['estated_response'] = $estated_response;
		echo json_encode($resp);
		
	}

	public function getZillowResponse($data) {
		$address = urlencode($data['address_street']." ".$data['route']);
		$city = $data['city'];
		$state = $data['state'];
		$zip = $data['zip'];		
		
		$citystatezip = urlencode($city.",".$state);

		$this->load->helper('zillow_api');		
		$zws_id = $this->config->item('zillow_api_key');
		
		$zillow_api = new Zillow_Api($zws_id); 
		$search_result = $zillow_api->GetSearchResults(array('address' => $address, 'citystatezip' => $citystatezip));	
		
		$resp['message_text'] = (string) $search_result->message[0]->text;
		$resp['error_code']  = 	(string) $search_result->message[0]->code;

		return $resp;
	}

	public function getEstatedResponse($data) {
		$address = urlencode($data['address_street']." ".$data['route']);
		$city = urlencode($data['city']);
		$state = $data['state'];
		$zip = $data['zip'];		

		$estated_api_key = $this->config->item('estated_api_key');

		$this->load->library('Curl');		
		$this->curl->create("https://apis.estated.com/v4/property?token=".$estated_api_key."&street_address=".$address."&city=".$city."&state=".$state."&zip_code=".$zip."");
		$this->curl->option('connecttimeout', 600);
		$this->curl->option('returntransfer', 1);
		$this->curl->option('SSL_VERIFYPEER', false);
		$this->curl->option('SSL_VERIFYHOST', false);
		$this->curl->option('CURLOPT_FOLLOWLOCATION', 1);
		$this->curl->option('CURLOPT_HEADER', 1);		

		$this->curl->option('SSLVERSION', 3);

		$res = $this->curl->execute();
		
		 $json = json_decode($res);
		 if (!empty($json->error)) {
		 	$response_data['error'] = $json->error->description;
		 }
		 else {
			 $response_data['area_sq_ft'] = $json->data->parcel->area_sq_ft;
			 $response_data['lot_number'] = $json->data->parcel->lot_number;
			 $response_data['year_built'] = $json->data->structure->year_built;
			 $response_data['beds_count'] = $json->data->structure->beds_count;
			 $response_data['baths_count'] = $json->data->structure->baths; 
			 $response_data['error'] = 0;
		}
	 
	     return $response_data;
	}

}
