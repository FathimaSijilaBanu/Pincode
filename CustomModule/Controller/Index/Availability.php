<?php
namespace Codilar\CustomModule\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Codilar\CustomModule\Api\Data\PincodeInterface;
use Codilar\CustomModule\Api\PincodeRepositoryInterface;
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
        $pincode = $this->getRequest()->getParam('pincode');
        $productId = $this->getRequest()->getParam('product_id');
    
        $result = $this->pincodeRepository->findByPincodeAndProductId($pincode, $productId);
    
        $response = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        if ($result !== null) {
            $response->setData(true); // Pincode exists for the specified product
        } else {
            $response->setData(false); // Pincode does not exist or not associated with the product
        }
        return $response;
    }  
    
}
