<?php

namespace Samumaretiya\Esewa\Model; //https://magento.stackexchange.com/questions/146444/payment-gateway-with-redirects-in-magento2

/*class Payment extends \Magento\Payment\Model\Method\Cc
{
    const CODE = 'samumaretiya_esewa';

    protected $_code = self::CODE;

    protected $_isGateway                   = true;
    protected $_canCapture                  = true;
    protected $_canCapturePartial           = true;
    protected $_canRefund                   = true;
    protected $_canRefundInvoicePartial     = true;

    protected $_stripeApi = false;

    protected $_countryFactory;

    protected $_minAmount = null;
    protected $_maxAmount = null;
    protected $_supportedCurrencyCodes = array('USD','AUD');

    protected $_debugReplacePrivateDataKeys = ['number', 'exp_month', 'exp_year', 'cvc'];

    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Api\ExtensionAttributesFactory $extensionFactory,
        \Magento\Framework\Api\AttributeValueFactory $customAttributeFactory,
        \Magento\Payment\Helper\Data $paymentData,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Payment\Model\Method\Logger $logger,
        \Magento\Framework\Module\ModuleListInterface $moduleList,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $localeDate,
        \Magento\Directory\Model\CountryFactory $countryFactory,
        array $data = array()
    ) {
        parent::__construct(
            $context,
            $registry,
            $extensionFactory,
            $customAttributeFactory,
            $paymentData,
            $scopeConfig,
            $logger,
            $moduleList,
            $localeDate,
            null,
            null,
            $data
        );

        $this->_countryFactory = $countryFactory;


        $this->_minAmount = $this->getConfigData('min_order_total');
        $this->_maxAmount = $this->getConfigData('max_order_total');
    }


    public function capture(\Magento\Payment\Model\InfoInterface $payment, $amount)
    {
        $order = $payment->getOrder();

        $billing = $order->getBillingAddress();
        try {
            $requestData = [
                'amount'        => $amount * 100,
                'currency'      => strtolower($order->getBaseCurrencyCode()),
                'description'   => sprintf('#%s, %s', $order->getIncrementId(), $order->getCustomerEmail()),
                'card'          => [
                    'number'            => $payment->getCcNumber(),
                    'exp_month'         => sprintf('%02d',$payment->getCcExpMonth()),
                    'exp_year'          => $payment->getCcExpYear(),
                    'cvc'               => $payment->getCcCid(),
                    'name'              => $billing->getName(),
                    'address_line1'     => $billing->getStreetLine(1),
                    'address_line2'     => $billing->getStreetLine(2),
                    'address_city'      => $billing->getCity(),
                    'address_zip'       => $billing->getPostcode(),
                    'address_state'     => $billing->getRegion(),
                    'address_country'   => $billing->getCountryId(),
                    // To get full localized country name, use this instead:
                    // 'address_country'   => $this->_countryFactory->create()->loadByCode($billing->getCountryId())->getName(),
                ]
            ];

            $charge = \Stripe\Charge::create($requestData);
            $payment
                ->setTransactionId($charge->id)
                ->setIsTransactionClosed(0);

        } catch (\Exception $e) {
            $this->debugData(['request' => $requestData, 'exception' => $e->getMessage()]);
            $this->_logger->error(__('Payment capturing error.'));
            throw new \Magento\Framework\Validator\Exception(__('Payment capturing error.'));
        }

        return $this;
    }

    public function refund(\Magento\Payment\Model\InfoInterface $payment, $amount)
    {
        $transactionId = $payment->getParentTransactionId();

        try {
            \Stripe\Charge::retrieve($transactionId)->refund(['amount' => $amount * 100]);
        } catch (\Exception $e) {
            $this->debugData(['transaction_id' => $transactionId, 'exception' => $e->getMessage()]);
            $this->_logger->error(__('Payment refunding error.'));
            throw new \Magento\Framework\Validator\Exception(__('Payment refunding error.'));
        }

        $payment
            ->setTransactionId($transactionId . '-' . \Magento\Sales\Model\Order\Payment\Transaction::TYPE_REFUND)
            ->setParentTransactionId($transactionId)
            ->setIsTransactionClosed(1)
            ->setShouldCloseParentTransaction(1);
		
        return $this;
    }

    public function isAvailable(\Magento\Quote\Api\Data\CartInterface $quote = null)
    {
         if ($quote && (
            $quote->getBaseGrandTotal() < $this->_minAmount
            || ($this->_maxAmount && $quote->getBaseGrandTotal() > $this->_maxAmount))
        ) {
            return false;
        }

        if (!$this->getConfigData('api_key')) {
            return false;
        }

        return parent::isAvailable($quote); 
		return true;
    }

    public function canUseForCurrency($currencyCode)
    {
        if (!in_array($currencyCode, $this->_supportedCurrencyCodes)) {
            return false;
        }
        return true;
    }
} */

class Payment extends \Magento\Payment\Model\Method\AbstractMethod
{
    const CODE = 'samumaretiya_esewa';
	protected $_code = self::CODE;
}