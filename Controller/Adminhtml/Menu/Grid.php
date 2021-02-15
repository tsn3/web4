<?php
namespace Web4\MenuCMS\Controller\Adminhtml\Menu;
class Grid extends \Magento\Backend\App\Action
{
    protected $resultPageFactory;
    protected $_coreRegistry;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory)
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context);
    }

    public function execute()
    {
        $model = $this->_objectManager->create(\Web4\MenuCMS\Model\Menu::class);
        $id = $this->getRequest()->getParam('id');

        if ($id) {
            $model->load($id);
        }
        $this->_coreRegistry->register('menu', $model);
        $page = $this->resultPageFactory->create(true);
        $page->addHandle($page->getDefaultLayoutHandle());

        return $page;

    }

}
