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

class SubCategories extends \Cytracon\CategoryPageBuilder\Data\Element
{
    /**
     * Prepare modal components
     */
    public function prepareForm()
    {
        parent::prepareForm();
        $this->prepareGridTab();
        $this->prepareCarouselTab();
        return $this;
    }

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
                'layout',
                'select',
                [
                    'sortOrder'       => 10,
                    'key'             => 'layout',
                    'defaultValue'    => 'grid',
                    'templateOptions' => [
                        'label'   => __('Layout'),
                        'options' => $this->getLayout()
                    ]
                ]
            );

            $container1->addChildren(
                'display_style',
                'select',
                [
                    'sortOrder'       => 20,
                    'key'             => 'display_style',
                    'defaultValue'    => '',
                    'templateOptions' => [
                        'label'   => __('Display Style'),
                        'options' => $this->getDisplayStyle()
                    ]
                ]
            );

        $container2 = $general->addContainerGroup(
            'container2',
            [
                'sortOrder' => 20
            ]
        );

            $container2->addChildren(
                'show_name',
                'toggle',
                [
                    'sortOrder'       => 10,
                    'key'             => 'show_name',
                    'defaultValue'    => true,
                    'templateOptions' => [
                        'label' => __('Category Name')
                    ]
                ]
            );

            $container2->addChildren(
                'show_productcount',
                'toggle',
                [
                    'sortOrder'       => 20,
                    'key'             => 'show_productcount',
                    'defaultValue'    => true,
                    'templateOptions' => [
                        'label' => __('Category Product Count')
                    ]
                ]
            );

            $container2->addChildren(
                'show_image',
                'toggle',
                [
                    'sortOrder'       => 30,
                    'key'             => 'show_image',
                    'defaultValue'    => true,
                    'templateOptions' => [
                        'label' => __('Category Image')
                    ]
                ]
            );

        $container3 = $general->addContainerGroup(
            'container3',
            [
                'sortOrder'      => 30,
                'hideExpression' => '!model.show_image'
            ]
        );

            $container3->addChildren(
                'image_width',
                'number',
                [
                    'sortOrder'       => 10,
                    'key'             => 'image_width',
                    'templateOptions' => [
                        'label' => __('Image Width')
                    ]
                ]
            );

            $container3->addChildren(
                'image_height',
                'number',
                [
                    'sortOrder'       => 20,
                    'key'             => 'image_height',
                    'templateOptions' => [
                        'label' => __('Image Height')
                    ]
                ]
            );

        $container4 = $general->addContainerGroup(
            'container4',
            [
                'sortOrder' => 40
            ]
        );

            $container4->addChildren(
                'show_description',
                'toggle',
                [
                    'sortOrder'       => 10,
                    'key'             => 'show_description',
                    'templateOptions' => [
                        'label' => __('Category Description')
                    ]
                ]
            );

            $container4->addChildren(
                'description_length',
                'number',
                [
                    'sortOrder'       => 20,
                    'key'             => 'description_length',
                    'templateOptions' => [
                        'label' => __('Length')
                    ],
                    'hideExpression' => '!model.show_description'
                ]
            );

        $container5 = $general->addContainerGroup(
            'container5',
            [
                'sortOrder' => 50
            ]
        );

            $container5->addChildren(
                'name_font_size',
                'number',
                [
                    'sortOrder'       => 10,
                    'key'             => 'name_font_size',
                    'templateOptions' => [
                        'label' => __('Name Font Size')
                    ]
                ]
            );

            $container5->addChildren(
                'name_font_weight',
                'text',
                [
                    'sortOrder'       => 20,
                    'key'             => 'name_font_weight',
                    'templateOptions' => [
                        'label' => __('Name Font Weight')
                    ]
                ]
            );

        $container6 = $general->addContainerGroup(
            'container6',
            [
                'sortOrder' => 60
            ]
        );

            $container6->addChildren(
                'name_bg_color',
                'color',
                [
                    'sortOrder'       => 10,
                    'key'             => 'name_bg_color',
                    'templateOptions' => [
                        'label' => __('Name Background Color')
                    ]
                ]
            );

            $container6->addChildren(
                'name_color',
                'color',
                [
                    'sortOrder'       => 20,
                    'key'             => 'name_color',
                    'templateOptions' => [
                        'label' => __('Name Color')
                    ]
                ]
            );

            $container6->addChildren(
                'overlay_color',
                'color',
                [
                    'sortOrder'       => 30,
                    'key'             => 'overlay_color',
                    'templateOptions' => [
                        'label' => __('Overlay Color')
                    ],
                    'hideExpression' => 'model.display_style!="style2"'
                ]
            );

        $container7 = $general->addContainerGroup(
            'container7',
            [
                'sortOrder' => 70,
                'hideExpression' => 'model.display_style!="style1"'
            ]
        );

            $container7->addChildren(
                'box_border_color',
                'color',
                [
                    'sortOrder'       => 10,
                    'key'             => 'box_border_color',
                    'templateOptions' => [
                        'label' => __('Border Color')
                    ]
                ]
            );

            $container7->addChildren(
                'box_hover_border_color',
                'color',
                [
                    'sortOrder'       => 20,
                    'key'             => 'box_hover_border_color',
                    'templateOptions' => [
                        'label' => __('Hover Border Color')
                    ]
                ]
            );

        return $general;
    }

    /**
     * @return array
     */
    public function getLayout()
    {
        return [
            [
                'label' => __('Grid'),
                'value' => 'grid'
            ],
            [
                'label' => __('List'),
                'value' => 'list'
            ],
            [
                'label' => __('Slider'),
                'value' => 'slider'
            ]
        ];
    }

    /**
     * @return array[]
     */
    public function getDisplayStyle()
    {
        return [
            [
                'label' => __('None'),
                'value' => ''
            ],
            [
                'label' => __('Style1'),
                'value' => 'style1'
            ],
            [
                'label' => __('Style2'),
                'value' => 'style2'
            ]
        ];
    }

    /**
     * @return int[]
     */
    public function getDefaultValues()
    {
        return [
            'owl_margin' => 15
        ];
    }
}
