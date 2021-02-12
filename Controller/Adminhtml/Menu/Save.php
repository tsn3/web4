<?php
namespace Web4\MenuCMS\Controller\Adminhtml\Menu;
class Save extends \Magento\Backend\App\Action
{
    protected $logger;
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->logger = $logger;
        parent::__construct($context);
    }
    public function execute()
    {
        $data = $this->getRequest()->getPost();
        if(is_object($data)){
            $data = $data->toArray();
        }
        $resultRedirect = $this->resultRedirectFactory->create();

        if ($data) {
            $model = $this->_objectManager->create(\Web4\MenuCMS\Model\Menu::class);
            $id = $this->getRequest()->getParam('menu_id');

            if (isset($data['menu_id'])&&(!$data['menu_id'])){
                unset($data['menu_id']);
            }

            $model->setData($data);
            if (isset($data['selected_pages'])){
                $pages = explode('&', ($data['selected_pages']));
                $model->setPages($pages);
            }

            try {
                $model->save();
                $this->messageManager->addSuccessMessage(__('You saved the menu.'));
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['menu_id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');

            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
                $this->messageManager->addErrorMessage(__('Something went wrong while saving the page.' ));
            }

            return $resultRedirect->setPath('*/*/edit', ['menu_id' => $this->getRequest()->getParam('menu_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
