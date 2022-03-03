<?php
/**
 * @category    RoyalCyberMarketplace
 * @package     RoyalCyberMarketplace_ProductQuestions
 * @copyright   Copyright (c) 2022 RoyalCyberMarketplace (https://royalcyber.com/)
 */

namespace RoyalCyberMarketplace\ProductQuestions\Controller\Adminhtml\Question;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;

/**
 * Create RoyalCyberMarketplace product question new action.
 */
class NewAction extends \Magento\Backend\App\Action implements HttpGetActionInterface
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'RoyalCyberMarketplace_ProductQuestions::question_save';

    /**
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->setActiveMenu('Magento_Backend::marketing');
        $resultPage->getConfig()->getTitle()->prepend(__('Product Questions'));
        $resultPage->getConfig()->getTitle()->prepend(__('New Question'));
        $resultPage->addContent($resultPage->getLayout()->createBlock(\RoyalCyberMarketplace\ProductQuestions\Block\Adminhtml\Add::class));
        $resultPage->addContent($resultPage->getLayout()->createBlock(
            \RoyalCyberMarketplace\ProductQuestions\Block\Adminhtml\Product\Grid::class
        ));
        return $resultPage;
    }
}
