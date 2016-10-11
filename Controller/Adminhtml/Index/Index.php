<?php

/**
 * @author Matthew Cooper
 * @author Matthew Cooper <matthew.cooper@thedailyedited.com>
 */
namespace Tde\Press\Controller\Adminhtml\Index;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Tde_Press::index';

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * Index constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory)
    {
        $this->resultPageFactory = $resultPageFactory;
        return parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage
            ->setActiveMenu(static::ADMIN_RESOURCE)
            ->getConfig()
            ->getTitle()
            ->prepend(__('Press Content'));
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
