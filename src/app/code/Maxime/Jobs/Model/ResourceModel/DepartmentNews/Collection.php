<?php
namespace Maxime\Jobs\Model\ResourceModel\DepartmentNews;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    // protected $_idFieldName = \Maxime\Jobs\Model\DepartmentNews::DEPARTMENT_NEWS_ID; // حقل المفتاح الأساسي

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            'Maxime\Jobs\Model\DepartmentNews',        // المسار الكامل لنموذج DepartmentNews
            'Maxime\Jobs\Model\ResourceModel\DepartmentNews' // المسار الكامل لـ ResourceModel
        );
    }



}
