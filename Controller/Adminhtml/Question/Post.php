<?php
/**
 * @category    RoyalCyber
 * @package     RoyalCyber_ProductQuestions
 * @copyright   Copyright (c) 2022 RoyalCyber (https://royalcyber.com/)
 */

namespace RoyalCyber\ProductQuestions\Controller\Adminhtml\Question;

use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Backend\App\Action;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class Post
 * @package RoyalCyber\ProductQuestions\Controller\Adminhtml\Question
 */
class Post extends \Magento\Backend\App\Action implements HttpPostActionInterface
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'RoyalCyber_ProductQuestions::question_save';

    /**
     * @var \RoyalCyber\ProductQuestions\Model\QuestionFactory
     */
    private $questionFactory;

    /**
     * @var \RoyalCyber\ProductQuestions\Api\QuestionRepositoryInterface
     */
    private $questionRepository;


    public function __construct(
        Action\Context $context,
        \RoyalCyber\ProductQuestions\Model\QuestionFactory $questionFactory = null,
        \RoyalCyber\ProductQuestions\Api\QuestionRepositoryInterface $questionRepository = null
    ) {
        $this->questionFactory = $questionFactory
            ?: \Magento\Framework\App\ObjectManager::getInstance()->get(\RoyalCyber\ProductQuestions\Model\QuestionFactory::class);
        $this->questionRepository = $questionRepository
            ?: \Magento\Framework\App\ObjectManager::getInstance()
                ->get(\RoyalCyber\ProductQuestions\Api\QuestionRepositoryInterface::class);
        parent::__construct($context);
    }

    /**
     * Post action
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data = $this->getRequest()->getPostValue()) {
            /** @var \RoyalCyber\ProductQuestions\Model\Question $model */
            $model = $this->questionFactory->create();
            $model->setData($data);

            try {
                $this->questionRepository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the question.'));
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addExceptionMessage($e->getPrevious() ?: $e);
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the question.'));
            }
            return $resultRedirect->setPath('*/*/new');
        }
        return $resultRedirect->setPath('*/*/');
    }
}
