<?php
namespace App\Security;

use Symfony\Component\Security\Core\Event\AuthenticationFailureEvent;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Authlog;

class  AuthenticationFailureListener
{
    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * AuthenticationFailureListener constructor.
     * @param ObjectManager $objectManager
     */
    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * onSecurityAuthenticationFailure
     * @param AuthenticationFailureEvent $event
     */
    public function onSecurityAuthenticationFailure(AuthenticationFailureEvent $event)
    {
        $ipaddress = $_SERVER['REMOTE_ADDR'];
        $useragent = $_SERVER['HTTP_USER_AGENT'];

        $authlog = new Authlog();
        $authlog->setIp($ipaddress);
        $authlog->setUseragent($useragent);
        $authlog->setFailure(true);
        $authlog->setException($event->getAuthenticationException()->getMessage());
        $authlog->setTstamp(date('U'));

        $this->objectManager->persist($authlog);
        $this->objectManager->flush();
    }
}