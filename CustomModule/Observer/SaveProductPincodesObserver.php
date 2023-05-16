<?php

namespace Codilar\CustomModule\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\ResourceConnection;
use Codilar\CustomModule\Api\PincodeRepositoryInterface;
use Codilar\CustomModule\Api\Data\PincodeInterfaceFactory;
use Codilar\CustomModule\Model\PincodeFactory;

class SaveProductPincodesObserver implements ObserverInterface
{
    protected $connection;
    protected $pincodeRepository;
    protected $pincodeFactory;

    public function __construct(
        ResourceConnection $resource,
        PincodeRepositoryInterface $pincodeRepository,
        PincodeFactory $pincodeFactory
    ) {
        $this->connection = $resource->getConnection();
        $this->pincodeRepository = $pincodeRepository;
        $this->pincodeFactory = $pincodeFactory;
    }

    public function execute(Observer $observer)
    {
        $product = $observer->getProduct();
        $productId = $product->getId();
        $pincodes = $product->getData('assign_pincodes');

        if ($productId && !empty($pincodes) && is_array($pincodes)) {
            foreach ($pincodes['dynamic_row'] as $pincode) {
                $existingPincode = $this->pincodeRepository->findByPincodeAndProductId($pincode['pincodes'], $productId);

                if (!$existingPincode) {
                    $pincodeModel = $this->pincodeFactory->create();
                    $pincodeModel->setProductId($productId);
                    $pincodeModel->setPincode($pincode['pincodes']);
                    $this->pincodeRepository->save($pincodeModel);
                }
            }
        }
    }
}  