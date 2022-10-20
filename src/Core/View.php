<?php

declare(strict_types=1);

namespace App\Core;

class View
{
    public function addTemplateParameter(mixed $parameter): string
    {
        return $parameter;
    }

    public function display(string $tplName, string $tplIdentifier, array $itemsToDiplay, \Smarty $smarty): void
    {
        $smarty = $smarty;
        $smarty->assign($tplIdentifier, $itemsToDiplay);
        $smarty->display(__DIR__ . '/../templates/' . $tplName);
    }

}
