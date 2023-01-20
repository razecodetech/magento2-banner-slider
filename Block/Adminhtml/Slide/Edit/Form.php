<?php

namespace Razecode\Banner\Block\Adminhtml\Slide\Edit;

/**
 * Adminhtml Add New Row Form.
 */
class Form extends \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $systemStore;

    protected $_stores;

    /**
     * @param \Magento\Backend\Block\Template\Context $context,
     * @param \Magento\Framework\Registry $registry,
     * @param \Magento\Framework\Data\FormFactory $formFactory,
     * @param \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
     * @param \Razecode\Banner\Model\Status $options,
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
        \Razecode\Banner\Model\Status $options,
        \Razecode\Banner\Model\System\Config\Source\Stores $stores,
        \Magento\Store\Model\System\Store $systemStore,
        array $data = []
    ) {
        $this->_options = $options;
        $this->_wysiwygConfig = $wysiwygConfig;
        $this->_stores = $stores;
        $this->_systemStore = $systemStore;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form.
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        $dateFormat = $this->_localeDate->getDateFormat(\IntlDateFormatter::SHORT);
        $model = $this->_coreRegistry->registry('row_data');
        $form = $this->_formFactory->create(
            ['data' => [
                        'id' => 'edit_form',
                        'enctype' => 'multipart/form-data',
                        'action' => $this->getData('action'),
                        'method' => 'post'
                    ]
            ]
        );

        $form->setHtmlIdPrefix('razecode_');
        if ($model->getSlideId()) {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Edit Slide'), 'class' => 'fieldset-wide']
            );
            $fieldset->addField('slide_id', 'hidden', ['name' => 'slide_id']);
        } else {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Add Slide Data'), 'class' => 'fieldset-wide']
            );
        }

        $fieldset->addField(
            'title',
            'text',
            [
                'name' => 'title',
                'label' => __('Title'),
                'id' => 'title',
                'title' => __('Title'),
                'class' => 'required-entry',
                'required' => true,
            ]
        );

        $fieldset->addField(
            'link',
            'text',
            [
                'name' => 'link',
                'label' => __('Link'),
                'id' => 'link',
                'title' => __('Link'),
                'required' => false,
            ]
        );

        $fieldset->addField(
            'slide_image_desktop',
            'image',
            [
                'name' => 'slide_image_desktop',
                'label' => __('Upload Desktop Image'),
                'id' => __('slide_image_desktop'),
                'title' => __('Upload Desktop Image'),
                'required' => false,
                'class' => 'admin__control-image',
                'note' => __('Preferred Size: 1220px x 407px, Allowed File Types : (JPG,JPEG,PNG),
                Preferred Image Type : Use Progressive JPEG Image.
                Note: Upload Optimised Image (Use online tool - https://tinyjpg.com/)')
            ]
        );

        $fieldset->addField(
            'slide_image_tablet',
            'image',
            [
                'name' => 'slide_image_tablet',
                'label' => __('Upload Tablet Image'),
                'id' => __('slide_image_tablet'),
                'title' => __('Upload Tablet Image'),
                'required' => false,
                'class' => 'admin__control-image',
                'note' => __('Preferred Size: 1024px x 400px, Allowed File Types : (JPG,JPEG,PNG),
                Preferred Image Type : Use Progressive JPEG Image.
                Note: Upload Optimised Image (Use online tool - https://tinyjpg.com/)')
            ]
        );

        $fieldset->addField(
            'slide_image_mobile',
            'image',
            [
                'name' => 'slide_image_mobile',
                'label' => __('Upload Mobile Image'),
                'id' => __('slide_image_mobile'),
                'title' => __('Upload Mobile Image'),
                'required' => false,
                'class' => 'admin__control-image',
                'note' => __('Preferred Size: 750px x 500px, Allowed File Types : (JPG,JPEG,PNG),
                Preferred Image Type : Use Progressive JPEG Image.
                Note: Upload Optimised Image (Use online tool - https://tinyjpg.com/)')
            ]
        );

        $fieldset->addField(
            'video',
            'text',
            [
                'name' => 'video',
                'label' => __('Add Video ID'),
                'id' => __('video'),
                'title' => __('Add Video ID'),
                'required' => false
            ]
        );

         /**
         * Check is single store mode
         */
        if (!$this->_storeManager->isSingleStoreMode()) {
            $storeField = $fieldset->addField(
                'store_id',
                'multiselect',
                [
                    'name' => 'stores[]',
                    'label' => __('Store View'),
                    'title' => __('Store View'),
                    'required' => true,
                    'values' => $this->_systemStore->getStoreValuesForForm(false, true)
                ]
            );
            $renderer = $this->getLayout()->createBlock(
                \Magento\Backend\Block\Store\Switcher\Form\Renderer\Fieldset\Element::class
            );
            $storeField->setRenderer($renderer);
        } else {
            $storeField = $fieldset->addField(
                'store_id',
                'hidden',
                ['name' => 'stores[]', 'value' => $this->_storeManager->getStore(true)->getId()]
            );
            $model->setStoreId($this->_storeManager->getStore(true)->getId());
        }

        $fieldset->addField(
            'is_active',
            'select',
            [
                'name' => 'is_active',
                'label' => __('Status'),
                'id' => 'is_active',
                'title' => __('Status'),
                'values' => $this->_options->getOptionArray(),
                'class' => 'status',
                'required' => true,
            ]
        );

        $fieldset->addField(
            'sort_order',
            'text',
            [
                'name' => 'sort_order',
                'label' => __('Sort Order'),
                'id' => __('sort_order'),
                'title' => __('Sort Order'),
                'required' => false
            ]
        );

        $fieldset->addField(
            'content',
            'editor',
            [
                'name' => 'content',
                'label' => __('Content'),
                'id' => __('content'),
                'title' => __('Content'),
                'required' => false,
                'style' => 'height:10em',
                'config' => $this->_wysiwygConfig->getConfig()
            ]
        );

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
