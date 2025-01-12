<?php
namespace Maxime\Jobs\Model\Source\News;

class Status implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * @var \Maxime\Jobs\Model\News
     */
    protected $_news;

    /**
     * Constructor
     *
     * @param \Maxime\Jobs\Model\News $job
     */
    public function __construct(\Maxime\Jobs\Model\News $News)
    {
        $this->_news = $News;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options[] = ['label' => '', 'value' => ''];
        $availableOptions = $this->_news->getAvailableStatuses();
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        return $options;
    }
}
