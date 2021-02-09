<?php
namespace Web4\MenuCMS\Model\ResourceModel;
use \Magento\Backend\App\Action;
use Magento\Framework\DataObject;
class Menu extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('menu', 'menu_id');
    }

    protected function _afterSave(\Magento\Framework\Model\AbstractModel $object)
    {
        $table = $this->getTable('menupage');
        $newPages = (array)$object->getPages();

        $connection = $this->getConnection();
        $where = ['menu_id = ?' => (int)$object->getId()];
        $connection->delete($table, $where);

        if ($newPages) {
            $data = [];
            foreach ($newPages as $pages) {
                $data[] = (['menu_id' => (int)$object->getId(), 'page_id' => $pages]);
            }
            $this->getConnection()->insertMultiple($table, $data);
        }
        return parent::_afterSave($object);
    }

}


//
///**
// * Perform operations after object load
// *
// * @param \Magento\Framework\Model\AbstractModel $object
// * @return $this
// */
//protected function _afterLoad(\Magento\Framework\Model\AbstractModel $object)
//{
//    if ($object->getId()) {
//        $stores = $this->lookupStoreIds($object->getId());
//        $object->setData('store_id', $stores);
//    }
//
//    return parent::_afterLoad($object);
//}
