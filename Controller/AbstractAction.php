<?php
/*
 *
 * @author VxCommerce
 * @copyright Copyright (c) 2024 VxCommerce (https://magento2.vxcommerce.net)
 * @package Magento Core Package
 *
 */

namespace VxCommerce\Core\Controller;

use Magento\Framework\App\Action\Context;

/**
 *
 */
abstract class AbstractAction extends \Magento\Framework\App\Action\Action {

    /**
     * @var
     */
    protected $_resultFactory;

    /**
     * @param Context $context
     */
    public function __construct(
        Context $context
    ){
        $this->_resultFactory = $context->getResultFactory();
        parent::__construct($context);
    }

    /**
     * @return mixed
     */
    public function createPageResult(){
        $resultPage = $this->_resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_PAGE);
        return $resultPage;
    }

    /**
     * @return mixed
     */
    public function createRedirectResult(){
        $resultRedirect = $this->_resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);
        return $resultRedirect;
    }
}