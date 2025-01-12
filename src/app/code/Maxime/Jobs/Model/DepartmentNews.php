<?php
namespace Maxime\Jobs\Model;

use \Magento\Framework\Model\AbstractModel;

class DepartmentNews extends AbstractModel
{
    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'department_news'; // Event prefix for pivot table

    /**
     * Name of the event object
     *
     * @var string
     */
    protected $_eventObject = 'department_news';

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Maxime\Jobs\Model\ResourceModel\DepartmentNews');
    }
}
