<?php

declare(strict_types=1);

namespace App\Model;


use App\Model\Dto\MainMenuDataTransferObject;
use App\Model\Dto\ProductsDataTransferObject;
use App\Model\Dto\SubMenuDataTransferObject;
use App\Model\Mapper\MainMenuMapper;
use App\Model\Mapper\MainMenuMapperInterface;
use App\Model\Mapper\ProductsMapperInterface;
use App\Model\Mapper\SubMenuMapper;
use App\Model\Mapper\SubMenuMapperInterface;
use App\SQL\SqlConnectionInterface;
use PDO;

class ProductRepository implements ProductRepositoryInterface
{


    public function __construct(private readonly SqlConnectionInterface $dbConnection, private PDO $pdo, private ProductsMapperInterface $productsMapper,private SubMenuMapper $listMapper,  private MainMenuMapper $mainMapper)
    {
        $this->pdo = $this->dbConnection->connectToDatabase('0.0.0.0', 'shopix', 'TestUser', 'password', '13306');
    }

    /**
     * @param int $mainId
     * @return MainMenuDataTransferObject[]
     */
    public function getAllDataFromMainTable(): array
    {
        $string = "SELECT * FROM mainCategorys";
        $rows = $this->pdo->query($string);
        foreach ($rows as $row){
            $dto []= ($this->mainMapper->mapToMainDto($row));
        }
        return $dto;
    }

    /**
     * @param int $subId
     * @return SubMenuDataTransferObject[]
     */
    public function getAllDataFromSubCategorys(int $mainId): array
    {
        $string = "SELECT * FROM subCategorys ";
        $string .= "WHERE mainId =" . $mainId;
        $dto = [];
        foreach ($this->pdo->query($string) as $row) {
            $dto[] = $this->listMapper->mapToListDto($row);
        }

        return $dto;
    }
    /**
     * @param int $subId
     * @return ProductsDataTransferObject
     */
    public function getAllDataFromProducts($subId): ProductsDataTransferObject
    {
        $string = "SELECT * FROM products ";
        $string .= "WHERE subId =" . $subId;
        foreach ($this->pdo->query($string) as $row) {
            $dto = $this->productsMapper->mapToProductsDto($row);
        }
        return $dto;
    }

}