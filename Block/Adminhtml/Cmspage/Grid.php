<?php
namespace Web4\MenuCMS\Block\Adminhtml\Cmspage;
use Magento\Framework\Registry;
class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * @var \Magento\Cms\Model\PageFactory
     */
    protected $_pageFactory;
    protected $registry;


    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Helper\Data $backendHelper
     * @param \Magento\Cms\Model\PageFactory $pageFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Magento\Cms\Model\PageFactory $pageFactory,
        \Magento\Framework\Registry $registry,
        array $data = []
    )
    {
        $this->registry = $registry;
        $this->_pageFactory = $pageFactory;
        parent::__construct($context, $backendHelper, $data);
    }

    protected function _construct()
    {
        parent::_construct();
        $this->setId('gridGrid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
        $this->setVarNameFilter('grid_record');
    }

    protected function _prepareCollection()
    {
        $collection = $this->_pageFactory->create()->getCollection();
        $this->setCollection($collection);
        parent::_prepareCollection();
        return $this;
    }

    protected function _prepareColumns()
    {
        $this->addColumn(
            'in_category',
            [
                'type' => 'checkbox',
                'name' => 'in_category',
//                'values' => $this->_getSelected(), must realizaited in GRID.php
                'index' => 'page_id',
//                'header_css_class' => 'col-select col-massaction',
//                'column_css_class' => 'col-select col-massaction'
            ]
        );

        $this->addColumn(
            'page_id',
            [
                'header' => __('ID'),
                'type' => 'number',
                'index' => 'page_id',
            ]
        );

        $this->addColumn(
            'title',
            [
                'header' => __('Title'),
                'index' => 'title',
            ]
        );



//        $block = $this->getLayout()->getBlock('grid.bottom.links');
//
//        if ($block) {
//            $this->setChild('grid.bottom.links', $block);
//        }
//
//        return parent::_prepareColumns();
    }

    /**
     * @return $this
     */
//    protected function _prepareMassaction()
//    {
//        $this->setMassactionIdField('id');
//        $this->getMassactionBlock()->setFormFieldName('id');
//
//        $this->getMassactionBlock()->addItem(
//            'delete',
//            [
//                'label' => __('Delete'),
//                'url' => $this->getUrl('menu/*/massDelete'),
//                'confirm' => __('Are you sure?'),
//            ]
//        );
//
//        $statuses = $this->_status->toOptionArray();
//
//        array_unshift($statuses, ['label' => '', 'value' => '']);
//
//        $this->getMassactionBlock()->addItem(
//            'status',
//            [
//                'label' => __('Change status'),
//                'url' => $this->getUrl('menu/*/massStatus', ['_current' => true]),
//                'additional' => [
//                    'visibility' => [
//                        'name' => 'status',
//                        'type' => 'select',
//                        'class' => 'required-entry',
//                        'label' => __('Status'),
//                        'values' => $statuses,
//                    ],
//                ],
//            ]
//        );
//
//        return $this;
//    }

    /**
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', ['_current' => true]);
    }

}
