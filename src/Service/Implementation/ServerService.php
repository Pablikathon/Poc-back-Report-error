<? 
namespace App\Controller;
use App\Entity\Host;
use App\Entity\Server;
use Doctrine\ORM\EntityManagerInterface;
use IHostService;
use IServerService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
class ServerService implements IServerService
{
    private $entityManager;
    private $hostService;
    public function __construct(EntityManagerInterface $entityManager,IHostService $hostService)
    {
        $this->entityManager = $entityManager;
        $this->hostService = $hostService;
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
        $host = $this->hostService->FindHostByName($hostname);

        if(!$host){
            return null;
        }
        
        $server = new Server();
        $server->setName($name);
        $server->setHost($host);
        $this->entityManager->persist($host);
        $this->entityManager->flush();
        return new JsonResponse(['status' => 'Server created!','data', $server], Response::HTTP_CREATED);
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