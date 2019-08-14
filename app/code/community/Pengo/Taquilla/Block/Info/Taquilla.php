<?php
/**
 * Overwrite helper to notify Pengo Stores when this modules throw an exception
 *
 * @author Pengo Stores
 * @category Pengo
 * @package Pengo_Taquilla
 */

class Pengo_Taquilla_Block_Info_Taquilla extends Mage_Payment_Block_Info {

    /**
     *
     * @access protected
     */
    protected function _construct() {
        parent::_construct();
    }

}
