<?php
/**
 * @category    RoyalCyberMarketplace
 * @package     RoyalCyberMarketplace_ProductQuestions
 * @copyright   Copyright (c) 2022 RoyalCyberMarketplace (https://royalcyber.com/)
 */

namespace RoyalCyberMarketplace\ProductQuestions\Controller\Adminhtml\Answer;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Answer Index
 * @package RoyalCyberMarketplace\ProductQuestions\Controller\Adminhtml\Answer
 */
class Index extends \Magento\Backend\App\Action implements HttpGetActionInterface
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'RoyalCyberMarketplace_ProductQuestions::answer';

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * Index constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Index action
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Magento_Backend::marketing');
        $resultPage->addBreadcrumb(__('Product Answers'), __('Product Answers'));
        $resultPage->addBreadcrumb(__('Manage Answers'), __('Manage Answers'));
        $resultPage->getConfig()->getTitle()->prepend(__('Answers'));

        return $resultPage;
    }
}
