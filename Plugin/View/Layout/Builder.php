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

namespace Cytracon\CategoryPageBuilder\Plugin\View\Layout;

class Builder
{
    /**
     * @var boolean
     */
    protected $_valid;

    /**
     * @var \Magento\Framework\View\LayoutInterface
     */
    protected $layout;

    /**
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    /**
     * @var \Magento\Framework\App\RequestInterface
     */
    protected $request;

    /**
     * @var \Magento\Security\Model\ResourceModel\AdminSessionInfo\CollectionFactory
     */
    protected $adminSessionInfoCollectionFactory;

    /**
     * @var \Cytracon\CheckoutSuccessPage\Helper\Data
     */
    protected $dataHelper;

    /**
     * @var \Cytracon\CategoryPageBuilder\Model\ProfileFactory
     */
    protected $profileFactory;

    /**
     * @var bool
     */
    protected $isBuilt = false;

    /**
     * @param \Magento\Framework\View\LayoutInterface                                  $layout
     * @param \Magento\Framework\Registry                                              $registry
     * @param \Magento\Framework\App\RequestInterface                                  $request
     * @param \Magento\Security\Model\ResourceModel\AdminSessionInfo\CollectionFactory $adminSessionInfoCollectionFactory
     * @param \Cytracon\CategoryPageBuilder\Helper\Data                                 $dataHelper
     * @param \Cytracon\CategoryPageBuilder\Model\ProfileFactory                        $profileFactory
     */
    public function __construct(
        \Magento\Framework\View\LayoutInterface $layout,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\App\RequestInterface $request,
        \Magento\Security\Model\ResourceModel\AdminSessionInfo\CollectionFactory $adminSessionInfoCollectionFactory,
        \Cytracon\CategoryPageBuilder\Helper\Data $dataHelper,
        \Cytracon\CategoryPageBuilder\Model\ProfileFactory $profileFactory
    ) {
        $this->layout                            = $layout;
        $this->_coreRegistry                     = $registry;
        $this->request                           = $request;
        $this->adminSessionInfoCollectionFactory = $adminSessionInfoCollectionFactory;
        $this->dataHelper                        = $dataHelper;
        $this->profileFactory                    = $profileFactory;
    }

    /**
     * @return \Magento\Catalog\Model\Category
     */
    public function getCategory()
    {
        return $this->_coreRegistry->registry('current_category');
    }

    /**
     * Retrieve the default layout handle name for the current action
     *
     * @return string
     */
    public function getDefaultLayoutHandle()
    {
        return strtolower($this->request->getFullActionName());
    }

    public function beforeBuild(
        $subject
    ) {
        $category = $this->getCategory();
        if (!$this->isBuilt && $this->dataHelper->isEnable() && ($this->getDefaultLayoutHandle() == 'catalog_category_view') && $category && !$this->_coreRegistry->registry('categorypagebuilder_profile')) {
            $valid     = false;
            $profileId = $category->getData('cpb_profile_id');
            if ($this->request->getParam('profile_id') && $this->request->getParam('key')) {
                $sessionCollection = $this->adminSessionInfoCollectionFactory->create();
                $sessionCollection->addFieldToFilter('session_id', $this->request->getParam('key'))
                ->addFieldToFilter('status', 1);
                if ($sessionCollection->count()) {
                    $profileId = $this->request->getParam('profile_id');
                }
            }

            if (!$profileId) {
                $profileId = $this->dataHelper->getConfig('general/default_profile');
            }

            if ($profileId) {
                $profile = $this->profileFactory->create();
                $profile->load($profileId);
                if ($profile->getId() && $profile->getIsActive()) {
                    $today = date("Y-m-d");
                    $from  = $profile->getFromDate();
                    $to    = $profile->getToDate();

                    $this->_coreRegistry->register('categorypagebuilder_profile', $profile);
                    $valid = true;
                    if (($from && $to && ($from > $today || $today > $to))
                        || ($from && !$to && $from > $today)
                        || ($to && !$from && $today > $to)
                    ) {
                        $valid = false;
                    }
                }
            }
            if ($valid) {
                $this->layout->getUpdate()->addHandle('categorypagebuilder');
            }
            $this->isBuilt = true;
        }
    }
}
