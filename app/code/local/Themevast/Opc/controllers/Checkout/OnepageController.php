<?php
$themevast_av_class = false;

if (! Mage::helper ( 'opc' )->isEnable ()) {
	// check if Themevast AddressValidation exists
	$path = Mage::getBaseDir ( 'app' ) . DS . 'code' . DS . 'local' . DS;
	$file = 'Themevast/AddressVerification/controllers/OnepageController.php';
	// load Themevast OPC class
	if (file_exists ( $path . $file )){		
		// check if Themevast AV enabled
		if (Mage::helper ( 'addressverification' )->isAddressVerificationEnabled ()){
			$themevast_av_class = true;
		}
	}
}

if (! $themevast_av_class) {
	require_once Mage::getModuleDir ( 'controllers', 'Mage_Checkout' ) . DS . 'OnepageController.php';
	class Themevast_Opc_Checkout_OnepageController extends Mage_Checkout_OnepageController {
		
		/**
		 * Checkout page
		 */
		public function indexAction() {
			$scheme = Mage::app ()->getRequest ()->getScheme ();
			if ($scheme == 'http') {
				$secure = false;
			} else {
				$secure = true;
			}
			
			if (Mage::helper ( 'opc' )->isEnable ()) {
				$this->_redirect ( 'onepage', array (
						'_secure' => $secure 
				) );
				return;
			} else {
				parent::indexAction ();
			}
		}
	}
} else {
	require_once Mage::getModuleDir ( 'controllers', 'Themevast_AddressVerification' ) . DS . 'OnepageController.php';
	class Themevast_Opc_Checkout_OnepageController extends Themevast_AddressVerification_OnepageController {
	}
}
