<?php
/**
 * @category    RoyalCyber
 * @package     RoyalCyber_ProductQuestions
 * @copyright   Copyright (c) 2022 RoyalCyber (https://royalcyber.com/)
 */

namespace RoyalCyber\ProductQuestions\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Ui\Component\Listing\Columns\Column;

/**
 * Class IsActive
 * @package RoyalCyber\ProductQuestions\Ui\Component\Listing\Column
 */
class IsActive extends Column
{
    /**
     * convert data to text for display
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$items) {
                if (isset($items['question_status_id'])) {
                    if ($items['question_status_id'] == 1) {
                        $items['question_status_id'] = 'Approved';
                    } elseif ($items['question_status_id'] == 2) {
                        $items['question_status_id'] = 'Pending';
                    } else {
                        $items['question_status_id'] = 'Not Approve';
                    }
                } else {
                    if ($items['answer_status_id'] == 1) {
                        $items['answer_status_id'] = 'Approved';
                    } elseif ($items['answer_status_id'] == 2) {
                        $items['answer_status_id'] = 'Pending';
                    } else {
                        $items['answer_status_id'] = 'Not Approve';
                    }
                }
            }
        }
        return $dataSource;
    }
}
