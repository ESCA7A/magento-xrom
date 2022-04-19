<?php
namespace Esca7a\ModuleCustomLog\Observer;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Customer\Model\Session as customerSession;

class AdminhtmlCustomerPrepareSave implements ObserverInterface
{
    protected $customerRepository;
    public function __construct(
        \Psr\Log\LoggerInterface $logger,
        customerSession $session
    )
    {
        $this->logger = $logger;
        $this->session = $session;
    }

    public function execute(Observer $observer)
    {
        /**
         * @var \Magento\Customer\Model\Data\Customer $customer
         */

        $customer = $observer->getData('customer_data_object');
        $customerId = $customer->getId();

        $this->logger->info(
            "ADMIN: " . $this->session->getName()
            . " | SAVED CUSTOMER WITH ID | " . $customerId
        );
    }
}
