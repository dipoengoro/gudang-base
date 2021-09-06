<?php
namespace Dipoengoro\GudangBase\Repository;

use Dipoengoro\GudangBase\Entity\Barang;
use PDO;

interface BarangRepository
{
    function add(Barang $barang): bool;

    function remove(string $id): bool;

    function findAll(): array;
}

class BarangRepositoryImpl implements BarangRepository
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function add(Barang $barang): bool
    {
        return true;
    }

    public function remove(string $idBarang): bool
    {
        return true;
    }

    public function findAll(): array
    {

        $sql = "SELECT * FROM barang";
        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $result = [];

        foreach ($statement as $row) {
            $barang = new Barang();
            $barang->setIdBarang($row['id_barang']);
            $barang->setNamaBarang($row['nama_barang']);
            $barang->setHargaSatuan($row['harga_satuan']);
            $barang->setSatuanBarang($row['satuan_barang']);
            $barang->setSisaBarang($row['sisa_barang']);

            $result[] = $barang;
        }

        return $result;
    }
}
