<?php

/**
 * Description of Payment
 *
 * @author Pengo Stores
 * @category Pengo
 * @package Pengo_Taquilla
 * @filesource
 */
class Pengo_Taquilla_Helper_Payment extends Mage_Payment_Helper_Data {

    const PENGO_PATH_PAYMENT_METHODS = 'pengostores';

    /**
     * Get and sort available payment methods for specified or current store
     *
     * array structure:
     *  $index => Varien_Simplexml_Element
     * @access public
     * @param mixed $store
     * @param Mage_Sales_Model_Quote $quote
     * @return array
     */
    public function getStoreMethods($store = null, $quote = null) {
        $res = array();
        foreach ($this->getPaymentMethods($store) as $code => $methodConfig) {
            $prefixM = self::XML_PATH_PAYMENT_METHODS . '/' . $code . '/';
            $prefixP = self::PENGO_PATH_PAYMENT_METHODS . '/' . $code . '/';
            $model = Mage::getStoreConfig($prefixM . 'model', $store) ? Mage::getStoreConfig($prefixM . 'model', $store) : Mage::getStoreConfig($prefixP . 'model', $store);
            if (!$model) {
                continue;
            }
            $methodInstance = Mage::getModel($model);
            if (!$methodInstance) {
                continue;
            }
            $methodInstance->setStore($store);
            if (!$methodInstance->isAvailable($quote)) {
                /* if the payment method cannot be used at this time */
                continue;
            }
            $sortOrder = (int) $methodInstance->getConfigData('sort_order', $store);
            $methodInstance->setSortOrder($sortOrder);
            $res[] = $methodInstance;
        }

        usort($res, array($this, '_sortMethods'));
        return $res;
    }

    /**
     * Retrieve all payment methods
     * @access public
     * @param mixed $store
     * @return array
     */
    public function getPaymentMethods($store = null) {
        $mage = Mage::getStoreConfig(self::XML_PATH_PAYMENT_METHODS, $store);
        $pengo = Mage::getStoreConfig(self::PENGO_PATH_PAYMENT_METHODS, $store);
        return array_merge($mage, $pengo);
    }

    /**
     * Retrieve method model object
     * @access public
     * @param   string $code
     * @return  Mage_Payment_Model_Method_Abstract|false
     */
    public function getMethodInstance($code) {
        $keyM = self::XML_PATH_PAYMENT_METHODS . '/' . $code . '/model';
        $keyP = self::PENGO_PATH_PAYMENT_METHODS . '/' . $code . '/model';
        $class = Mage::getStoreConfig($keyM) ? Mage::getStoreConfig($keyM) : Mage::getStoreConfig($keyP);
        return Mage::getModel($class);
    }

}

?>
