<?php

namespace Codilar\Pincode\Controller\Adminhtml\Pin;

use Magento\Backend\App\Action;
use Magento\Framework\Exception\LocalizedException;
use Codilar\Pincode\Api\PincodeRepositoryInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Psr\Log\LoggerInterface;

class MassDelete extends Action implements HttpPostActionInterface
{
    /**
     * @var PincodeRepositoryInterface
     */
    private $pincodeRepository;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * MassDelete constructor.
     *
     * @param Action\Context $context
     * @param PincodeRepositoryInterface $pincodeRepository
     * @param LoggerInterface $logger
     */
    public function __construct(
        Action\Context $context,
        PincodeRepositoryInterface $pincodeRepository,
        LoggerInterface $logger
    ) {
        parent::__construct($context);
        $this->pincodeRepository = $pincodeRepository;
        $this->logger = $logger;
    }

    /**
     * MassDelete action
     *
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    public function execute()
    {
        $ids = $this->getRequest()->getParam('selected');
        if (empty($ids)) {
            $this->messageManager->addError(__('Please select pincode(s) to delete.'));
        } else {
            try {
                foreach ($ids as $id) {
                    $pincode = $this->pincodeRepository->getById($id);
                    $this->pincodeRepository->delete($pincode);
                }
                $this->messageManager->addSuccess(
                    __('Total of %1 pincode(s) have been deleted.', count($ids))
                );
            } catch (LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addError(
                    __(
                        'We can\'t delete the pincode(s) right now. Please review the log and try again.'
                    )
                );
                $this->logger->critical($e);
            }
        }

        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('*/*/');

        return $resultRedirect;
    }
}
