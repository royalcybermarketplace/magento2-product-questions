<?php
/**
 * @category    RoyalCyberMarketplace
 * @package     RoyalCyberMarketplace_ProductQuestions
 * @copyright   Copyright (c) 2022 RoyalCyberMarketplace (https://royalcyber.com/)
 */

namespace RoyalCyberMarketplace\ProductQuestions\Block\Product;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\View\Element\Template;

/**
 * Product Question Tab
 *
 * @author     GiaPhuGroup Ltd. <bestearnmoney87@gmail.com>
 */
class Question extends Template implements IdentityInterface
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $coreRegistry;

    /**
     * Question Collection
     *
     * @var \RoyalCyberMarketplace\ProductQuestions\Model\ResourceModel\Question\CollectionFactory
     */
    protected $questionCollectionFactory;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \RoyalCyberMarketplace\ProductQuestions\Model\ResourceModel\Question\CollectionFactory $collectionFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \RoyalCyberMarketplace\ProductQuestions\Model\ResourceModel\Question\CollectionFactory $collectionFactory,
        array $data = []
    ) {
        $this->coreRegistry = $registry;
        $this->questionCollectionFactory = $collectionFactory;
        parent::__construct($context, $data);

        $this->setTabTitle();
    }

    /**
     * Get current product id
     *
     * @return null|int
     */
    public function getProductId()
    {
        $product = $this->coreRegistry->registry('product');
        return $product ? $product->getId() : null;
    }

    /**
     * Get URL for ajax call
     *
     * @return string
     */
    public function getProductQuestionUrl()
    {
        return $this->getUrl(
            'question/product/listAjax',
            [
                '_secure' => $this->getRequest()->isSecure(),
                'id' => $this->getProductId(),
            ]
        );
    }

    /**
     * Get URL for likes and dislikes
     *
     * @return string
     */
    public function getLikeDislikeUrl()
    {
        return $this->getUrl(
            'question/product/likeDislike',
            [
                '_secure' => $this->getRequest()->isSecure()
            ]
        );
    }

    /**
     * Set tab title
     *
     * @return void
     */
    public function setTabTitle()
    {
        $title = $this->getCollectionSize()
            ? __('Questions %1', '<span class="counter">' . $this->getCollectionSize() . '</span>')
            : __('Questions');
        $this->setTitle($title);
    }

    /**
     * Get size of questions collection
     *
     * @return int
     */
    public function getCollectionSize()
    {
        $collection = $this->questionCollectionFactory->create()->addStoreFilter(
            ['0', $this->_storeManager->getStore()->getId()]
        )->addFieldToFilter(
            'main_table.product_id',
            $this->getProductId()
        )->addStatusFilter(
            \RoyalCyberMarketplace\ProductQuestions\Model\Status::STATUS_APPROVED
        )->addVisibilityFilter(
            \RoyalCyberMarketplace\ProductQuestions\Model\Visibility::VISIBILITY_VISIBLE
        )->addProductIdFilter(
            $this->getProductId()
        );

        return $collection->getSize();
    }

    /**
     * Return unique ID(s) for each object in system
     *
     * @return array
     */
    public function getIdentities()
    {
        return [\RoyalCyberMarketplace\ProductQuestions\Model\Question::CACHE_TAG];
    }
}
