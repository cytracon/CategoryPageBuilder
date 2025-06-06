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

class SubCategories extends \Cytracon\Builder\Block\ElementStyle
{
    /**
     * @return string
     */
    public function getAdditionalStyleHtml()
    {
        $styleHtml = parent::getAdditionalStyleHtml();
        $element   = $this->getElement();

        $displayStyle = $element->getData('display_style');

        $styles = [];
        $styles['color'] = $this->getStyleColor($element->getData('name_color'));
        $styles['background-color'] = $this->getStyleColor($element->getData('name_bg_color'));
        $styles['font-size']   = $this->getStyleProperty($element->getData('name_font_size'));
        $styles['font-weight'] = $element->getData('name_font_weight');
        $styleHtml .= $this->getStyles('.subcategory-name', $styles);

        if ($displayStyle == 'style2') {
            $styles = [];
            $styles['background-color'] = $this->getStyleColor($element->getData('overlay_color'));
            $styleHtml .= $this->getStyles('.subcategory:hover .mgz-overlay', $styles);
        }

        if ($displayStyle == 'style1') {
            $styles = [];
            $styles['border-color'] = $this->getStyleColor($element->getData('box_border_color'));
            $styleHtml .= $this->getStyles('.subcategory-inner', $styles);

            $styles = [];
            $styles['border-color'] = $this->getStyleColor($element->getData('box_hover_border_color'));
            $styleHtml .= $this->getStyles('.subcategory-inner:hover', $styles);
        }

        return $styleHtml;
    }
}
