<?php
namespace Web4\MenuCMS\Block\Adminhtml\Cmspage;
use Magento\Framework\View\Element\Template;
use \Web4\MenuCMS\Model\ResourceModel\Menu\CollectionFactory as LinkCollectionFactory;
class LinksPages extends Template
{
    protected $_linkCollectionFactory;
    protected $_collection;

    public function __construct(
        Template\Context $context,
        linkCollectionFactory $linkCollectionFactory,
        array $data = []
    )
    {
        $this->_linkCollectionFactory = $linkCollectionFactory;
        parent::__construct($context, $data);
    }

    public function getLinksCollection()
    {
        $link = $this->getLayout()->getBlock('cms_page')->getPage()->getId();

        $this->_collection = $this->_linkCollectionFactory->create();
        $this->_collection->join(['selected_pages' =>'menupage'], '(selected_pages.menu_id=main_table.menu_id)and(selected_pages.page_id='.$link.')', 'page_id');
        $this->_collection->addFieldToFilter('status', array('eq' => 1));

        return $this->_collection;
    }
}






