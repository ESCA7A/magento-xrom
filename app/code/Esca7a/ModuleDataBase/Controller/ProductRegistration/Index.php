<?php

namespace Esca7a\ModuleDataBase\Controller\ProductRegistration;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $session;
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
    public function redirectGuest()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('home');
    }
    public function execute()
    {
        return $this->_pageFactory->create();
        // when i user is loggin in
        //return $this->session->isLoggedIn() ? $this->_pageFactory->create() : $this->redirectGuest();
    }
}
