<?php

namespace Esca7a\ModuleDataBase\Model\ResourceModel;

class DataExample extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    public function _construct()
    {
        $this->_init("esca7a_task5", "application_id");
    }
}
