<?php
namespace Maxime\Jobs\Block\Adminhtml\News\Edit;

use \Magento\Backend\Block\Widget\Form\Generic;

class Form extends Generic
{

    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_status;

     /**
     * @var \Maxime\Jobs\Model\News
     */
    protected $_news;

    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_department;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param \Maxime\Jobs\Model\Source\Job\Status $status
     * @param \Maxime\Jobs\Model\Source\Department $department
     * @param \Maxime\Jobs\Model\News $news
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        \Maxime\Jobs\Model\Source\Job\Status $status,
        \Maxime\Jobs\Model\Source\Department $department,
        // \Maxime\Jobs\Model\News $news,
        array $data = []
    ) {
        $this->_systemStore = $systemStore;
        $this->_status = $status;
        $this->_department = $department;
        // $this->_news = $news;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Init form
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('news_form');
        $this->setTitle(__('New Informations'));
    }

    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        /** @var \Maxime\Jobs\Model\Job $model */
        $model = $this->_coreRegistry->registry('jobs_news');


        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(
            ['data' => ['id' => 'edit_form', 'action' => $this->getData('action'), 'method' => 'post']]
        );

        $form->setHtmlIdPrefix('news_');

        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('General Information'), 'class' => 'fieldset-wide']
        );

        if ($model->getId()) {
            $fieldset->addField('entity_id', 'hidden', ['name' => 'entity_id']);
        }

        // Title - Type Text
        $fieldset->addField(
            'title',
            'text',
            ['name' => 'title', 'label' => __('Title'), 'title' => __('Title'), 'required' => true]
        );

        // Status - Dropdown
        if (!$model->getId()) {
            $model->setStatus('1'); // Enable status when adding a Job
        }
        $statuses = $this->_status->toOptionArray();
        $fieldset->addField(
            'status',
            'select',
            ['name' => 'status', 'label' => __('Status'), 'title' => __('Status'), 'required' => true, 'values' => $statuses]
        );

        // Description - Type textarea
        $fieldset->addField(
            'content',
            'textarea',
            ['name' => 'content', 'label' => __('Content'), 'title' => __('Content'), 'required' => true]
        );

        // Department - Dropdown
        $departments = $this->_department->toOptionArray();
        $fieldset->addField(
            'department_id',
            'multiselect',
            ['name' => 'department_id[]', 'label' => __('Department'), 'title' => __('Department'), 'required' => true, 'values' => $departments]
        );

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
