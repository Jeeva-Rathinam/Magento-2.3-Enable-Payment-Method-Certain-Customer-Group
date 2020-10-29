<?php
namespace Gta\EnablePaymentMethod\Observer;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class PaymentMethodEnable implements ObserverInterface {
  
    protected $_customerSession;
    protected $_storeManager;

    public function __construct(
       \Magento\Customer\Model\Session $customerSession,
       \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
       $this->_customerSession = $customerSession;
       $this->_storeManager = $storeManager;
    }

    public function execute(Observer $observer) {

      $website_id = $this->_storeManager->getStore()->getWebsiteId();
      if($website_id == '2')
      {

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
}
