<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

interface IRestJsonController
{
    /**
     * Controller method used for fetching resource via HTTP GET method
     *
     * @param string $id
     *
     * @return JsonResponse
     */
    public function fetch(string $id): JsonResponse;

    /**
     * Controller method used for creating resource via HTTP POST method
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function post(Request $request): JsonResponse;

    /**
     * Controller method used for updating resource partially via HTTP PATCH method
     *
     * @param string $id
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function patch(string $id, Request $request): JsonResponse;

    /**
     * Controller method used for removal of resource via HTTP DELETE method
     *
     * @param string $id
     *
     * @return JsonResponse
     */
    public function delete(string $id): JsonResponse;
}