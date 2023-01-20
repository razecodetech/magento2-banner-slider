<?php

namespace Razecode\Banner\Api\Data;

interface SlideInterface
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case.
     */
    const SLIDE_ID = 'slide_id';
    const TITLE = 'title';
    const SLIDE_IMAGE_DESKTOP = 'slide_image_desktop';
    const SLIDE_IMAGE_TABLET = 'slide_image_tablet';
    const SLIDE_IMAGE_MOBILE = 'slide_image_mobile';
    const VIDEO = 'video';
    const IS_ACTIVE = 'is_active';
    const UPDATE_TIME = 'update_time';
    const CREATED_AT = 'created_at';

   /**
    * Get SlideId.
    *
    * @return int
    */
    public function getSlideId();

   /**
    * Set SlideId.
    */
    public function setSlideId($slideId);

   /**
    * Get Title.
    *
    * @return varchar
    */
    public function getTitle();

   /**
    * Set Title.
    */
    public function setTitle($title);

    /**
     * Get slide_image_desktop.
     *
     * @return varchar
     */
    public function getSlideImageDesktop();

    /**
     * Set slide_image_desktop.
     */
    public function setSlideImageDesktop($slide_image_desktop);

    /**
     * Get slide_image_tablet.
     *
     * @return varchar
     */
    public function getSlideImageTablet();

    /**
     * Set slide_image_tablet.
     */
    public function setSlideImageTablet($slide_image_tablet);

    /**
     * Get slide_image_mobile.
     *
     * @return varchar
     */
    public function getSlideImageMobile();

    /**
     * Set slide_image_mobile.
     */
    public function setSlideImageMobile($slide_image_mobile);

   /**
    * Get IsActive.
    *
    * @return varchar
    */
    public function getIsActive();

   /**
    * Set StartingPrice.
    */
    public function setIsActive($isActive);

   /**
    * Get UpdateTime.
    *
    * @return varchar
    */
    public function getUpdateTime();

   /**
    * Set UpdateTime.
    */
    public function setUpdateTime($updateTime);

   /**
    * Get CreatedAt.
    *
    * @return varchar
    */
    public function getCreatedAt();

   /**
    * Set CreatedAt.
    */
    public function setCreatedAt($createdAt);
}
