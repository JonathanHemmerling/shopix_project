<?php

declare(strict_types=1);
namespace AppTest\jsons;
class jsonDecode
{
    private $array = array(
        "0" => array(
            "id" => "1",
            "category" => "jeans",
            "displayName" => "Jeans"
        ),
        "1" => array(
            "id" => "2",
            "category" => "sweatshirts",
            "displayName" => "Sweatshirts"
        ),
        "2" => array(
            "id" => "3",
            "category" => "t-shirts",
            "displayName" => "T-Shirts"
        )
    );

    public function __construct()
    {
        $this->createJson($this->array);
    }

    public function createJson($array)
    {
        $json =json_encode($array);
        file_put_contents("HomeJsonTest.json", $json);
    }
}