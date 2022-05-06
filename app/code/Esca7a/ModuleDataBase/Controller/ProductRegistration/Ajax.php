<?php

namespace Esca7a\ModuleDataBase\Controller\ProductRegistration;

class Ajax extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;
    protected $categoryFactory;
    protected $currentCategory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Catalog\Model\CategoryFactory $categoryFactory
    ) {
        $this->_pageFactory = $pageFactory;
        $this->categoryFactory = $categoryFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $result = [['id' => '1', 'name' => 'pasha'], ['id' => '2', 'name' => 'nePasha']];
//        $this->initCategory();
//        $this->currentCategory->getProductCollection()->addAttributeToSelect('*');
        return $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_JSON)->setData($result);
    }

    protected function initCategory()
    {
        $categoryID = $this->getRequest()->getParam('category');
        $category = $this->categoryFactory->create()->load($categoryID);
        $this->categoryFactory = $category;
    }
}
