<?php

/**
 * @author Matthew Cooper
 * @author Matthew Cooper <matthew.cooper@thedailyedited.com>
 */
namespace Tde\Press\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Tde\Press\Model\Press;

class Edit extends \Magento\Backend\App\Action
{

    const ADMIN_RESOURCE = 'Tde_Press::index_edit';

    /**
     * @var Registry
     */
    protected $registry;

    /**
     * @var Press
     */
    protected $press;

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * Edit constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param Press $press
     * @param Registry $registry
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        Press $press,
        Registry $registry
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->registry = $registry;
        $this->press = $press;
        return parent::__construct($context);
    }

    /**
     * @return $this|\Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        if ($id) {
            $this->press->load($id);
            if (!$this->press->getId()) {
                $this->messageManager->addError(__('This page no longer exists.'));
                /** \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        $this->registry->register('press', $this->press);

        // 5. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage
            ->getConfig()
            ->getTitle()
            ->prepend(__('New Press Release'));
        $resultPage->addBreadcrumb(
            $id ? __('Edit Press Release') : __('New Press Release'),
            $id ? __('Edit Press Release') : __('New Press Release')
        );

        return $resultPage;
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return true;
        //return $this->_authorization->isAllowed('ACL RULE HERE');
    }

}
