<?php 

namespace App\Service\Host;


use App\Entity\Host;
use App\Repository\HostRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;

class HostService implements IHostService
{
    private $entityManager;
    private $hostRepository;
    private $logger;
    public function __construct(EntityManagerInterface $entityManager,HostRepository $hostRepository,LoggerInterface $logger)
    {
        $this->entityManager = $entityManager;
        $this->hostRepository = $hostRepository;
        $this->logger = $logger;
    }
    public function gethost(): array{
        $hosts = $this->entityManager->getRepository(Host::class)->findAll();
        foreach ($hosts as $host) {
            $data[] = [
                'id' => $host->getId(),
                'libelle' => $host->getLibelle(),
            ];
        }
        return $data;
    }
    public function createHost(string $libelle): ?Host
    {
        $host = $this->hostRepository->findOneBy(['libelle'=> $libelle]);
        if($host){
            return null;
        }
        $host = new Host($libelle);        

        $this->entityManager->persist($host);
        $this->entityManager->flush();
        return $host;
    }
    public function updateHost(Host $host,string $libelle): bool
    {   
        try {

            $criteria =new Criteria();
            $criteria->where(Criteria::expr()->eq('libelle', $libelle));
            $criteria->andWhere(Criteria::expr()->neq('Id', $host->getId()));
            $result = $this->hostRepository->matching($criteria);

            if(!is_null($result->count())){
                $host->setLibelle($libelle);
                $this->entityManager->persist($host);
                $this->entityManager->flush();
                return true;
            }
            return false;
        } catch (\Throwable $th) {
            return false;
        }
    }
    public function deleteHost(Host $host): bool{
        try {
            $this->entityManager->remove($host);
            $this->entityManager->flush();
            $this->logger->info('Host successfully deleted with ID ' . $host->getId());
            return true;
        } catch (\Throwable $th) {
            $this->logger->error('Error deleting host: ' . $th->getMessage());
            return false;
        }
    }
}