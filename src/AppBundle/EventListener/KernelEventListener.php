<?php

namespace AppBundle\EventListener;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\DependencyInjection\ContainerInterface;

class KernelEventListener
{

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * KernelEventListener constructor.
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param FilterControllerEvent $event
     */
    public function initController(FilterControllerEvent $event)
    {
        /** @var Controller $controller */
        list($controller, $actionName) = $event->getController();

        if (!$controller instanceof Controller) {
            return ;
        }

        $this->checkAccess($controller, $actionName);
        return;
    }

    /**
     * @param Controller $controller
     * @param $actionName
     * @return $this
     */
    private function checkAccess(Controller $controller, $actionName)
    {
        $controllerName = $this->extractControllerName($controller);
        $authChecker = $this->container->get('security.authorization_checker');
        if (!$authChecker->isGranted('access', $controllerName)) {
            throw new AccessDeniedException("Access denied $controllerName !!!!");
        }
        return $this;
    }

    /**
     * @param Controller $controller
     * @return string
     */
    private function extractControllerName(Controller $controller)
    {
        $fullClassName = get_class($controller);
        $split = explode('\\', $fullClassName);
        $controllerName = strtolower(substr(array_pop($split), 0, -10));
        return $controllerName;
    }
}
