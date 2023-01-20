<?php

namespace Razecode\Banner\Controller\Adminhtml\Slide;

class Save extends \Magento\Backend\App\Action
{
    /**
     * @var \Razecode\Banner\Model\GridFactory
     */
    var $slideFactory;

    var $slideStoreFactory;

    /**
    * @var \Magento\Framework\Image\AdapterFactory
    */
    protected $adapterFactory;
    /**
    * @var \Magento\MediaStorage\Model\File\UploaderFactory
    */
    protected $uploader;
    /**
    * @var \Magento\Framework\Filesystem
    */
    protected $filesystem;
    /**
    * @var \Magento\Framework\Stdlib\DateTime\TimezoneInterface
    */
    protected $timezoneInterface;

    protected $connection;

    protected $resource;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Razecode\Banner\Model\GridFactory $slideFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Razecode\Banner\Model\SlideFactory $slideFactory,
        \Razecode\Banner\Model\SlideStoreFactory $slideStoreFactory,
        \Magento\Framework\Image\AdapterFactory $adapterFactory,
        \Magento\MediaStorage\Model\File\UploaderFactory $uploader,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\Framework\App\ResourceConnection $resource,
        \Razecode\Banner\Model\SlideStoreFactory $bannerStoreFactory
    ) {
        parent::__construct($context);
        $this->slideFactory = $slideFactory;
        $this->slideStoreFactory = $slideStoreFactory;
        $this->adapterFactory = $adapterFactory;
        $this->uploader = $uploader;
        $this->filesystem = $filesystem;
        $this->connection = $resource->getConnection();
        $this->resource = $resource;
        $this->bannerStoreFactory = $bannerStoreFactory;
    }


    /**
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        if (!$data) {
            $this->_redirect('razecode_banner/slide/addslide');
            return;
        }
        try {

            //start block upload slide_image_desktop
            if (isset($_FILES['slide_image_desktop'])
            && isset($_FILES['slide_image_desktop']['name'])
            && strlen($_FILES['slide_image_desktop']['name'])) {
                /*
                 * Save slide_image_desktop upload
                 */
                try {
                    $base_media_path = 'razecode/banner';
                    $uploader = $this->uploader->create(['fileId' => 'slide_image_desktop']);
                    $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
                    $imageAdapter = $this->adapterFactory->create();
                    $uploader->addValidateCallback('slide_image_desktop', $imageAdapter, 'validateUploadFile');
                    $uploader->setAllowRenameFiles(true);
                    $uploader->setFilesDispersion(true);
                    $mediaDirectory = $this->filesystem->getDirectoryRead(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
                    $result = $uploader->save($mediaDirectory->getAbsolutePath($base_media_path));
                    $data['slide_image_desktop'] = $base_media_path.$result['file'];
                } catch (\Exception $e) {
                    if ($e->getCode() == 0) {
                        $this->messageManager->addErrorMessage($e->getMessage());
                    }
                }
			} else {
                if (isset($data['slide_image_desktop']) && isset($data['slide_image_desktop']['value'])) {
                    if (isset($data['slide_image_desktop']['delete'])) {
                        $data['slide_image_desktop'] = null;
                        $data['delete_image'] = true;
                    } elseif (isset($data['slide_image_desktop']['value'])) {
                        $data['slide_image_desktop'] = $data['slide_image_desktop']['value'];
                    } else {
                        $data['slide_image_desktop'] = null;
                    }
                }
            }

            //start block upload image
            if (isset($_FILES['slide_image_tablet']) && isset($_FILES['slide_image_tablet']['name']) && strlen($_FILES['slide_image_tablet']['name'])) {
                /*
                 * Save image upload
                 */
                try {
                    $base_media_path = 'razecode/banner';
                    $uploader = $this->uploader->create(['fileId' => 'slide_image_tablet']);
                    $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
                    $imageAdapter = $this->adapterFactory->create();
                    $uploader->addValidateCallback('slide_image_tablet', $imageAdapter, 'validateUploadFile');
                    $uploader->setAllowRenameFiles(true);
                    $uploader->setFilesDispersion(true);
                    $mediaDirectory = $this->filesystem->getDirectoryRead(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
                    $result = $uploader->save($mediaDirectory->getAbsolutePath($base_media_path));
                    $data['slide_image_tablet'] = $base_media_path . $result['file'];
                } catch (\Exception $e) {
                    if ($e->getCode() == 0) {
                        $this->messageManager->addErrorMessage($e->getMessage());
                    }
                }
            } else {
                if (isset($data['slide_image_tablet']) && isset($data['slide_image_tablet']['value'])) {
                    if (isset($data['slide_image_tablet']['delete'])) {
                        $data['slide_image_tablet'] = null;
                        $data['delete_image'] = true;
                    } elseif (isset($data['slide_image_tablet']['value'])) {
                        $data['slide_image_tablet'] = $data['slide_image_tablet']['value'];
                    } else {
                        $data['slide_image_tablet'] = null;
                    }
                }
            }

            //start block upload image
            if (isset($_FILES['slide_image_mobile']) && isset($_FILES['slide_image_mobile']['name']) && strlen($_FILES['slide_image_mobile']['name'])) {
                /*
                 * Save image upload
                 */
                try {
                    $base_media_path = 'razecode/banner';
                    $uploader = $this->uploader->create(['fileId' => 'slide_image_mobile']);
                    $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
                    $imageAdapter = $this->adapterFactory->create();
                    $uploader->addValidateCallback('slide_image_mobile', $imageAdapter, 'validateUploadFile');
                    $uploader->setAllowRenameFiles(true);
                    $uploader->setFilesDispersion(true);
                    $mediaDirectory = $this->filesystem->getDirectoryRead(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
                    $result = $uploader->save($mediaDirectory->getAbsolutePath($base_media_path));
                    $data['slide_image_mobile'] = $base_media_path . $result['file'];
                } catch (\Exception $e) {
                    if ($e->getCode() == 0) {
                        $this->messageManager->addErrorMessage($e->getMessage());
                    }
                }
            } else {
                if (isset($data['slide_image_mobile']) && isset($data['slide_image_mobile']['value'])) {
                    if (isset($data['slide_image_mobile']['delete'])) {
                        $data['slide_image_mobile'] = null;
                        $data['delete_image'] = true;
                    } elseif (isset($data['slide_image_mobile']['value'])) {
                        $data['slide_image_mobile'] = $data['slide_image_mobile']['value'];
                    } else {
                        $data['slide_image_mobile'] = null;
                    }
                }
            }
            
            $rowData = $this->slideFactory->create();
            $rowData->setData($data);
            if (isset($data['id'])) {
                $rowData->setSlideId($data['id']);
            }
            $rowData->save();

            $slideID = $rowData->getId();

            $this->updateMultiple('razecode_banner_store', $data['stores'], $slideID);

            $this->messageManager->addSuccess(__('Slide data has been successfully saved.'));
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
        $this->_redirect('razecode_banner/slide/index');
    }

    public function updateMultiple($table, $stores, $slideID)
    {
        try {
            $tableName = $this->resource->getTableName($table);
            $this->connection->beginTransaction();
            
            $oldStores = $this->lookupStoreIds($slideID);
            $newStores = (array)$stores;

            $insert = array_diff($newStores, $oldStores);
            $delete = array_diff($oldStores, $newStores);

            if ($delete) {
                $where = ['slide_id = ?' => (int)$slideID, 'store_id IN (?)' => $delete];

                $this->connection->delete($tableName, $where);
            }

            if ($insert) {
                $data = [];

                foreach ($insert as $storeId) {
                    $data[] = ['slide_id' => (int)$slideID, 'store_id' => (int)$storeId];
                }

                $this->connection->insertMultiple($tableName, $data);
            }

            $this->connection->commit();
            return true;
        } catch (\Exception $e) {
            $this->connection->rollBack();
            return false;
        }
    }

    public function lookupStoreIds($slideId)
    {
        $connection = $this->connection;

        $select = $connection->select()->from(
            $connection->getTableName('razecode_banner_store'),
            'store_id'
        )->where(
            'slide_id = ?',
            (int)$slideId
        );

        return $connection->fetchCol($select);
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Razecode_Banner::banner');
    }
}
