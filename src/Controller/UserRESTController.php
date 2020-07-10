<?php

namespace App\Controller;

use App\Services\UserService;
use App\Utils\ApiHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class UserRESTController extends AbstractController implements IRestJsonController
{
    /**
     * @var UserService
     */
    private $userService;
    /**
     * @var SerializerInterface
     */
    private $serializer;

    public function __construct(
        UserService $userService,
        SerializerInterface $serializer
    )
    {
        $this->userService = $userService;
        $this->serializer = $serializer;
    }

    /**
     * Controller method used for fetching resource via HTTP GET method
     *
     * @param string $id
     *
     * @return JsonResponse
     *
     * @throws \App\Exceptions\EntityNotFoundException
     * @Route(path="api/v1/user/{id}", methods={"GET"})
     */
    public function fetch(string $id): JsonResponse
    {
        return new JsonResponse(
            ApiHelper::prepareResponse(
                true,
                $this->serializer->normalize(
                    $this->userService->fetchUser($id),
                    'json'
                )
            ),
            Response::HTTP_OK
        );
    }

    /**
     * Controller method used for creating resource via HTTP POST method
     *
     * @param Request $request
     *
     * @return JsonResponse
     *
     * @throws \App\Exceptions\ValidationException
     * @Route(path="api/v1/user", methods={"POST"})
     */
    public function post(Request $request): JsonResponse
    {
        $user = $this->userService->createUser($request->getContent());

        return new JsonResponse(
            ApiHelper::prepareResponse(
                true,
                [
                    'id' => $user->getId()
                ]
            ),
            Response::HTTP_CREATED
        );
    }

    /**
     * Controller method used for updating resource via HTTP PUT method
     *
     * @param string $id
     *
     * @param Request $request
     *
     * @return JsonResponse
     *
     * @throws \App\Exceptions\EntityNotFoundException
     * @Route(path="api/v1/user/{id}", methods={"PUT"})
     */
    public function put(string $id, Request $request): JsonResponse
    {
        $user = $this->userService->updateUser($id, $request->getContent());

        return new JsonResponse(
            ApiHelper::prepareResponse(
                true,
                [
                    'id' => $user->getId()
                ]
            )
        );
    }

    /**
     * Controller method used for removal of resource via HTTP DELETE method
     *
     * @param string $id
     *
     * @return JsonResponse
     *
     * @throws \App\Exceptions\EntityNotFoundException
     * @Route(path="api/v1/user/{id}", methods={"DELETE"})
     */
    public function delete(string $id): JsonResponse
    {
        $user = $this->userService->deleteUser($id);

        return new JsonResponse(
            ApiHelper::prepareResponse(
                true,
                [
                    'id' => $user->getId()
                ]
            ),
            Response::HTTP_OK
        );
    }
}
