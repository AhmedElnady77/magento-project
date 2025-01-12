<?php
namespace Maxime\Jobs\Controller\DepartmentNews;
class View extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Maxime\Jobs\Model\Department
     */
    protected $_model;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Maxime\Jobs\Model\Department $model
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        // \Maxime\Jobs\Model\Department $model,
        protected \Maxime\Jobs\Model\ResourceModel\DepartmentNews\CollectionFactory $pivotCollectionFactory,
        protected \Maxime\Jobs\Model\ResourceModel\News\CollectionFactory $newsCollectionFactory,
    )
    {

        // $this->_model = $model;
        parent::__construct($context);
    }

    public function execute()
    {
        $pivot = $this->pivotCollectionFactory->create();
        $news = $this->newsCollectionFactory->create();


        // Get param id
        $id = $this->getRequest()->getParam('id');

        // No id, redirect
        if(empty($id)){
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/');
        }

        $pivot->addFieldToSelect(['news_id'])->addFieldToFilter('department_id',$id);
        // $pivot->addFieldToSelect(['news_id'])->addFieldToFilter('department_id',$id);

        $newsId = $pivot->getData();

        $news->addFieldToFilter('entity_id', $newsId);

        $newsData = $news->getData();
        // dd($newsData);



        // Model not exists with this id, redirect
        if (!$newsData) {
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/');
        }

        $this->_view->loadLayout();
        $this->_view->getLayout()->initMessages();
        $this->_view->renderLayout();
    }
}
