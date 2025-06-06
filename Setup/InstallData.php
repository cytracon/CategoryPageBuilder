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

namespace Cytracon\CategoryPageBuilder\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;

class InstallData implements InstallDataInterface
{
      private $eavSetupFactory;

    /**
     * @param BrandFactory $brandFactory
     * @param GroupFactory $groupFactory
     */
    public function __construct(
        EavSetupFactory $eavSetupFactory
    ) {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
            $eavSetup->addAttribute(
                \Magento\Catalog\Model\Category::ENTITY,
                'cpb_profile_id',
                [
                    'group'                         => 'Design',
                    'global'                        => ScopedAttributeInterface::SCOPE_STORE,
                    'type'                          => 'int',
                    'input'                         => 'select',
                    'label'                         => 'CategoryPageBuilder Profile',
                    'backend'                       => \Magento\Eav\Model\Entity\Attribute\Backend\ArrayBackend::class,
                    'frontend'                      => '',
                    'source'                        => \Cytracon\CategoryPageBuilder\Model\Source\ListProfile::class,
                    'visible'                       => 1,
                    'user_defined'                  => 1,
                    'used_for_price_rules'          => 1,
                    'position'                      => 0,
                    'unique'                        => 0,
                    'sort_order'                    => 100,
                    'required'                      => 0,
                    'is_configurable'               => 1,
                    'is_searchable'                 => 0,
                    'is_visible_in_advanced_search' => 0,
                    'is_comparable'                 => 0,
                    'is_filterable'                 => 0,
                    'is_filterable_in_search'       => 1,
                    'is_used_for_promo_rules'       => 1,
                    'is_html_allowed_on_front'      => 0,
                    'is_visible_on_front'           => 1,
                    'used_in_product_listing'       => 0,
                    'used_for_sort_by'              => 0,
                    'is_used_in_grid'               => 1,
                    'is_filterable_in_grid'         => 1
                ]
            );
    }
}
