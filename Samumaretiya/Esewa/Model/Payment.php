<?php
namespace Samumaretiya\Esewa\Model; //https://magento.stackexchange.com/questions/146444/payment-gateway-with-redirects-in-magento2

class Payment extends \Magento\Payment\Model\Method\AbstractMethod
{
    const CODE = 'samumaretiya_esewa';
	protected $_code = self::CODE;
}