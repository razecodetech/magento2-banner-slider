<?php

namespace Razecode\Banner\Block;

use Magento\Store\Model\ScopeInterface;

class BannerSlider extends \Magento\Framework\View\Element\Template
{
    /**
     * @var string
     */
    const MODULE_ENABLED = 'banner/general/enable';

    /**
     * Section name of module configuration
     */
    const CONFIG_SECTION = 'banner';

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var \Razecode\Banner\Model\ResourceModel\Slide\CollectionFactory
     */
    private $sliderCollectionFactory;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var \Razecode\Banner\Model\ResourceModel\Slide\Collection|null
     */
    private $sliderCollection = null;

    /**
     * Bannerslider constructor.
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Razecode\Banner\Model\ResourceModel\Slide\CollectionFactory $sliderCollectionFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Razecode\Banner\Model\ResourceModel\Slide\CollectionFactory $sliderCollectionFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->scopeConfig = $scopeConfig;
        $this->sliderCollectionFactory = $sliderCollectionFactory;
        $this->storeManager = $storeManager;
    }


    /**
     * @return mixed
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getMediaUrl()
    {
        return $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
    }

    /**
     * Get settings
     *
     * @return string
     */
    public function getConfigValue($optionString)
    {
        return $this->scopeConfig->getValue(self::CONFIG_SECTION . '/' . $optionString, ScopeInterface::SCOPE_STORE);
    }

    /**
     * @return mixed
     */
    public function isActive()
    {
        return $this->scopeConfig->getValue(self::MODULE_ENABLED, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /**
     * @return \Razecode\Banner\Model\ResourceModel\Slide\Collection
     */
    public function getBannerSliders()
    {
        if ($this->sliderCollection == null && $this->isActive()) {
            $storeId = $this->storeManager->getStore()->getId();
            $this->sliderCollection = $this->sliderCollectionFactory->create();
            $this->sliderCollection->addFieldToFilter('is_active', \Razecode\Banner\Model\Status::STATUS_ENABLED);
            $this->sliderCollection->getSelect()->join(
                array('banner_store' => 'razecode_banner_store'),
                "main_table.slide_id = banner_store.slide_id AND banner_store.store_id IN (0, $storeId)"
            );
            $this->sliderCollection->addOrder('sort_order', 'ASC');
        }
        return $this->sliderCollection;
    }
}
