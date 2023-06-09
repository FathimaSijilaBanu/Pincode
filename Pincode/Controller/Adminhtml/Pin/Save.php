<?php

namespace Codilar\Pincode\Controller\Adminhtml\Pin;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Session\SessionManagerInterface;
use Magento\Framework\Controller\ResultFactory;
use Codilar\Pincode\Api\PincodeRepositoryInterface;
use Codilar\Pincode\Api\Data\PincodeInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;

class Save extends Action implements HttpPostActionInterface
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    public const ADMIN_RESOURCE = 'Codilar_Pincode::pincode';

    /**
     * @var PincodeRepositoryInterface
     */
    protected $pincodeRepository;

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var SessionManagerInterface
     */
    protected $sessionManager;

    /**
     * @param Context $context
     * @param PincodeRepositoryInterface $pincodeRepository
     * @param PageFactory $resultPageFactory
     * @param SessionManagerInterface $sessionManager
     */
    public function __construct(
        Context $context,
        PincodeRepositoryInterface $pincodeRepository,
        PageFactory $resultPageFactory,
        SessionManagerInterface $sessionManager
    ) {
        parent::__construct($context);
        $this->pincodeRepository = $pincodeRepository;
        $this->resultPageFactory = $resultPageFactory;
        $this->sessionManager = $sessionManager;
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $pincode = $this->pincodeRepository->getNew();

        // Retrieves the data submitted by the user in the form of an associative array
        $data = $this->getRequest()->getPostValue();

        try {
            if (!empty($data['id'])) {
                $pincode = $this->pincodeRepository->getById($data['id']);
            }
            $pincode->setSku($data['SKU']);
            $pincode->setPincode($data['pincode']);
            $pincode->setAvailableMode($data['available_mode']);
            $this->pincodeRepository->save($pincode);

            // Check for `back` parameter
            if ($this->getRequest()->getParam('back')) {
                return $resultRedirect->setPath('*/*/edit', ['id' => $pincode->getId(), '_current' => true, '_use_rewrite' => true]);
            }

            $this->messageManager->addSuccess(__('The pincode has been saved.'));
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }

        return $resultRedirect->setPath('*/*/');
    }
}
