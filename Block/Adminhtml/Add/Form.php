<?php
/**
 * @category    RoyalCyberMarketplace
 * @package     RoyalCyberMarketplace_ProductQuestions
 * @copyright   Copyright (c) 2022 RoyalCyberMarketplace (https://royalcyber.com/)
 */

namespace RoyalCyberMarketplace\ProductQuestions\Block\Adminhtml\Add;

/**
 * Adminhtml add product question form
 *
 * @author   Magento RoyalCyberMarketplace Team <royalcybermarketplace@gmail.com>
 */
class Form extends \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * Question statuses
     *
     * @var \RoyalCyberMarketplace\ProductQuestions\Model\Status
     */
    protected $_questionStatus = null;

    /**
     * Question User types
     *
     * @var \RoyalCyberMarketplace\ProductQuestions\Model\UserType
     */
    protected $_questionUserType = null;

    /**
     * Question User types
     *
     * @var \RoyalCyberMarketplace\ProductQuestions\Model\Visibility
     */
    protected $_questionVisibility = null;

    /**
     * Core system store model
     *
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param \RoyalCyberMarketplace\ProductQuestions\Model\Status $questionStatus,
     * @param \RoyalCyberMarketplace\ProductQuestions\Model\UserType $questionUserType
     * @param \RoyalCyberMarketplace\ProductQuestions\Model\Visibility $questionVisibility
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        \RoyalCyberMarketplace\ProductQuestions\Model\Status $questionStatus,
        \RoyalCyberMarketplace\ProductQuestions\Model\UserType $questionUserType,
        \RoyalCyberMarketplace\ProductQuestions\Model\Visibility $questionVisibility,
        array $data = []
    ) {
        $this->_questionStatus = $questionStatus;
        $this->_questionUserType = $questionUserType;
        $this->_questionVisibility = $questionVisibility;
        $this->_systemStore = $systemStore;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare add product question form
     *
     * @return void
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareForm()
    {
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        $fieldset = $form->addFieldset('add_product_questions_form', ['legend' => __('Question Details')]);

        $fieldset->addField('product_name', 'note', ['label' => __('Product'), 'text' => 'product_name']);

        $fieldset->addField(
            'question_status_id',
            'select',
            [
                'label' => __('Status'),
                'required' => true,
                'name' => 'question_status_id',
                'values' => $this->_questionStatus->getOptionValues()
            ]
        );

        /**
         * Check is single store mode
         */
        if (!$this->_storeManager->isSingleStoreMode()) {
            $field = $fieldset->addField(
                'question_store_id',
                'select',
                [
                    'label' => __('Store'),
                    'required' => true,
                    'name' => 'question_store_id',
                    'values' => $this->_systemStore->getStoreValuesForForm()
                ]
            );
            $renderer = $this->getLayout()->createBlock(
                \Magento\Backend\Block\Store\Switcher\Form\Renderer\Fieldset\Element::class
            );
            $field->setRenderer($renderer);
        }

        $fieldset->addField(
            'question_user_type_id',
            'select',
            [
                'label' => __('User type'),
                'required' => true,
                'name' => 'question_user_type_id',
                'values' => $this->_questionUserType->getOptionValues()
            ]
        );

        $fieldset->addField(
            'question_visibility_id',
            'select',
            [
                'label' => __('Visibility'),
                'required' => true,
                'name' => 'question_visibility_id',
                'values' => $this->_questionVisibility->getOptionValues()
            ]
        );

        $fieldset->addField(
            'question_detail',
            'text',
            [
                'name' => 'question_detail',
                'title' => __('Question'),
                'label' => __('Question'),
                'maxlength' => '150',
                'required' => true
            ]
        );

        $fieldset->addField(
            'question_author_name',
            'text',
            [
                'name' => 'question_author_name',
                'title' => __('Author name'),
                'label' => __('Author name'),
                'maxlength' => '30',
                'required' => true
            ]
        );

        $fieldset->addField(
            'question_author_email',
            'text',
            [
                'name' => 'question_author_email',
                'title' => __('Author email'),
                'label' => __('Author email'),
                'maxlength' => '30',
                'required' => true
            ]
        );

        $fieldset->addField(
            'question_likes',
            'text',
            [
                'name' => 'question_likes',
                'title' => __('Likes'),
                'label' => __('Likes'),
                'maxlength' => '10',
                'required' => false
            ]
        );

        $fieldset->addField(
            'question_dislikes',
            'text',
            [
                'name' => 'question_dislikes',
                'title' => __('Dislikes'),
                'label' => __('Dislikes'),
                'maxlength' => '10',
                'required' => false
            ]
        );

        $fieldset->addField('product_id', 'hidden', ['name' => 'product_id']);

        $form->setMethod('post');
        $form->setUseContainer(true);
        $form->setId('edit_form');
        $form->setAction($this->getUrl('product_questions/question/post'));

        $this->setForm($form);
    }
}
