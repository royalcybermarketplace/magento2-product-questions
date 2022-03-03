<?php
/**
 * @category    RoyalCyberMarketplace
 * @package     RoyalCyberMarketplace_ProductQuestions
 * @copyright   Copyright (c) 2022 RoyalCyberMarketplace (https://royalcyber.com/)
 */

namespace RoyalCyberMarketplace\ProductQuestions\Api;

/**
 * Interface AnswerRepositoryInterface
 * @package RoyalCyberMarketplace\ProductQuestions\Api
 */
interface AnswerRepositoryInterface
{
    /**
     * Save Answer.
     *
     * @param \RoyalCyberMarketplace\ProductQuestions\Api\Data\AnswerInterface $answer
     * @return \RoyalCyberMarketplace\ProductQuestions\Api\Data\AnswerInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(\RoyalCyberMarketplace\ProductQuestions\Api\Data\AnswerInterface $answer);

    /**
     * Retrieve answer.
     *
     * @param int $answerId
     * @return \RoyalCyberMarketplace\ProductQuestions\Api\Data\AnswerInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($answerId);

    /**
     * Retrieve answers matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \RoyalCyberMarketplace\ProductQuestions\Api\Data\AnswerSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * Delete answer.
     *
     * @param \RoyalCyberMarketplace\ProductQuestions\Api\Data\AnswerInterface $answer
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(\RoyalCyberMarketplace\ProductQuestions\Api\Data\AnswerInterface $answer);

    /**
     * Delete answer by ID.
     *
     * @param int $answerId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($answerId);
}
