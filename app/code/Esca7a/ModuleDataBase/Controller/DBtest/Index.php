<?php

namespace Esca7a\ModuleDataBase\Controller\DBtest;

use Esca7a\ModuleDataBase\Model\DataFactory as DataFactory;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Request\Http as request;
use Magento\Framework\Controller\ResultFactory;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $_dataFactory;
    protected $resultRedirect;
    protected $_request;
    public function __construct(
        Context $context,
        DataFactory $dataFactory,
        ResultFactory $result,
        request $request
    ) {
        parent::__construct($context);
        $this->_dataFactory = $dataFactory;
        $this->resultRedirect = $result;
        $this->_request = $request;
    }

    public function execute()
    {
        /**
         * get Post Params from <form action>
         */
        $somePost = $this->_request->getPost();
        $productName = $somePost->get('model');
        $serialNumber = $somePost->get('serialNumData');
        $email = $somePost->get('emailData');
        $phone = $somePost->get('phoneData');
        $userFeedback = $somePost->get('created_at');

        /**
         * create object manager to get customer id
         */
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $customerSession = $objectManager->create("Magento\Customer\Model\Session");
        $customerIdObjectManager = $customerSession->getCustomerId();

        /**
         * create redirect to feedback of customer page
         */
        $resultRedirect = $this->resultRedirectFactory
            ->create()
            ->setPath('moduledatabase/customerallfeedback/*');
        /**
         * write data to database
         */
        $model = $this->_dataFactory->create();
        $getModel = $model->getData();
        $model->addData([
            "customer_id" => $customerIdObjectManager,
            "product_name" => $productName,
            "serial_number" => $serialNumber,
            "email" => $email,
            "phone_number" => $phone,
            "created_at" => date('Y-m-d H:i:s'),
            "user_request" => $userFeedback
        ]);
        $saveData = $model->save();
        if ($saveData) {
            $this->messageManager->addSuccess(__('Thank you for feedback!'));
        }
        return $resultRedirect;
    }
}
