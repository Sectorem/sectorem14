<?php
/*
 *  Db::getInstance()->autoExecute('target_table', array('id_target' => (int)$target,'name' => pSQL($name)), 'INSERT');
 * 
 */

//include('httpful.phar');
include_once(PS_ADMIN_DIR.'/../classes/AdminTab.php');
include ('httpful.phar');
//include_once('httpful.phar');
//if ()
use Httpful\Request;

class AdminSectorem extends AdminTab
{
		
	public function __construct()
	{
			global $cookie, $smarty, $_LANGADM, $_MODULES, $currentIndex;
		
/*
 * 
	 	$this->table = 'sectorem14';
	 	$this->table = 'none';
 	 	$this->className = 'none'; // Nie ma klasy
	 	$this->lang = false; // brak jezyka
	 	$this->edit = false;
	 	$this->delete = false;
		
		$this->fieldsDisplay = array(
		'id_sectorem14' => array('title' => $this->l('ID'), 'align' => 'center', 'width' => 25),
		'name' => array('title' => $this->l('Name')),
		'file' => array('title' => $this->l('File'))); 
*/
		$this->table = 'none';
		$this->className = 'none';
		parent::__construct();
	}

	public function postProcess()
	{

		return parent::postProcess();
	}
	
/* 	public function displayForm($isMainTab = true)
	{
		global $currentIndex;
		parent::displayForm();
		
// 		if (!($obj = $this->loadObject(true)))
// 			return;
		
		echo '';
		
	}
 */	
	
	public function display()
	{
		echo '<h2 class="space">'.$this->l('Catalog tracking').'</h2>';
		echo ''.PS_ADMIN_DIR;	
		
		try
		{
			// 	$webService = new PrestaShopWebservice(PS_SHOP_PATH, PS_WS_AUTH_KEY, DEBUG);
			// 	$opt = array('resource' => 'customers');
			// 	if (isset($_GET['Create']))
				// 		$xml = $webService->get(array('url' => PS_SHOP_PATH.'/api/customers?schema=blank'));
				// 	else
					// 		$xml = $webService->get($opt);
					// 	$resources = $xml->children()->children();
			$uri = "http://localhost:6869/api/towarapi";
// 			$response = Httpful\Request::get($uri)->send();
			$response = Request::get($uri)->send();
				echo  $response;
		}
		//catch (ConnectionErrorException $e)
		catch (Exception $e)
		{
			// Here we are dealing with errors
			$trace = $e->getTrace();
			if ($trace[0]['args'][0] == 404) echo 'Bad ID';
			else if ($trace[0]['args'][0] == 401) echo 'Bad auth key';
			else if ($trace[0]['args'][0] == 409) echo 'Conflict ID';
			else echo 'Other error';
		}
		
		//$row = array();
		$parsedData = json_decode($response); // przerobienie na arraya
		
		// print_r($parsedData); // echo debuger
		
		echo '<table>';
		
		// http://stackoverflow.com/questions/15000874/php-loop-through-json-array
		foreach ($parsedData as $row)
		{
		
			echo '<tr>';
			echo '<td>' . $row->id . '</td>'; // -> patrz komentarz wyzej
			echo '<td>' . $row->nazwa . '</td>';
			echo '<td>' . $row->ilosc . '</td>';
		
			echo '</tr>';
			 
		}
		echo '</table>';
	}

 }
