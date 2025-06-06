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

namespace Cytracon\CategoryPageBuilder\Ui\DataProvider\Category\Form\Modifier;

use Magento\Ui\Component\Form\Field;
use Magento\Ui\Component\Form\Element\Select;

class Profile implements \Magento\Ui\DataProvider\Modifier\ModifierInterface
{
    /**
     * @var \Cytracon\CategoryPageBuilder\Model\Source\ListProfile
     */
    protected $listProfile;

    /**
     * @param \Cytracon\CategoryPageBuilder\Model\Source\ListProfile $listProfile
     */
    public function __construct(
        \Cytracon\CategoryPageBuilder\Model\Source\ListProfile $listProfile
    ) {
        $this->listProfile = $listProfile;
    }

    /**
     * {@inheritdoc}
     */
    public function modifyMeta(array $meta)
    {
        $meta = array_merge_recursive(
            $meta,
            [
                'design' => [
                    'children' => [
                        'cpb_profile_id' => [
                            'arguments' => [
                                'data' => [
                                    'config' => [
                                        'label'         => __('Category Page Builder Profile'),
                                        'componentType' => Field::NAME,
                                        'formElement'   => Select::NAME,
                                        'sortOrder'     => 220,
                                        'options'       => $this->listProfile->getAllOptions()
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        );

        return $meta;
    }

    /**
     * {@inheritdoc}
     */
    public function modifyData(array $data)
    {
        return $data;
    }
}
