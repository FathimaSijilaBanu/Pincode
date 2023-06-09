<?php

namespace Codilar\Pincode\Controller\Adminhtml\Pin;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\File\Csv;
use Codilar\Pincode\Api\PincodeRepositoryInterface;
use Codilar\Pincode\Api\Data\PincodeInterfaceFactory;

class UploadPost extends Action
{
    protected $csvProcessor;
    protected $pincodeRepository;
    protected $pincodeInterfaceFactory;

    public function __construct(
        Action\Context $context,
        Csv $csvProcessor,
        PincodeRepositoryInterface $pincodeRepository,
        PincodeInterfaceFactory $pincodeInterfaceFactory
    ) {
        parent::__construct($context);
        $this->csvProcessor = $csvProcessor;
        $this->pincodeRepository = $pincodeRepository;
        $this->pincodeInterfaceFactory = $pincodeInterfaceFactory;
    }

    public function execute()
    {
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        try {
            $file = $this->getRequest()->getFiles('csv_file');
            $data = $this->csvProcessor->getData($file['tmp_name']);
            $headers = array_shift($data); // Retrieve column headers
            $headers = array_map(function ($header) {
                // Remove unwanted characters and leading/trailing whitespace
                return trim(preg_replace('/[^(\x20-\x7F)]+/', '', $header));
            }, $headers);
            $pincodeIndex = array_search('pincode', $headers);
            $skuIndex = array_search('SKU', $headers);
            foreach ($data as $row) {
                // Check if the sku and pincode indexes exist in the row
                if (isset($row[$skuIndex])) {
                    $sku = $row[$skuIndex];
                } else {
                    continue; // Skip this row if sku is not found
                }

                if (isset($row[$pincodeIndex])) {
                    $pincode = $row[$pincodeIndex];
                } else {
                    continue; // Skip this row if pincode is not found
                }
                // Convert SKU and pincode to normal string
                $sku = $this->convertToNormalString($sku);
                $pincode = $this->convertToNormalString($pincode);
                $pincodeModel = $this->pincodeInterfaceFactory->create();
                $pincodeModel->setSku($sku);
                $pincodeModel->setPincode($pincode);
                $pincodeModel->setAvailableMode('custom');
                $this->pincodeRepository->save($pincodeModel);
            }
            $this->messageManager->addSuccessMessage(__('CSV file uploaded successfully.'));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__($e->getMessage()));
        }
        $resultRedirect->setPath('pincode/pin/index');
        return $resultRedirect;
    }
    /**
     * Convert a string to a normal string without any special characters or spaces.
     *
     * @param string $value
     * @return string
     */
    private function convertToNormalString($value)
    {
        $value = preg_replace('/[^A-Za-z0-9\-]/', '', $value);
        return $value;
    }
}
