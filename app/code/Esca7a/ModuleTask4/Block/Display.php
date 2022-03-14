<?php

namespace Esca7a\ModuleTask4\Block;

class Display extends \Magento\Framework\View\Element\Template
{
	protected $helperData;

	public function __construct(
		\Magento\Framework\View\Element\Template\Context $context,
		\Esca7a\ModuleTask4\Helper\Data $helperData
	)
	{
		$this->helperData = $helperData;
		parent::__construct($context);
	}

	public function getTest1()
	{
		return $this->helperData->getGeneralConfig('test1');
	}

	public function getTest2()
	{
		return $this->helperData->getGeneralConfig('test2');
	}

	public function getTest3()
	{
		return $this->helperData->getGeneralConfig('test3');
	}
}
