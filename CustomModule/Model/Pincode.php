<?php

namespace Codilar\CustomModule\Model;

use Codilar\CustomModule\Api\Data\PincodeInterface;
use Magento\Framework\Model\AbstractModel;

class Pincode extends AbstractModel implements PincodeInterface
{
    protected function _construct()
    {
        $this->_init(\Codilar\CustomModule\Model\ResourceModel\Pincode::class);
    }

    public function getPincodeId()
    {
        return $this->getData(self::PINCODE_ID);
    }

    public function setPincodeId($pincodeId)
    {
        $this->setData(self::PINCODE_ID, $pincodeId);
        return $this;
    }

    public function getProductId()
    {
        return $this->getData(self::PRODUCT_ID);
    }

    public function setProductId($productId)
    {
        $this->setData(self::PRODUCT_ID, $productId);
        return $this;
    }

    public function getPincode()
    {
        return $this->getData(self::PINCODE);
    }

    public function setPincode($pincode)
    {
        $this->setData(self::PINCODE, $pincode);
        return $this;
    }
}
