<?php 

namespace App\Service\Serializer;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
class SerializerService implements ISerializerService
{
    private $encoders; 
    private $normalizers; 

    private $serializer;
    public function __construct()
    {
        $this->encoders = [new XmlEncoder(), new JsonEncoder()];
        $this->normalizers = [new ObjectNormalizer()];
        $this->serializer = new Serializer($this->normalizers, $this->encoders);
    }
    public function serialize(mixed $ToSerialize):string 
    {
        return $json = $this->serializer->serialize($ToSerialize, 'json');
    }
}