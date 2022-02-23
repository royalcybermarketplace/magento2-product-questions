<?php
/**
 * @category    RoyalCyber
 * @package     RoyalCyber_ProductQuestions
 * @copyright   Copyright (c) 2022 RoyalCyber (https://royalcyber.com/)
 */
namespace RoyalCyber\ProductQuestions\Block\Adminhtml\Answer\Edit;

use Magento\Backend\Block\Widget\Context;
use RoyalCyber\ProductQuestions\Api\AnswerRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class GenericButton
 */
class GenericButton
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * @var AnswerRepositoryInterface
     */
    protected $answerRepository;

    /**
     * GenericButton constructor.
     *
     * @param Context $context
     * @param AnswerRepositoryInterface $answerRepository
     */
    public function __construct(
        Context $context,
        AnswerRepositoryInterface $answerRepository
    ) {
        $this->context = $context;
        $this->answerRepository = $answerRepository;
    }

    /**
     * Get Answer Id
     *
     * @return int|null
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getAnswerId()
    {
        try {
            return $this->answerRepository->getById(
                $this->context->getRequest()->getParam('answer_id')
            )->getId();
        } catch (NoSuchEntityException $e) {
        }
        return null;
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
