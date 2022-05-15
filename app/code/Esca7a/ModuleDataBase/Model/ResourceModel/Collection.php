<?php

namespace Esca7a\ModuleDataBase\Model\ResourceModel;

\Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
class Collection extends AbstractCollection
{
    public function _construct()
    {
        $this->_init("Esca7a\ModuleDataBase\Model\Data", "Esca7a\ModuleDataBase\Model\ResourceModel\DataExample");
    }
}
