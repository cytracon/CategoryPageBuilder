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

namespace Cytracon\CategoryPageBuilder\Block\Adminhtml\Profile\Edit\Button;

class Preview extends Generic
{
    /**
     * {@inheritdoc}
     */
    public function getButtonData()
    {
        $data = [];
        if ($this->getCurrentProfile()->getId()) {
            $data = [
                'label' => __('Preview'),
                'data_attribute' => [
                    'mage-init' => [
                        'Magento_Ui/js/form/button-adapter' => [
                            'actions' => [
                                [
                                    'targetName' => 'categorypagebuilder_profile_form.categorypagebuilder_profile_form.preview_modal',
                                    'actionName' => 'toggleModal'
                                ],
                                [
                                    'targetName' => 'categorypagebuilder_profile_form.categorypagebuilder_profile_form.preview_modal.categorypagebuilder_profile_category_grid',
                                    'actionName' => 'render'
                                ]
                            ]
                        ]
                    ]
                ],
                'on_click'   => '',
                'sort_order' => 20
            ];
        }
        return $data;
    }
}
