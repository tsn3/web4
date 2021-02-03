<?php
namespace Web4\MenuCMS\Block\Adminhtml;
use Magento\Framework\Serialize\SerializerInterface;
class Cmspage extends \Magento\Backend\Block\Widget\Grid\Container
{
    protected $serializer;
    protected function _construct(
    )
    {
        $this->serializer = $serializer;
        $this->_blockGroup = 'Web4_MenuCMS';
        $this->_controller = 'adminhtml_cmspage';
        $this->_headerText = __('CMS pages');
        $this->_addButtonLabel = __('Add New Link');


        parent::_construct();
    }
//    protected function _prepareLayout()
//    {
//        $grid = $this->getGridBlock();
//        if (is_string($grid)) {
//            $grid = $this->getLayout()->getBlock($grid);
//        }
//        if ($grid instanceof \Magento\Backend\Block\Widget\Grid) {
//            $this->setGridBlock($grid)->setSerializeData($grid->{$this->getCallback()}());
//        }
//        return parent::_prepareLayout();
//    }
    public function _prepareLayout()
    {
       $selected = $this->getRequest()->getParam('selected', '');
       $productTypeId = $this->getRequest()->getParam('product_type_id', '');
       $chooser = $this->_view->getLayout()->createBlock(
            \Magento\Catalog\Block\Adminhtml\Product\Widget\Chooser::class
        )->setName(
            $this->mathRandom->getUniqueHash('products_grid_')
        )->setUseMassaction(
            true
        )->setProductTypeId(
            $productTypeId
        )->setSelectedProducts(
            explode(',', $selected)
       );
        /* @var $serializer \Magento\Backend\Block\Widget\Grid\Serializer */
        $serializer = $this->_view->getLayout()->createBlock(
            \Magento\Backend\Block\Widget\Grid\Serializer::class,
            '',
            [
                'data' => [
                    'grid_block' => $chooser,
                    'callback' => 'getSelectedProducts',
                    'input_element_name' => 'selected_pages',
                    'reload_param_name' => 'selected_pages',
                ]
            ]
        );
        $this->setBody($chooser->toHtml() . $serializer->toHtml());
    }

    public function getGridHtml()
    {
        return $this->getChildHtml('grid');
    }
}

//
//
//    /**
//     * Prepare button and grid
//     *
//     * @return \Magento\Catalog\Block\Adminhtml\Product
//     */
//    protected function _prepareLayout()
//    {
//        $this->setChild(
//            'grid',
//            $this->getLayout()->createBlock('Web4\MenuCMS\Block\Adminhtml\Cmspage\Grid', 'admin.myadmingrid.grid')
//        );
//        return parent::_prepareLayout();
//    }
