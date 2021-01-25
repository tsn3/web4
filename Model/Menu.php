<?php
namespace Web4\MenuCMS\Model;
class Menu extends \Magento\Framework\Model\AbstractModel
{
    const CACHE_TAG = 'menu';

    protected $_cacheTag = 'menu';

    protected $_eventPrefix = 'menu';

    protected function _construct()
    {
        $this->_init('Web4\MenuCMS\Model\ResourceModel\Menu');
    }

}

