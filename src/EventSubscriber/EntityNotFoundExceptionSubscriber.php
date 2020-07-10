<?php

namespace App\EventSubscriber;

use App\Exceptions\EntityNotFoundException;
use App\Utils\ApiHelper;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class EntityNotFoundExceptionSubscriber implements EventSubscriberInterface
{
    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();

        if ( $exception instanceof EntityNotFoundException ) {
            $event->setResponse(new JsonResponse(
                ApiHelper::prepareResponse(
                    false,
                    null
                ),
                Response::HTTP_NOT_FOUND
            ));
        }
    }

    public static function getSubscribedEvents()
    {
        return [
            'kernel.exception' => 'onKernelException',
        ];
    }
}
