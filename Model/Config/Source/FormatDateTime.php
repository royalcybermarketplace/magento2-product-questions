<?php
/**
 * @category    RoyalCyberMarketplace
 * @package     RoyalCyberMarketplace_ProductQuestions
 * @copyright   Copyright (c) 2022 RoyalCyberMarketplace (https://royalcyber.com/)
 */

namespace RoyalCyberMarketplace\ProductQuestions\Model\Config\Source;

use Magento\Framework\Stdlib\DateTime\TimezoneInterface;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class FormatDateTime
 * @package RoyalCyberMarketplace\ProductQuestions\Model\Config\Source
 */
class FormatDateTime
{
    /**
     * @var TimezoneInterface
     */
    protected $timezone;

    /**
     * Store manager
     *
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     *
     * @param TimezoneInterface $timezone
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        TimezoneInterface $timezone,
        StoreManagerInterface $storeManager
    ) {
        $this->timezone = $timezone;
        $this->storeManager = $storeManager;
    }

    /**
     * Format the datetime
     *
     * @param string $value
     * @param string $format
     * @return string
     */
    public function getDateTime($value, $format = 'M d, Y g:i:s A')
    {
        if (!empty($value)) {
            $date = $this->timezone->date(new \DateTime($value));
            $configTimezone = $this->timezone->getConfigTimezone('store', $this->storeManager->getStore()->getStoreId());
            if (isset($configTimezone) && !$configTimezone) {
                $date = new \DateTime($value);
            }
            return $date->format($format);
        }
        return $value;
    }

    /**
     * Format the created at
     *
     * @param string $date
     * @return string
     */
    public function formatCreatedAt($date)
    {
        return $this->getDateTime($date, 'M d, Y').' '.__('at').' '.$this->getDateTime($date, 'g:i:s A');
    }
}
