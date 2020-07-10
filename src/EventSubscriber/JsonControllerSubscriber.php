<?php

namespace App\EventSubscriber;

use App\Controller\IRestJsonController;
use App\Utils\ViolationHelper;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Controller\ErrorController;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class JsonControllerSubscriber implements EventSubscriberInterface
{
    /**
     * @var ValidatorInterface
     */
    private $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::CONTROLLER => [
                ['onKernelController', 9999]
            ],
        ];
    }

    public function onKernelController(
        ControllerEvent $event
    )
    {
        if ( $event->getController() instanceof ErrorController ) {
            return;
        }

        [$controller, $methodName] = $event->getController();

        if ( $controller instanceof IRestJsonController && ($methodName !== 'fetch' && $methodName !== 'delete') ) {
            $violations = $this->validator->validate(
                $event->getRequest()->getContent(),
                new Assert\Json(['message' => 'Request should be valid JSON'])
            );

            if ( $violations->count() > 0 ) {
                $event->setController(function () use ($violations) {
                    return new JsonResponse([
                        'errors' => ViolationHelper::normalizeViolations($violations),
                    ]);
                });
            }
        }
    }
}
