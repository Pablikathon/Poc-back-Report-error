<?php

namespace App\Controller\Api;

use App\Entity\Server;
use App\Service\Server\IServerService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiServerController extends AbstractController
{
    private $ServerService;

    public function __construct(IServerService $ServerService)  
    {
        $this->ServerService = $ServerService;
    }
    #[Route('/server', name: 'GetServer',methods: Request::METHOD_GET)]
    public function get(): JsonResponse
    {
        try
        {
            return new JsonResponse($this->ServerService->getServer(), Response::HTTP_OK);
        }catch(Exception $e){
            return new JsonResponse($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    #[Route('/server', name: 'CreateServer',methods: Request::METHOD_POST)]
    public function create(Request $request):Response{
        try
        {
            $data = $request->getContent();
            return new JsonResponse($this->ServerService->createServer($data["ServerName"],$data["ServerHost"]), Response::HTTP_OK);
        }catch(Exception $e){
            return new JsonResponse($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    #[Route('/server', name: 'UpdateServer',methods: Request::METHOD_PUT)]
    public function update(Request $request):Response{
        try
        {
            $data = $request->getContent();
            return new JsonResponse($this->ServerService->updateServer(new Server($data["ServerName"])), Response::HTTP_OK);
        }catch(Exception $e){
            return new JsonResponse($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
