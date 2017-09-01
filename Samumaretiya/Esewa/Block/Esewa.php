<?php

namespace Samumaretiya\Esewa\Block;
 
use Magento\Framework\View\Element\Template;

class Esewa extends Template
{
	protected $_storeManager;
	
	protected $checkoutSession;

	public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,  
		\Magento\Store\Model\StoreManagerInterface $storeManager,
		\Magento\Checkout\Model\Session $checkoutSession,
        array $data = []
    ) {
		 parent::__construct(
            $context,
            $data
        );
		$this->checkoutSession  = $checkoutSession;
		$this->_storeManager = $storeManager;
    }
	
	
	public function getSuccessUrl(){
		echo $this->_storeManager->getStore()->getBaseUrl().'esewa/index/success/';
	}
	public function getFailureUrl(){
		echo $this->_storeManager->getStore()->getBaseUrl().'esewa/index/failure/';
	}
	public function getSubTotal(){
		return $this->checkoutSession->getQuote()->getSubtotal();
	}
	public function getGrandTotal(){
		return $this->checkoutSession->getQuote()->getGrandTotal();
	}
	public function getTax(){
		return $this->checkoutSession->getQuote()->getShippingAddress()->getData('tax_amount');
	}
	public function getServiceCode(){
		/*echo $this->_scopeConfig->getValue(
                'payment/samumaretiya_esewa/merchant',
                \Magento\Store\Model\ScopeInterface::SCOPE_STORE
            )
			*/
	}
}
