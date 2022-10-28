<?php

declare(strict_types=1);

namespace App\Core;

class View
{
    private \Smarty $smarty;
    private array $smartyArray = [];

    public function __construct(\Smarty $smarty){
       $this->smarty = $smarty;
    }

    public function addTemplateParameter(string $tplIdentifier, array $itemsToDisplay): void
    {
        $this->smarty->assign($tplIdentifier, $itemsToDisplay);
    }

    public function display(string $tplName): void
    {
        $this->smarty->display(__DIR__ . '/../templates/' . $tplName);
    }

}
