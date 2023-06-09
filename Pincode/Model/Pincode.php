<?php

namespace Codilar\Pincode\Model;

use Codilar\Pincode\Api\Data\PincodeInterface;
use Magento\Framework\Model\AbstractExtensibleModel;

class Pincode extends AbstractExtensibleModel implements PincodeInterface
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ResourceModel\Pincode::class);
    }

    /**
     * Get Pincode ID
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->_getData(self::ID);
    }

    /**
     * Set Pincode ID
     *
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

    /**
     * Get SKU
     *
     * @return string|null
     */
    public function getSKU()
    {
        return $this->_getData(self::SKU);
    }

    /**
     * Set SKU
     *
     * @param string $sku
     * @return $this
     */
    public function setSKU($sku)
    {
        return $this->setData(self::SKU, $sku);
    }

    /**
     * Get Pincode
     *
     * @return int|null
     */
    public function getPincode()
    {
        return $this->_getData(self::PINCODE);
    }

    /**
     * Set Pincode
     *
     * @param int $pincode
     * @return $this
     */
    public function setPincode($pincode)
    {
        return $this->setData(self::PINCODE, $pincode);
    }

    /**
     * Get Available Mode
     *
     * @return string|null
     */
    public function getAvailableMode()
    {
        return $this->_getData(self::AVAILABLE_MODE);
    }

    /**
     * Set Available Mode
     *
     * @param string $availableMode
     * @return $this
     */
    public function setAvailableMode($availableMode)
    {
        return $this->setData(self::AVAILABLE_MODE, $availableMode);
    }
}
