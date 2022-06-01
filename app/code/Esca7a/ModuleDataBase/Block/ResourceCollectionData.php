<?php

namespace Esca7a\ModuleDataBase\Block;

use Esca7a\ModuleDataBase\Model\ResourceModel\CollectionFactory as CollectionFactory;
use Magento\Customer\Model\Session;
use Magento\Framework\View\Element\Template;

class ResourceCollectionData extends \Magento\Framework\View\Element\Template
{
    public $customerSession;
    protected $_dataFactory;
    public function __construct(
        CollectionFactory $dataFactory,
        Template\Context $context,
        Session $session,
        array $data = []
    ) {
        $this->_dataFactory = $dataFactory;
        parent::__construct($context, $data);
        $this->customerSession = $session;
    }
    public function getCustomerId()
    {
        return $this->customerSession->getCustomer()->getId();
    }

    public function getCollection()
    {
        /** @var ViewCollection $viewCollection */
        $viewCollection = $this->_dataFactory->create();
        $viewCollection->addFieldToSelect('*')->load();
        return $viewCollection->getItems();
    }
}
