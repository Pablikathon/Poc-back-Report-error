<?php

namespace App\Controller\Api;

use App\Entity\Host;
use App\Service\Host\IHostService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiHostController extends AbstractController
{
    private $HostService;

    public function __construct(IHostService $hostService)  
    {
        $this->HostService = $hostService;
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
    
            return new JsonResponse($this->HostService->createHost($data["HostLibelle"]), Response::HTTP_CREATED);
        }catch(Exception $e){
            dd($e);
            return new JsonResponse($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    #[Route('/host/{id}', name: 'UpdateHost',methods: Request::METHOD_PUT)]
    public function update(Host $host,Request $request): JsonResponse
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
}