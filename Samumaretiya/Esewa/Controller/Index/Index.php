<?php

namespace Samumaretiya\Esewa\Controller\Index;

use Magento\Checkout\Model\Session;
use Magento\Framework\App\Action\Action;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\Page;

class Index extends Action
{
    protected $resultPageFactory;

	public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
		$resultPage = $this->resultPageFactory->create();
        return $resultPage;
    }
}
