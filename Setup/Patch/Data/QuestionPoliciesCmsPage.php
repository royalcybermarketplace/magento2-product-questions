<?php
/**
 * @category    RoyalCyberMarketplace
 * @copyright   Copyright (c) 2022 RoyalCyberMarketplace (https://royalcyber.com/)
 */

namespace RoyalCyberMarketplace\ProductQuestions\Setup\Patch\Data;

use Magento\Cms\Model\PageFactory;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class QuestionPoliciesCmsPage implements DataPatchInterface
{
    /**
     * ModuleDataSetupInterface
     *
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @var PageFactory
     */
    private $pageFactory;
    
    /**
     * QuestionPoliciesCmsPage constructor.
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param PageFactory $pageFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        PageFactory $pageFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->pageFactory = $pageFactory;
    }

    public function apply()
    {
        $this->moduleDataSetup->startSetup();
        //add the product question policies page
        $identifier = 'product-question-policies';
        $content = '<p>We will update the rules for the question of products soon.</p>';
        $page = $this->pageFactory->create();
        $page->setTitle('Product Question Policies')
            ->setIdentifier($identifier)
            ->setIsActive(true)
            ->setMetaKeywords('Product Question Policies')
            ->setMetaDescription('Product Question Policies')
            ->setContentHeading('Product Question Policies')
            ->setPageLayout('1column')
            ->setStores([\Magento\Store\Model\Store::DEFAULT_STORE_ID])
            ->setContent($content)
            ->save();
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
