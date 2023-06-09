<?php

namespace Codilar\Pincode\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Codilar\Pincode\Api\Data\PincodeInterface;
use Codilar\Pincode\Api\PincodeRepositoryInterface;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\App\Action\HttpPostActionInterface;

class Availability extends Action implements HttpPostActionInterface
{
    protected $resultFactory;
    protected $pincodeRepository;
    protected $connection;

    public function __construct(
        Context $context,
        ResultFactory $resultFactory,
        PincodeRepositoryInterface $pincodeRepository,
        ResourceConnection $resource
    ) {
        parent::__construct($context);
        $this->resultFactory = $resultFactory;
        $this->pincodeRepository = $pincodeRepository;
        $this->connection = $resource->getConnection();
    }

    public function execute()
    {
        $pincode = (int)$this->getRequest()->getParam('pincode');
        $sku = $this->getRequest()->getParam('SKU');
    
        $result = $this->pincodeRepository->findByPincodeAndSku($pincode, $sku);
        $result2 = $this->pincodeRepository->findBySkuAndAvailableMode($sku, 'all');
        $response = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        if ($result != null || $result2 != null) {
            $response->setData(true); // Pincode exists for the specified SKU
        } else {
            $response->setData(false); // Pincode does not exist or not associated with the SKU
        }
        return $response;
    }
}
