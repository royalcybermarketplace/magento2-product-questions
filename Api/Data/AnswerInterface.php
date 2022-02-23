<?php
/**
 * @category    RoyalCyber
 * @package     RoyalCyber_ProductQuestions
 * @copyright   Copyright (c) 2022 RoyalCyber (https://royalcyber.com/)
 */

namespace RoyalCyber\ProductQuestions\Api\Data;

/**
 * Interface AnswerInterface
 * @api
 * @since 100.0.2
 */
interface AnswerInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const ANSWER_ID              = 'answer_id';
    const ANSWER_DETAIL          = 'answer_detail';
    const ANSWER_AUTHOR_NAME     = 'answer_author_name';
    const ANSWER_AUTHOR_EMAIL    = 'answer_author_email';
    const QUESTION_ID            = 'question_id';
    const ANSWER_STATUS_ID       = 'answer_status_id';
    const ANSWER_USER_TYPE_ID    = 'answer_user_type_id';
    const ANSWER_USER_ID         = 'answer_user_id';
    const ANSWER_CREATED_BY      = 'answer_created_by';
    const ANSWER_VISIBILITY_ID   = 'answer_visibility_id';
    const ANSWER_LIKES           = 'answer_likes';
    const ANSWER_DISLIKES        = 'answer_dislikes';
    const ANSWER_CREATED_AT      = 'answer_created_at';
    /**#@-*/

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get answer detail
     *
     * @return string
     */
    public function getAnswerDetail();

    /**
     * Get answer author name
     *
     * @return string
     */
    public function getAnswerAuthorName();

    /**
     * Get answer author email
     *
     * @return string
     */
    public function getAnswerAuthorEmail();

    /**
     * Get question id
     *
     * @return int
     */
    public function getQuestionId();

    /**
     * Get answer status id
     *
     * @return int
     */
    public function getAnswerStatusId();

    /**
     * Get answer user type id
     *
     * @return int
     */
    public function getAnswerUserTypeId();

    /**
     * Get answer user id
     *
     * @return int
     */
    public function getAnswerUserId();

    /**
     * Get answer created by
     *
     * @return int
     */
    public function getAnswerCreatedBy();

    /**
     * Get answer visibility id
     *
     * @return int
     */
    public function getAnswerVisibilityId();

    /**
     * Get answer likes
     *
     * @return int
     */
    public function getAnswerLikes();

    /**
     * Get answer dislikes
     *
     * @return int
     */
    public function getAnswerDislikes();

    /**
     * Get answer created at
     *
     * @return int
     */
    public function getAnswerCreatedAt();

    /**
     * Set ID
     *
     * @param int $id
     * @return \RoyalCyber\ProductQuestions\Api\Data\AnswerInterface
     */
    public function setId($id);

    /**
     * Set answer detail
     *
     * @param string $answerDetail
     * @return \RoyalCyber\ProductQuestions\Api\Data\AnswerInterface
     */
    public function setAnswerDetail($answerDetail);

    /**
     * Set answer author name
     *
     * @param string $answerAuthorName
     * @return \RoyalCyber\ProductQuestions\Api\Data\AnswerInterface
     */
    public function setAnswerAuthorName($answerAuthorName);

    /**
     * Set answer author email
     *
     * @param string $answerAuthorEmail
     * @return \RoyalCyber\ProductQuestions\Api\Data\AnswerInterface
     */
    public function setAnswerAuthorEmail($answerAuthorEmail);

    /**
     * Set question Id
     *
     * @param int $questionId
     * @return \RoyalCyber\ProductQuestions\Api\Data\AnswerInterface
     */
    public function setQuestionId($questionId);

    /**
     * Set answer status id
     *
     * @param int $answerStatusId
     * @return \RoyalCyber\ProductQuestions\Api\Data\AnswerInterface
     */
    public function setAnswerStatusId($answerStatusId);

    /**
     * Set answer user type id
     *
     * @param int $answerUserTypeId
     * @return \RoyalCyber\ProductQuestions\Api\Data\AnswerInterface
     */
    public function setAnswerUserTypeId($answerUserTypeId);

    /**
     * Set answer user id
     *
     * @param int $answerUserId
     * @return \RoyalCyber\ProductQuestions\Api\Data\AnswerInterface
     */
    public function setAnswerUserId($answerUserId);

    /**
     * Set answer created by
     *
     * @param int $answerCreatedBy
     * @return \RoyalCyber\ProductQuestions\Api\Data\AnswerInterface
     */
    public function setAnswerCreatedBy($answerCreatedBy);

    /**
     * Set answer visibility id
     *
     * @param int $answerVisibilityId
     * @return \RoyalCyber\ProductQuestions\Api\Data\AnswerInterface
     */
    public function setAnswerVisibilityId($answerVisibilityId);

    /**
     * Set answer likes
     *
     * @param int $answerLikes
     * @return \RoyalCyber\ProductQuestions\Api\Data\AnswerInterface
     */
    public function setAnswerLikes($answerLikes);

    /**
     * Set answer dislikes
     *
     * @param int $answerDislikes
     * @return \RoyalCyber\ProductQuestions\Api\Data\AnswerInterface
     */
    public function setAnswerDislikes($answerDislikes);

    /**
     * Set answer created at
     *
     * @param int $answerCreatedAt
     * @return \RoyalCyber\ProductQuestions\Api\Data\AnswerInterface
     */
    public function setAnswerCreatedAt($answerCreatedAt);
}
