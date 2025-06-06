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

namespace Cytracon\CategoryPageBuilder\Ui\DataProvider\Profile\Form\Modifier;

use Magento\Framework\UrlInterface;
use Magento\Ui\Component\Modal;

class PreviewModal implements \Magento\Ui\DataProvider\Modifier\ModifierInterface
{
    const IMPORT_OPTIONS_MODAL   = 'preview_modal';
    const SORT_ORDER             = 2000;
    const FORM_NAME              = 'categorypagebuilder_profile_form';
    const CUSTOM_OPTIONS_LISTING = 'categorypagebuilder_profile_category_grid';

    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * @var \Magento\Framework\Registry
     */
    protected $registry;

    /**
     * @param UrlInterface                $urlBuilder
     * @param \Magento\Framework\Registry $registry
     */
    public function __construct(
        UrlInterface $urlBuilder,
        \Magento\Framework\Registry $registry
    ) {
        $this->urlBuilder = $urlBuilder;
        $this->registry   = $registry;
    }

    /**
     * Get current profile
     *
     * @return \Cytracon\CategoryPageBuilder\Model\Profile
     * @throws NoSuchEntityException
     */
    public function getCurrentProfile()
    {
        return $this->registry->registry('current_profile');
    }

    /**
     * {@inheritdoc}
     */
    public function modifyMeta(array $meta)
    {
        $meta = array_merge_recursive(
            $meta,
            [
                static::IMPORT_OPTIONS_MODAL => $this->getImportOptionsModalConfig()
            ]
        );

        return $meta;
    }

    /**
     * Get config for modal window "Import Options"
     *
     * @return array
     * @since 101.0.0
     */
    protected function getImportOptionsModalConfig()
    {
        return [
            'arguments' => [
                'data' => [
                    'config' => [
                        'componentType' => Modal::NAME,
                        'options' => [
                            'title'    => __('Preview'),
                            'subTitle' => __('This function allows you to preview how your profile looks on category page. ')
                        ]
                    ]
                ],
            ],
            'children' => [
                static::CUSTOM_OPTIONS_LISTING => [
                    'arguments' => [
                        'data' => [
                            'config' => [
                                'autoRender' => false,
                                'componentType' => 'insertListing',
                                'dataScope' => static::CUSTOM_OPTIONS_LISTING,
                                'externalProvider' => static::CUSTOM_OPTIONS_LISTING . '.'
                                    . static::CUSTOM_OPTIONS_LISTING . '_data_source',
                                'ns' => static::CUSTOM_OPTIONS_LISTING,
                                'render_url' => $this->urlBuilder->getUrl('mui/index/render'),
                                'realTimeLink' => true,
                                'externalFilterMode' => false,
                                'currentProfileId' => $this->getCurrentProfile()->getId(),
                                'dataLinks' => [
                                    'imports' => false,
                                    'exports' => true
                                ],
                                'exports' => [
                                    'currentProfileId' => '${ $.externalProvider }:params.profile_id'
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function modifyData(array $data)
    {
        $data['current_profile_id'] = $this->getCurrentProfile()->getId();
        return $data;
    }
}
