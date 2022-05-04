<?php

namespace Esca7a\ModuleDataBase\Block;

class Display extends \Magento\Framework\View\Element\Template
{
	protected $helperData;

	public function __construct(
		\Magento\Framework\View\Element\Template\Context $context,
		\Esca7a\ModuleDataBase\Helper\Data $helperData
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
