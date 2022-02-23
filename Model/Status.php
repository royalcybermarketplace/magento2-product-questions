<?php
/**
 * @category    RoyalCyber
 * @package     RoyalCyber_ProductQuestions
 * @copyright   Copyright (c) 2022 RoyalCyber (https://royalcyber.com/)
 */

namespace RoyalCyber\ProductQuestions\Model;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class Status
 * @package RoyalCyber\ProductQuestions\Model
 */
class Status implements OptionSourceInterface
{
    /**
     * Approved status code
     */
    const STATUS_APPROVED = '1';

    /**
     * Pending status code
     */
    const STATUS_PENDING = '2';

    /**
     * Not Approved status code
     */
    const STATUS_NOT_APPROVED = '3';

    /**
     * {@inheritdoc}
     */
    public function toOptionArray()
    {
        $res = [];
        foreach ($this->getOptionArray() as $index => $value) {
            $res[] = ['value' => $index, 'label' => $value];
        }
        return $res;
    }

    /**
     * Get status type values array
     *
     * @return array
     */
    public function getOptionArray()
    {
        return [
            self::STATUS_PENDING => __('Pending'),
            self::STATUS_APPROVED => __('Approved'),
            self::STATUS_NOT_APPROVED => __('Not Approved')
        ];
    }

    /**
     * Get status type values array with empty value
     *
     * @return array
     */
    public function getOptionValues()
    {
        $options = [];
        $options[''] = __('--Please Select--');
        foreach ($this->getOptionArray() as $key => $value) {
            $options[$key] = $value;
        }
        return $options;
    }

    /**
     * Get only user types
     *
     * @return array
     */
    public function getArrayKeys()
    {
        $arrayKeys = [];
        foreach ($this->getOptionArray() as $key => $value) {
            $arrayKeys[] = $key;
        }
        return $arrayKeys;
    }

    /**
     * Retrieve the status text
     *
     * @param int $statusId
     * @return string
     */
    public function getStatusText($statusId)
    {
        foreach ($this->getOptionArray() as $key => $value) {
            if ($key == $statusId) {
                return $value->getText();
            }
        }
        return '';
    }
}
