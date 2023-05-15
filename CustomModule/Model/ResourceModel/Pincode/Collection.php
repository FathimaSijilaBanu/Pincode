<?php

namespace Codilar\CustomModule\Model\ResourceModel\Pincode;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init('Codilar\CustomModule\Model\Pincode', 'Codilar\CustomModule\Model\ResourceModel\Pincode');
    }
}
