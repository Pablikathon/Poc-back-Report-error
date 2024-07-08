<?php
namespace App\Service;

use App\Entity\Host;

Interface IHostService{
    public function FindHostByName(string $hostname) : ?Host;
}