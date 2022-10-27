<?php

declare(strict_types=1);

namespace App\Model;

class ProductRepository
{
    public function getAllDataFromJson($fileName): array
    {
        $jsonFile = file_get_contents(__DIR__ . '/../jsons/' . $fileName . '.json');
        $mainMenuContent = json_decode($jsonFile, true);
        return $mainMenuContent;
    }

    public function findProductById(string $categoryId, string $id): array
    {
        $allDateOfOneEntry = [];
        $allData = $this->getAllDataFromJson('products');
        foreach ($allData as $concreteRecord) {
            if ($concreteRecord['id'] === $id && $concreteRecord['categoryId'] === $categoryId) {
                $allDateOfOneEntry[] = $concreteRecord['id'];
                $allDateOfOneEntry[] = $concreteRecord['detail'];
                $allDateOfOneEntry[] = $concreteRecord['displayName'];
                $allDateOfOneEntry[] = $concreteRecord['description'];
            }
        }
        return $allDateOfOneEntry;
    }

    public function findCategoryById(string $categoryId): array
    {
        $allDateOfOneCategory = [];
        $allData = $this->getAllDataFromJson('menuCategorys');
        foreach ($allData as $oneData) {
            if ($oneData['id'] === $categoryId) {
                $allDateOfOneCategory[] = $oneData['id'];
                $allDateOfOneCategory[] = $oneData['category'];
                $allDateOfOneCategory[] = $oneData['displayName'];
            }
        }
        return $allDateOfOneCategory;
    }
}