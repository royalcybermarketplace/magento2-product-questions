<?php
/**
 * @category    RoyalCyberMarketplace
 * @copyright   Copyright (c) 2022 RoyalCyberMarketplace (https://royalcyber.com/)
 */

namespace RoyalCyberMarketplace\ProductQuestions\Api\Data;

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
     * @return \RoyalCyberMarketplace\ProductQuestions\Api\Data\AnswerInterface[]
     */
    public function getItems();

    /**
     * Set answers list.
     *
     * @param \RoyalCyberMarketplace\ProductQuestions\Api\Data\AnswerInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
