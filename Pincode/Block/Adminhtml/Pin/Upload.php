<?php

namespace Codilar\Pincode\Block\Adminhtml\Pin;

use Magento\Framework\View\Element\Template;

class Upload extends Template
{
    public function getFormAction()
    {
        return $this->getUrl('pincode/pin/uploadpost');
    }
}
