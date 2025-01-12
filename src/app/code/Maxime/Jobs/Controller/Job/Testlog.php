<?php
namespace Maxime\Jobs\Controller\Job;

class Testlog extends \Magento\Framework\App\Action\Action
{
    /**
     * Logger
     *
     * @var LoggerInterface
     */
    protected $_logger;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Psr\Log\LoggerInterface $logger
    )
    {
        $this->_logger = $logger;
        parent::__construct($context);
    }

    public function execute()
    {
        var_dump(get_class($this->_logger));

        $this->_view->loadLayout();
        $this->_view->getLayout()->initMessages();
        $this->_view->renderLayout();
    }
}
