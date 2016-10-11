<?php

/**
 * @author Matthew Cooper
 * @author Matthew Cooper <matthew.cooper@thedailyedited.com>
 */
namespace Tde\Press\Controller\Adminhtml\Index;

use Exception;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\LocalizedException;
use Tde\Press\Model\Press;
use Tde\Press\Model\ResourceModel\Press\Collection;

class MassDelete extends \Magento\Backend\App\Action
{

    /**
     * @var \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
     */
    private $collection;

    /**
     * MassStatus constructor.
     * @param Context $context
     * @param Press $press
     */
    public function __construct(
        Context $context,
        Press $press
    )
    {
        parent::__construct($context);
        $this->collection = $press->getCollection();
    }

    /**
     * Update press releases(s) status
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        try {
            /** @var Collection $pressItems */
            $pressItems = $this->collection->addFieldToFilter('entity_id', $this->getRequest()->getParam('selected'));
            $deleted = 0;
            /** @var Press $item */
            foreach ($pressItems as $item) {
                $item->delete();
                $deleted++;
            }
            $this->messageManager->addSuccess(__('A total of %1 record(s) have been delete.', $deleted));

        } catch (LocalizedException $e) {
            $this->messageManager->addError($e->getMessage());
        } catch (Exception $e) {
            $this->_getSession()->addException($e, __('Something went wrong while deleting.'));
        }

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('press/index/index');
    }
}
