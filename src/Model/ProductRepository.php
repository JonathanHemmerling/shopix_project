<?php

declare(strict_types=1);

class ProductRepository
{
    public function getAllDataFromJson($fileName): array
    {
        $jsonFile = file_get_contents(__DIR__ . '/../jsons/' . $fileName . '.json');
        $mainMenuContent = json_decode($jsonFile, true);
        return $mainMenuContent;
    }
    public function findProductById(string $productId): string
    {
        $allData = $this->getAllDataFromJson('products');


        return '';
    }

    public function findCategoryById(string $categoryId): string
    {
        $allData = $this->getAllDataFromJson('menuCategorys');
        $oneDataArray = [];
        foreach ($allData as $oneData){
            if($oneData['id'] === $categoryId){
                $oneDataArray 
            }
        }
        return '';
    }
}