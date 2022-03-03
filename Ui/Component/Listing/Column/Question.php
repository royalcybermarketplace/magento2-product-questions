<?php
/**
 * @category    RoyalCyberMarketplace
 * @package     RoyalCyberMarketplace_ProductQuestions
 * @copyright   Copyright (c) 2022 RoyalCyberMarketplace (https://royalcyber.com/)
 */

namespace RoyalCyberMarketplace\ProductQuestions\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;
use RoyalCyberMarketplace\ProductQuestions\Api\QuestionRepositoryInterface;

/**
 * Class Question
 * @package RoyalCyberMarketplace\ProductQuestions\Ui\Component\Listing\Column
 */
class Question extends Column
{
    /** Url Path */
    const QUESTION_URL_PATH_EDIT = 'product_questions/question/edit';

    /**
     * @var UrlInterface
     */
    private $urlBuilder;

    /**
     * @var QuestionRepositoryInterface
     */
    protected $questionRepositoryInterface;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        QuestionRepositoryInterface $questionRepositoryInterface,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->urlBuilder = $urlBuilder;
        $this->questionRepositoryInterface = $questionRepositoryInterface;
    }

    /**
     * @param array $dataSource
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$items) {
                if ($items['question_id'] > 0) {
                    $question = $this->questionRepositoryInterface->getById($items['question_id']);
                    $items['question_id'] = $this->getLink($question->getId(), $question->getQuestionDetail());
                }
            }
        }
        return $dataSource;
    }

    /**
     * Build a link for column value
     *
     * @param $questionId
     * @param $questionDetail
     * @return string
     */
    private function getLink($questionId, $questionDetail)
    {
        $href = $this->urlBuilder->getUrl(self::QUESTION_URL_PATH_EDIT, ['question_id' => $questionId]);
        $result = html_entity_decode('<a href="'.$href.'">'.$questionDetail.'</a>');

        return $result;
    }
}
