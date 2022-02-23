<?php
/**
 * @category    RoyalCyber
 * @package     RoyalCyber_ProductQuestions
 * @copyright   Copyright (c) 2022 RoyalCyber (https://royalcyber.com/)
 */

namespace RoyalCyber\ProductQuestions\Model;

/**
 * Class AdminUser
 * @package RoyalCyber\ProductQuestions\Model
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
    public function getEmail($default = 'royalcyber_ecommerce@magento.com')
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
    public function getName($default = 'royalcyber')
    {
        if ($this->authSession->isLoggedIn()) {
            return $this->authSession->getUser()->getFirstname();
        }

        return 'royalcyber';
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
