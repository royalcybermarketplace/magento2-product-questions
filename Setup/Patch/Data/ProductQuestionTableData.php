<?php
/**
 * @category    RoyalCyberMarketplace
 * @copyright   Copyright (c) 2022 RoyalCyberMarketplace (https://royalcyber.com/)
 */

namespace RoyalCyberMarketplace\ProductQuestions\Setup\Patch\Data;

use Amasty\Label\Model\ResourceModel\Label;
use Amasty\Label\Setup\Model\DeployExamples;
use Amasty\Label\Setup\Model\DeployExamplesFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Zend_Db_Expr;

class ProductQuestionTableData implements DataPatchInterface
{
    /**
     * Product Questions Status Table
     *
     * @var string
     */
    const RCM_PQ_STATUS = 'royalcybermarketplace_product_questions_status';

    /**
     * Product Questions Visibility Table
     *
     * @var string
     */
    const RCM_PQ_VIS = 'royalcybermarketplace_product_questions_visibility';

    /**
     * Product Questions User Type Table
     *
     * @var string
     */
    const RCM_PQ_UT = 'royalcybermarketplace_product_questions_user_type';

    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;
    
    /**
     * QuestionPoliciesCmsPage constructor.
     * @param ModuleDataSetupInterface $moduleDataSetup
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
    }

    public function apply()
    {
        $this->moduleDataSetup->startSetup();
        $setup = $this->moduleDataSetup;

        //Fill table royalcybermarketplace_product_questions_status
        $questionAnswerStatuses = [
            \RoyalCyberMarketplace\ProductQuestions\Model\Status::STATUS_APPROVED => 'Approved',
            \RoyalCyberMarketplace\ProductQuestions\Model\Status::STATUS_PENDING => 'Pending',
            \RoyalCyberMarketplace\ProductQuestions\Model\Status::STATUS_NOT_APPROVED => 'Not Approved'
        ];
        foreach ($questionAnswerStatuses as $k => $v) {
            $bind = ['status_id' => $k, 'status_code' => $v];
            $setup->getConnection()->insertOnDuplicate($setup->getTable(self::RCM_PQ_STATUS), $bind);
        }

        //Fill table royalcybermarketplace_product_questions_visibility
        $questionAnswerStatuses = [
            \RoyalCyberMarketplace\ProductQuestions\Model\Visibility::VISIBILITY_NOT_VISIBLE => 'Not visible',
            \RoyalCyberMarketplace\ProductQuestions\Model\Visibility::VISIBILITY_VISIBLE => 'Visible'
        ];
        foreach ($questionAnswerStatuses as $k => $v) {
            $bind = ['visibility_id' => $k, 'visibility_code' => $v];
            $setup->getConnection()->insertOnDuplicate($setup->getTable(self::RCM_PQ_VIS), $bind);
        }

        //Fill table royalcybermarketplace_product_questions_user_type
        $questionAnswerStatuses = [
            \RoyalCyberMarketplace\ProductQuestions\Model\UserType::USER_TYPE_GUEST => 'Guest',
            \RoyalCyberMarketplace\ProductQuestions\Model\UserType::USER_TYPE_CUSTOMER => 'Customer',
            \RoyalCyberMarketplace\ProductQuestions\Model\UserType::USER_TYPE_ADMINISTRATOR => 'Administrator'
        ];
        foreach ($questionAnswerStatuses as $k => $v) {
            $bind = ['user_type_id' => $k, 'user_type_code' => $v];
            $setup->getConnection()->insertOnDuplicate($setup->getTable(self::RCM_PQ_UT), $bind);
        }
    
        $this->moduleDataSetup->endSetup();
    }

    /**
     * @inheritdoc
     */
    public function getAliases()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public static function getDependencies()
    {
        return [];
    }
}
