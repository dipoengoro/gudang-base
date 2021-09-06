<?php
require_once __DIR__ . "../../vendor/autoload.php";
require_once __DIR__ . "../../src/Repository/Repository.php";
require_once __DIR__ . "../../src/Service/Service.php";
require_once __DIR__ . "../../src/View/Gudang.php";


use Dipoengoro\GudangBase\Repository\BarangRepositoryImpl;
use Dipoengoro\GudangBase\Service\BarangServiceImpl;
use Dipoengoro\GudangBase\Util\Connect;
use Dipoengoro\GudangBase\View\GudangView;

echo "Aplikasi Gudang" . PHP_EOL;

$connection = Connect::getConnection();
$barangRepository = new BarangRepositoryImpl($connection);
$barangService = new BarangServiceImpl($barangRepository);
$gudangView = new GudangView($barangService);

$gudangView->showBarang();
