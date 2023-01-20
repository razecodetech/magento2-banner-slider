<?php

namespace Razecode\Banner\Model;

class SlideStore extends \Magento\Framework\Model\AbstractModel
{
    /**
     * CMS page cache tag.
     */
    const CACHE_TAG = 'razecode_banner_store';

    /**
     * @var string
     */
    protected $_cacheTag = 'razecode_banner_store';

    /**
     * Prefix of model events names.
     *
     * @var string
     */
    protected $_eventPrefix = 'razecode_banner_store';

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init('Razecode\Banner\Model\ResourceModel\SlideStore');
    }
    
}
