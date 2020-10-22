<?php
namespace Gta\EnablePaymentMethod\Observer;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
class PaymentMethodEnable implements ObserverInterface {
    protected $_customerSession;
    public function __construct(
       \Magento\Customer\Model\Session $customerSession
    ) {
       $this->_customerSession = $customerSession;
    }
    // public function execute(Observer $observer) {
    //    $payment_method_code = $observer->getEvent()->getMethodInstance()->getCode();
    //    if ($payment_method_code == 'paypal_express') {
    //        $result = $observer->getEvent()->getResult();
    //        if ($this->_customerSession->isLoggedIn()) {
    //            $customerGroupId = $this->_customerSession->getCustomer()->getGroupId();
    //            if ($customerGroupId == 9) {
    //                $result->setData('is_available', true);
    //            }
    //        }
    //    }
    // }
    public function execute(Observer $observer) {
      $payment_method_code = $observer->getEvent()->getMethodInstance()->getCode();
      if ($payment_method_code == 'paypal_express') {
        $result = $observer->getEvent()->getResult();
        $result->setData('is_available', false);
       if ($this->_customerSession->isLoggedIn()) {
           $customerGroupId = $this->_customerSession->getCustomer()->getGroupId();
           if ($customerGroupId == 7) {
               $result->setData('is_available', true);
            }
        }
      }
    }
}