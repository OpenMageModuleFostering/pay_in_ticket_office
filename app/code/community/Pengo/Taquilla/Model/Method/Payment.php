<?php
/**
 *
 * @author Pengo Stores
 * @category    Mage
 * @package     Mage_Payment
 * @filesource
 */

class Pengo_Taquilla_Model_Method_Payment extends Mage_Payment_Model_Method_Abstract {

    protected $_code  = 'taquilla';
    protected $_formBlockType = 'taquilla/form_taquilla';
    protected $_infoBlockType = 'taquilla/info_taquilla';

    /**
     * Assign data to info model instance
     * @access public
     * @param   mixed $data
     * @return  Pengo_Taquilla_Model_Method_Payment
     */
    public function assignData($data) {
        $details = array();
        if (!empty($details)) {
            $this->getInfoInstance()->setAdditionalData(serialize($details));
        }
        return $this;
    }

     /**
     * Retrieve information from payment configuration
     * @access public
     * @param   string $field
     * @return  mixed
     */
    public function getConfigData($field, $storeId = null) {
        if (null === $storeId) {
            $storeId = $this->getStore();
        }
        $path = 'pengostores/' . $this->getCode() . '/' . $field;
        return Mage::getStoreConfig($path, $storeId);
    }
}
