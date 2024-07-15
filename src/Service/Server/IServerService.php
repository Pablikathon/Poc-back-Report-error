<?php
namespace App\Service\Server;
use App\Entity\Server;
interface IServerService {
    public function getServer(): Array;
    public function createServer(string $name, string $hostname): ?Server;
    public function updateServer(Server $server): ?Server;
}