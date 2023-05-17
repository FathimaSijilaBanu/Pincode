<?php

/**
 *
 * @package     magento2
 * @author      Codilar Technologies
 * @license     https://opensource.org/licenses/OSL-3.0 Open Software License v. 3.0 (OSL-3.0)
 * @link        https://www.codilar.com/
 */

namespace Codilar\CustomModule\Block;

use Magento\Framework\View\Element\Template;

class Custom extends Template
{
    public function getText()
    {
        return "Welcome";
    }
}
