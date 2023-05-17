<?php

namespace Codilar\CustomModule\Model;

use Codilar\CustomModule\Api\Data\PincodeInterface;
use Codilar\CustomModule\Api\PincodeRepositoryInterface;
use Codilar\CustomModule\Model\ResourceModel\Pincode as PincodeResource;
use Codilar\CustomModule\Model\ResourceModel\Pincode\CollectionFactory as PincodeCollectionFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;

class PincodeRepository implements PincodeRepositoryInterface
{
    protected $pincodeResource;
    protected $pincodeFactory;
    protected $pincodeCollectionFactory;
    protected $dataObjectHelper;
    protected $dataObjectProcessor;
    protected $collectionProcessor;

    public function __construct(
        PincodeResource $pincodeResource,
        PincodeFactory $pincodeFactory,
        PincodeCollectionFactory $pincodeCollectionFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->pincodeResource = $pincodeResource;
        $this->pincodeFactory = $pincodeFactory;
        $this->pincodeCollectionFactory = $pincodeCollectionFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->collectionProcessor = $collectionProcessor;
    }

    public function save(PincodeInterface $pincode)
    {
        try {
            $this->pincodeResource->save($pincode);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        }
        return $pincode;
    }

    public function getById($pincodeId)
    {
        $pincode = $this->pincodeFactory->create();
        $this->pincodeResource->load($pincode, $pincodeId);
        if (!$pincode->getId()) {
            throw new NoSuchEntityException(__('Pincode with id "%1" does not exist.', $pincodeId));
        }
        return $pincode;
    }

    public function delete(PincodeInterface $pincode)
    {
        try {
            $this->pincodeResource->delete($pincode);
        } catch (\Exception $e) {
            throw new CouldNotDeleteException(__($e->getMessage()));
        }
        return true;
    }

    public function deleteById($pincodeId)
    {
        $pincode = $this->getById($pincodeId);
        return $this->delete($pincode);
    }
    public function getByProductId($productId)
    {
        $pincodeCollection = $this->pincodeCollectionFactory->create();
        $pincodeCollection->addFieldToFilter('product_id', $productId);
        return $pincodeCollection->getItems();
    }
    public function findByPincodeAndProductId($pincode, $productId)
    {
        $pincodeCollection = $this->pincodeCollectionFactory->create();
        $pincodeCollection->addFieldToFilter('pincode', $pincode);
        $pincodeCollection->addFieldToFilter('product_id', $productId);
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
}
