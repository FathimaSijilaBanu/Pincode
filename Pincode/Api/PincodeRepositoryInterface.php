<?php

namespace Codilar\Pincode\Api;

use Codilar\Pincode\Api\Data\PincodeInterface;

interface PincodeRepositoryInterface
{
    /**
     * Save Pincode
     *
     * @param PincodeInterface $pincode
     * @return PincodeInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(PincodeInterface $pincode);

    /**
     * Get Pincode by ID
     *
     * @param int $pincodeId
     * @return PincodeInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($pincodeId);

    /**
     * Delete Pincode
     *
     * @param PincodeInterface $pincode
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(PincodeInterface $pincode);

    /**
     * Delete Pincode by ID
     *
     * @param int $pincodeId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($pincodeId);
     /**
     * Get new instance of Pincode
     *
     * @return PincodeInterface
     */
    public function getNew();
    /**
     * Find pincode by pincode and SKU
     *
     * @param string $pincode
     * @param string $sku
     * @return PincodeInterface|null
     */
    public function findByPincodeAndSku($pincode, $sku);
    /**
     * Find by SKU and Avaialbility Mode
     *
     * @param string $sku
     * @return PincodeInterface|null
     */
    public function findBySkuAndAvailableMode($sku);
}
