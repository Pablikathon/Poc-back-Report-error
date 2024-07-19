<?php

namespace App\Controller\Api;

use App\Entity\Host;
use App\Service\Host\IHostService;
use App\Service\Serializer\ISerializerService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiHostController extends AbstractController
{
    private $HostService;
    private $serializeService;
    public function __construct(IHostService $hostService,ISerializerService $serializeService)  
    {
        $this->HostService = $hostService;
        $this->serializeService = $serializeService;
    }
    #[Route('/host', name: 'GetHost',methods: Request::METHOD_GET)]
    public function get(): JsonResponse
    {
        try
        {
            return new JsonResponse($this->HostService->getHost(), Response::HTTP_OK);
        }catch(Exception $e){
            return new JsonResponse($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    #[Route('/host', name: 'CreateHost',methods: Request::METHOD_POST)]
    public function create(Request $request): JsonResponse
    {
        try
        {
            $data = json_decode($request->getContent(),true);
            if (!isset($data['HostLibelle'])) {
                return new JsonResponse(['error' => 'HostLibelle is required'], 400);
            }
            $host = $this->HostService->createHost($data["HostLibelle"]);
            return new JsonResponse($this->serializeService->serialize($host), Response::HTTP_OK);

        }catch(Exception $e){
            return new JsonResponse($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    #[Route('/host/{id}', name: 'UpdateHost',methods: Request::METHOD_PUT)]
    public function update(Host $host,Request $request): Response
    {
        try
        {
            $data = json_decode($request->getContent(),true);
            if (!isset($data['HostLibelle'])) {
                return new JsonResponse(['error' => 'HostLibelle is required'], 400);
            }
            $result = $this->HostService->updateHost($host,$data['HostLibelle']);
            return new JsonResponse(serialize($result),Response::HTTP_NO_CONTENT);
        }catch(Exception $e){
            dd($e);
            return new JsonResponse($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    #[Route('/host/{id}', name: 'DeleteHost',methods: Request::METHOD_DELETE)]
    public function delete(Host $host): JsonResponse
    {
        try
        {
            $result = $this->HostService->deleteHost($host);
            return new JsonResponse(serialize($result),Response::HTTP_NO_CONTENT);
        }catch(Exception $e){
            dd($e);
            return new JsonResponse($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}