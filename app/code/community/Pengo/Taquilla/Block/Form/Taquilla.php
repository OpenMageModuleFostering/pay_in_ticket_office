<?php
/**
 * Overwrite helper to notify Pengo Stores when this modules throw an exception
 *
 * @author Pengo Stores
 * @category Pengo
 * @package Pengo_Taquilla
 */

class Pengo_Taquilla_Block_Form_Taquilla extends Mage_Payment_Block_Form {

    /**
     * 
     */
    protected function _construct() {
        parent::_construct();
        $this->setTemplate('taquilla/payment/form.phtml');
    }
}
