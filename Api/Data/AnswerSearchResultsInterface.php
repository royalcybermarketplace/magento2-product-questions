<?php
/**
 * @category    RoyalCyber
 * @package     RoyalCyber_ProductQuestions
 * @copyright   Copyright (c) 2022 RoyalCyber (https://royalcyber.com/)
 */

namespace RoyalCyber\ProductQuestions\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface for product answer search results.
 * @api
 * @since 100.0.2
 */
interface AnswerSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get answers list.
     *
     * @return \RoyalCyber\ProductQuestions\Api\Data\AnswerInterface[]
     */
    public function getItems();

    /**
     * Set answers list.
     *
     * @param \RoyalCyber\ProductQuestions\Api\Data\AnswerInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
