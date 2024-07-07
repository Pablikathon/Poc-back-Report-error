<?php

use App\Entity\Host;

Interface IHostService{
    public function FindHostByName(string $hostname) : ?Host;
}