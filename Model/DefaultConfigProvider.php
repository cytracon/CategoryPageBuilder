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

namespace Cytracon\CategoryPageBuilder\Model;

class DefaultConfigProvider extends \Cytracon\Builder\Model\DefaultConfigProvider
{
    /**
     * @var string
     */
    protected $_builderArea = 'category';

    /**
     * @return array
     */
    public function getConfig()
    {
        $config = parent::getConfig();
        $config['profile'] = [
            'builder'     => \Cytracon\CategoryPageBuilder\Block\Builder::class,
            'home'        => 'https://www.cytracon.com/magento-2-category-page-builder.html?utm_campaign=mgzbuilder&utm_source=mgz_user&utm_medium=backend',
            'templateUrl' => 'https://www.cytracon.com/productfile/categorypagebuilder/templates.php'
        ];
        return $config;
    }
}
