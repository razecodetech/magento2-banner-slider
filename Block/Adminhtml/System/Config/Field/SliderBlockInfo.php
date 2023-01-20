<?php

namespace Razecode\Banner\Block\Adminhtml\System\Config\Field;

class SliderBlockInfo extends \Magento\Config\Block\System\Config\Form\Field
{
    /**
     * Template path
     *
     * @var string
     */
    protected $_template = 'Razecode_Banner::system/config/Field/SliderBlockInfo.phtml';

    /**
     * Render fieldset html
     *
     * @param \Magento\Framework\Data\Form\Element\AbstractElement $element
     * @return string
     */
    public function render(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        return $this->_decorateRowHtml($element, "<td colspan='2'>" . $this->toHtml() . '</td>');
    }
}
