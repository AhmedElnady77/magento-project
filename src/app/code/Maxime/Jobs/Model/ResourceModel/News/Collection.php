<?php
namespace Maxime\Jobs\Model\ResourceModel\News;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = \Maxime\Jobs\Model\News::NEWS_ID; // حقل المفتاح الأساسي

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            'Maxime\Jobs\Model\News',        // المسار الكامل لنموذج News
            'Maxime\Jobs\Model\ResourceModel\News' // المسار الكامل لـ ResourceModel
        );
    }




    public function addStatusFilter($news, $department_news, $department)
    {
        $this->addFieldToSelect('*')
        ->addFieldToFilter('status', array('eq' => $news->getEnableStatus()))
        ->join(
            array('department_news' => $department_news->getResource()->getMainTable()),
                'main_table.entity_id = department_news.news_id',
                array('department_id' => 'department_id')
        )
        ->join(
            array('department' => $department->getResource()->getMainTable()),
                'department_news.department_id = department.entity_id',
                array('department_name' => 'name')
        );
        // dd($this->getData());
        return $this;
    }






    // protected function _initSelect()
    // {
    //     parent::_initSelect();
    //     $this->getSelect()
    //         ->join(
    //             ['pivot' => $this->getTable('maxime_department_news')],
    //             'main_table.entity_id = pivot.news_id',
    //             ['department_id']
    //         ) ->join(
    //             ['department' => $this->getTable('maxime_department')],
    //             'pivot.department_id = department.entity_id',
    //             ['name AS department_name']
    //         );
    // }
}
