<?php


namespace Maxime\Jobs\Controller\Adminhtml\News;


use Magento\Backend\App\Action;

class Save extends Action
{
    protected $_model;
    protected $_departmentNewsModel;

    public function __construct(
        Action\Context $context,
        \Maxime\Jobs\Model\News $model,
        \Maxime\Jobs\Model\DepartmentNews $departmentNewsModel,
        )
    {
        parent::__construct($context);
        $this->_model = $model;
        $this->_departmentNewsModel = $departmentNewsModel;
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Maxime_Jobs::news_save');
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        // dd($data);
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

        if ($data) {
            /** @var \Maxime\Jobs\Model\News $model */
            $model = $this->_model;

            $id = $this->getRequest()->getParam('entity_id');
            if ($id) {
                $model->load($id);
            }

            $model->setData($data);

            // Dispatch an event before saving
            $this->_eventManager->dispatch(
                'jobs_news_prepare_save',
                ['news' => $model, 'request' => $this->getRequest()]
            );

            try {
                // Save the main model
                $model->save();

                // Save the pivot table data
                if (!empty($data['department_id']) && is_array($data['department_id'])) {
                    $this->saveDepartments($model->getId(), $data['department_id']);
                }

                $this->messageManager->addSuccess(__('New saved'));
                $this->_getSession()->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the new'));
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['entity_id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }

    /**
     * Save the department associations to the pivot table
     *
     * @param int $newsId
     * @param array $departmentIds
     * @return void
     */
    protected function saveDepartments($newsId, array $departmentIds)
    {
        // Delete all existing department associations for this news ID
        $this->_departmentNewsModel->getResource()->getConnection()->delete(
            $this->_departmentNewsModel->getResource()->getMainTable(),
            ['news_id = ?' => $newsId]
        );


        foreach ($departmentIds as $departmentId) {
            if(empty($departmentId))
            {
                continue;  // Skip empty department IDs
            }
            $attachDeparmentToNews = $this->_departmentNewsModel->setData(['department_id' => $departmentId, 'news_id' => $newsId]);
            $attachDeparmentToNews->save();
        }   
    }
}


// $test = $this->_departmentNewsResource->setData(['department_id' => 2, 'news_id' => 2]);
// $test->save();
// dd($test->getData());
