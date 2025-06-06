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

namespace Cytracon\CategoryPageBuilder\Data\Element;

class Description extends \Cytracon\CategoryPageBuilder\Data\Element
{
    /**
     * @return \Cytracon\Builder\Data\Form\Element\Fieldset
     */
    public function prepareGeneralTab()
    {
        $general = parent::prepareGeneralTab();

            $general->addChildren(
                'font_size',
                'text',
                [
                    'sortOrder'       => 10,
                    'key'             => 'font_size',
                    'templateOptions' => [
                        'label' => __('Font size')
                    ]
                ]
            );

            $general->addChildren(
                'color',
                'color',
                [
                    'key'             => 'color',
                    'sortOrder'       => 20,
                    'templateOptions' => [
                        'label' => __('Text Color')
                    ]
                ]
            );

            $general->addChildren(
                'line_height',
                'text',
                [
                    'sortOrder'       => 30,
                    'key'             => 'line_height',
                    'templateOptions' => [
                        'label' => __('Line height')
                    ]
                ]
            );

            $general->addChildren(
                'font_weight',
                'text',
                [
                    'sortOrder'       => 40,
                    'key'             => 'font_weight',
                    'templateOptions' => [
                        'label' => __('Font Weight')
                    ]
                ]
            );

        return $general;
    }
}
