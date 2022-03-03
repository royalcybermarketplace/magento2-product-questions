<?php
/**
 * @category    RoyalCyberMarketplace
 * @package     RoyalCyberMarketplace_ProductQuestions
 * @copyright   Copyright (c) 2022 RoyalCyberMarketplace (https://royalcyber.com/)
 */

namespace RoyalCyberMarketplace\ProductQuestions\Api\Data;

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
     * @return \RoyalCyberMarketplace\ProductQuestions\Api\Data\QuestionInterface[]
     */
    public function getItems();

    /**
     * Set questions list.
     *
     * @param \RoyalCyberMarketplace\ProductQuestions\Api\Data\QuestionInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
