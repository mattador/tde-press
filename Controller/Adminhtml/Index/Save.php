<?php

/**
 * @author Matthew Cooper
 * @author Matthew Cooper <matthew.cooper@thedailyedited.com>
 */
namespace Tde\Press\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;
use Tde\Press\Model\Press;

class Save extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Tde_Press::save';

    /**
     * @var PostDataProcessor
     */
    protected $dataProcessor;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;
    /**
     * @var Press
     */
    private $press;

    /**
     * @param Action\Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param Press $press
     */
    public function __construct(
        Action\Context $context,
        DataPersistorInterface $dataPersistor,
        Press $press
    )
    {
        $this->dataPersistor = $dataPersistor;
        $this->press = $press;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {

        $data = $this->getRequest()->getPostValue();
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {

            if (isset($data['is_active']) && $data['is_active'] === '1') {
                $data['is_active'] = Press::STATUS_ENABLED;
            } else {
                $data['is_active'] = Press::STATUS_DISABLED;
            }
            if (empty($data['entity_id'])) {
                $data['entity_id'] = null;
            }

            $id = $this->getRequest()->getParam('entity_id');
            if ($id) {
                $this->press->load($id);
            }
            $this->press->setData($data);
            //@todo implement form validation

            try {
                $this->press->save();
                $this->messageManager->addSuccess(__('You saved the press release.'));
                $this->dataPersistor->clear('press');
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $this->press->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the press release.'));
            }

            $this->dataPersistor->set('press', $data);
            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
