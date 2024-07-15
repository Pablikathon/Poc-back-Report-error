<?php 

namespace App\Service\Host;


use App\Entity\Host;
use App\Repository\HostRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\AST\WhereClause;
use PhpParser\Node\Expr\BinaryOp\NotEqual;

use function PHPUnit\Framework\isNull;

class HostService implements IHostService
{
    private $entityManager;
    private $hostRepository;
    public function __construct(EntityManagerInterface $entityManager,HostRepository $hostRepository)
    {
        $this->entityManager = $entityManager;
        $this->hostRepository = $hostRepository;
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

}