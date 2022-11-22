<?php

declare(strict_types=1);

namespace AppTest\Controller\jsons;

class jsonDecode
{

    private $array = array(
        "userId" => 1,
        "userName" => "testUser",
        "password"
    );

    public function __construct()
    {
        $this->createJson($this->array);
    }

    public function createJson($array)
    {
        $json = json_encode($array);
        file_put_contents("HomeJsonTest.json", $json);
    }
}