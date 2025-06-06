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

namespace Cytracon\CategoryPageBuilder\Block\Category\Element;

class Image extends \Cytracon\CategoryPageBuilder\Block\Category\Element
{
    /**
     * @return boolean
     */
    public function isEnabled()
    {
        $category = $this->getCategory();

        if (!$category->getImageUrl()) {
            return false;
        }

        return parent::isEnabled();
    }

    /**
     * @return string
     */
    public function getAdditionalStyleHtml()
    {
        $styleHtml = parent::getAdditionalStyleHtml();
        $element   = $this->getElement();

        $styles['width'] = $this->getStyleProperty($element->getData('image_width'));
        $styles['height'] = $this->getStyleProperty($element->getData('image_height'));
        $styleHtml .= $this->getStyles('.cpb-category-image', $styles);

        return $styleHtml;
    }
}
