<?php

namespace Codilar\Pincode\Controller\Adminhtml\Pin;

use Codilar\Pincode\Api\PincodeRepositoryInterface;
use Codilar\Pincode\Model\CouldNotDeleteException;
use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\App\Action\HttpGetActionInterface;

class Delete extends Action implements HttpGetActionInterface
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
    private $pincodeRepository;

    /**
     * Delete constructor.
     *
     * @param Action\Context $context
     * @param PincodeRepositoryInterface $pincodeRepository
     */
    public function __construct(
        Action\Context $context,
        PincodeRepositoryInterface $pincodeRepository
    ) {
        parent::__construct($context);
        $this->pincodeRepository = $pincodeRepository;
    }

    /**
     * Delete action
     *
     * @return Redirect
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $resultRedirect = $this->resultRedirectFactory->create();

        try {
            if ($id) {
                $pincode = $this->pincodeRepository->getById($id);
                $this->pincodeRepository->delete($pincode);
                $this->messageManager->addSuccess(
                    __('Pincode has been deleted.')
                );
                return $resultRedirect->setPath('*/*/');
            } else {
                $this->messageManager->addError(
                    __('We can\'t find the pincode to delete.')
                );
            }
        } catch (NoSuchEntityException $e) {
            $this->messageManager->addError(
                __('We can\'t find the pincode to delete.')
            );
        } catch (CouldNotDeleteException $e) {
            $this->messageManager->addError($e->getMessage());
            return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
        } catch (LocalizedException $e) {
            $this->messageManager->addError($e->getMessage());
        }

        return $resultRedirect->setPath('*/*/');
    }
}
