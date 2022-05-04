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
    )
	{
		$this->_pageFactory = $pageFactory;
        $this->categoryFactory = $categoryFactory;
        $this->initCategory();
		return parent::__construct($context);
	}

	public function execute()
	{
        $this->currentCategory->getProductCollection()->addAttributeToSelect('*');
		return $this->_pageFactory->create();
	}

    protected function initCategory()
    {
        $categoryID = $this->getRequest()->getParam('category');
        $category = $this->categoryFactory->create()->load($categoryID);
        $this->categoryFactory = $category;
    }

}
