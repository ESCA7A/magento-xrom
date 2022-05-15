<?php

namespace Esca7a\ModuleDataBase\Controller\DBtest;

use Esca7a\ModuleDataBase\Model\DataFactory;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\Context;
use Magento\Customer\Model\Session;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $_dataExample;
    protected $resultRedirect;
    protected $_customerSession;
    public function __construct(
        Context $context,
        DataFactory $data,
        ResultFactory $result,
        Session $CustomerSession
    ) {
        parent::__construct($context);
        $this->_dataExample = $data;
        $this->resultRedirect = $result;
        $this->_customerSession = $CustomerSession;
    }
    public function execute()
    {
        $customerIsLoggedIn = $this->_customerSession->isLoggedIn();
        $customerId = $this->_customerSession->getCustomer()->getId();
        $dataString =  ['customerId' => $customerId, 'customer is logged in' => $customerIsLoggedIn];

        $customerSession = $this->objectManager->create("Magento\Customer\Model\Session");
        $customerIDobjectManager = $customerSession->getCustomerId();

        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        $model = $this->_dataExample->create();
        $model->addData([
            "customer_id" => 1,
            "product_id" => 1,
            "serial_number" => 229,
            "email" => 'pasha.asd@gmail.com',
            "phone_number" => 2323322333,
            "date" => "02.02.1997",
            "user_request" => "its product very nice"
        ]);
        $saveData = $model->save();
        if ($saveData) {
            $this->messageManager->addSuccess(__('Thank you for feedback!'));
        }
        return $resultRedirect->setPath('home');
    }
}
