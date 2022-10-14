<?php require __DIR__ . '/vendor/autoload.php';?>

<?php
use Src\Controller;

// alle Fehler anzeigen
error_reporting(E_ALL);
// Fehler in der Webseite anzeigen (nicht in Produktion verwenden)
ini_set('display_errors', 'On');
// Fehler in Log-Datei schreiben (absolut oder relativ)
// ini_set('error_log', '/var/www/virtual/meine-domain.de/logs/php-errors.log');
ini_set('log_errors', 'On');
ini_set('error_log', 'php-errors.log'); ?>

<?php
$mainMenu = new Controller\MainMenuController();
$products = new Controller\ProductsController();

$smarty = new Smarty();
if(!isset($_GET['page'])) {
    $strForMenuLink = $mainMenu->getMenuAsArr('menuCategorys');
    $smarty->assign('home');
    $smarty->assign('menu', $strForMenuLink);
    $smarty->assign('name');
    $smarty->assign('description');
}
if(isset($_GET['productId'])){
    $smarty->assign('home', '<a href="index.php">Home</a>');
    $pageName = $_GET['page'];
    $productId = $_GET['productId'];
        $strForCategoryLink = $products->getCategorysAsArr('products', $productId);
        $smarty->assign('menu', $strForCategoryLink);
        $smarty->assign('name');
        $smarty->assign('description');
}
if(isset($_GET['id'])){
    $smarty->assign('home', '<a href="index.php">Home</a>');
    $pageId = $_GET['id'];
    $strForProductName = $products->getProductName('products', $pageId);
    $strForProductDescription = $products->getProductDescription('products',$pageId);
    $smarty->assign('menu');
        $smarty->assign('name', $strForProductName);
        $smarty->assign('description', $strForProductDescription);
}
/*if(isset($_GET['id'])){
    $pageName = $_GET['page'];
    $pageId = $_GET['id'];
    $strForProductsLink = $products->getProductsAsArr('products', $pageId);
    $smarty->assign('menu', $strForProductsLink);
}*/
//$smarty->assign('homelink', '<a href="index.tpl">HOME</a>');
$smarty->addTemplateDir(__DIR__.'/src/templates');
$smarty->display('index.tpl');

?>


