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

class Products extends \Cytracon\CategoryPageBuilder\Block\Category\Element
{
    /**
     * @return array
     */
    public function getWrapperClasses()
    {
        $classes = parent::getWrapperClasses();
        $element = $this->getElement();
        $classes[] = 'cpb-grid-col-' . $element->getData('grid_columns');
        return $classes;
    }
}
