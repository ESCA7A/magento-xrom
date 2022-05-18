<?php

namespace Esca7a\ModuleDataBase\Controller\CustomerFeedbackForm;

class Ajax extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;
    protected $_productCollectionFactory;
    protected $_categoryCollectionFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $categoryCollectionFactory
    ) {
        $this->_pageFactory = $pageFactory;
        $this->_productCollectionFactory = $productCollectionFactory;
        $this->_categoryCollectionFactory = $categoryCollectionFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $categoryId = $this->getRequest()->getParam('category');

        $result = [];
        if ($categoryId) {
            $collection = $this->_productCollectionFactory->create()->addCategoryIds($categoryId);
            $collection->addAttributeToSelect('*')->addCategoriesFilter(['in' => $categoryId]);

            foreach ($collection as $item) {
                $ProductName = $item->getName();
                $result[] = ["id" => "$categoryId", "name" => "$ProductName"];
            }
        }
        if (empty($result)) {
            $result[] = 'result EMPTY';
        }

        return $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_JSON)->setData($result);
    }
}
