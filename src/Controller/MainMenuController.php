<?php

namespace src\Controller;

use Src\Model as mod;

class MainMenuController
{
    private $strForMenuLinks = [];

    public function getMenuDataFromModel($fileName)
    {
        return (new Mod\MainMenu())->getMenuCategorysFromJson($fileName);
    }
    public function getMenuAsArr($fileName){
        $menuContent = $this->getMenuDataFromModel($fileName);
        foreach ($menuContent as $menuLink) {
            $this ->strForMenuLinks[] = 'index.php?page=' . $menuLink['category']. '&productId=' . $menuLink['id'] . '>' . $menuLink['displayName'];
        }
        return $this->strForMenuLinks;
    }
}
