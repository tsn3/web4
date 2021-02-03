<?php
namespace Web4\MenuCMS\Block\Adminhtml\Cmspage;

class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{

    /**
     * @var \Web4\MenuCMS\Model\MenuFactory
     */
    protected $_menuFactory;

    /**
     * @var \Magento\Framework\Module\Manager
     */
    protected $moduleManager;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Helper\Data $backendHelper
     * @param \Web4\MenuCMS\Model\MenuFactory $menuFactory

     * @param \Magento\Framework\Module\Manager $moduleManager
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Web4\MenuCMS\Model\MenuFactory $menuFactory,

        \Magento\Framework\Module\Manager $moduleManager,
        array $data = []
    )
    {
        $this->_menuFactory = $menuFactory;

        $this->moduleManager = $moduleManager;
        parent::__construct($context, $backendHelper, $data);
    }

    /**
     * @return void
     */
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

    /**
     * @return $this
     */
    protected function _prepareCollection()
    {
        $collection = $this->_menuFactory->create()->getCollection();
        $this->setCollection($collection);
        parent::_prepareCollection();
        return $this;
    }

    /**
     * @return $this
     */
    protected function _prepareColumns()
    {

        $this->addColumn(
            'page_id',
            [
                'header' => __('ID'),
                'type' => 'number',
                'index' => 'id',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
            ]
        );

        $this->addColumn(
            'title',
            [
                'header' => __('Title'),
                'index' => 'title',
            ]
        );

        $this->addColumn(
            'is_active',
            [
                'header' => __('Status'),
                'index' => 'is_active',
                'type' => 'options',
                'options' => $this->_status->getOptionArray(),
            ]
        );


        $this->addColumn(
            'edit',
            [
                'header' => __('Edit'),
                'type' => 'action',
                'getter' => 'getId',
                'actions' => [
                    [
                        'caption' => __('Edit'),
                        'url' => [
                            'base' => 'menu/*/edit',
                        ],
                        'field' => 'id',
                    ],
                ],
                'filter' => false,
                'sortable' => false,
                'index' => 'stores',
                'header_css_class' => 'col-action',
                'column_css_class' => 'col-action',
            ]
        );

        $this->addColumn(
            'delete',
            [
                'header' => __('Delete'),
                'type' => 'action',
                'getter' => 'getId',
                'actions' => [
                    [
                        'caption' => __('Delete'),
                        'url' => [
                            'base' => 'menu/*/delete',
                        ],
                        'field' => 'id',
                    ],
                ],
                'filter' => false,
                'sortable' => false,
                'index' => 'stores',
                'header_css_class' => 'col-action',
                'column_css_class' => 'col-action',
            ]
        );

        $block = $this->getLayout()->getBlock('grid.bottom.links');

        if ($block) {
            $this->setChild('grid.bottom.links', $block);
        }

        return parent::_prepareColumns();
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
        return $this->getUrl('menu/*/grid', ['_current' => true]);
    }

    /**
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('menu/*/edit', ['id' => $row->getId()]);
    }
}
