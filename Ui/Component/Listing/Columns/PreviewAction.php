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

namespace Cytracon\CategoryPageBuilder\Ui\Component\Listing\Columns;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\App\RequestInterface;

class PreviewAction extends Column
{
    /**
     * @var \Magento\Framework\Url
     */
    protected $frontendUrlBuilder;

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var \Magento\Backend\Model\Auth\Session
     */
    protected $authSession;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @param ContextInterface                                                $context
     * @param UiComponentFactory                                              $uiComponentFactory
     * @param \Magento\Framework\Url                                          $frontendUrlBuilder
     * @param RequestInterface                                                $request
     * @param \Magento\Backend\Model\Auth\Session                             $authSession
     * @param \Magento\Store\Model\StoreManagerInterface                      $storeManager
     * @param \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $collectionFactory
     * @param array                                                           $components
     * @param array                                                           $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        \Magento\Framework\Url $frontendUrlBuilder,
        RequestInterface $request,
        \Magento\Backend\Model\Auth\Session $authSession,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $collectionFactory,
        array $components = [],
        array $data = []
    ) {
        $this->frontendUrlBuilder = $frontendUrlBuilder;
        $this->request            = $request;
        $this->authSession        = $authSession;
        $this->storeManager       = $storeManager;
        $this->collectionFactory  = $collectionFactory;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            $productIds = [];
            foreach ($dataSource['data']['items'] as & $item) {
                if (isset($item['entity_id'])) {
                    $productIds[] = $item['entity_id'];
                }
            }
            $collection = $this->collectionFactory->create();
            $collection->addAttributeToSelect(['url_key']);
            $collection->addFieldToFilter('entity_id', ['in' => $productIds]);
            foreach ($dataSource['data']['items'] as & $item) {
                if (isset($item['entity_id'])) {
                    $category = $collection->getItemById($item['entity_id']);
                    $url = $category->getUrl();
                    $url .= '?profile_id=' . $this->request->getParam('profile_id');
                    $url .= '&key=' . $this->authSession->getSessionId();
                    $item[$this->getData('name')] = [
                        'view' => [
                            'href'   => $url,
                            'label'  => __('Preview'),
                            'target' => '_blank'
                        ]
                    ];
                }
            }
        }
        return $dataSource;
    }
}
