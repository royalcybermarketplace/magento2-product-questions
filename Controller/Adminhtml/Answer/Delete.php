<?php
/**
 * @category    RoyalCyberMarketplace
 * @package     RoyalCyberMarketplace_ProductQuestions
 * @copyright   Copyright (c) 2022 RoyalCyberMarketplace (https://royalcyber.com/)
 */

namespace RoyalCyberMarketplace\ProductQuestions\Controller\Adminhtml\Answer;

use Magento\Framework\App\Action\HttpPostActionInterface;

/**
 * Class Answer Delete
 * @package RoyalCyberMarketplace\ProductQuestions\Controller\Adminhtml\Answer
 */
class Delete extends \Magento\Backend\App\Action implements HttpPostActionInterface
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'RoyalCyberMarketplace_ProductQuestions::answer_delete';

    /**
     * Delete action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('answer_id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

        if ($id) {
            $title = "Answer id " .$id;
            try {
                // init model and delete
                $model = $this->_objectManager->create(\RoyalCyberMarketplace\ProductQuestions\Model\Answer::class);
                $model->load($id);
                $model->delete();

                // display success message
                $this->messageManager->addSuccessMessage(__('The answer has been deleted.'));

                // go to grid
                $this->_eventManager->dispatch('adminhtml_royalcybermarketplace_product_answers_on_delete', [
                    'title' => $title,
                    'status' => 'success'
                ]);

                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->_eventManager->dispatch(
                    'adminhtml_royalcybermarketplace_product_answers_on_delete',
                    ['title' => $title, 'status' => 'fail']
                );
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['answer_id' => $id]);
            }
        }

        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a answer to delete.'));

        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}
