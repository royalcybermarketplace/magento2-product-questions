<?php
/**
 * @category    RoyalCyber
 * @package     RoyalCyber_ProductQuestions
 * @copyright   Copyright (c) 2022 RoyalCyber (https://royalcyber.com/)
 */

namespace RoyalCyber\ProductQuestions\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface for product question search results.
 * @api
 * @since 100.0.2
 */
interface QuestionSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get questions list.
     *
     * @return \RoyalCyber\ProductQuestions\Api\Data\QuestionInterface[]
     */
    public function getItems();

    /**
     * Set questions list.
     *
     * @param \RoyalCyber\ProductQuestions\Api\Data\QuestionInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
