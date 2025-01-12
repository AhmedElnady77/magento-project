<?php
namespace Maxime\Jobs\Model;

use Magento\Framework\Model\AbstractModel;

class News extends AbstractModel
{
    const NEWS_ID = 'entity_id'; // Define the id field name

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'jobs'; // Prefix for model events

    /**
     * Name of the event object
     *
     * @var string
     */
    protected $_eventObject = 'news'; // Name of the event object

    /**
     * Name of object id field
     *
     * @var string
     */
    protected $_idFieldName = self::NEWS_ID; // Define id field name

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Maxime\Jobs\Model\ResourceModel\News');
    }

    public function getEnableStatus() {
        return 1;
    }

    public function getDisableStatus() {
        return 0;
    }

    public function getAvailableStatuses() {
        return [$this->getDisableStatus() => __('Disabled'), $this->getEnableStatus() => __('Enabled')];
    }
}
