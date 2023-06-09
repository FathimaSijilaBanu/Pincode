<?php

namespace Codilar\Pincode\Controller\Adminhtml\Pin;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;
use Codilar\Pincode\Api\PincodeRepositoryInterface;
use Codilar\Pincode\Api\Data\PincodeInterface;
use Magento\Framework\App\Action\HttpGetActionInterface;

class Edit extends Action implements HttpGetActionInterface
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    public const ADMIN_RESOURCE = 'Codilar_Pincode::pincode';

    /**
     * @var \Magento\Framework\Registry
     */
    private $coreRegistry;

    /**
     * @var PincodeRepositoryInterface
     */
    private $pincodeRepository;

    /**
     * @var \Codilar\Pincode\Model\PincodeFactory
     */
    private $pincodeFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Codilar\Pincode\Model\PincodeFactory $pincodeFactory
     * @param PincodeRepositoryInterface $pincodeRepository
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Codilar\Pincode\Model\PincodeFactory $pincodeFactory,
        PincodeRepositoryInterface $pincodeRepository
    ) {
        parent::__construct($context);
        $this->coreRegistry = $coreRegistry;
        $this->pincodeFactory = $pincodeFactory;
        $this->pincodeRepository = $pincodeRepository;
    }

    /**
     * Execute the controller action.
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $model = $this->pincodeFactory->create();

        if ($id) {
            $pincode = $this->pincodeRepository->getById($id);
            if (!$pincode) {
                $this->messageManager->addError(__('This entity no longer exists.'));
                return $this->_redirect('*/*/');
            }
            $model = $pincode;
        }

        $this->coreRegistry->register('pincode_data', $model);

        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->setActiveMenu('Codilar_Pincode::pincode');
        $resultPage->getConfig()->getTitle()->prepend(__('Pincode Editing Page'));

        return $resultPage;
    }
}
