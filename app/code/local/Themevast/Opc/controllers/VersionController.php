<?php
class Themevast_Opc_VersionController extends Mage_Core_Controller_Front_Action{
	
	public function indexAction(){
		$version = Mage::getConfig()->getModuleConfig("Themevast_Opc")->version;
		echo 'Themevast OPC Version: ' . $version;
		return;
	}
}