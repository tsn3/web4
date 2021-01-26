<?php
namespace Web4\MenuCMS\Model;
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    /**
     * DataProvider constructor.
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param \Magento\Framework\Registry $coreRegistry
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        \Magento\Framework\Registry $coreRegistry,
        array $meta = [],
        array $data = []
    )
    {
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function addFilter(\Magento\Framework\Api\Filter $filter)
    {

    }

    public function getData()
    {
        $model = $this->_coreRegistry->registry('menu');
        if ($model != null) {
            $this->loadedData[$model->getId()] = $model->getData();
            return $this->loadedData;
        }
        return [];
    }
}
