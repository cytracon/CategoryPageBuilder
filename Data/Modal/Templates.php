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

namespace Cytracon\CategoryPageBuilder\Data\Modal;

class Templates extends \Cytracon\Builder\Data\Element\AbstractElement
{
    const TAB_TEMPLATES = 'tab_templates';

    /**
     * Prepare modal components
     */
    public function prepareForm()
    {
        $this->prepareTemplatesTab();
        return $this;
    }

    /**
     * @return \Cytracon\Builder\Data\Form\Element\Fieldset
     */
    public function prepareTemplatesTab()
    {
        $general = $this->addTab(
            self::TAB_TEMPLATES,
            [
                'sortOrder'       => 0,
                'templateOptions' => [
                    'label' => __('Template Library')
                ]
            ]
        );

            $general->addChildren(
                'templates',
                'select',
                [
                    'sortOrder'       => 10,
                    'templateOptions' => [
                        'element'     => 'Cytracon_Builder/js/form/element/templates',
                        'templateUrl' => 'Cytracon_Builder/js/templates/form/element/templates.html',
                        'url'         => $this->builderHelper->getUrl('categorypagebuilder/ajax/listTemplate'),
                        'resultKey'   => 'templates'
                    ]
                ]
            );
    }
}
