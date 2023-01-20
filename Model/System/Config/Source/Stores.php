<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

/**
 * Used in creating options for Yes|No config value selection
 *
 */
namespace Razecode\Banner\Model\System\Config\Source;

class Stores implements \Magento\Framework\Option\ArrayInterface
{

    protected $storeFactory;

    public function __construct(\Magento\Store\Model\System\Store $storeFactory)
    {
        $this->storeFactory = $storeFactory;
    }

    public function toOptionArray()
    {
        $options = $this->storeFactory->getStoreValuesForForm();
        return $options;
    }

    public function toArray()
    {

    }
}
