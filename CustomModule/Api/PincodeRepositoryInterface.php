<?php

namespace Codilar\CustomModule\Api;

use Codilar\CustomModule\Api\Data\PincodeInterface;

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
     * Find Pincode by Pincode and Product ID
     *
     * @param string $pincode
     * @param int $productId
     * @return PincodeInterface|null
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function findByPincodeAndProductId($pincode, $productId);
    /**
     * Get Pincodes by Product ID
     *
     * @param int $productId
     * @return PincodeInterface[]
     */
    public function getByProductId($productId);
}

