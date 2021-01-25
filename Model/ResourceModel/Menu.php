<?php
namespace Web4\MenuCMS\Model\ResourceModel;


class Menu extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('menu', 'menu_id');
    }

}

