<?php

use App\Entity\Server;
use Symfony\Component\HttpFoundation\Request;

interface IServerService {
    public function getServer(): Array;
    public function createServer(string $name, string $hostname): ?Server;
}