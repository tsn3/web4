<?php
namespace Web4\MenuCMS\Model;
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;
    protected $logger;
    protected $_loadedData;

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
        \Psr\Log\LoggerInterface $logger,
        array $meta = [],
        array $data = []
    )
    {
        $this->_coreRegistry = $coreRegistry;
        $this->logger = $logger;
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
        $this->loadedData[$model->getId()] = $model->getData();
        return [];
    }

}
