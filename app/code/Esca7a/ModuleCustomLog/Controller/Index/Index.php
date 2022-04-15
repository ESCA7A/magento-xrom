<?php

namespace Esca7a\ModuleCustomLog\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
	protected $_pageFactory;

	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $pageFactory)
	{
        $this->_pageFactory = $pageFactory;
		return parent::__construct($context);
	}

	public function execute()
	{
        $this->setTitle();
		return $this->_pageFactory->create();
	}

    public function setTitle()
    {
        echo '<hr> SOME TEXT OF METHOD EXECUTE CLASS INDEX <hr>';
    }
}
