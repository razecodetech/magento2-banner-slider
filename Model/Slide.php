<?php

namespace Razecode\Banner\Model;

use Razecode\Banner\Api\Data\SlideInterface;

class Slide extends \Magento\Framework\Model\AbstractModel implements SlideInterface
{
    /**
     * CMS page cache tag.
     */
    const CACHE_TAG = 'razecode_banner';

    /**
     * @var string
     */
    protected $_cacheTag = 'razecode_banner';

    /**
     * Prefix of model events names.
     *
     * @var string
     */
    protected $_eventPrefix = 'razecode_banner';

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init('Razecode\Banner\Model\ResourceModel\Slide');
    }
    /**
     * Get SlideId.
     *
     * @return int
     */
    public function getSlideId()
    {
        return $this->getData(self::SLIDE_ID);
    }

    /**
     * Set SlideId.
     */
    public function setSlideId($slideId)
    {
        return $this->setData(self::SLIDE_ID, $slideId);
    }

    /**
     * Get Title.
     *
     * @return varchar
     */
    public function getTitle()
    {
        return $this->getData(self::TITLE);
    }

    /**
     * Set Title.
     */
    public function setTitle($title)
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * Get getSlideImageDesktop.
     *
     * @return varchar
     */
    public function getSlideImageDesktop()
    {
        return $this->getData(self::SLIDE_IMAGE_DESKTOP);
    }

    /**
     * Set setSlideImageDesktop.
     */
    public function setSlideImageDesktop($slide_image_desktop)
    {
        return $this->setData(self::SLIDE_IMAGE_DESKTOP, $slide_image_desktop);
    }

    /**
     * Get slide_image_tablet.
     *
     * @return varchar
     */
    public function getSlideImageTablet()
    {
        return $this->getData(self::SLIDE_IMAGE_TABLET);
    }

    /**
     * Set slide_image_tablet.
     */
    public function setSlideImageTablet($slide_image_tablet)
    {
        return $this->setData(self::SLIDE_IMAGE_TABLET, $slide_image_tablet);
    }

    /**
     * Get slide_image_tablet.
     *
     * @return varchar
     */
    public function getSlideImageMobile()
    {
        return $this->getData(self::SLIDE_IMAGE_MOBILE);
    }

    /**
     * Set slide_image_tablet.
     */
    public function setSlideImageMobile($slide_image_mobile)
    {
        return $this->setData(self::SLIDE_IMAGE_MOBILE, $slide_image_mobile);
    }

    /**
     * Get IsActive.
     *
     * @return varchar
     */
    public function getIsActive()
    {
        return $this->getData(self::IS_ACTIVE);
    }

    /**
     * Set IsActive.
     */
    public function setIsActive($isActive)
    {
        return $this->setData(self::IS_ACTIVE, $isActive);
    }

    /**
     * Get UpdateTime.
     *
     * @return varchar
     */
    public function getUpdateTime()
    {
        return $this->getData(self::UPDATE_TIME);
    }

    /**
     * Set UpdateTime.
     */
    public function setUpdateTime($updateTime)
    {
        return $this->setData(self::UPDATE_TIME, $updateTime);
    }

    /**
     * Get CreatedAt.
     *
     * @return varchar
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * Set CreatedAt.
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }
}
