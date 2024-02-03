<?php
/*
 *
 * @author VxCommerce
 * @copyright Copyright (c) 2024 VxCommerce (https://magento2.vxcommerce.net)
 * @package Magento Core Package
 *
 */

namespace VxCommerce\Core\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

/**
 *
 */
class Data extends AbstractHelper {

    /**
     * @var \Magento\Framework\Serialize\SerializerInterface
     */
    public $_serializer;

    /**
     *
     */
    const DEFAULT_STATUS_YES    = 1;

    /**
     *
     */
    const DEFAULT_STATUS_NO     = 2;

    /**
     * @param \Magento\Framework\App\Helper\Context $context
     * @param \Magento\Framework\Serialize\SerializerInterface $serializer
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Framework\Serialize\SerializerInterface $serializer
    )
    {
        $this->_serializer = $serializer;
        parent::__construct($context);
    }
    /**
     * @param $configPath
     * @param $store
     * @return mixed
     */
    public function getConfigValue($configPath, $store = null)
    {
        return $this->scopeConfig->getValue(
            $configPath,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $store
        );
    }

    /**
     * @param $data
     * @return mixed
     */
    public function arrayToSerialize($data)
    {
        return $this->_serializer->serialize($data);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function serializeToArray($data)
    {
        return $this->_serializer->unserialize($data);
    }
}

