<?php
/**
 * @category    RoyalCyber
 * @package     RoyalCyber_ProductQuestions
 * @copyright   Copyright (c) 2022 RoyalCyber (https://royalcyber.com/)
 */

namespace RoyalCyber\ProductQuestions\Api\Data;

/**
 * Interface QuestionInterface
 * @api
 * @since 100.0.2
 */
interface QuestionInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const QUESTION_ID            = 'question_id';
    const QUESTION_DETAIL        = 'question_detail';
    const QUESTION_AUTHOR_NAME   = 'question_author_name';
    const QUESTION_AUTHOR_EMAIL  = 'question_author_email';
    const QUESTION_STATUS_ID     = 'question_status_id';
    const QUESTION_USER_TYPE_ID  = 'question_user_type_id';
    const CUSTOMER_ID            = 'customer_id';
    const QUESTION_VISIBILITY_ID = 'question_visibility_id';
    const QUESTION_STORE_ID      = 'question_store_id';
    const QUESTION_LIKES         = 'question_likes';
    const QUESTION_DISLIKES      = 'question_dislikes';
    const TOTAL_ANSWERS          = 'total_answers';
    const PENDING_ANSWERS        = 'pending_answers';
    const PRODUCT_ID             = 'product_id';
    const QUESTION_CREATED_BY    = 'question_created_by';
    const QUESTION_CREATED_AT    = 'question_created_at';
    /**#@-*/

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get question detail
     *
     * @return string
     */
    public function getQuestionDetail();

    /**
     * Get question author name
     *
     * @return string
     */
    public function getQuestionAuthorName();

    /**
     * Get question author email
     *
     * @return string
     */
    public function getQuestionAuthorEmail();

    /**
     * Get question status id
     *
     * @return int
     */
    public function getQuestionStatusId();

    /**
     * Get question user type id
     *
     * @return int
     */
    public function getQuestionUserTypeId();

    /**
     * Get customer id
     *
     * @return string|null
     */
    public function getCustomerId();

    /**
     * Get question visibility id
     *
     * @return int
     */
    public function getQuestionVisibilityId();

    /**
     * Get question store id
     *
     * @return int
     */
    public function getQuestionStoreId();

    /**
     * Get question likes
     *
     * @return int
     */
    public function getQuestionLikes();

    /**
     * Get question dislikes
     *
     * @return int
     */
    public function getQuestionDislikes();

    /**
     * Get total answers
     *
     * @return int
     */
    public function getTotalAnswers();

    /**
     * Get pending answers
     *
     * @return int
     */
    public function getPendingAnswers();

    /**
     * Get product id
     *
     * @return int
     */
    public function getProductId();

    /**
     * Get question created by
     *
     * @return int
     */
    public function getQuestionCreatedBy();

    /**
     * Get question created at
     *
     * @return string
     */
    public function getQuestionCreatedAt();

    /**
     * Set ID
     *
     * @param int $id
     * @return \RoyalCyber\ProductQuestions\Api\Data\QuestionInterface
     */
    public function setId($id);

    /**
     * Set question detail
     *
     * @param string $questionDetail
     * @return \RoyalCyber\ProductQuestions\Api\Data\QuestionInterface
     */
    public function setQuestionDetail($questionDetail);

    /**
     * Set question author name
     *
     * @param string $questionAuthorName
     * @return \RoyalCyber\ProductQuestions\Api\Data\QuestionInterface
     */
    public function setQuestionAuthorName($questionAuthorName);

    /**
     * Set question author email
     *
     * @param string $questionAuthorEmail
     * @return \RoyalCyber\ProductQuestions\Api\Data\QuestionInterface
     */
    public function setQuestionAuthorEmail($questionAuthorEmail);

    /**
     * Set question status id
     *
     * @param int $questionStatusId
     * @return \RoyalCyber\ProductQuestions\Api\Data\QuestionInterface
     */
    public function setQuestionStatusId($questionStatusId);

    /**
     * Set question user type id
     *
     * @param int $questionUserTypeId
     * @return \RoyalCyber\ProductQuestions\Api\Data\QuestionInterface
     */
    public function setQuestionUserTypeId($questionUserTypeId);

    /**
     * Set customer id
     *
     * @param int|null $customerId
     * @return \RoyalCyber\ProductQuestions\Api\Data\QuestionInterface
     */
    public function setCustomerId($customerId);

    /**
     * Set question visibility id
     *
     * @param int $questionVisibilityId
     * @return \RoyalCyber\ProductQuestions\Api\Data\QuestionInterface
     */
    public function setQuestionVisibilityId($questionVisibilityId);

    /**
     * Set question store id
     *
     * @param int $questionStoreId
     * @return \RoyalCyber\ProductQuestions\Api\Data\QuestionInterface
     */
    public function setQuestionStoreId($questionStoreId);

    /**
     * Set question likes
     *
     * @param int $questionLikes
     * @return \RoyalCyber\ProductQuestions\Api\Data\QuestionInterface
     */
    public function setQuestionLikes($questionLikes);

    /**
     * Set question dislike
     *
     * @param int $questionDislikes
     * @return \RoyalCyber\ProductQuestions\Api\Data\QuestionInterface
     */
    public function setQuestionDislikes($questionDislikes);

    /**
     * Set total answers
     *
     * @param int $totalAnswers
     * @return \RoyalCyber\ProductQuestions\Api\Data\QuestionInterface
     */
    public function setTotalAnswers($totalAnswers);

    /**
     * Set pending answers
     *
     * @param int $pendingAnswers
     * @return \RoyalCyber\ProductQuestions\Api\Data\QuestionInterface
     */
    public function setPendingAnswers($pendingAnswers);

    /**
     * Set product id
     *
     * @param int $productId
     * @return \RoyalCyber\ProductQuestions\Api\Data\QuestionInterface
     */
    public function setProductId($productId);

    /**
     * Set question created by
     *
     * @param int $questionCreatedBy
     * @return \RoyalCyber\ProductQuestions\Api\Data\QuestionInterface
     */
    public function setQuestionCreatedBy($questionCreatedBy);

    /**
     * Set question created at
     *
     * @param string $questionCreatedAt
     * @return \RoyalCyber\ProductQuestions\Api\Data\QuestionInterface
     */
    public function setQuestionCreatedAt($questionCreatedAt);
}
