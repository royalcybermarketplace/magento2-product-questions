<?php
/**
 * @category    RoyalCyber
 * @package     RoyalCyber_ProductQuestions
 * @copyright   Copyright (c) 2022 RoyalCyber (https://royalcyber.com/)
 */

namespace RoyalCyber\ProductQuestions\Model\ResourceModel\Answer;

/**
 * Class Collection
 * @package RoyalCyber\ProductQuestions\Model\ResourceModel\Answer
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'answer_id';

    /**
     * Event prefix
     *
     * @var string
     */
    protected $_eventPrefix = 'royalcyber_product_answer_collection';

    /**
     * Event object
     *
     * @var string
     */
    protected $_eventObject = 'product_answer_collection';

    /**
     * Define resource model.
     */
    protected function _construct()
    {
        $this->_init(
            \RoyalCyber\ProductQuestions\Model\Answer::class,
            \RoyalCyber\ProductQuestions\Model\ResourceModel\Answer::class
        );
    }

    /**
     * Add status filter
     *
     * @param int $status
     * @return $this
     */
    public function addStatusFilter($status)
    {
        $this->addFilter(
            'answer_status_id',
            $this->getConnection()->quoteInto('main_table.answer_status_id=?', $status),
            'string'
        );
        return $this;
    }

    /**
     * Add visibility filter
     *
     * @param int $visibility
     * @return $this
     */
    public function addVisibilityFilter($visibility)
    {
        $this->addFilter(
            'answer_visibility_id',
            $this->getConnection()->quoteInto('main_table.answer_visibility_id=?', $visibility),
            'string'
        );
        return $this;
    }
}
