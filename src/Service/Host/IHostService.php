<?php
namespace App\Service\Host;

use App\Entity\Host;

Interface IHostService{
    public function getHost(): Array;
    public function createHost(string $libelle): ?Host;
    public function updateHost(Host $host,string $libelle): bool;
    public function deleteHost(Host $host): bool;

}