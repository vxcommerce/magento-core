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
     * @var \Magento\Framework\App\Config\Storage\WriterInterface
     */
    protected $_configWriter;

    /**
     * @var \Magento\Framework\App\Cache\TypeListInterface
     */
    protected $_cacheTypeList;
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
     * @param \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList
     * @param \Magento\Framework\Serialize\SerializerInterface $serializer
     * @param \Magento\Framework\Serialize\JsonValidator $jsonValidator
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Framework\App\Config\Storage\WriterInterface $configWriter,
        \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList,
        \Magento\Framework\Serialize\SerializerInterface $serializer,
        \Magento\Framework\Serialize\JsonValidator $jsonValidator
    )
    {
        $this->_configWriter = $configWriter;
        $this->_cacheTypeList = $cacheTypeList;
        $this->_serializer = $serializer;
        $this->_jsonValidator = $jsonValidator;
        parent::__construct($context);
    }
    /**
     * @param $configPath
     * @param $storeId
     * @return mixed
     */
    public function getConfigValue($configPath, $storeId = null, $scope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE)
    {
        return $this->scopeConfig->getValue(
            $configPath,
            $scope,
            $storeId
        );
    }

    /**
     * @param $configPath
     * @param $value
     * @param $scope
     * @param $storeId
     * @return void
     */
    public function setConfigValue($configPath, $value, $scope = \Magento\Framework\App\Config\ScopeConfigInterface::SCOPE_TYPE_DEFAULT, $storeId = 0)
    {
        $this->_configWriter->save($configPath, $value, $scope, $storeId);
    }

    /**
     * @param $cacheTypes
     * @return void
     */
    public function refreshCache($cacheTypes = []) {
        /*
        foreach ($cacheTypes as $cacheType) {
            $this->_cacheTypeList->cleanType($cacheType);
        }
        */
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

