<?php
/* https://magento.stackexchange.com/questions/126439/programatically-create-order-in-magento-2-1 */
namespace Samumaretiya\Esewa\Controller\Index;

use Magento\Checkout\Model\Session;
use Magento\Framework\App\Action\Action;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\Page;
use Magento\Framework\Controller\ResultFactory;
use Magento\Quote\Api\Data\CartInterface;

class Success extends Action
{
    protected $resultPageFactory;
	
	protected $checkoutSession;
	
	public function __construct(
        Context $context,
		Session $checkoutSession,
        PageFactory $resultPageFactory
	)
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
		$this->checkoutSession = $checkoutSession;
    }

    public function execute()
    { 
		$resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
		$quote 			= $this->checkoutSession->getQuote();
		
		$this->validateQuote($quote);
		
		$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $quoteRepository = $objectManager->create(\Magento\Quote\Api\CartRepositoryInterface::class);
        $quoteRepository->save($quote);
		
		$quote->setPaymentMethod("samumaretiya_esewa");
	
		$quote->getPayment()->importData(
                    						array('method' => "samumaretiya_esewa")
            							);
		$quote->collectTotals()->save();
		
     
		$quoteManagement = $objectManager->create(\Magento\Quote\Api\CartManagementInterface::class);
		$quote = $quoteRepository->get($quote->getId());
        $order = $quoteManagement->submit($quote);

		return $resultRedirect->setPath('checkout/onepage/success', ['_secure' => true]);
    }
	protected function validateQuote($quote)
    {
        if (!$quote || !$quote->getItemsCount()) {
            throw new \InvalidArgumentException(__('We can\'t initialize checkout.'));
        }
    }
}
