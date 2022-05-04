<?php

namespace Esca7a\ModuleDataBase\Block;
use Esca7a\ModuleDataBase\Model\AllCategory;
use Magento\Catalog\Model\ProductRepository;
class DisplayForm extends \Magento\Framework\View\Element\Template
{
    protected $productCollectionFactory;
    protected $_categoryHelper;
    public function __construct(
        \Magento\Catalog\Block\Product\Context $context,
        \Magento\Catalog\Helper\Category $categoryHelper,
        array $data = [],
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory
    ) {
        $this->_categoryHelper = $categoryHelper;
        parent::__construct($context, $data);
        $this->productCollectionFactory = $productCollectionFactory;
    }

    /**
     * Retrieve current store level 2 category
     *
     * @param bool|string $sorted (if true display collection sorted as name otherwise sorted as based on id asc)
     * @param bool $asCollection (if true display all category otherwise display second level category menu visible category for current store)
     * @param bool $toLoad
     */

    public function getStoreCategories($sorted = false, $asCollection = false, $toLoad = true)
    {
        return $this->_categoryHelper->getStoreCategories($sorted , $asCollection, $toLoad);
    }
        /*
         * loop for Product category to template
         */
    public function getCategoryList()
    {
        return $categories = $this->getStoreCategories(false,false,true);
    }

    public function getProductCollectionByCategories($ids)
    {
        $collection = $this->productCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->addCategoriesFilter(['in' => $ids]);
        return $collection;
    }
}
