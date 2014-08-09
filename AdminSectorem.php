<?php
/*
 *  Db::getInstance()->autoExecute('target_table', array('id_target' => (int)$target,'name' => pSQL($name)), 'INSERT');
 * 
 */

//include_once(PS_ADMIN_DIR.'/../classes/AdminTab.php');

class AdminSectorem extends AdminTab
{
		
	public function __construct()
	{
			global $cookie, $smarty, $_LANGADM, $_MODULES, $currentIndex;
		
	 	//$this->table = 'sectorem14';
	 	//$this->table = 'none';
 	 	//$this->className = 'none'; // Nie ma klasy
	 	//$this->lang = false; // brak jezyka
	 	//$this->edit = false;
	 	//$this->delete = false;
		
// 		$this->fieldsDisplay = array(
// 		'id_sectorem14' => array('title' => $this->l('ID'), 'align' => 'center', 'width' => 25),
// 		'name' => array('title' => $this->l('Name')),
// 		'file' => array('title' => $this->l('File')));
		$this->table = 'none';
		$this->className = 'none';
		parent::__construct();
	}

	public function postProcess()
	{

		return parent::postProcess();
	}
	
// 	public function displayForm($isMainTab = true)
// 	{
// 		global $currentIndex;
// 		parent::displayForm();
		
// // 		if (!($obj = $this->loadObject(true)))
// // 			return;
		
// 		echo '';
		
// 	}
	public function display()
	{
		echo '<h2 class="space">'.$this->l('Catalog tracking').'</h2>';
	}

 }
