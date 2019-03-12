<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class NavigationHistoricSubscriber implements EventSubscriberInterface
{
    const HISTORIC_SIZE = 5;

    public function onKernelResponse(FilterResponseEvent $event)
    {
        $request = $event->getRequest();

        if (!$request->hasPreviousSession()) {
            return;
        }
        $session = $request->getSession();
        $historic = $session->get('historic') ?? [];
        $route = $request->get('_route');

        // _wdt is the debug bar
        if ($route !== '_wdt' && strpos($route, 'ajax') === false) {
            $entry = ['route' => $route, 'params' => $request->attributes->get('_route_params')];
            // We don't want to keep following duplicate of a historic
            if (empty($historic) || !empty($historic) && end($historic) !== $entry) {
                $historic[] = $entry;
            }

            if (!empty($historic) && count($historic) > self::HISTORIC_SIZE) {
                array_shift($historic);
            }
        }

        $session->set('historic', $historic);
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::RESPONSE => [['onKernelResponse', 0]],
        ];
    }
}
