<?php
namespace Web4\MenuCMS\Controller\Adminhtml\Menu;
use Magento\Backend\App\Action;
class Edit extends \Magento\Backend\App\Action
{
    protected $logger;
    protected $_coreRegistry;
    protected $resultPageFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Psr\Log\LoggerInterface $logger
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $coreRegistry;
        $this->logger = $logger;
        parent::__construct($context);
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $model = $this->_objectManager->create(\Web4\MenuCMS\Model\Menu::class);

        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This Menu link no longer exists.'));
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }

        $this->_coreRegistry->register('menu', $model);


        $resultPage = $this->resultPageFactory->create();

        $resultPage->getConfig()->getTitle()->prepend(__('Menu'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? __('Edit Menu %1', $model->getId()) : __('New Menu'));
        return $resultPage;
    }
}
