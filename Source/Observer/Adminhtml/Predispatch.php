<?php
/**
 * Greetings from Wamoco GmbH, Bremen, Germany.
 * @author Wamoco Team<info@wamoco.de>
 * @license See LICENSE.txt for license details.
 */

namespace Wamoco\Common\Observer\Adminhtml;

/**
 * Class: PredispathAdminActionControllerObserver
 *
 * @see \Magento\Framework\Event\ObserverInterface
 */
class Predispatch implements \Magento\Framework\Event\ObserverInterface
{
    /**
     * @var \Wamoco\Common\Model\FeeddFactory
     */
    protected $feedFactory;

    /**
     * @var \Magento\Backend\Model\Auth\Session
     */
    protected $backendAuthSession;

    /**
     * __construct
     *
     * @param \Wamoco\Common\Model\FeedFactory $feedFactory
     * @param \Magento\Backend\Model\Auth\Session $backendAuthSession
     */
    public function __construct(
        \Wamoco\Common\Model\FeedFactory $feedFactory,
        \Magento\Backend\Model\Auth\Session $backendAuthSession
    ) {
        $this->feedFactory = $feedFactory;
        $this->backendAuthSession = $backendAuthSession;
    }

    /**
     * execute
     *
     * @param \Magento\Framework\Event\Observer $observer
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        if ($this->isLoggedIn()) {
            $feed = $this->feedFactory->create();
            $feed->checkUpdate();
        }
    }

    /**
     * isLoggedIn
     * @return bool
     */
    protected function isLoggedIn()
    {
        return $this->backendAuthSession->isLoggedIn();
    }
}
