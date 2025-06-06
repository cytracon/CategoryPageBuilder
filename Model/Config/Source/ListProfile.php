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

namespace Cytracon\CategoryPageBuilder\Model\Config\Source;

class ListProfile implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @var \Cytracon\CategoryPageBuilder\Model\ResourceModel\Profile\CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @param \Cytracon\CategoryPageBuilder\Model\ResourceModel\Profile\CollectionFactory $collectionFactory
     */
    public function __construct(
        \Cytracon\CategoryPageBuilder\Model\ResourceModel\Profile\CollectionFactory $collectionFactory
    ) {
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        $collection = $this->collectionFactory->create();
        $options[] = [
            'value' => '',
            'label' => 'None'
        ];
        foreach ($collection as $profile) {
            $options[] = [
                'value' => $profile->getId(),
                'label' => $profile->getName()
            ];
        }
        return $options;
    }
}
