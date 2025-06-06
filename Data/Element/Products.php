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

class Products extends \Cytracon\CategoryPageBuilder\Data\Element
{
    /**
     * @return \Cytracon\Builder\Data\Form\Element\Fieldset
     */
    public function prepareGeneralTab()
    {
        $general = parent::prepareGeneralTab();

            $container0 = $general->addContainerGroup(
                'container0',
                [
                    'sortOrder' => 10
                ]
            );

            $container0->addChildren(
                'use_theme_layout',
                'toggle',
                [
                    'sortOrder'       => 10,
                    'key'             => 'use_theme_layout',
                    'defaultValue'    => true,
                    'templateOptions' => [
                        'label'   => __('Use Default Theme Layout')
                    ]
                ]
            );

            $container0->addChildren(
                'grid_columns',
                'select',
                [
                    'sortOrder'       => 20,
                    'key'             => 'grid_columns',
                    'defaultValue'    => 4,
                    'templateOptions' => [
                        'label'   => __('Grid Columns'),
                        'options' => $this->getGridColumns()
                    ],
                    'hideExpression' => 'model.use_theme_layout'
                ]
            );

            $container1 = $general->addContainer(
                'container1',
                [
                    'sortOrder'       => 20,
                    'templateOptions' => [
                        'label'       => __('Product Options'),
                        'collapsible' => true
                    ],
                    'hideExpression' => 'model.use_theme_layout'
                ]
            );

                $container2 = $container1->addContainerGroup(
                    'container2',
                    [
                        'sortOrder' => 10
                    ]
                );

                    $container2->addChildren(
                        'product_name',
                        'toggle',
                        [
                            'sortOrder'       => 10,
                            'key'             => 'product_name',
                            'defaultValue'    => true,
                            'templateOptions' => [
                                'label' => __('Name')
                            ]
                        ]
                    );

                    $container2->addChildren(
                        'product_price',
                        'toggle',
                        [
                            'sortOrder'       => 20,
                            'key'             => 'product_price',
                            'defaultValue'    => true,
                            'templateOptions' => [
                                'label' => __('Price')
                            ]
                        ]
                    );

                $container3 = $container1->addContainerGroup(
                    'container3',
                    [
                        'sortOrder' => 20
                    ]
                );

                    $container3->addChildren(
                        'product_image',
                        'toggle',
                        [
                            'sortOrder'       => 10,
                            'key'             => 'product_image',
                            'defaultValue'    => true,
                            'templateOptions' => [
                                'label' => __('Image')
                            ]
                        ]
                    );

                    $container3->addChildren(
                        'product_review',
                        'toggle',
                        [
                            'sortOrder'       => 20,
                            'key'             => 'product_review',
                            'defaultValue'    => true,
                            'templateOptions' => [
                                'label' => __('Review')
                            ]
                        ]
                    );

                $container4 = $container1->addContainerGroup(
                    'container4',
                    [
                        'sortOrder' => 30
                    ]
                );

                    $container4->addChildren(
                        'product_addtocart',
                        'toggle',
                        [
                            'sortOrder'       => 10,
                            'key'             => 'product_addtocart',
                            'defaultValue'    => true,
                            'templateOptions' => [
                                'label' => __('Add To Cart')
                            ]
                        ]
                    );

                    $container4->addChildren(
                        'product_shortdescription',
                        'toggle',
                        [
                            'sortOrder'       => 20,
                            'key'             => 'product_shortdescription',
                            'templateOptions' => [
                                'label' => __('Short Description')
                            ]
                        ]
                    );

                $container5 = $container1->addContainerGroup(
                    'container5',
                    [
                        'sortOrder' => 40
                    ]
                );

                    $container5->addChildren(
                        'product_wishlist',
                        'toggle',
                        [
                            'sortOrder'       => 10,
                            'key'             => 'product_wishlist',
                            'defaultValue'    => true,
                            'templateOptions' => [
                                'label' => __('Wishlist Link')
                            ]
                        ]
                    );

                    $container5->addChildren(
                        'product_compare',
                        'toggle',
                        [
                            'sortOrder'       => 20,
                            'key'             => 'product_compare',
                            'defaultValue'    => true,
                            'templateOptions' => [
                                'label' => __('Compare Link')
                            ]
                        ]
                    );

	            $container6 = $container1->addContainerGroup(
	                'container6',
	                [
	                    'sortOrder' => 50
	                ]
	            );

	                $container6->addChildren(
	                    'product_swatches',
	                    'toggle',
	                    [
	                        'sortOrder'       => 10,
	                        'key'             => 'product_swatches',
	                        'defaultValue'    => true,
	                        'templateOptions' => [
	                            'label' => __('Swatches')
	                        ]
	                    ]
	                );

        return $general;
    }

    /**
     * @return array[]
     */
    public function getGridColumns()
    {
        return [
            [
                'label' => __('2 Columns'),
                'value' => 2
            ],
            [
                'label' => __('3 Columns'),
                'value' => 3
            ],
            [
                'label' => __('4 Columns'),
                'value' => 4
            ],
            [
                'label' => __('5 Columns'),
                'value' => 5
            ],
            [
                'label' => __('6 Columns'),
                'value' => 6
            ],
            [
                'label' => __('7 Columns'),
                'value' => 7
            ],
            [
                'label' => __('8 Columns'),
                'value' => 8
            ]
        ];
    }
}
