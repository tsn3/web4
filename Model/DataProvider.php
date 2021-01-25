<?php
namespace WEb4\MenuCMS\Model;
//use Web4\MenuCMS\Model\ResourceModel\Menu\CollectionFactory;
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $menuCollectionFactory
     * @param array $meta
     * @param array $data
     */
    protected $_coreRegistry;
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        \Magento\Framework\Registry $coreRegistry,
        array $meta = [],
        array $data = []
    )
    {
//        $this->collection = $menuCollectionFactory->create();
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        $model = $this->_registry->registry('menu');
        if ($model != null) {
            $this->loadedData[$model->getId()] = $model->getData();
            return $this->loadedData;
        }
        return [];
    }
}

//    public function getData()
//    {
//        if (isset($this->_loadedData)) {
//            return $this->_loadedData;
//        }
//        $items = $this->collection->getItems();
//        foreach ($items as $model) {
//            $this->_loadedData[$menu->getId()] = $model->getData();
//            if($model->getCategoryIds()){
//                $data['menu_id'] = explode(',', $model->getCategoryIds());
//                $fullData = $this->_loadedData;
//                $this->_loadedData[$model->getId()] = array_merge($fullData[$model->getId()], $data);
//            }
//            if($model->getFile()){
//                $m['file'][0]['name'] = $model->getFile();
//                $m['file'][0]['url'] = $this->getMediaUrl().$model->getFile();
//                $fullData = $this->_loadedData;
//                $this->_loadedData[$model->getId()] = array_merge($fullData[$model->getId()], $m);
//            }
//        }
//        return $this->_loadedData;
//        //return [];
//    }
