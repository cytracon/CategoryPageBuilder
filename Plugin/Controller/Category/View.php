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

namespace Cytracon\CategoryPageBuilder\Plugin\Controller\Category;

class View
{
    /**
     * @var \Magento\Framework\Registry
     */
    protected $registry;

    /**
     * @param \Magento\Framework\Registry $registry
     */
    public function __construct(
        \Magento\Framework\Registry $registry
    ) {
        $this->registry = $registry;
    }

    public function afterExecute(
        $subject,
        $result
    ) {
        if ($result instanceof \Magento\Framework\View\Result\Page) {
            $profile = $this->registry->registry('categorypagebuilder_profile');
            if ($profile && $profile->getPageLayout()) {
                $result->getConfig()->setPageLayout($profile->getPageLayout());
            }
        }
        return $result;
    }
}
