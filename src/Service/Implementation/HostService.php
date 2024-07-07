<?

use App\Entity\Host;
use Doctrine\ORM\EntityManagerInterface;

class HostService implements IHostService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function FindHostByName(string $hostName) : ?host
    {
        $host = $this->entityManager->getRepository(Host::class)->findOneBy(['name' => $hostName]);
        if ($host) {
            return $host;
        }else{
            return null;
        }
    }
}