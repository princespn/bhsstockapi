<?php
App::uses('Controller', 'Controller');

class StocksController extends AppController {

    var $name = 'Stocks';
	var $components = array('Acl', 'Auth', 'Session', 'Cookie','Email');
	public $helpers = array('Form', 'Html', 'Js', 'Time');
		
	
	function tokenkey(){
		 $auth_data = array(
			'userName' =>'roopa@homescapesonline.com',
			'password' =>'bhslinn',
			'userId' =>'ffc7e454-b0b3-4d67-ad10-23c639a61992'); 
			$header = array("POST:https://api.linnworks.net//api/Auth/Authorize HTTP/1.1","Host:api.linnworks.net","Connection: keep-alive","Accept: application/json, text/javascript, */*; q=0.01","Origin: https://www.linnworks.net","Accept-Language: en","User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36","Content-Type: application/x-www-form-urlencoded; charset=UTF-8","Referer: https://www.linnworks.net/","Accept-Encoding: gzip, deflate");
			$url = 'https://api.linnworks.net//api/Auth/Authorize?userName='.$auth_data['userName'].'&password='.$auth_data['password'].'&userId='.$auth_data['userId'];
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL,$url);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_POST, 1); 
					curl_setopt($ch, CURLOPT_POSTFIELDS,$auth_data);
					curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
					//curl_setopt($ch, CURLOPT_USERPWD,$some_data['userName'].':'.$some_data['password']);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);	
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					$result = curl_exec($ch);
					$yummy = json_decode($result);
					curl_close($ch);
					return $yummy->{'Token'};
					//$this->Stock->recursive = 1;
					//$this->set('stocks',$yummy,$this->paginate());
		
					
	}
		
	public function getinventoryitemsinformation (){
		$userkey = $this->tokenkey();
		$some_data = array('token' => $userkey);
		$header = array("POST:https://eu1.linnworks.net//api/Inventory/GetInventoryItemsInformation HTTP/1.1","Host: eu1.linnworks.net","Connection: keep-alive","Accept: application/json, text/javascript, */*; q=0.01","Origin: https://www.linnworks.net","Accept-Language: en","User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36","Content-Type: application/x-www-form-urlencoded; charset=UTF-8","Referer: https://www.linnworks.net/","Accept-Encoding: gzip, deflate","Authorization:".$some_data['token']);
		$url = 'https://eu1.linnworks.net//api/Inventory/GetInventoryItemsInformation';
		
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL,$url);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_POST, 1); 
					curl_setopt($ch, CURLOPT_POSTFIELDS,$some_data);
					curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
					//curl_setopt($ch, CURLOPT_USERPWD,$some_data['userName'].':'.$some_data['password']);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);	
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					$result = curl_exec($ch);
					$yummy = json_decode($result);
					curl_close($ch);
					$this->Stock->recursive = 1;
					$this->set('stocks',$yummy,$this->paginate());
		
		
		
	}
	
		public function index() {
			$userkey = $this->tokenkey();
			$some_data = array('token' => $userkey); 
			//$header = array("Accept: application/json, text/javascript","Origin: https://www.linnworks.net","Referer: https://www.linnworks.net/","Authorization:".$some_data['token']);
			$header = array("POST:https://eu1.linnworks.net//api/Inventory/GetCategories HTTP/1.1<","Host: eu1.linnworks.net","Connection: keep-alive","Accept: application/json, text/javascript, */*; q=0.01","Origin: https://www.linnworks.net","Accept-Language: en","User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36","Content-Type: application/x-www-form-urlencoded; charset=UTF-8","Referer: https://www.linnworks.net/","Accept-Encoding: gzip, deflate","Authorization:".$some_data['token']);
			//$url = 'https://api.linnworks.net//api/Auth/AuthorizeByApplication?applicationId='.$some_data['applicationId'].'&applicationSecret='.$some_data['applicationSecret'].'&token='.$some_data['token'];
			$url = 'https://eu1.linnworks.net//api/Inventory/GetCategories';

					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL,$url);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_POST, 1); 
					curl_setopt($ch, CURLOPT_POSTFIELDS,$some_data);
					curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
					//curl_setopt($ch, CURLOPT_USERPWD,$some_data['userName'].':'.$some_data['password']);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);	
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					$result = curl_exec($ch);
					$yummy = json_decode($result);
					curl_close($ch);
					$this->Stock->recursive = 1;
					$this->set('stocks',$yummy,$this->paginate());
    }
	
		public function getinventoryitembyid(){
		$id="";
		$lok = $this->getinventoryitemlocation();
		$cats = $this->categorieslist();		
		$userkey = $this->tokenkey();
		$some_data = array('token' => $userkey);
		$header = array("POST:https://eu1.linnworks.net//api/Inventory/GetInventoryItemById HTTP/1.1","Host: eu1.linnworks.net","Connection: keep-alive","Accept: application/json, text/javascript, */*; q=0.01","Origin: https://www.linnworks.net","Accept-Language: en","User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36","Content-Type: application/x-www-form-urlencoded; charset=UTF-8","Referer: https://www.linnworks.net/","Accept-Encoding: gzip, deflate","Authorization:".$some_data['token']);
		$url = 'https://eu1.linnworks.net//api/Inventory/GetInventoryItemById?id='.$id.'';
		
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL,$url);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_POST, 1); 
					curl_setopt($ch, CURLOPT_POSTFIELDS,$some_data);
					curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
					//curl_setopt($ch, CURLOPT_USERPWD,$some_data['userName'].':'.$some_data['password']);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);	
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					$result = curl_exec($ch);
					$stocks = json_decode($result);
					curl_close($ch);
					$this->set(compact('stocks','cats','lok'));
					$this->Stock->recursive = 1;					
					$this->set('stocks',$yummy1,$this->paginate());
					
}
	
		
	/*  Use this Function need locationId and keyword */
	
	
	public function details($catname) {
		
				if((!empty($catname)) && (substr_count($catname, ' '))){	
				$keyword = substr(trim($catname),0,3);
				
				}
			else if ((!empty($catname))){		
			$keyword = substr(trim($catname),0,5);
			}
			else if ((!empty($this->data['Stock']['keyword'])) &&(is_numeric($this->data['Stock']['keyword'])))
			{
				
			$keyword = trim($this->data['Stock']['keyword']);
			
			}
			else if ((!empty($this->data['Stock']['keyword'])) &&(substr_count($this->data['Stock']['keyword'],' ')==0))
			{		
			$catname = trim($this->data['Stock']['keyword']);
			$keyword = substr($catname,0,8);	
			}
			else if ((!empty($this->data['Stock']['keyword'])) &&(substr_count($this->data['Stock']['keyword'],' ')<=3))
			{		
			$catname = trim($this->data['Stock']['keyword']);
			$keyword = substr($catname,0,3);	
			}
			else if ((!empty($this->data['Stock']['keyword'])) &&(substr_count($this->data['Stock']['keyword'],' ')>=4))
			{		
			$catname = trim($this->data['Stock']['keyword']);
			$keyword = substr($catname,0,4);	
			}
			else{
				
				$this->Session->setFlash('Invalid search Provided');
				$this->redirect(array('controller' => 'stocks','action'=>'index'));
				//$keyword = '';
			}
		$locationId = '';
		//$locationId = "7abe0a4b-cc76-4b8e-a762-c134a2c407eb";
		$userkey = $this->tokenkey();
		$some_data = array('token' => $userkey);
		$header = array("POST:https://eu1.linnworks.net//api/Stock/GetStockItems HTTP/1.1","Host: eu1.linnworks.net","Connection: keep-alive","Accept: application/json, text/javascript, */*; q=0.01","Origin: https://www.linnworks.net","Accept-Language: en","User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36","Content-Type: application/x-www-form-urlencoded; charset=UTF-8","Referer: https://www.linnworks.net/","Accept-Encoding: gzip, deflate","Authorization:".$some_data['token']);
		$url = 'https://eu1.linnworks.net//api/Stock/GetStockItems?keyWord='.$keyword.'&locationId='.$locationId.'&entriesPerPage=10000&pageNumber=1&excludeComposites=true';
		
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL,$url);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_POST, 1); 
					curl_setopt($ch, CURLOPT_POSTFIELDS,$some_data);
					curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
					//curl_setopt($ch, CURLOPT_USERPWD,$some_data['userName'].':'.$some_data['password']);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);	
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					$result = curl_exec($ch);
					$stocks = json_decode($result);
					curl_close($ch);
					$this->set(compact('stocks','catname'));
					//$this->Stock->recursive = 1;
					//$this->set('stocks',$yummy,$this->paginate());
					
		/*}
		else
		{
		$this->redirect(array('action' => 'index'));
		$this->Session->setFlash(__('Keyword,locationId is Not Corrects.', true));
		}
		*/
	}
	
	public function level($id) {		
		$userkey = $this->tokenkey();
		$some_data = array('token' => $userkey);
		$header = array("POST:https://eu1.linnworks.net//api/Stock/GetStockLevel HTTP/1.1","Host: eu1.linnworks.net","Connection: keep-alive","Accept: application/json, text/javascript, */*; q=0.01","Origin: https://www.linnworks.net","Accept-Language: en","User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36","Content-Type: application/x-www-form-urlencoded; charset=UTF-8","Referer: https://www.linnworks.net/","Accept-Encoding: gzip, deflate","Authorization:".$some_data['token']);
		$url = 'https://eu1.linnworks.net//api/Stock/GetStockLevel?stockItemId='.$id.'';
		
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL,$url);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_POST, 1); 
					curl_setopt($ch, CURLOPT_POSTFIELDS,$some_data);
					curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
					//curl_setopt($ch, CURLOPT_USERPWD,$some_data['userName'].':'.$some_data['password']);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);	
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					$result = curl_exec($ch);
					$yummy = json_decode($result);
					curl_close($ch);
					$this->set('stocks',$yummy,$this->paginate());
					
	}
	
	public function location($id){
	    
		$userkey = $this->tokenkey();
		$some_data = array('token' => $userkey);
		$header = array("POST:https://eu1.linnworks.net//api/Inventory/GetInventoryItemLocations HTTP/1.1","Host: eu1.linnworks.net","Connection: keep-alive","Accept: application/json, text/javascript, */*; q=0.01","Origin: https://www.linnworks.net","Accept-Language: en","User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36","Content-Type: application/x-www-form-urlencoded; charset=UTF-8","Referer: https://www.linnworks.net/","Accept-Encoding: gzip, deflate","Authorization:".$some_data['token']);
		$url = 'https://eu1.linnworks.net//api/Inventory/GetInventoryItemLocations?inventoryItemId='.$id.'';
					
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL,$url);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_POST, 1); 
					curl_setopt($ch, CURLOPT_POSTFIELDS,$some_data);
					curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
					//curl_setopt($ch, CURLOPT_USERPWD,$some_data['userName'].':'.$some_data['password']);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);	
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					$result = curl_exec($ch);
					$yumm = json_decode($result);
					curl_close($ch);
					$this->Stock->recursive = 1;
					$this->set('stocks',$yumm,$this->paginate());
				    
			}

	

}
