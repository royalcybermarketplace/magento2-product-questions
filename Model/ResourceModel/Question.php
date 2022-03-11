<?php
/**
 * @category    RoyalCyberMarketplace
 * @copyright   Copyright (c) 2022 RoyalCyberMarketplace (https://royalcyber.com/)
 */

namespace RoyalCyberMarketplace\ProductQuestions\Model\ResourceModel;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class Question
 */
class Question extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Product Questions Store
     *
     * @var string
     */
    const RCM_PQST = 'royalcybermarketplace_product_questions_store';

    /**
     * Product Questions Sharing
     *
     * @var string
     */
    const RCM_PQSH = 'royalcybermarketplace_product_questions_sharing';

    /**
     * ValidationRules
     *
     * @var \RoyalCyberMarketplace\ProductQuestions\Model\ValidationRules
     */
    protected $validationRules;

    /**
     * @var \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory
     */
    protected $productCollectionFactory;

    /**
     * Escaper
     *
     * @var \Magento\Framework\Escaper
     */
    protected $escaper;

    /**
     * @var \Magento\Catalog\Model\Product\Attribute\Source\Status
     */
    protected $productStatus;

    /**
     * @var \Magento\Catalog\Model\Product\Visibility
     */
    protected $productVisibility;

    /**
     * @param \Magento\Framework\Model\ResourceModel\Db\Context $context
     * @param \RoyalCyberMarketplace\ProductQuestions\Model\ValidationRules $validationRules
     * @param \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory
     * @param \Magento\Catalog\Model\Product\Attribute\Source\Status $productStatus
     * @param \Magento\Catalog\Model\Product\Visibility $productVisibility
     * @param \Magento\Framework\Escaper $escaper
     */
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context,
        \RoyalCyberMarketplace\ProductQuestions\Model\ValidationRules $validationRules,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Magento\Catalog\Model\Product\Attribute\Source\Status $productStatus,
        \Magento\Catalog\Model\Product\Visibility $productVisibility,
        \Magento\Framework\Escaper $escaper
    ) {
        $this->validationRules = $validationRules;
        $this->productCollectionFactory = $productCollectionFactory;
        $this->productStatus = $productStatus;
        $this->productVisibility = $productVisibility;
        $this->escaper = $escaper;
        parent::__construct($context);
    }

    /**
     * construct
     * @return void
     */
    protected function _construct()
    {
        $this->_init('royalcybermarketplace_product_questions', 'question_id');
    }

    /**
     * After save callback
     *
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return parent
     */
    protected function _afterSave(AbstractModel $object)
    {
        $this->saveQuestionStore($object);
        return parent::_afterSave($object);
    }

    /**
     * Save the question_id and store_id in the table royalcybermarketplace_product_questions_store
     *
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return $this
     */
    protected function saveQuestionStore(AbstractModel $object)
    {
        $questionId = (int) $object->getData('question_id');
        $storeIds = (array) $object->getData('store_ids');

        if (empty($storeIds)) {
            $storeIds = [\Magento\Store\Model\Store::DEFAULT_STORE_ID];
        }

        if ($questionId) {
            $adapter = $this->getConnection();
            $adapter->delete($this->getTable(self::RCM_PQST), ['question_id =?' => $questionId]);
            foreach ($storeIds as $storeId) {
                $data = [
                    'question_id' => $questionId,
                    'store_view_id' => $storeId
                ];
                $adapter->insertMultiple($this->getTable(self::RCM_PQST), $data);
            }
        }

        return $this;
    }

    /**
     * Save the question_id and product_id in the table royalcybermarketplace_product_questions_sharing
     *
     * @param int $questionId
     * @param array $productIds
     * @return $this
     */
    public function saveProductIdToQuestionSharing($questionId = null, $productIds = [])
    {
        if ($questionId) {
            $adapter = $this->getConnection();
            $adapter->delete($this->getTable(self::RCM_PQSH), ['question_id =?' => $questionId]);
            foreach ($productIds as $productId) {
                if (!empty($productId)) {
                    $data = [
                        'question_id' => $questionId,
                        'product_id' => $productId
                    ];
                    $adapter->insertOnDuplicate($this->getTable(self::RCM_PQSH), $data);
                }
            }
        }

        return $this;
    }

    /**
     * Get the products were shared the question
     *
     * @param int $questionId
     * @return array
     */
    public function getProductsWereSharedQuestion($questionId)
    {
        if ($questionId) {
            $question = $this->getConnection()
                ->select()
                ->from($this->getTable('royalcybermarketplace_product_questions'), ['product_id'])
                ->where('question_id = :question_id');
            $productPkValue = $this->getConnection()->fetchCol($question, [':question_id' => $questionId]);
            $productId = 0;
            if (!empty($productPkValue)) {
                $productId = (int) $productPkValue[0];
            }
            $collection = $this->productCollectionFactory->create()
                ->addAttributeToSelect('*')
                ->addAttributeToFilter('status', ['in' => $this->productStatus->getVisibleStatusIds()])
                ->addAttributeToFilter('visibility', ['in' => $this->productVisibility->getVisibleInSiteIds()])
                ->addFieldToFilter('entity_id', ['neq' => $productId])
                ->joinField(
                    'product_id',
                    self::RCM_PQSH,
                    'product_id',
                    'product_id=entity_id',
                    'question_id='.$questionId,
                    'right'
                )->getData();

            $productIds = [];
            foreach ($collection as $result) {
                $productIds[] = $result['product_id'];
            }
            return $productIds;
        }
        return [];
    }

    /**
     * Update the question(s) visibility
     *
     * @param array $questionIds
     * @param int $visibility
     * @param string $column
     * @return void
     */
    public function massUpdateVisibility($questionIds, $visibility, $column = 'question_visibility_id')
    {
        if (!empty($visibility)) {
            $adapter = $this->getConnection();
            foreach ($questionIds as $questionId) {
                $adapter->update(
                    $this->getMainTable(),
                    [$column => (int) $visibility],
                    ['question_id = ?' => (int) $questionId]
                );
            }
        }
    }

    /**
     * Update the question(s) status
     *
     * @param array $questionIds
     * @param int $statusCode
     * @return void
     */
    public function massUpdateStatus($questionIds, $statusCode)
    {
        $this->massUpdateVisibility($questionIds, $statusCode, 'question_status_id');
    }

    /**
     * Before save callback
     *
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return parent
     */
    protected function _beforeSave(AbstractModel $object)
    {
        $this->validateInputs($object);

        $this->cleanInputs($object);

        return parent::_beforeSave($object);
    }

    /**
     * Clean inputs
     *
     * @param AbstractModel $object
     * @return this
     */
    protected function cleanInputs(AbstractModel $object)
    {
        $object->setQuestionDetail(trim(strip_tags($object->getQuestionDetail())));
        $object->setQuestionAuthorName(trim($object->getQuestionAuthorName()));
        return $this;
    }

    /**
     * validate Values input
     *
     * @param AbstractModel $object
     * @return $this
     * @throws LocalizedException
     */
    protected function validateInputs(AbstractModel $object)
    {
        $this->validationRules->validateEmptyValue($object->getQuestionDetail(), 'Content of Question');
        $this->validationRules->validateEmptyValue($object->getQuestionAuthorName(), 'Author Name');
        $this->validationRules->validateEmptyValue($object->getProductId(), 'Product ID');
        $this->validationRules->validateEmail($object->getQuestionAuthorEmail(), 'Author Email');
        $this->validationRules->validateVisibility($object->getQuestionVisibilityId());
        $this->validationRules->validateStatus($object->getQuestionStatusId());
        $this->validationRules->validateIntegerNumber($object->getQuestionLikes(), 'Total number of likes');
        $this->validationRules->validateIntegerNumber($object->getQuestionDislikes(), 'Total number of dislikes');

        return $this;
    }

    /**
     * Method to run after load
     *
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return parent
     */
    protected function _afterLoad(AbstractModel $object)
    {
        $questionStore = $this->getConnection()
            ->select()
            ->from($this->getTable(self::RCM_PQST), ['store_view_id'])
            ->where('question_id = :question_id');

        $stores = $this->getConnection()->fetchCol($questionStore, [':question_id' => $object->getQuestionId()]);

        if ($stores) {
            $object->setData('store_ids', $stores);
        }

        return parent::_afterLoad($object);
    }
}
