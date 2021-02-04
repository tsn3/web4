<?php
namespace Web4\MenuCMS\Block\Adminhtml;
use Magento\Framework\Serialize\SerializerInterface;
class Cmspage extends \Magento\Backend\Block\Widget\Grid\Container
{
    protected $serializer;
    protected function _construct(
    )
    {
        $this->_blockGroup = 'Web4_MenuCMS';
        $this->_controller = 'adminhtml_cmspage';
        $this->_headerText = __('CMS pages');
        parent::_construct();
        $this->removeButton('add');
    }

    public function _prepareLayout()
    {
       parent::_prepareLayout();
        /* @var $serializer \Magento\Backend\Block\Widget\Grid\Serializer */
        $serializer = $this->getLayout()->createBlock(
            \Magento\Backend\Block\Widget\Grid\Serializer::class,
            '',
            [
                'data' => [
                    'grid_block' => $this->getChildBlock('grid'),
                    'callback' => 'getSelectedProducts',
                    'input_element_name' => 'selected_pages',
                    'reload_param_name' => 'selected_pages',
                ]
            ]
        );
        $this->setChild('serializer', $serializer);
    }

    public function getGridHtml()
    {
        return parent::getGridHtml().$this->getChildHtml('serializer');
    }
}
