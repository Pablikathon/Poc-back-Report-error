<?php
namespace App\Service\Serializer;

interface ISerializerService
{
    public function  serialize(mixed $ToSerialize) : string;
}