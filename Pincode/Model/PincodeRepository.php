<?php

namespace Codilar\Pincode\Model;

use Codilar\Pincode\Api\PincodeRepositoryInterface;
use Codilar\Pincode\Api\Data\PincodeInterface;
use Codilar\Pincode\Model\ResourceModel\Pincode as PincodeResourceModel;
use Codilar\Pincode\Model\ResourceModel\Pincode\CollectionFactory as PincodeCollectionFactory;
use Codilar\Pincode\Model\PincodeFactory;

class PincodeRepository implements PincodeRepositoryInterface
{
    protected $pincodeResourceModel;
    protected $pincodeCollectionFactory;
    protected $pincodeFactory;

    public function __construct(
        PincodeResourceModel $pincodeResourceModel,
        PincodeCollectionFactory $pincodeCollectionFactory,
        PincodeFactory $pincodeFactory
    ) {
        $this->pincodeResourceModel = $pincodeResourceModel;
        $this->pincodeCollectionFactory = $pincodeCollectionFactory;
        $this->pincodeFactory = $pincodeFactory;
    }

    public function save(PincodeInterface $pincode)
    {
        // dd($pincode->getData());
        $this->pincodeResourceModel->save($pincode);
        return $pincode;
    }

    public function getById($pincodeId)
    {
        $pincode = $this->pincodeCollectionFactory->create()->getItemById($pincodeId);
        return $pincode;
    }

    public function delete(PincodeInterface $pincode)
    {
        $this->pincodeResourceModel->delete($pincode);
        return true;
    }

    public function deleteById($pincodeId)
    {
        $pincode = $this->getById($pincodeId);
        if ($pincode) {
            return $this->delete($pincode);
        }
        return false;
    }

    /**
     * @inheritdoc
     */
    public function getNew()
    {
        return $this->pincodeFactory->create();
    }

    /**
     * @inheritdoc
     */
    public function findByPincodeAndSku($pincode, $sku)
    {
        $pincodeCollection = $this->pincodeCollectionFactory->create();
        $pincodeCollection->addFieldToFilter('pincode', ['eq' => $pincode]);
        $pincodeCollection->addFieldToFilter('SKU', ['eq' => $sku]);
        $pincodeCollection->setPageSize(1);
        $pincodeModel = null;
        foreach ($pincodeCollection as $pincodeItem) {
            $pincodeModel = $pincodeItem;
            break;
        }
        if ($pincodeModel) {
            return $pincodeModel;
        }
        return null;
    }
    /**
     * @inheritdoc
     */
    public function findBySkuAndAvailableMode($sku)
    {
        $pincodeCollection = $this->pincodeCollectionFactory->create();
        $pincodeCollection->addFieldToFilter('SKU', ['eq' => $sku]);
        $pincodeCollection->addFieldToFilter('available_mode', ['eq' => 'all']);
        $pincodeCollection->setPageSize(1);
        foreach ($pincodeCollection as $pincodeItem) {
            return $pincodeItem; // Return the first matching pincode model
        }
        return null; // No matching pincode with available mode "all" found
    }
}
