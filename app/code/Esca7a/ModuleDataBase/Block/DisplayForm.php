<?php

namespace Esca7a\ModuleDataBase\Block;

class DisplayForm extends \Magento\Framework\View\Element\Template
{
    protected $_productCollectionFactory;
    protected $_categoryHelper;
    protected $_storeManager;
    public function __construct(
        \Magento\Catalog\Block\Product\Context $context,
        \Magento\Catalog\Helper\Category $categoryHelper,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        array $data = []
    ) {
        $this->_categoryHelper = $categoryHelper;
        $this->_productCollectionFactory = $productCollectionFactory;
        $this->_storeManager = $storeManager;
        parent::__construct($context, $data);
    }

    /**
     * Retrieve current store level 2 category
     *
     * @param bool|string $sorted (if true display collection sorted as name otherwise sorted as based on id asc)
     * @param bool $asCollection (if true display all category otherwise display second level category menu visible
     * category for current store)
     * @param bool $toLoad
     */

    public function getStoreCategories($sorted = true, $asCollection = true, $toLoad = true)
    {
        return $this->_categoryHelper->getStoreCategories($sorted, $asCollection, $toLoad);
    }

    public function getCategoryList()
    {
        return $categories = $this->getStoreCategories(false, false, true);
    }

    public function getProductCollectionById($ids)
    {
        $collection = $this->_productCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->addCategoriesFilter(['in' => $ids]);
        return $collection;

//        $website_ids = [$ids];
//        $collection = $this->_productCollectionFactory->create();
//        $collection->addAttributeToSelect(['name']);
//        $collection->addWebsiteFilter($website_ids);
//        $collection->addCategoriesFilter(['in' => $ids]);
//        return $collection;
    }

}
