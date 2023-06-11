<?php

namespace Codilar\Pincode\Controller\Adminhtml\Pin;

use Magento\Backend\App\Action;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Controller\ResultFactory;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Magento\Framework\App\Action\HttpPostActionInterface;

class Actions extends Action implements HttpPostActionInterface
{
    protected $uploaderFactory;
    protected $mediaDirectory;

    public function __construct(
        Action\Context $context,
        UploaderFactory $uploaderFactory,
        \Magento\Framework\Filesystem $filesystem
    ) {
        parent::__construct($context);
        $this->uploaderFactory = $uploaderFactory;
        $this->mediaDirectory = $filesystem->getDirectoryWrite(DirectoryList::MEDIA);
    }

    public function execute()
    {
        try {
            $uploader = $this->uploaderFactory->create(['fileId' => 'csv_file_upload']);
            $uploader->setAllowedExtensions(['csv']);
            $uploader->setAllowRenameFiles(true);
            $uploader->setFilesDispersion(true);

            $uploader->save($this->mediaDirectory->getAbsolutePath('csv_upload'));

            // Process the uploaded CSV file

            $this->messageManager->addSuccessMessage(__('CSV file uploaded successfully.'));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('An error occurred while uploading the CSV file.'));
        }

        $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $redirect->setUrl($this->_redirect->getRefererUrl());
        return $redirect;
    }
}
