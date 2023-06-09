<?php

namespace Codilar\Pincode\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

interface PincodeInterface extends ExtensibleDataInterface
{
    public const ID = 'id';
    public const SKU = 'SKU';
    public const PINCODE = 'pincode';
    public const AVAILABLE_MODE = 'available_mode';

    /**
     * Get Pincode ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Set Pincode ID
     *
     * @param int $id
     * @return $this
     */
    public function setId($id);

    /**
     * Get SKU
     *
     * @return string|null
     */
    public function getSKU();

    /**
     * Set SKU
     *
     * @param string $sku
     * @return $this
     */
    public function setSKU($sku);

    /**
     * Get Pincode
     *
     * @return int|null
     */
    public function getPincode();

    /**
     * Set Pincode
     *
     * @param int $pincode
     * @return $this
     */
    public function setPincode($pincode);

    /**
     * Get Available Mode
     *
     * @return string|null
     */
    public function getAvailableMode();

    /**
     * Set Available Mode
     *
     * @param string $availableMode
     * @return $this
     */
    public function setAvailableMode($availableMode);
}
