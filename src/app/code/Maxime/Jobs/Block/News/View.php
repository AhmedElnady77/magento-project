<?php
namespace Maxime\Jobs\Block\News;
class View extends \Magento\Framework\View\Element\Template
{
    protected $_news;

    protected $_department;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Maxime\Jobs\Model\News $news
     * @param \Maxime\Jobs\Model\Department $department
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Maxime\Jobs\Model\News $news,
        \Maxime\Jobs\Model\Department $department,
        array $data = []
    ) {
        $this->_news = $news;
        $this->_department = $department;

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

        // Get job and department
        $news = $this->getLoadedNews();
        $department = $this->getLoadedDepartment();

        // Title is job's title and department's name
        $title = $news->getTitle();
        $description = __('Look at the jobs we have got for you');
        $keywords = __('job,hiring');

        $this->getLayout()->createBlock('Magento\Catalog\Block\Breadcrumbs');

        if ($breadcrumbsBlock = $this->getLayout()->getBlock('breadcrumbs')) {
            $breadcrumbsBlock->addCrumb(
                'news',
                [
                    'label' => __('We are hiring'),
                    'title' => __('We are hiring'),
                    'link' => $this->getListNewsUrl() // No link for the last element
                ]
            );
            $breadcrumbsBlock->addCrumb(
                'new',
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

    protected function _getNews()
    {
        if (!$this->_news->getId()) {
            // our model is already set in the construct
            // but I put this method to load in case the model is not loaded
            $entityId = $this->_request->getParam('id');
            $this->_news = $this->_news->load($entityId);
        }
        return $this->_news;
    }


    public function getLoadedNews()
    {
        return $this->_getNews();
    }

    // protected function _getDepartment()
    // {
    //     if (!$this->_department->getId()) {
    //         // Get the job to retrieve department_id
    //         $job = $this->getLoadedJob();
    //         // Load department with id
    //         $this->_department->load($job->getDepartmentId());
    //     }
    //     return $this->_department;
    // }


    // public function getLoadedDepartment()
    // {
    //     return $this->_getDepartment();
    // }


    public function getListNewsUrl(){
        return $this->getUrl('jobs/news');
    }

    // public function getDepartmentUrl($job){
    //     if(!$job->getDepartmentId()){
    //         return '#';
    //     }

    //     return $this->getUrl('jobs/department/view', ['id' => $job->getDepartmentId()]);
    // }
}



// .' - '.$department->getName()
