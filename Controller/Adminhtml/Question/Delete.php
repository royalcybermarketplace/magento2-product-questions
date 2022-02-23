<?php
/**
 * @category    RoyalCyber
 * @package     RoyalCyber_ProductQuestions
 * @copyright   Copyright (c) 2022 RoyalCyber (https://royalcyber.com/)
 */

namespace RoyalCyber\ProductQuestions\Controller\Adminhtml\Question;

use Magento\Framework\App\Action\HttpPostActionInterface;

/**
 * Class Question Delete
 * @package RoyalCyber\ProductQuestions\Controller\Adminhtml\Question
 */
class Delete extends \Magento\Backend\App\Action implements HttpPostActionInterface
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'RoyalCyber_ProductQuestions::question_delete';

    /**
     * Delete action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('question_id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

        if ($id) {
            $questionDetail = "";
            try {
                // init model and delete
                $model = $this->_objectManager->create(\RoyalCyber\ProductQuestions\Model\Question::class);
                $model->load($id);

                $questionDetail = $model->getQuestionDetail();
                $model->delete();

                // display success message
                $this->messageManager->addSuccessMessage(__('The question has been deleted.'));

                // go to grid
                $this->_eventManager->dispatch('adminhtml_royalcyber_product_questions_on_delete', [
                    'title' => $questionDetail,
                    'status' => 'success'
                ]);

                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->_eventManager->dispatch(
                    'adminhtml_royalcyber_product_questions_on_delete',
                    ['title' => $questionDetail, 'status' => 'fail']
                );
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['question_id' => $id]);
            }
        }

        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a question to delete.'));

        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}
