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
//        \Magento\Framework\Registry $registry,
        \Magento\Framework\Registry $coreRegistry,
        array $data = []
    )
    {
//        $this->registry = $registry;
        $this->_coreRegistry = $coreRegistry;
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
            'in_pages',
            [
                'type' => 'checkbox',
                'name' => 'in_pages',
                'values' => $this->_getSelectedPages(),
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

    }

    protected function _getSelectedPages()
    {
//         $this->getPages();
        $pages =$this->_coreRegistry->registry('menu')->getPages();
//        if (!is_array($pages)) {
//            $pages = array_keys($this->getSelectedRelatedPages());
//        }
        return $pages;
    }

    /**
     * Retrieve related pages
     *
     * @return array
     */
//    public function getSelectedRelatedPages()
//    {
//        $pages = [];
//        if ($this->_coreRegistry->registry('menu')->getRelatedProducts()) {
//            foreach ($this->_coreRegistry->registry('menu')->getRelatedProducts() as $page) {
//                $pages[$page->getId()] = ['position' => $page->getPosition()];
//            }
//        }
//        return $pages;
//    }


    /**
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', ['_current' => true]);
    }
}
