<?php

/**
 * @package Codilar_Pincode
 *
 */

namespace Codilar\Pincode\Block\Adminhtml\Pin\Edit;

use Magento\Backend\Block\Widget\Context;

/**
 * Class GenericButton
 * GenericButton class represents a generic button used in various contexts.
 */
class GenericButton
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * The Url Builder class is responsible for building URLs in Magento
     *
     * @var \Magento\Framework\UrlInterface
     */
    protected $urlBuilder;

    /**
     * Constructor
     *
     * @param \Magento\Backend\Block\Widget\Context $context
     */
    public function __construct(
        Context $context
    ) {
        $this->context = $context;
        $this->urlBuilder = $this->context->getUrlBuilder();
    }

    /**
     * Return the entity ID.
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->context->getRequest()->getParam('id');
    }

    /**
     * Generate URL by route and parameters
     *
     * @param  string $route
     * @param  array $params
     * @return string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->urlBuilder->getUrl($route, $params);
    }
}
