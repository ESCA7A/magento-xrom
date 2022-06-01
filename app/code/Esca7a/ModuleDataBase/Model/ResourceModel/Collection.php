<?php

namespace Esca7a\ModuleDataBase\Model\ResourceModel;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    public function _construct()
    {
        $this->_init(
            "Esca7a\ModuleDataBase\Model\Data",
            "Esca7a\ModuleDataBase\Model\ResourceModel\Data"
        );
    }
}
