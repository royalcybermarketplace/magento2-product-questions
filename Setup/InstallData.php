<?php
/**
 * @category    RoyalCyberMarketplace
 * @package     RoyalCyberMarketplace_ProductQuestions
 * @copyright   Copyright (c) 2022 RoyalCyberMarketplace (https://royalcyber.com/)
 */

namespace RoyalCyberMarketplace\ProductQuestions\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallData implements InstallDataInterface
{
    /**
     * @var \Magento\Cms\Model\PageFactory
     */
    protected $pageFactory;

    /**
     * @param \Magento\Cms\Model\PageFactory $pageFactory
     */
    public function __construct(
        \Magento\Cms\Model\PageFactory $pageFactory
    ) {
        $this->pageFactory = $pageFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        //Fill table royalcybermarketplace_product_questions_status
        $questionAnswerStatuses = [
            \RoyalCyberMarketplace\ProductQuestions\Model\Status::STATUS_APPROVED => 'Approved',
            \RoyalCyberMarketplace\ProductQuestions\Model\Status::STATUS_PENDING => 'Pending',
            \RoyalCyberMarketplace\ProductQuestions\Model\Status::STATUS_NOT_APPROVED => 'Not Approved'
        ];
        foreach ($questionAnswerStatuses as $k => $v) {
            $bind = ['status_id' => $k, 'status_code' => $v];
            $installer->getConnection()->insertOnDuplicate($installer->getTable('royalcybermarketplace_product_questions_status'), $bind);
        }

        //Fill table royalcybermarketplace_product_questions_visibility
        $questionAnswerStatuses = [
            \RoyalCyberMarketplace\ProductQuestions\Model\Visibility::VISIBILITY_NOT_VISIBLE => 'Not visible',
            \RoyalCyberMarketplace\ProductQuestions\Model\Visibility::VISIBILITY_VISIBLE => 'Visible'
        ];
        foreach ($questionAnswerStatuses as $k => $v) {
            $bind = ['visibility_id' => $k, 'visibility_code' => $v];
            $installer->getConnection()->insertOnDuplicate($installer->getTable('royalcybermarketplace_product_questions_visibility'), $bind);
        }

        //Fill table royalcybermarketplace_product_questions_user_type
        $questionAnswerStatuses = [
            \RoyalCyberMarketplace\ProductQuestions\Model\UserType::USER_TYPE_GUEST => 'Guest',
            \RoyalCyberMarketplace\ProductQuestions\Model\UserType::USER_TYPE_CUSTOMER => 'Customer',
            \RoyalCyberMarketplace\ProductQuestions\Model\UserType::USER_TYPE_ADMINISTRATOR => 'Administrator'
        ];
        foreach ($questionAnswerStatuses as $k => $v) {
            $bind = ['user_type_id' => $k, 'user_type_code' => $v];
            $installer->getConnection()->insertOnDuplicate($installer->getTable('royalcybermarketplace_product_questions_user_type'), $bind);
        }

        //add the product question policies page
        $this->pageFactory->create()
            ->load('product-question-policies', 'identifier')
            ->addData(
                [
                    'title' => 'Product Question Policies',
                    'page_layout' => '1column',
                    'meta_keywords' => 'Product Question Policies',
                    'meta_description' => 'Product Question Policies',
                    'identifier' => 'product-question-policies',
                    'content_heading' => 'Product Question Policies',
                    'content' => 'We will update the rules for the question of products soon.'
                ]
            )->setStores(
                [\Magento\Store\Model\Store::DEFAULT_STORE_ID]
            )->save();
    }
}
