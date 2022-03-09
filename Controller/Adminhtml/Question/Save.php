<?php
/**
 * @category    RoyalCyberMarketplace
 * @copyright   Copyright (c) 2022 RoyalCyberMarketplace (https://royalcyber.com/)
 */

namespace RoyalCyberMarketplace\ProductQuestions\Controller\Adminhtml\Question;

use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Backend\App\Action;
use Magento\Framework\Exception\LocalizedException;
use RoyalCyberMarketplace\ProductQuestions\Model\QuestionFactory;
use RoyalCyberMarketplace\ProductQuestions\Api\QuestionRepositoryInterface;

/**
 * Class Save
 */
class Save extends \Magento\Backend\App\Action implements HttpPostActionInterface
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'RoyalCyberMarketplace_ProductQuestions::question_save';

    /**
     * @var \RoyalCyberMarketplace\ProductQuestions\Model\QuestionFactory
     */
    private $questionFactory;

    /**
     * @var \RoyalCyberMarketplace\ProductQuestions\Api\QuestionRepositoryInterface
     */
    private $questionRepository;

    public function __construct(
        Action\Context $context,
        \RoyalCyberMarketplace\ProductQuestions\Model\QuestionFactory $questionFactory = null,
        \RoyalCyberMarketplace\ProductQuestions\Api\QuestionRepositoryInterface $questionRepository = null
    ) {
        $this->questionFactory = $questionFactory
            ?: \Magento\Framework\App\ObjectManager::getInstance()->get(QuestionFactory::class);
        $this->questionRepository = $questionRepository
            ?: \Magento\Framework\App\ObjectManager::getInstance()
                ->get(QuestionRepositoryInterface::class);
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            /** @var \RoyalCyberMarketplace\ProductQuestions\Model\Question $model */
            $model = $this->questionFactory->create();

            $id = $this->getRequest()->getParam('question_id');
            if ($id) {
                try {
                    $model = $this->questionRepository->getById($id);
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This question no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            }

            $model->addData($data);

            $this->_eventManager->dispatch(
                'royalcybermarketplace_product_questions_prepare_save',
                ['question' => $model, 'request' => $this->getRequest()]
            );

            try {
                $this->questionRepository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the question.'));
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addExceptionMessage($e->getPrevious() ?: $e);
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the question.'));
            }
            $questionId = $this->getRequest()->getParam('question_id');
            return $resultRedirect->setPath('*/*/edit', ['question_id' => $questionId]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
