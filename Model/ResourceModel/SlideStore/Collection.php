<?php

namespace Razecode\Banner\Model\ResourceModel\SlideStore;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'slide_id';
    /**
     * Define resource model.
     */
    protected function _construct()
    {
        $this->_init(
            'Razecode\Banner\Model\SlideStore',
            'Razecode\Banner\Model\ResourceModel\SlideStore'
        );
    }

}
