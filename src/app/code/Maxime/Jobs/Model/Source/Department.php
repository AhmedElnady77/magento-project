<?php
namespace Maxime\Jobs\Model\Source;

use Magento\Framework\Data\OptionSourceInterface;

class Department implements OptionSourceInterface
{
    /**
     * @var \Maxime\Jobs\Model\Department
     */
    protected $_department;

    /**
     * Constructor
     *
     * @param \Maxime\Jobs\Model\Department $department
     */
    public function __construct(\Maxime\Jobs\Model\Department $department)
    {
        $this->_department = $department;
    }

    public function toTreeOptionArray()
    {
        $departmentCollection = $this->_department->getCollection()
            ->addFieldToSelect(['entity_id', 'name', 'parent_id']);

        $tree = [];
        foreach ($departmentCollection as $department) {
            $tree[$department->getParentId()][] = $department;
        }
        // dd($tree);
        return $this->buildTree($tree, null, 0);
    }

    /**
     * Build hierarchical tree structure
     *
     * @param array $departments
     * @param int|null $parentId
     * @param int $level
     * @return array
     */


    private function buildTree($departments, $parentId = null, $level = 0)
{
    $options = [];

    // Check if the parent ID exists in the array
    if (!empty($departments[$parentId])) {
        foreach ($departments[$parentId] as $department) {
            // Add the current department to the options array
            $options[] = [
                'label' => str_repeat('*', $level) . ' ' . $department->getName(),
                'value' => $department->getEntityId(),
            ];

            // Recursively process child departments
            $childOptions = $this->buildTree($departments, $department->getEntityId(), $level + 1);
            $options = array_merge($options, $childOptions);
        }
    }
    return $options;
}


    /**
     * Get flat options array (fallback for other use cases)
     *
     * @return array
     */
    public function toOptionArray()
    {
        $departmentCollection = $this->_department->getCollection()
            ->addFieldToSelect(['entity_id', 'name']);

        $options = [];
        foreach ($departmentCollection as $department) {
            $options[] = [
                'label' => $department->getName(),
                'value' => $department->getEntityId()
            ];
        }

        return $options;
    }
}
