<?php

namespace Codilar\Pincode\Model\ResourceModel\Pincode;

use Codilar\Pincode\Model\Pincode;
use Codilar\Pincode\Model\ResourceModel\Pincode as PincodeResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = Pincode::ID;

    /**
     * Initialize collection
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(Pincode::class, PincodeResourceModel::class);
    }
}
