<?php

namespace Razecode\Banner\Controller\Adminhtml\Slide;

use Magento\Framework\Controller\ResultFactory;

class AddSlide extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\Registry
     */
    private $coreRegistry;

    /**
     * @var \Razecode\Banner\Model\GridFactory
     */
    private $slideFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry,
     * @param \Razecode\Banner\Model\GridFactory $gridFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Razecode\Banner\Model\SlideFactory $slideFactory
    ) {
        parent::__construct($context);
        $this->coreRegistry = $coreRegistry;
        $this->slideFactory = $slideFactory;
    }

    /**
     * Mapped Grid List page.
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $rowId = (int) $this->getRequest()->getParam('id');
        $rowData = $this->slideFactory->create();
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        if ($rowId) {
            $rowData = $rowData->load($rowId);
            $rowTitle = $rowData->getTitle();
            if (!$rowData->getSlideId()) {
                $this->messageManager->addErrorMessage(__('Slide data no longer exist.'));
                $this->_redirect('razecode_banner/slide/index');
                return;
            }
        }

        $this->coreRegistry->register('row_data', $rowData);
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $title = $rowId ? __('Edit Slide: ').$rowTitle : __('Add Slide');
        $resultPage->getConfig()->getTitle()->prepend($title);
        return $resultPage;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Razecode_Banner::banner');
    }
}
