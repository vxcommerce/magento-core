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
     *
     */
    const DEFAULT_STATUS_YES    = 1;

    /**
     *
     */
    const DEFAULT_STATUS_NO     = 2;

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
}

