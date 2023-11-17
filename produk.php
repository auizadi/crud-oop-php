<?php

class Product
{
    private $conn;
    private $table_name = "tbl_produk";

    public $id;
    public $nama;
    public $harga;
    public $foto;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " SET nama=?, harga=?, foto=?";

        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("sds", $this->nama, $this->harga, $this->foto);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function read()
    {
        $query = "SELECT id, nama, harga, foto FROM " . $this->table_name;

        $result = $this->conn->query($query);

        return $result;
    }

    public function update()
    {
        $query = "UPDATE " . $this->table_name . " SET nama=?, harga=?, foto=? WHERE id=?";

        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("sdsi", $this->nama, $this->harga, $this->foto, $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id=?";

        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("i", $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
