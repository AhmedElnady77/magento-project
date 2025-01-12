<?php
namespace Maxime\Jobs\Block\News;
class ListNews extends \Magento\Framework\View\Element\Template
{

    protected $_news;
    protected $_department_news;
    protected $_department;
    protected $_resource;

    protected $_newsCollection = null;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Maxime\Jobs\Model\News $news
     * @param \Maxime\Jobs\Model\DepartmentNews $department_news
     * @param \Maxime\Jobs\Model\Department $department
     * @param \Magento\Framework\App\ResourceConnection $resource
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Maxime\Jobs\Model\News $news,
        \Maxime\Jobs\Model\DepartmentNews $department_news,
        \Maxime\Jobs\Model\Department $department,
        \Magento\Framework\App\ResourceConnection $resource,
        array $data = []
    ) {
        $this->_news = $news;
        $this->_department_news = $department_news;
        $this->_department = $department;
        $this->_resource = $resource;

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


        // You can put these informations editable on BO
        $title = __('All News');
        $description = __('This Is All News');
        $keywords = __('news');

        $this->getLayout()->createBlock('Magento\Catalog\Block\Breadcrumbs');

        if ($breadcrumbsBlock = $this->getLayout()->getBlock('breadcrumbs')) {
            $breadcrumbsBlock->addCrumb(
                'news',
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

    protected function _getNewsCollection()
    {
        if ($this->_newsCollection === null) {
            $newsCollection=$this->_newsCollection;
            $newsCollection = $this->_news->getCollection()->addStatusFilter($this->_news, $this->_department_news,$this->_department);

            $mergedData = [];

            foreach ($newsCollection->getData() as $item) {
                $entityId = $item['entity_id'];
                if (!isset($mergedData[$entityId])) {
                    $mergedData[$entityId] = [
                        "entity_id" => $item['entity_id'],
                        "title" => $item['title'],
                        "content" => $item['content'],
                        "status" => $item['status'],
                        "department_ids" => [$item['department_id']],
                        "department_names" => [$item['department_name']],
                    ];
                } else {
                    $mergedData[$entityId]['department_ids'][] = $item['department_id'];
                    $mergedData[$entityId]['department_names'][] = $item['department_name'];
                }
            }
            $result = array_values($mergedData);

            // dd($result);

            // var_dump($this->_newsCollection->getSelect()->__toString());
            // $this->_newsCollection = $newsCollection;
        }

        return $result;
    }


    public function getLoadedNewsCollection()
    {
        return $this->_getNewsCollection();
    }

    public function getNewsUrl($news){
        if(!$news['entity_id']){
            return '#';
        }

        return $this->getUrl('jobs/news/view', ['id' => $news['entity_id']]);
    }

    public function getDepartmentNewsUrl($departmentId){
        // if(!$department['entity_id']){
        //     return '#';
        // }

        return $this->getUrl('jobs/departmentnews/view', ['id' => $departmentId]);
    }
}
