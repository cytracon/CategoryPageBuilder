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

class Image extends \Cytracon\CategoryPageBuilder\Data\Element
{
    /**
     * @return \Cytracon\Builder\Data\Form\Element\Fieldset
     */
    public function prepareGeneralTab()
    {
        $general = parent::prepareGeneralTab();

            $container1 = $general->addContainerGroup(
                'container1',
                [
                    'sortOrder' => 10
                ]
            );

                $container1->addChildren(
                    'image_width',
                    'number',
                    [
                        'sortOrder'       => 10,
                        'key'             => 'image_width',
                        'templateOptions' => [
                            'label'   => __('Image Width')
                        ]
                    ]
                );

                $container1->addChildren(
                    'image_height',
                    'number',
                    [
                        'sortOrder'       => 20,
                        'key'             => 'image_height',
                        'templateOptions' => [
                            'label'   => __('Image Height')
                        ]
                    ]
                );

        return $general;
    }
}
