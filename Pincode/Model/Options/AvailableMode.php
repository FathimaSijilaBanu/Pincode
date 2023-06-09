<?php

namespace Codilar\Pincode\Model\Options;

use Magento\Framework\Data\OptionSourceInterface;

class AvailableMode implements OptionSourceInterface
{
    /**
     * Return array of options as value-label pairs
     *
     * @return array Format: array(array('value' => '<value>', 'label' => '<label>'), ...)
     */
    public function toOptionArray()
    {
        return [
            ['value' => 'all', 'label' => __('All')],
            ['value' => 'custom', 'label' => __('Custom')],
        ];
    }
}
