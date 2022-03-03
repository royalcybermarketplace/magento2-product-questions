<?php
/**
 * @category    RoyalCyberMarketplace
 * @package     RoyalCyberMarketplace_ProductQuestions
 * @copyright   Copyright (c) 2022 RoyalCyberMarketplace (https://royalcyber.com/)
 */

namespace RoyalCyberMarketplace\ProductQuestions\Model\Answer;

/**
 * Class DataProvider
 * @package RoyalCyberMarketplace\ProductQuestions\Model\Answer
 */
class DataProvider extends \Magento\Ui\DataProvider\ModifierPoolDataProvider
{
    /**
     * @var \RoyalCyberMarketplace\ProductQuestions\Model\ResourceModel\Answer\Collection
     */
    protected $collection;

    /**
     * @var array
     */
    protected $loadedData;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param \RoyalCyberMarketplace\ProductQuestions\Model\ResourceModel\Answer\CollectionFactory $answerCollectionFactory
     * @param array $meta
     * @param array $data
     * @param \Magento\Ui\DataProvider\Modifier\PoolInterface|null $pool
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        \RoyalCyberMarketplace\ProductQuestions\Model\ResourceModel\Answer\CollectionFactory $answerCollectionFactory,
        array $meta = [],
        array $data = [],
        \Magento\Ui\DataProvider\Modifier\PoolInterface $pool = null
    ) {
        $this->collection = $answerCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data, $pool);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        /** @var $answer \RoyalCyberMarketplace\ProductQuestions\Model\Answer */
        foreach ($items as $answer) {
            $this->loadedData[$answer->getId()] = $answer->getData();
        }

        if (!empty($data)) {
            $answer = $this->collection->getNewEmptyItem();
            $answer->setData($data);
            $this->loadedData[$answer->getId()] = $answer->getData();
        }

        return $this->loadedData;
    }
}
