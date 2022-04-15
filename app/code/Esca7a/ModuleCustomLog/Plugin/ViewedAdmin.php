<?php

namespace Esca7a\ModuleCustomLog\Plugin;

use Magento\Customer\Controller\Adminhtml\Index\Edit;
use Magento\Backend\Model\Auth\Session; //нужно что бы вытащить ник админа
use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Customer\Model\Session as customerSession;


class ViewedAdmin{
    protected $customer;

    public function __CONSTRUCT(
        \Psr\Log\LoggerInterface $logger,
        Edit $edit,
        Session $authSession,
        CustomerInterface $customer,
        customerSession $customerSession
    ){
        $this->logger = $logger;
        $this->authSession = $authSession;
        $this->customerInterface = $customer;
        $this->customerSessionFromModel = $customerSession;
    }

    public function beforeExecute(Edit $subject)
    {
        $customerResponse = $subject->getResponse()->sendResponse();
        $customerId = $subject->getRequest()->getParam('id');
        if ($customerId)
        {
            $this->logger->info(" | ADMIN : " . $this->authSession->getName()
                . " | VIEWED CUSTOMER WITH ID | " . $customerId
            );
        } else $this->logger->info("сработало условия если");
    }
}

