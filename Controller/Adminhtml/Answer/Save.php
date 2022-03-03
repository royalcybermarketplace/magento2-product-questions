<?php
/**
 * @category    RoyalCyberMarketplace
 * @package     RoyalCyberMarketplace_ProductQuestions
 * @copyright   Copyright (c) 2022 RoyalCyberMarketplace (https://royalcyber.com/)
 */

namespace RoyalCyberMarketplace\ProductQuestions\Controller\Adminhtml\Answer;

use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Backend\App\Action;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class Save
 * @package RoyalCyberMarketplace\ProductQuestions\Controller\Adminhtml\Answer
 */
class Save extends \Magento\Backend\App\Action implements HttpPostActionInterface
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'RoyalCyberMarketplace_ProductQuestions::answer_save';

    /**
     * @var \RoyalCyberMarketplace\ProductQuestions\Model\AnswerFactory
     */
    private $answerFactory;

    /**
     * @var \RoyalCyberMarketplace\ProductQuestions\Api\AnswerRepositoryInterface
     */
    private $answerRepository;

    /**
     * Save constructor.
     * @param Action\Context $context
     * @param \RoyalCyberMarketplace\ProductQuestions\Model\AnswerFactory|null $answerFactory
     * @param \RoyalCyberMarketplace\ProductQuestions\Api\QuestionRepositoryInterface|null $answerRepository
     */
    public function __construct(
        Action\Context $context,
        \RoyalCyberMarketplace\ProductQuestions\Model\AnswerFactory $answerFactory = null,
        \RoyalCyberMarketplace\ProductQuestions\Api\QuestionRepositoryInterface $answerRepository = null
    ) {
        $this->answerFactory = $answerFactory
            ?: \Magento\Framework\App\ObjectManager::getInstance()
                ->get(\RoyalCyberMarketplace\ProductQuestions\Model\AnswerFactory::class);
        $this->answerRepository = $answerRepository
            ?: \Magento\Framework\App\ObjectManager::getInstance()
                ->get(\RoyalCyberMarketplace\ProductQuestions\Api\AnswerRepositoryInterface::class);
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
            $model = $this->answerFactory->create();

            $id = $this->getRequest()->getParam('answer_id');
            if ($id) {
                try {
                    $model = $this->answerRepository->getById($id);
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This answer no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            } else {
                unset($data['answer_id']);
            }
            $model->setData($data);

            $this->_eventManager->dispatch(
                'royalcybermarketplace_product_answers_prepare_save',
                ['answer' => $model, 'request' => $this->getRequest()]
            );

            try {
                $this->answerRepository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the answer.'));
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addExceptionMessage($e->getPrevious() ?: $e);
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the answer.'));
            }
            return $resultRedirect->setPath('*/*/edit', ['answer_id' => $this->getRequest()->getParam('answer_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
