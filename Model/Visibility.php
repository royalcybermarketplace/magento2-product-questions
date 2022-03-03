<?php
/**
 * @category    RoyalCyberMarketplace
 * @package     RoyalCyberMarketplace_ProductQuestions
 * @copyright   Copyright (c) 2022 RoyalCyberMarketplace (https://royalcyber.com/)
 */

namespace RoyalCyberMarketplace\ProductQuestions\Model;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class Visibility
 * @package RoyalCyberMarketplace\ProductQuestions\Model
 */
class Visibility implements OptionSourceInterface
{
    /**
     * Not visible code
     */
    const VISIBILITY_NOT_VISIBLE = '1';

    /**
     * Visible code
     */
    const VISIBILITY_VISIBLE = '2';

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
     * Get visibility type values array
     *
     * @return array
     */
    public function getOptionArray()
    {
        return [
            self::VISIBILITY_VISIBLE => __('Visible'),
            self::VISIBILITY_NOT_VISIBLE => __('Not Visible')
        ];
    }

    /**
     * Get visibility type values array with empty value
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
}
