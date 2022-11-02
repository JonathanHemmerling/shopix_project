<?php

declare(strict_types=1);

namespace App\Core;

class View
{
    private \Smarty $smarty;

    public function __construct()
    {
        $this->smarty = new \Smarty();
    }

    public function addTemplateParameter(string $tplIdentifier, array $itemsToDisplay): void
    {
        $this->smarty->assign($tplIdentifier, $itemsToDisplay);
    }

    public function renderTemplate(string $tplName): void
    {
        $this->smarty->display(__DIR__ . '/../templates/' . $tplName);
    }

}
