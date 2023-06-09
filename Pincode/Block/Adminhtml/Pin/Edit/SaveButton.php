<?php

/**
 *
 * @package Codilar_Pincode
 *
 */

namespace Codilar\Pincode\Block\Adminhtml\Pin\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class SaveButton
 * It extends the GenericButton class
 */

class SaveButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * Retrieves button data.
     *
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Save Pincode'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => ['button' => ['event' => 'save']],
                'form-role' => 'save',
            ],
            'sort_order' => 90,
        ];
    }
}
