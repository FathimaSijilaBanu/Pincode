<?php

namespace Codilar\CustomModule\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Pincode extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('custom_pincodes', 'pincode_id');
    }
}
