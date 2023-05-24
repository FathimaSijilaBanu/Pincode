<?php

namespace Codilar\CustomModule\Model\Product;

use Magento\Catalog\Model\Locator\LocatorInterface;
use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier;
use Magento\Ui\Component\Form\Element\Input;
use Magento\Ui\Component\DynamicRows;
use Magento\Ui\Component\Container;
use Magento\Ui\Component\Form\Element\DataType\Text;
use Codilar\CustomModule\Api\PincodeRepositoryInterface;

class PincodeDataProvider extends AbstractModifier
{
    /**
     * @var LocatorInterface
     */
    private $locator;

    /**
     * @var PincodeRepositoryInterface
     */
    private $pincodeRepository;

    public function __construct(
        LocatorInterface $locator,
        PincodeRepositoryInterface $pincodeRepository
    ) {
        $this->locator = $locator;
        $this->pincodeRepository = $pincodeRepository;
    }

    public function modifyData(array $data)
    {
        // Retrieve the product ID
        $productId = $this->locator->getProduct()->getId();

        // Initialize the dynamic row array
        $data[$productId]['product']['assign_pincodes']['dynamic_row'] = [];
        // Retrieve the pincode values from your custom source based on the product ID
        $pincodeValues = $this->getPincodeValues($productId);

        // Iterate through the pincode values and add them to the dynamic row
        foreach ($pincodeValues as $pincodeValue) {
            $data[$productId]['product']['assign_pincodes']['dynamic_row'][]['pincodes'] = $pincodeValue;
        }

        return $data;
    }

    public function modifyMeta(array $meta)
    {
        // Modify the meta array as needed
        return $meta;
    }
    /**
     * Get the pincode values from your custom repository.
     *
     * @param int $productId
     * @return array
     */
    private function getPincodeValues($productId)
    {
        $pincodeValues = [];
        $pincodes = $this->pincodeRepository->getByProductId($productId);
        foreach ($pincodes as $pincode) {
            $pincodeValues[] = $pincode->getPincode();
        }
        return $pincodeValues;
    }
}
