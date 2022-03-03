<?php
/**
 * @category    RoyalCyberMarketplace
 * @package     RoyalCyberMarketplace_ProductQuestions
 * @copyright   Copyright (c) 2022 RoyalCyberMarketplace (https://royalcyber.com/)
 */

namespace RoyalCyberMarketplace\ProductQuestions\Model;

/**
 * Class AdminUser
 * @package RoyalCyberMarketplace\ProductQuestions\Model
 */
class AdminUser
{
    /**
     * Backend Auth session model
     *
     * @var \Magento\Backend\Model\Auth\Session
     */
    protected $authSession;

    /**
     * @param \Magento\Backend\Model\Auth\Session $authSession
     */
    public function __construct(
        \Magento\Backend\Model\Auth\Session $authSession
    ) {
        $this->authSession = $authSession;
    }

    /**
     * Retrieve the email of admin user
     *
     * @param string $default
     * @return string
     */
    public function getEmail($default = 'royalcybermarketplace_ecommerce@magento.com')
    {
        if ($this->authSession->isLoggedIn()) {
            return $this->authSession->getUser()->getEmail();
        }

        return $default;
    }

    /**
     * Retrieve the name of admin user
     *
     * @param string $default
     * @return string
     */
    public function getName($default = 'royalcybermarketplace')
    {
        if ($this->authSession->isLoggedIn()) {
            return $this->authSession->getUser()->getFirstname();
        }

        return 'royalcybermarketplace';
    }

    /**
     * Retrieve the ID of admin user
     *
     * @return int|null
     */
    public function getID()
    {
        if ($this->authSession->isLoggedIn()) {
            return $this->authSession->getUser()->getUserId();
        }
        return null;
    }
}
