<?php
namespace Web4\MenuCMS\Controller\Adminhtml\Menu;
use Magento\Backend\App\Action;
class Delete extends \Magento\Backend\App\Action
{
    private $menusFactory;
    protected $_coreRegistry;
    protected $resultPageFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Web4\MenuCMS\Model\MenuFactory $menusFactory
    )
    {
        $this->menusFactory = $menusFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

        if ($id) {
            $model = $this->menusFactory->create();
            $model->load($id);
            $model->delete();
            if (!$model->getId()) {
                $this->messageManager->addSuccessMessage(__('You deleted the record.'));
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        return $resultRedirect->setPath('*/*/');
    }
}
