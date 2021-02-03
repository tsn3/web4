<?php
namespace Web4\MenuCMS\Block\Adminhtml;

class AssignLinks extends \Magento\Backend\Block\Template
{
    /**
     * Block template
     *
     * @var string
     */
    protected $_template = 'links/assign_links.phtml';

    /**
     * @var \Magento\Catalog\Block\Adminhtml\Category\Tab\Link
     */
    protected $blockGrid;

    /**
     * @var \Magento\Framework\Registry
     */
    protected $registry;

    /**
     * @var \Magento\Framework\Json\EncoderInterface
     */
    protected $jsonEncoder;

    /**
     * @var \Web4\MenuCMS\Model\ResourceModel\Menu\CollectionFactory
     */
    protected $menuFactory;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Json\EncoderInterface $jsonEncoder
     * @param \Web4\MenuCMS\Model\ResourceModel\Menu\CollectionFactory $menuFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Json\EncoderInterface $jsonEncoder,
        \Web4\MenuCMS\Model\ResourceModel\Menu\CollectionFactory $menuFactory,
        array $data = []
    )
    {
        $this->registry = $registry;
        $this->jsonEncoder = $jsonEncoder;
        $this->menuFactory = $menuFactory;
        parent::__construct($context, $data);
    }

    /**
     * Retrieve instance of grid block
     *
     * @return \Magento\Framework\View\Element\BlockInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getBlockGrid()
    {
        if (null === $this->blockGrid) {
            $this->blockGrid = $this->getLayout()->createBlock(
                'Web4\MenuCMS\Block\Adminhtml\Tab\Menugrid',
                'category.menu.grid'
            );
        }
        return $this->blockGrid;
    }

    /**
     * Return HTML of grid block
     *
     * @return string
     */
    public function getGridHtml()
    {
        return $this->getBlockGrid()->toHtml();
    }

    /**
     * @return string
     */
    public function getLinksJson()
    {
        $entity_id = $this->getRequest()->getParam('entity_id');
        $menuFactory = $this->menuFactory->create();
        $menuFactory->addFieldToSelect(['menu_id', 'position']);
        $menuFactory->addFieldToFilter('entity_id', ['eq' => $entity_id]);
        $result = [];
        if (!empty($menuFactory->getData())) {
            foreach ($menuFactory->getData() as $webLinks) {
                $result[$webLinks['menu_id']] = '';
            }
            return $this->jsonEncoder->encode($result);
        }
        return '{}';
    }

    public function getItem()
    {
        return $this->registry->registry('my_item');
    }
}
