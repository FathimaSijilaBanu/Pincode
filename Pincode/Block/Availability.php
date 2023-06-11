<?php

namespace Codilar\Pincode\Block;

use Magento\Framework\View\Element\Template;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\App\RequestInterface;
use Codilar\Pincode\Api\PincodeRepositoryInterface;
use Magento\Framework\App\ResourceConnection;

class Availability extends Template
{
    protected $productRepository;
    protected $request;
    protected $pincodeRepository;
    protected $connection;

    public function __construct(
        Template\Context $context,
        ProductRepositoryInterface $productRepository,
        RequestInterface $request,
        PincodeRepositoryInterface $pincodeRepository,
        ResourceConnection $resource,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->productRepository = $productRepository;
        $this->request = $request;
        $this->pincodeRepository = $pincodeRepository;
        $this->connection = $resource->getConnection();
    }

    public function getCurrentProduct()
    {
        $productId = $this->request->getParam('id');
        if ($productId) {
            try {
                return $this->productRepository->getById($productId);
            } catch (\Exception $e) {
                return null;
            }
        }
        return null;
    }

    public function getCurrentProductSku()
    {
        $product = $this->getCurrentProduct();
        if ($product) {
            $productData = $product->getData();
            if (isset($productData['sku'])) {
                return $productData['sku'];
            }
        }
        return null;
    }
}
