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

    public function getEntityId()
    {
        return $this->getData(self::ENTITY_ID);
    }

    public function setEntityId($entityId)
    {
        $this->setData(self::ENTITY_ID, $entityId);
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
