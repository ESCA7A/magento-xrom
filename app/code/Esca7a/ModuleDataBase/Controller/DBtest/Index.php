<?php

namespace Esca7a\ModuleDataBase\Controller\DBtest;

use Esca7a\ModuleDataBase\Model\DataFactory as DataFactory;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\Context;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $_dataFactory;
    protected $resultRedirect;
    public function __construct(
        Context $context,
        DataFactory $dataFactory,
        ResultFactory $result,
        \Magento\Framework\App\Request\Http $request
    ) {
        parent::__construct($context);
        $this->_dataFactory = $dataFactory;
        $this->resultRedirect = $result;
        $this->_request = $request;
    }
    public function execute()
    {

        //$somePost = $this->_request->getPost();

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $customerSession = $objectManager->create("Magento\Customer\Model\Session");
        $customerIdObjectManager = $customerSession->getCustomerId();

        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setUrl($this->_redirect->getRefererUrl());

        $model = $this->_dataFactory->create();
        $model->addData([
            "customer_id" => $customerIdObjectManager,
            "product_id" => "some product name or id",
////            "serial_number" => 229,
////            "email" => 'pasha.asd@gmail.com',
////            "phone_number" => 2323322333,
////            "date" => "02.02.1997",
            "user_request" => "its product very nice"
        ]);
        $saveData = $model->save();
        if ($saveData) {
            $this->messageManager->addSuccess(__('Thank you for feedback!'));
        }
        return $resultRedirect->setPath('home');
    }
}
