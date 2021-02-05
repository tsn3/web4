<?php
namespace Web4\MenuCMS\Model\ResourceModel;


class Menu extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('menu', 'menu_id');
    }

    protected function _afterLoad(\Magento\Framework\Model\AbstractModel $object)
    {
        $id = $this->getIdFieldName('id');

        $select->joinLeft(
            array('cms_page'=>$this->getTable('cms_page')),
            'menu_id.menu=page_id.cms_page',
            array('*');

        return parent::_afterLoad();
    }

    public function afterSave(\Magento\Framework\DataObject $object)
    {
        $this->_afterSave($object);
    }

}
