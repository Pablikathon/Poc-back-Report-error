<?php  
namespace App\Service\Server;

use App\Entity\Host;
use App\Entity\Server;
use App\Repository\HostRepository;
use Doctrine\ORM\EntityManagerInterface;
class ServerService implements IServerService
{
    private $entityManager;
    private $hostRepository;
    public function __construct(EntityManagerInterface $entityManager,HostRepository $HostRepository)
    {
        $this->entityManager = $entityManager;
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
        $host = $this->hostRepository->findOneByLibelle($hostname);

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
    public function updateServer(Server $server): ?Server
    {
        $serverInBase = $this->entityManager->getRepository(Server::class)->find($server->getId());
        $hostInBase = $this->entityManager->getRepository(Host::class)->find($server->getHost()->getId());
        if(!$serverInBase || !$hostInBase){
            return null;
        }
        $serverInBase = $server;
        $this->entityManager->persist($serverInBase);
        $this->entityManager->flush();
        return $serverInBase;
    }
}