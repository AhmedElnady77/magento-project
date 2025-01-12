<?php
namespace Maxime\Jobs\Model\Source;

class DepartmentNews implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * @var \Maxime\Jobs\Model\DepartmentNews
     */
    protected $_departmentNews;

    /**
     * Constructor
     *
     * @param \Maxime\Jobs\Model\DepartmentNews $departmentNews
     */
    public function __construct(\Maxime\Jobs\Model\DepartmentNews $departmentNews)
    {
        $this->_departmentNews = $departmentNews;
    }

    /**
     * Get options
     *
     * @return array
     */
   

    public function toOptionArray()
    {
        $options[]= ['label' => '', 'value' => ''];
        $seenDepartmentIds = [];
        $departmentNewsCollection = $this->_departmentNews->getCollection()
            ->addFieldToSelect('department_id')
            ->distinct(true);

        foreach ($departmentNewsCollection as $department) {
            $departmentId = $department->getData('department_id');


            if (!in_array($departmentId, $seenDepartmentIds)) {
                $options[] = [
                    'value' => $departmentId,
                    'label' => __('Department ID: %1', $departmentId)
                ];
                $seenDepartmentIds[] = $departmentId;
            }
        }

        return $options;
    }
}
