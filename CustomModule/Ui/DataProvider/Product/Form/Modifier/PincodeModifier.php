<?php

namespace Codilar\CustomModule\Ui\DataProvider\Product\Form\Modifier;

use Magento\Catalog\Model\Locator\LocatorInterface;
use Magento\Framework\Stdlib\ArrayManager;
use Magento\Ui\DataProvider\Modifier\ModifierInterface;
use Magento\Framework\App\ResourceConnection;

class PincodeModifier implements ModifierInterface
{
    private $locator;
    private $arrayManager;
    private $resourceConnection;

    public function __construct(
        LocatorInterface $locator,
        ArrayManager $arrayManager,
        ResourceConnection $resourceConnection
    ) {
        $this->locator = $locator;
        $this->arrayManager = $arrayManager;
        $this->resourceConnection = $resourceConnection;
    }

    public function modifyData(array $data)
    {
        $product = $this->locator->getProduct();
        $productId = $product->getId();
        if ($productId) {
            $existingPincodes = $this->getAssignPincodes($productId);
            $data[$productId]['assign_pincodes']['dynamic_row'] = $existingPincodes;
        }

        return $data;
    }

    public function modifyMeta(array $meta)
    {
        return $meta;
    }

    private function getAssignPincodes($productId)
    {
        $existingPincodes = [];
        $connection = $this->resourceConnection->getConnection();
        $tableName = $this->resourceConnection->getTableName('custom_pincodes');

        $select = $connection->select()
            ->from($tableName, 'pincode')
            ->where('product_id = ?', $productId);

        $result = $connection->fetchAll($select);
        var_dump($result);

        foreach ($result as $row) {
            $existingPincodes[] = $row['pincode'];
        }

        return $existingPincodes;
    
    }
}
