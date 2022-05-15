<?php

namespace Esca7a\ModuleDataBase\Model;

/**
 * Class File
 * @package Esca7a\ModuleDataBase\Model
 */
class Data extends \Magento\Framework\Model\AbstractModel
{
    public function _construct()
    {
        $this->_init("Esca7a\ModuleDataBase\Model\ResourceModel\DataExample");
    }
}
