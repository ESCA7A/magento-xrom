<?php

namespace Esca7a\ModuleDataBase\Controller\DBtest;

use Esca7a\ModuleDataBase\Model\DataFactory as DataFactory;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Request\Http as request;

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
         * get Post Params
         */
        $somePost = $this->_request->getPost(); // $somePost = get Post Data;
        $modelName = $somePost->get('model');
        $serialNumber = $somePost->get('serialNumData');
        $email = $somePost->get('emailData');
        $phone = $somePost->get('phoneData');
        $userFeedback = $somePost->get('userFeedbackData');

        /**
         * create object manager to get customer Id
         */
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $customerSession = $objectManager->create("Magento\Customer\Model\Session");
        $customerIdObjectManager = $customerSession->getCustomerId();

        /**
         * create redicrect to feedback of customer page
         */
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect = $resultRedirect->setPath('moduledatabase/customerallfeedback/*');

        /**
         * write data to database
         */
        $model = $this->_dataFactory->create();
        $model->addData([
            "customer_id" => $customerIdObjectManager,
            "product_id" => $modelName,
            "serial_number" => $serialNumber,
            "email" => $email,
            "phone_number" => $phone,
            "date" => date('Y-m-d H:i:s'),
            "user_request" => $userFeedback
        ]);
        $saveData = $model->save();
        if ($saveData) {
            $this->messageManager->addSuccess(__('Thank you for feedback!'));
        }
        return $resultRedirect;
    }
}
