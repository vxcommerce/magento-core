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
use Magento\Framework\App\Config\ScopeConfigInterface;

/**
 *
 */
class Data extends AbstractHelper {

    /**
     * @var \Magento\Framework\App\Config\Storage\WriterInterface
     */
    protected $_configWriter;

    /**
     * @var \Magento\Framework\Serialize\SerializerInterface
     */
    protected $_serializer;

    /**
     * @var \Magento\Framework\Serialize\JsonValidator
     */
    protected $_jsonValidator;

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
     * @param \Magento\Framework\App\Config\Storage\WriterInterface $configWriter
     * @param \Magento\Framework\Serialize\SerializerInterface $serializer
     * @param \Magento\Framework\Serialize\JsonValidator $jsonValidator
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Framework\App\Config\Storage\WriterInterface $configWriter,
        \Magento\Framework\Serialize\SerializerInterface $serializer,
        \Magento\Framework\Serialize\JsonValidator $jsonValidator
    )
    {
        $this->_configWriter = $configWriter;
        $this->_serializer = $serializer;
        $this->_jsonValidator = $jsonValidator;
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
     * @param $configPath
     * @param $value
     * @param $scope
     * @param $store
     * @return void
     */
    public function setConfigValue($configPath, $value, $scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT, $store = 0)
    {
        $this->_configWriter->save($configPath, $value, $scope, $store);
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

    /**
     * @param $string
     * @return mixed
     */
    public function isJsonValid($string) {
        return $this->_jsonValidator->isValid($string);
    }
}

