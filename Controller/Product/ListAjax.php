<?php
/**
 * @category    RoyalCyber
 * @package     RoyalCyber_ProductQuestions
 * @copyright   Copyright (c) 2022 RoyalCyber (https://royalcyber.com/)
 */

namespace RoyalCyber\ProductQuestions\Controller\Product;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\TestFramework\Inspection\Exception;
use Magento\Framework\Controller\ResultFactory;

/**
 * Class ListAjax
 * @package RoyalCyber\ProductQuestions\Controller\Product
 */
class ListAjax extends \Magento\Framework\App\Action\Action
{
    /**
     * Catalog product model
     *
     * @var \Magento\Catalog\Api\ProductRepositoryInterface
     */
    protected $productRepository;

    /**
     * Core model store manager interface
     *
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $coreRegistry = null;

    /**
     * Question Collection
     *
     * @var \RoyalCyber\ProductQuestions\Model\ResourceModel\Question\CollectionFactory
     */
    protected $questionCollectionFactory;

    /**
     * @var \Magento\Framework\Controller\Result\RawFactory
     */
    protected $resultRawFactory;

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var \RoyalCyber\ProductQuestions\Helper\Data
     */
    protected $questionData;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Catalog\Api\ProductRepositoryInterface $productRepository
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Framework\Registry $coreRegistry
     * @param ProductStatus $productStatus
     * @param ProductVisibility $productVisibility
     * @param \RoyalCyber\ProductQuestions\Model\ResourceModel\Question\CollectionFactory $collectionFactory
     * @param \Magento\Framework\Controller\Result\RawFactory $resultRawFactory
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Registry $coreRegistry,
        \RoyalCyber\ProductQuestions\Model\ResourceModel\Question\CollectionFactory $collectionFactory,
        \Magento\Framework\Controller\Result\RawFactory $resultRawFactory,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \RoyalCyber\ProductQuestions\Helper\Data $questionData
    ) {
        $this->productRepository = $productRepository;
        $this->storeManager = $storeManager;
        $this->coreRegistry = $coreRegistry;
        $this->questionCollectionFactory = $collectionFactory;
        $this->resultRawFactory = $resultRawFactory;
        $this->resultPageFactory = $resultPageFactory;
        $this->questionData = $questionData;
        parent::__construct($context);
    }

    /**
     * Show list of product's questions
     *
     * @return \Magento\Framework\Controller\Result\RawFactory|\Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        $credentials = null;
        $httpBadRequestCode = 400;

        /** @var \Magento\Framework\Controller\Result\RawFactory $resultRawFactory */
        $resultRaw = $this->resultRawFactory->create();
        try {
            $credentials = $this->getRequest()->getParams();
        } catch (\Exception $e) {
            return $resultRaw->setHttpResponseCode($httpBadRequestCode);
        }
        if (!$credentials || $this->getRequest()->getMethod() !== 'GET' || !$this->getRequest()->isXmlHttpRequest()) {
            return $resultRaw->setHttpResponseCode($httpBadRequestCode);
        }

        $productId = (int) $credentials['id'];
        $pageId = (!empty($credentials['page']) && (int) $credentials['page'] > 0) ? (int) $credentials['page'] : 1;
        $pageSize = $this->questionData->getPageSize();
        if ($productId > 0) {
            try {
                $product = $this->productRepository->getById($productId, false, $this->storeManager->getStore()->getId());
                $collection = $this->questionCollectionFactory->create()->addStoreFilter(
                    ['0', $this->storeManager->getStore()->getId()]
                )->addFieldToFilter(
                    'main_table.product_id',
                    $productId
                )->addStatusFilter(
                    \RoyalCyber\ProductQuestions\Model\Status::STATUS_APPROVED
                )->addVisibilityFilter(
                    \RoyalCyber\ProductQuestions\Model\Visibility::VISIBILITY_VISIBLE
                )->addProductIdFilter(
                    $productId
                )->setPageSize(
                    $pageSize
                )->setCurPage(
                    $pageId
                );

                $this->coreRegistry->register('royalcyber_question_product', $collection);
            } catch (NoSuchEntityException $e) {

            }
        }

        /** @var \Magento\Framework\View\Result\Layout $resultLayout */
        $resultLayout = $this->resultFactory->create(ResultFactory::TYPE_LAYOUT);
        return $resultLayout;
    }
}
