<?php
require_once __DIR__ . "../../../vendor/autoload.php";
require_once __DIR__ . "../../Repository/Repository.php";
require_once __DIR__ . "../../Service/Service.php";

use Dipoengoro\GudangBase\Repository\BarangRepositoryImpl;
use Dipoengoro\GudangBase\Service\BarangServiceImpl;
use Dipoengoro\GudangBase\Util\Connect;

function testShowBarang(): void
{
    $connection = Connect::getConnection();
    $barangRepository = new BarangRepositoryImpl($connection);
    $barangService = new BarangServiceImpl($barangRepository);
    $barangService->showBarang();
    $connection = null;
}

function testRepository(): PDO
{
    $connection = Connect::getConnection();
    try {
        $barangRepository = new BarangRepositoryImpl($connection);
    } catch(Exception $e) {
        echo $e->getMessage();
    }
    
    // $result = $barangRepository->remove("dfada");
    return $connection;
}

testShowBarang();
