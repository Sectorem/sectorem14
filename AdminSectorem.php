<?php
/*
 *  Db::getInstance()->autoExecute('target_table', array('id_target' => (int)$target,'name' => pSQL($name)), 'INSERT');
 *  http://doc.prestashop.com/download/attachments/1409083/PrestaShop-Developer-Guide.pdf
 *  samcroft.co.uk/2014/php-json-encode-decode-functions-tutorial/
 * 	http://stackoverflow.com/questions/15000874/php-loop-through-json-array
 * 
 * TODO: 1. POST na curl [http://blog.kamilbrenk.pl/jak-pobierac-zewnetrzne-zasoby/]
 */


include(PS_ADMIN_DIR.'/../classes/AdminTab.php');

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
		
		
		try
		{
			//samcroft.co.uk/2014/php-json-encode-decode-functions-tutorial/
			$uri = 'http://localhost:6869/api/towarapi';
			$request = file_get_contents($uri);
// 			echo $request;
			$request = array("\$id"=>"1","danezamowieniepozycja"=>array(),"id"=>0,"nazwa"=>"zxcc","ean13"=>null,"vat"=>null,"ilosc"=>20,"iloscRezerwacja"=>null,"cena"=>null);
			//("$id"=>"1","danezamowieniepozycja"=>[],"id"=>0,"nazwa"=>"zxcc","ean13"=>null,"vat"=>null,"ilosc"=>20,"iloscRezerwacja"=>null,"cena"=>null);
			$parsedData = json_decode($request); // przerobienie na arraya
			
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
		
		
		
	}

 }
