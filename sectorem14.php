<?php
if (!defined('_PS_VERSION_'))
  exit;
 
class Sectorem14 extends Module
  {
  public function __construct()
    {
    $this->name = 'sectorem14';
    $this->tab = 'Sectorem';
    $this->version = 0.01;
    $this->author = 'Damian Mach';
    $this->need_instance = 0;
 
    parent::__construct();
 
    $this->displayName = $this->l('SectoremTest');
    $this->description = $this->l('Modul do synchronizacji z systemem Sectorem.');
    }
 
  public function install()
    {
    if (parent::install() == false)
      return false;
    return true;
    }
  }
?>