<?php
namespace Maxime\Jobs\Model\ResourceModel\Department;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = \Maxime\Jobs\Model\Department::DEPARTMENT_ID; // حقل المفتاح الأساسي

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            'Maxime\Jobs\Model\Department',        // المسار الكامل لنموذج Department
            'Maxime\Jobs\Model\ResourceModel\Department' // المسار الكامل لـ ResourceModel
        );
    }


    protected function _initSelect()
    {
        parent::_initSelect();

        // Add a join to get the parent department name
        // $this->getSelect()->joinLeft(
        //     ['parent_department' => $this->getTable('maxime_department')], // Replace with your actual table name
        //     'main_table.parent_id = parent_department.entity_id', // Join condition
        //     ['parent_id' => 'parent_department.name'] // Select the parent department name
        // );

        return $this;
    }

}
