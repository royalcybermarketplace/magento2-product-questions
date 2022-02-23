<?php
/**
 * @category    RoyalCyber
 * @package     RoyalCyber_ProductQuestions
 * @copyright   Copyright (c) 2022 RoyalCyber (https://royalcyber.com/)
 */

namespace RoyalCyber\ProductQuestions\Model\Answer\Source;

use Magento\Framework\Data\OptionSourceInterface;
use RoyalCyber\ProductQuestions\Model\ResourceModel\Question\CollectionFactory as QuestionCollection;

class Question implements OptionSourceInterface
{
    /**
     * @var QuestionCollection
     */
    protected $questionColFactory;

    /**
     * Question constructor.
     * @param QuestionCollection $questionColFactory
     */
    public function __construct(QuestionCollection $questionColFactory)
    {
        $this->questionColFactory = $questionColFactory;
    }

    /**
     * Return array of options as value-label pairs
     *
     * @return array Format: array(array('value' => '<value>', 'label' => '<label>'), ...)
     */
    public function toOptionArray()
    {
        $result = [];
        $questions = $this->questionColFactory->create()->getItems();
        foreach ($questions as $question) {
            $result[] = [
                'value' => $question->getQuestionId(),
                'label' => $question->getQuestionDetail()
            ];
        }
        return $result;
    }
}
