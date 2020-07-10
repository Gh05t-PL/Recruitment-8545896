<?php

namespace App\EventSubscriber;

use App\Exceptions\ValidationException;
use App\Utils\ApiHelper;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ValidationExceptionSubscriber implements EventSubscriberInterface
{
    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();

        if ( $exception instanceof ValidationException ) {
            $event->setResponse(new JsonResponse(
                ApiHelper::prepareResponse(
                    false,
                    null,
                    $exception->getNormalizedViolations()
                ),
                Response::HTTP_UNPROCESSABLE_ENTITY
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
