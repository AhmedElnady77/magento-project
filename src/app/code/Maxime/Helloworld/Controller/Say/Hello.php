<?php
namespace Maxime\Helloworld\Controller\Say;
class Hello extends \Magento\Framework\App\Action\Action
{
    public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->getLayout();
        $this->_view->renderLayout();
    }
}
