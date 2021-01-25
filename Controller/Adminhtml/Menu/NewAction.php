<?php
namespace Web4\MenuCMS\Controller\Adminhtml\Menu;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\ForwardFactory;

class NewAction extends Action
{
    protected $resultForwardFactory;

    public function __construct(Action\Context $context, ForwardFactory $resultForwardFactory)
    {
        parent::__construct($context);
        $this->resultForwardFactory = $resultForwardFactory;
    }

    public function execute()
    {
        $resultForward = $this->resultForwardFactory->create();
        return $resultForward->forward('edit');
    }
}
//
//namespace Web4\MenuCMS\Controller\Adminhtml\Menu;
//
//class NewAction extends \Magento\Backend\App\Action
//{
//    protected $resultForwardFactory;
//
//    public function __construct(
//        \Magento\Backend\App\Action\Context $context,
//        \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory
//    ) {
//        $this->resultForwardFactory = $resultForwardFactory;
//        parent::__construct($context);
//    }
