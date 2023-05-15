<?php
namespace Codilar\CustomModule\Api\Data;

interface PincodeInterface
{
    const ENTITY_ID = 'entity_id';
    const PRODUCT_ID = 'product_id';
    const PINCODE = 'pincode';

    /**
     * Get entity ID.
     *
     * @return int|null
     */
    public function getEntityId();

    /**
     * Set entity ID.
     *
     * @param int $entityId
     * @return \Codilar\CustomModule\Api\Data\PincodeInterface
     */
    public function setEntityId($entityId);

    /**
     * Get product ID.
     *
     * @return int|null
     */
    public function getProductId();

    /**
     * Set product ID.
     *
     * @param int $productId
     * @return \Codilar\CustomModule\Api\Data\PincodeInterface
     */
    public function setProductId($productId);

    /**
     * Get pincode.
     *
     * @return string|null
     */
    public function getPincode();

    /**
     * Set pincode.
     *
     * @param string $pincode
     * @return \Codilar\CustomModule\Api\Data\PincodeInterface
     */
    public function setPincode($pincode);
}
