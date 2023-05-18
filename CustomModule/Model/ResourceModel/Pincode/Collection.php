<?php

namespace Codilar\CustomModule\Model\ResourceModel\Pincode;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Codilar\CustomModule\Model\Pincode;
use Codilar\CustomModule\Model\ResourceModel\Pincode as PincodeResource;

class Collection extends AbstractCollection
{
    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init(Pincode::class, PincodeResource::class);
    }
}
