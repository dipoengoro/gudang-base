<?php

namespace Dipoengoro\GudangBase\Repository;

use Dipoengoro\GudangBase\Entity\Barang;
use PDO;

interface BarangRepository
{
    function add(Barang $barang): void;

    function remove(string $id): void;

    function findAll(): array;

    function check(string $idBarang): bool;

    function find(string $idBarang): Barang;

    function updateId(string $idBarang, string $valueBaru): void;

    function updateNama(string $idBarang, string $valueBaru): void;

    function updateHarga(string $idBarang, string $valueBaru): void;

    function updateSatuan(string $idBarang, string $valueBaru): void;

    function updateSisa(string $idBarang, string $valueBaru): void;
}

class BarangRepositoryImpl implements BarangRepository
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function add(Barang $barang): void
    {
        $sql = "INSERT INTO 
                barang(
                    id_barang,
                    nama_barang, 
                    harga_satuan, 
                    satuan_barang,
                    sisa_barang
                ) 
                VALUES (?, ?, ?, ?, ?)";
        $statement = $this->connection->prepare($sql);

        $statement->execute([
            $barang->getIdBarang(),
            $barang->getNamaBarang(),
            $barang->getHargaSatuan(),
            $barang->getSatuanBarang(),
            $barang->getSisaBarang()
        ]);
    }

    public function remove(string $idBarang): void
    {
        $sql = "DELETE FROM barang WHERE id_barang = ?";
        $statement = $this->connection->prepare($sql);
        $statement->execute([$idBarang]);
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

    public function check(string $idBarang): bool
    {
        $sql = "SELECT id_barang FROM barang WHERE id_barang = ?";
        $statement = $this->connection->prepare($sql);
        $statement->execute([$idBarang]);

        if ($statement->fetch()) {
            return true;
        } else {
            return false;
        }
    }

    public function find(string $idBarang): Barang
    {
        $sql = "SELECT * FROM barang WHERE id_barang = ?";
        $statement = $this->connection->prepare($sql);
        $statement->execute([$idBarang]);
        $barang = new Barang();

        foreach ($statement as $row) {
            $barang->setIdBarang($row['id_barang']);
            $barang->setNamaBarang($row['nama_barang']);
            $barang->setHargaSatuan($row['harga_satuan']);
            $barang->setSatuanBarang($row['satuan_barang']);
            $barang->setSisaBarang($row['sisa_barang']);
        }
        return $barang;
    }

    public function updateId(string $idBarang, string $valueBaru): void
    {
        $sql = "UPDATE barang SET id_barang = ? WHERE id_barang = ?";
        $statement = $this->connection->prepare($sql);
        $statement->execute([$valueBaru, $idBarang]);
    }

    public function updateNama(string $idBarang, string $valueBaru): void
    {
        $sql = "UPDATE barang SET nama_barang = ? WHERE id_barang = ?";
        $statement = $this->connection->prepare($sql);
        $statement->execute([$valueBaru, $idBarang]);
    }

    public function updateHarga(string $idBarang, string $valueBaru): void
    {
        $sql = "UPDATE barang SET harga_satuan = ? WHERE id_barang = ?";
        $statement = $this->connection->prepare($sql);
        $statement->execute([$valueBaru, $idBarang]);
    }

    public function updateSatuan(string $idBarang, string $valueBaru): void
    {
        $sql = "UPDATE barang SET satuan_barang = ? WHERE id_barang = ?";
        $statement = $this->connection->prepare($sql);
        $statement->execute([$valueBaru, $idBarang]);
    }

    public function updateSisa(string $idBarang, string $valueBaru): void
    {
        $sql = "UPDATE barang SET sisa_barang = ? WHERE id_barang = ?";
        $statement = $this->connection->prepare($sql);
        $statement->execute([$valueBaru, $idBarang]);
    }
}
