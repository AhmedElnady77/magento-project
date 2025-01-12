<?php
namespace Maxime\Jobs\Block\DepartmentNews;
class View extends \Magento\Framework\View\Element\Template
{
    protected $_newsCollection = null;

    protected $_department;

    protected $_news;
    protected $_department_news;


    // const LIST_JOBS_ENABLED = 'jobs/department_news/view_list';
    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Maxime\Jobs\Model\Department $department
     * @param \Maxime\Jobs\Model\DepartmentNews $department_news
     * @param \Maxime\Jobs\Model\News $news
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Maxime\Jobs\Model\Department $department,
        \Maxime\Jobs\Model\DepartmentNews $department_news,
        \Maxime\Jobs\Model\News $news,
        array $data = []
    ) {
        $this->_department = $department;
        $this->_department_news = $department_news;

        $this->_news = $news;

        parent::__construct(
            $context,
            $data
        );
    }

    /**
     * @return $this
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();

        // Get department
        $department = $this->getLoadedDepartment();

        // Title is department's name
        $title = $department->getName();
        $description = __('Look at the jobs we have got for you');
        $keywords = __('job,hiring');

        $this->getLayout()->createBlock('Magento\Catalog\Block\Breadcrumbs');

        if ($breadcrumbsBlock = $this->getLayout()->getBlock('breadcrumbs')) {
            $breadcrumbsBlock->addCrumb(
                'jobs',
                [
                    'label' => __('We are hiring'),
                    'title' => __('We are hiring'),
                    'link' => $this->getListNewsUrl() // No link for the last element
                ]
            );
            $breadcrumbsBlock->addCrumb(
                'job',
                [
                    'label' => $title,
                    'title' => $title,
                    'link' => false // No link for the last element
                ]
            );
        }

        $this->pageConfig->getTitle()->set($title);
        $this->pageConfig->setDescription($description);
        $this->pageConfig->setKeywords($keywords);


        $pageMainTitle = $this->getLayout()->getBlock('page.main.title');
        if ($pageMainTitle) {
            $pageMainTitle->setPageTitle($title);
        }

        return $this;
    }

    protected function _getDepartment()
    {
        if (!$this->_department->getId()) {
            // our model is already set in the construct
            // but I put this method to load in case the model is not loaded
            $entityId = $this->_request->getParam('id');
            $this->_department = $this->_department->load($entityId);
        }
        return $this->_department;
    }

    public function getLoadedDepartment()
    {
        return $this->_getDepartment();
    }

    public function getListNewsUrl(){
        return $this->getUrl('jobs/news');
    }

    protected function _getNewsCollection(){
        if($this->_newsCollection === null && $this->_department_news->getDepartmentId()){
            $newsCollection = $this->_department_news->getCollection()
                ->addFieldToFilter('department_id', $this->_department->getId())
                ->addStatusNewsFilter($this->_news, $this->_department, $this->_department_news);
            $this->_newsCollection = $newsCollection;
        }
        return $this->_newsCollection;
    }

    public function getLoadedNewsCollection()
    {
        return $this->_getNewsCollection();
    }

    public function getNewUrl($new){
        if(!$new->getId()){
            return '#';
        }

        return $this->getUrl('jobs/news/view', ['id' => $new->getId()]);
    }



}
