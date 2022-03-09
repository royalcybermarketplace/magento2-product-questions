<?php
/**
 * @category    RoyalCyberMarketplace
 * @copyright   Copyright (c) 2022 RoyalCyberMarketplace (https://royalcyber.com/)
 */

namespace RoyalCyberMarketplace\ProductQuestions\Api;

/**
 * Interface QuestionRepositoryInterface
 */
interface QuestionRepositoryInterface
{
    /**
     * Save Question.
     *
     * @param \RoyalCyberMarketplace\ProductQuestions\Api\Data\QuestionInterface $question
     * @return \RoyalCyberMarketplace\ProductQuestions\Api\Data\QuestionInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(\RoyalCyberMarketplace\ProductQuestions\Api\Data\QuestionInterface $question);

    /**
     * Retrieve question.
     *
     * @param int $questionId
     * @return \RoyalCyberMarketplace\ProductQuestions\Api\Data\QuestionInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($questionId);

    /**
     * Retrieve questions matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \RoyalCyberMarketplace\ProductQuestions\Api\Data\QuestionSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * Delete question.
     *
     * @param \RoyalCyberMarketplace\ProductQuestions\Api\Data\QuestionInterface $question
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(\RoyalCyberMarketplace\ProductQuestions\Api\Data\QuestionInterface $question);

    /**
     * Delete question by ID.
     *
     * @param int $questionId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($questionId);
}
