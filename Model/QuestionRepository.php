<?php
/**
 * @category    RoyalCyber
 * @package     RoyalCyber_ProductQuestions
 * @copyright   Copyright (c) 2022 RoyalCyber (https://royalcyber.com/)
 */

namespace RoyalCyber\ProductQuestions\Model;

use RoyalCyber\ProductQuestions\Api\Data;
use RoyalCyber\ProductQuestions\Api\QuestionRepositoryInterface;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use RoyalCyber\ProductQuestions\Model\ResourceModel\Question as ResourceQuestion;
use RoyalCyber\ProductQuestions\Model\ResourceModel\Question\CollectionFactory as QuestionCollectionFactory;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class QuestionRepository
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class QuestionRepository implements QuestionRepositoryInterface
{
    /**
     * @var ResourceQuestion
     */
    protected $resource;

    /**
     * @var QuestionFactory
     */
    protected $questionFactory;

    /**
     * @var QuestionCollectionFactory
     */
    protected $questionCollectionFactory;

    /**
     * @var Data\QuestionSearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;

    /**
     * @var DataObjectHelper
     */
    protected $dataObjectHelper;

    /**
     * @var DataObjectProcessor
     */
    protected $dataObjectProcessor;

    /**
     * @var \RoyalCyber\ProductQuestions\Api\Data\QuestionInterfaceFactory
     */
    protected $dataQuestionFactory;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * QuestionRepository constructor.
     *
     * @param ResourceQuestion $resource
     * @param QuestionFactory $questionFactory
     * @param Data\QuestionInterfaceFactory $dataQuestionFactory
     * @param QuestionCollectionFactory $questionCollectionFactory
     * @param Data\QuestionSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface|null $collectionProcessor
     */
    public function __construct(
        ResourceQuestion $resource,
        QuestionFactory $questionFactory,
        Data\QuestionInterfaceFactory $dataQuestionFactory,
        QuestionCollectionFactory $questionCollectionFactory,
        Data\QuestionSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor = null
    ) {
        $this->resource = $resource;
        $this->questionFactory = $questionFactory;
        $this->questionCollectionFactory = $questionCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataQuestionFactory = $dataQuestionFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor ?: $this->getCollectionProcessor();
    }

    /**
     * Save Question data
     *
     * @param \RoyalCyber\ProductQuestions\Api\Data\QuestionInterface $question
     * @return Question
     * @throws CouldNotSaveException
     */
    public function save(\RoyalCyber\ProductQuestions\Api\Data\QuestionInterface $question)
    {
        if ($question->getQuestionStoreId() === null) {
            $storeId = $this->storeManager->getStore()->getId();
            $question->setQuestionStoreId($storeId);
        }
        try {
            $this->resource->save($question);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __('Could not save the question: %1', $exception->getMessage()),
                $exception
            );
        }
        return $question;
    }

    /**
     * Load Question data by given Question Identity
     *
     * @param string $questionId
     * @return Question
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($questionId)
    {
        $question = $this->questionFactory->create();
        $question->load($questionId);
        if (!$question->getId()) {
            throw new NoSuchEntityException(__('The question with the "%1" ID doesn\'t exist.', $questionId));
        }
        return $question;
    }

    /**
     * Load Question data collection by given search criteria
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @param \Magento\Framework\Api\SearchCriteriaInterface $criteria
     * @return \RoyalCyber\ProductQuestions\Api\Data\QuestionSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $criteria)
    {
        /** @var \RoyalCyber\ProductQuestions\Model\ResourceModel\Question\Collection $collection */
        $collection = $this->questionCollectionFactory->create();

        $this->collectionProcessor->process($criteria, $collection);

        /** @var Data\QuestionSearchResultsInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * Delete Question
     *
     * @param \RoyalCyber\ProductQuestions\Api\Data\QuestionInterface $question
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(\RoyalCyber\ProductQuestions\Api\Data\QuestionInterface $question)
    {
        try {
            $this->resource->delete($question);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the question: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * Delete Question by given Question Identity
     *
     * @param string $questionId
     * @return bool
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById($questionId)
    {
        return $this->delete($this->getById($questionId));
    }

    /**
     * Retrieve collection processor
     *
     * @deprecated 102.0.0
     * @return CollectionProcessorInterface
     */
    private function getCollectionProcessor()
    {
        if (!$this->collectionProcessor) {
            $this->collectionProcessor = \Magento\Framework\App\ObjectManager::getInstance()->get(
                'RoyalCyber\ProductQuestions\Model\Api\SearchCriteria\QuestionCollectionProcessor'
            );
        }
        return $this->collectionProcessor;
    }
}
