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
 * @package   Cytracon_PageBuilder
 * @copyright Copyright (C) 2019 Cytracon (https://www.cytracon.com)
 */

namespace Cytracon\CategoryPageBuilder\Block\Category\Element;

class SubCategories extends \Cytracon\CategoryPageBuilder\Block\Category\Element
{
    /**
     * @var \Magento\Framework\App\ResourceConnection
     */
    protected $_resource;

    /**
     * @var \Magento\Framework\Stdlib\StringUtils
     */
    protected $string;

    /**
     * @var \Magento\Catalog\Model\ResourceModel\Category\Collection
     */
    protected $_collection;

    protected $_childrenCategories;

    /**
     * @var \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @param \Magento\Framework\View\Element\Template\Context                $context
     * @param \Magento\Framework\App\Http\Context                             $httpContext
     * @param \Magento\Framework\Pricing\PriceCurrencyInterface               $priceCurrency
     * @param \Magento\Framework\Registry                                     $registry
     * @param \Magento\Catalog\Model\Layer\Resolver                           $layerResolver
     * @param \Magento\Framework\App\ResourceConnection                       $resource
     * @param \Magento\Framework\Stdlib\StringUtils                           $string
     * @param \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $collectionFactory
     * @param \Cytracon\Core\Helper\Data                                       $coreHelper
     * @param array                                                           $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\App\Http\Context $httpContext,
        \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency,
        \Magento\Framework\Registry $registry,
        \Magento\Catalog\Model\Layer\Resolver $layerResolver,
        \Magento\Framework\App\ResourceConnection $resource,
        \Magento\Framework\Stdlib\StringUtils $string,
        \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $collectionFactory,
        \Cytracon\Core\Helper\Data $coreHelper,
        array $data = []
    ) {
        parent::__construct($context, $httpContext, $priceCurrency, $registry, $layerResolver, $coreHelper, $data);
        $this->_resource         = $resource;
        $this->string            = $string;
        $this->collectionFactory = $collectionFactory;
        $this->coreHelper        = $coreHelper;
    }
    /**
     * @return boolean
     */
    public function isEnabled()
    {
        if (!$this->getChildrenCategories() || !$this->getCollection()->count()) {
            return false;
        }

        return parent::isEnabled();
    }

    /**
     * Return child categories
     *
     * @param \Magento\Catalog\Model\Category $category
     * @return \Magento\Catalog\Model\ResourceModel\Category\Collection
     */
    public function getChildrenCategories()
    {
        if ($this->_childrenCategories === null) {
            $category = $this->getCategory();
            $collection = $this->collectionFactory->create();
            /* @var $collection \Magento\Catalog\Model\ResourceModel\Category\Collection */
            $collection->addAttributeToSelect(
                'url_key'
            )->addAttributeToSelect(
                'name'
            )->addAttributeToSelect(
                'all_children'
            )->addAttributeToSelect(
                'is_anchor'
            )->addAttributeToSelect(
                'image'
            )->addAttributeToSelect(
                'description'
            )->addAttributeToFilter(
                'is_active',
                1
            )->addIdFilter(
                $category->getChildren()
            )->setOrder(
                'position',
                \Magento\Framework\DB\Select::SQL_ASC
            )->joinUrlRewrite();
            $this->_childrenCategories = $collection;
        }
        return $this->_childrenCategories;
    }

    /**
     * @return array
     */
    public function getWrapperClasses()
    {
        $classes = parent::getWrapperClasses();
        $element = $this->getElement();
        $classes[] = 'cpb-subcategoies-layout-' . $element->getData('layout');
        $displayStyle = $element->getData('display_style');
        if ($displayStyle) {
            $classes[] = 'cpb-subcategoies-' . $displayStyle;
        }

        return $classes;
    }

    /**
     * @return \Magento\Catalog\Model\ResourceModel\Category\Collection
     */
    public function getCollection()
    {
        if ($this->_collection == null) {
            $connection = $this->_resource->getConnection();
            $productTable = $this->_resource->getTableName('catalog_category_product');

            $category = $this->getCategory();
            $subcategories = $this->getChildrenCategories();
            $ids = [];
            foreach ($subcategories as $_category) {
                $ids[] = $_category->getId();
            }
            $select = $connection->select()->from($productTable)->where(
                'category_id IN (?)',
                $ids
            );
            $list = $connection->fetchAll($select);

            $count = [];
            foreach ($list as $row) {
                if (isset($count[$row['category_id']])) {
                    $count[$row['category_id']]++;
                } else {
                    $count[$row['category_id']] = 1;
                }
            }

            foreach ($subcategories as $_category) {
                if (isset($count[$_category->getId()])) {
                    $_category->setProductCount($count[$_category->getId()]);
                }
            }
            $this->_collection = $subcategories;
        }

        return $this->_collection;
    }

    /**
     * @param  \Magento\Catalog\Model\Category $category
     * @return string
     */
    public function getCategoryDescription($category)
    {
        $length = $this->getElement()->getData('description_length');

        if ($length && strlen($category->getDescription()) > $length) {
            return $this->coreHelper->filter(
                $this->string->substr(strip_tags($category->getDescription()), 0, $length)
            );
        }
        return false;
    }
    /**
     * @return string
     */
    public function getAdditionalStyleHtml()
    {
        $styleHtml = parent::getAdditionalStyleHtml();
        $element   = $this->getElement();

        $displayStyle = $element->getData('display_style');

        $styles = [];
        $styles['color'] = $this->getStyleColor($element->getData('name_color'));
        $styles['background-color'] = $this->getStyleColor($element->getData('name_bg_color'));
        $styles['font-size']   = $this->getStyleProperty($element->getData('name_font_size'));
        $styles['font-weight'] = $element->getData('name_font_weight');
        $styleHtml .= $this->getStyles('.subcategory-name', $styles);

        if ($displayStyle == 'style2') {
            $styles = [];
            $styles['background-color'] = $this->getStyleColor($element->getData('overlay_color'));
            $styleHtml .= $this->getStyles('.subcategory:hover .mgz-overlay', $styles);
        }

        if ($displayStyle == 'style1') {
            $styles = [];
            $styles['border-color'] = $this->getStyleColor($element->getData('box_border_color'));
            $styleHtml .= $this->getStyles('.subcategory-inner', $styles);

            $styles = [];
            $styles['border-color'] = $this->getStyleColor($element->getData('box_hover_border_color'));
            $styleHtml .= $this->getStyles('.subcategory-inner:hover', $styles);
        }

        $styles = [];
        $styles['width'] = $this->getStyleProperty($element->getData('image_width'));
        $styles['height'] = $this->getStyleProperty($element->getData('image_height'));
        $styleHtml .= $this->getStyles('.subcategory-image', $styles);

        return $styleHtml;
    }
}
