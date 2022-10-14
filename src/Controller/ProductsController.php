<?php

namespace src\Controller;

use Src\Model as Mod;

class ProductsController
{
    private $strForCategoryLinks = [];
    private $strForProductName = [];
    private $strForProductDescription = [];

    public function getMenuDataFromModel($fileName)
    {
        return (new Mod\Products())->getProductsFromJson($fileName);
    }
    public function getCategorysAsArr($fileName, $pageId){
        $categoryContent = $this->getMenuDataFromModel($fileName);
        foreach ($categoryContent as $categoryLink) {
            if($pageId === $categoryLink['productId']) {
                $this->strForCategoryLinks[] = 'index.php?page=' . $categoryLink['detail'] . '&id=' . $categoryLink['id'] . '>' . $categoryLink['displayName'];
            }
        }
        return $this->strForCategoryLinks;
    }
    public function getProductName($fileName, $pageId){
        $nameContent = $this->getMenuDataFromModel($fileName);
        foreach ($nameContent as $name) {
            if($pageId === $name['id']) {
                $this->strForProductName['Productname']= $name['displayName'].':';
            }
        }
        return $this->strForProductName;
    }
    public function getProductDescription($fileName, $pageId){
        $detailContent = $this->getMenuDataFromModel($fileName);
        foreach ($detailContent as $details) {
            if($pageId === $details['id']) {
                $this->strForProductDescription['Description']= $details['description'];
            }
        }
        return $this->strForProductDescription;
    }

}
?>