<?php
/**
 * Cytracon
 *
 * This source file is subject to the Cytracon Software License, which is available at https://www.cytracon.com/license
 * Do not edit or add to this file if you wish to upgrade the to newer versions in the future.
 * If you wish to customize this module for your needs.
 * Please refer to https://www.cytracon.com for more information.
 *
 * @category  Cytracon
 * @package   Cytracon_CategoryPageBuilder
 * @copyright Copyright (C) 2019 Cytracon (https://www.cytracon.com)
 */

namespace Cytracon\CategoryPageBuilder\Block\Style;

class Name extends \Cytracon\Builder\Block\ElementStyle
{
    /**
     * @return string
     */
    public function getAdditionalStyleHtml()
    {
        $styleHtml = parent::getAdditionalStyleHtml();
        $element   = $this->getElement();

        $styles['color']       = $this->getStyleColor($element->getData('color'));
        $styles['font-size']   = $this->getStyleProperty($element->getData('font_size'));
        $styles['line-height'] = $this->getStyleProperty($element->getData('line_height'));
        $styles['font-weight'] = $element->getData('font_weight');
        $styleHtml .= $this->getStyles('.cpb-category-name', $styles);

        return $styleHtml;
    }
}
