<?php  
namespace App\Service\Server;

use App\Entity\Server;
use App\Repository\HostRepository;
use App\Service\IHostService;
use Doctrine\ORM\EntityManagerInterface;
class ServerService implements IServerService
{
    private $entityManager;
    private $hostService;
    private $hostRepository;
    public function __construct(EntityManagerInterface $entityManager,IHostService $hostService,HostRepository $HostRepository)
    {
        $this->entityManager = $entityManager;
        $this->hostService = $hostService;
        $this->hostRepository = $HostRepository;
    }
    public function getServer(): Array{
        $data = [];
        $servers = $this->entityManager->getRepository(Server::class)->findAll();
        foreach ($servers as $server) {
            $data[] = [
                'id' => $server->getId(),
                'name' => $server->getName(),
                'host' => $server->getHost()
            ];
        }
        return $data;
    }
    public function createServer(string $name, string $hostname): ?Server
    {
        $server = new Server();
        $server->setName($name);
        $host = $this->hostRepository->FindHostByName($hostname);

        if(!$host){
            return null;
        }
        
        $server = new Server();
        $server->setName($name);
        $server->setHost($host);
        $this->entityManager->persist($host);
        $this->entityManager->flush();
        return $server;
    }
    public function updateServer(string $id, Server $server): ?Server
    {
        $serverInBase = $this->entityManager->getRepository(Server::class)->find($id);
        if(!$serverInBase){
            return null;
        }
        $serverInBase = $server;
        return $serverInBase;
    }
}