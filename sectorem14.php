<?php
if (!defined('_PS_VERSION_'))
  exit;
 
class Sectorem14 extends Module
  {
  public function __construct()
    {
    $this->name = 'sectorem14';
    $this->tab = 'Sectorem';
    $this->version = 0.05;
    $this->author = 'Sectorem Team';
    $this->need_instance = 1;
 
    parent::__construct();
 
    $this->displayName = $this->l('SectoremTest');
    $this->description = $this->l('Modul do synchronizacji z systemem Sectorem.');
    }
 
      public function install()
    {
    
        if ( ! parent::install()) 
            return false;
        
        $query = 
        'CREATE TABLE `' . _DB_PREFIX_ . 'sectorem14`
            (
                `id_sectorem14` INT(10) unsigned NOT NULL AUTO_INCREMENT  ,
                `name`               VARCHAR(128) NOT NULL                     ,
                `cron_schedule`      VARCHAR(255) DEFAULT NULL                 ,
                `status`             TINYINT(1) unsigned NOT NULL DEFAULT "0"  ,
                PRIMARY KEY ( `id_sectorem14` )
            )
            ENGINE=MyISAM DEFAULT CHARSET=utf8';
        
        if ( ! Db::getInstance()->Execute($query))
        {
            $this->uninstall();
            
            return false;
        }
        
//         $zones = Zone::getZones(true);
//         $carriers = Carrier::getCarriers(intval(Configuration::get('PS_LANG_DEFAULT')), true);
        
//         if (sizeof($zones) == 0 || sizeof($carriers) == 0) 
//             return false;
        
//         Configuration::updateValue('EXPORT_LANGUAGE', (int)(Configuration::get('PS_LANG_DEFAULT')));
//         Configuration::updateValue('EXPORT_DELIMITER', ',');
//         Configuration::updateValue('EXPORT_COMBINATIONS', 1);
//         Configuration::updateValue('EXPORT_ENCLOSURE', 1);
//         Configuration::updateValue('EXPORT_HEADER', 1);
//         Configuration::updateValue('EXPORT_ZONE', $zones[0]['id_zone']);
//         Configuration::updateValue('EXPORT_CARRIER', $carriers[0]['id_carrier']);
//         Configuration::updateValue('EXPORT_INACTIVE', 0);
        
        return $this->installModuleTab('AdminSectorem', 'Sectorem');
    }
    
	public function uninstall()
	{
		$sql = '
		SELECT `id_tab` FROM `' . _DB_PREFIX_ . 'tab` WHERE `module` = "' . pSQL($this->name) . '"';
		
		$result = Db::getInstance()->ExecuteS($sql);
		
		if ($result && sizeof($result))
		{
			foreach ($result as $tabData)
			{
				$tab = new Tab($tabData['id_tab']);
				
				if (Validate::isLoadedObject($tab))
					$tab->delete();
			}
		}
		
		if (self::tableExists(_DB_PREFIX_ . 'sectorem14'))
			Db::getInstance()->Execute('DROP TABLE `' . _DB_PREFIX_ . 'sectorem14`');
            
//         Configuration::deleteByName('EXPORT_LANGUAGE');
//         Configuration::deleteByName('EXPORT_DELIMITER');
//         Configuration::deleteByName('EXPORT_ENCLOSURE');
//         Configuration::deleteByName('EXPORT_COMBINATIONS');
//         Configuration::deleteByName('EXPORT_HEADER');
//         Configuration::deleteByName('EXPORT_ZONE');
//         Configuration::deleteByName('EXPORT_CARRIER');
//         Configuration::deleteByName('EXPORT_INACTIVE');
		
		return parent::uninstall();
	}
	private static function tableExists($table, $useCache = FALSE)
	{
// 		if ( ! sizeof(self::$_tblCache) || ! $useCache)
// 		{
			$tmp = Db::getInstance()->ExecuteS('SHOW TABLES');
	
			foreach ($tmp as $entry)
			{
				reset($entry);
	
				$tableTmp = strtolower($entry[key($entry)]);
	
// 				if ( ! array_search($tableTmp, self::$_tblCache))
// 					self::$_tblCache[] = $tableTmp;
			}
// 		}
	
// 		return array_search(strtolower($table), self::$_tblCache) ? true : false;
		return true;
	}
	
	private function installModuleTab($class, $name)
	{
		$sql = '
		SELECT `id_tab` FROM `' . _DB_PREFIX_ . 'tab` WHERE `class_name` = "AdminCatalog"';
	
		$tabParent = (int)(Db::getInstance()->getValue($sql));
	
		if ( ! is_array($name))
// 			$name = self::getMultilangField($name);
	
// 		if (self::fileExistsInModulesDir('logo.gif') && is_writeable(_PS_IMG_DIR_ . 't/'))
// 			$this->copyLogo($class);
	
		$tab = new Tab();
		$tab->name       = $name;
		$tab->class_name = $class;
		$tab->module     = $this->name;
		$tab->id_parent  = $tabParent;
	
		return $tab->save();
	}
	public function _outputErrors()
	{
		if (sizeof($this->_postErrors))
		foreach ($this->_postErrors as $error)
			echo $this->displayError($error);
	}

  }
?>