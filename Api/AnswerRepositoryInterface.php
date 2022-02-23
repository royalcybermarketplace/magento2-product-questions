<?php
/**
 * @category    RoyalCyber
 * @package     RoyalCyber_ProductQuestions
 * @copyright   Copyright (c) 2022 RoyalCyber (https://royalcyber.com/)
 */

namespace RoyalCyber\ProductQuestions\Api;

/**
 * Interface AnswerRepositoryInterface
 * @package RoyalCyber\ProductQuestions\Api
 */
interface AnswerRepositoryInterface
{
    /**
     * Save Answer.
     *
     * @param \RoyalCyber\ProductQuestions\Api\Data\AnswerInterface $answer
     * @return \RoyalCyber\ProductQuestions\Api\Data\AnswerInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(\RoyalCyber\ProductQuestions\Api\Data\AnswerInterface $answer);

    /**
     * Retrieve answer.
     *
     * @param int $answerId
     * @return \RoyalCyber\ProductQuestions\Api\Data\AnswerInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($answerId);

    /**
     * Retrieve answers matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \RoyalCyber\ProductQuestions\Api\Data\AnswerSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * Delete answer.
     *
     * @param \RoyalCyber\ProductQuestions\Api\Data\AnswerInterface $answer
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(\RoyalCyber\ProductQuestions\Api\Data\AnswerInterface $answer);

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
