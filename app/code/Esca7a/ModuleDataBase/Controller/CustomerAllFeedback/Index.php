<?php

namespace Esca7a\ModuleDataBase\Controller\CustomerAllFeedback;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Customer\Model\Session $session
    ) {
        $this->_pageFactory = $pageFactory;
        $this->session = $session;
        return parent::__construct($context);
    }

    public function execute()
    {
        return $this->session->isLoggedIn() ? $this->_pageFactory->create() : $this->resultRedirectFactory
            ->create()
            ->setPath('customer/account/login');
    }
}
