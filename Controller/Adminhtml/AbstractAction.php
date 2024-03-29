<?php
/*
 *
 * @author VxCommerce
 * @copyright Copyright (c) 2024 VxCommerce (https://magento2.vxcommerce.net)
 * @package Magento Core Package
 *
 */

namespace VxCommerce\Core\Controller\Adminhtml;

use Magento\Backend\App\Action\Context;

/**
 *
 */
abstract class AbstractAction extends \Magento\Backend\App\Action {

    /**
     * @var \Magento\Framework\Controller\ResultFactory
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
     * @param $data
     *
     * @return mixed
     */
    public function createJsonResult($data){
        $resultJson = $this->_resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_JSON);
        return $resultJson->setData($data);
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function createPageResult(){
        $resultPage = $this->_resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_PAGE);
        return $resultPage;
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function createRedirectResult(){
        $resultRedirect = $this->_resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);
        return $resultRedirect;
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function createForwardResult(){
        $resultForward = $this->_resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_FORWARD);
        return $resultForward;
    }
}