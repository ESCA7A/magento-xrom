<?php

namespace Esca7a\ModuleDataBase\Block;

use Magento\Framework\Data\Tree\Node\Collection;

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
     * @param bool $asCollection (if true display all category otherwise display second level category menu
     * visible category for current store)
     * @param bool $toLoad
     * @return array|Collection
     */

    public function getStoreCategories($sorted = false, bool $asCollection = true, bool $toLoad = true)
    {
        return $this->_categoryHelper->getStoreCategories($sorted, $asCollection, $toLoad);
    }

    public function getCategoryList()
    {
        return $this->getStoreCategories(false, true, true);
    }

    public function getProductCollectionById($ids)
    {
        $collection = $this->_productCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->addCategoriesFilter(['in' => $ids]);
        return $collection;
    }
}
