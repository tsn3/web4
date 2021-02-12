<?php
namespace Web4\MenuCMS\Model\ResourceModel\Menu;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'menu_id';
    protected $_eventPrefix = 'menu_collection';
    protected $_eventObject = 'menu_collection';

    protected function _construct()
    {
        $this->_init('Web4\MenuCMS\Model\Menu', 'Web4\MenuCMS\Model\ResourceModel\Menu');
    }



}
