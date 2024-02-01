<?php
    namespace DB;
    require_once "Products.php";
    require_once "Users.php";
    class Database
    {
        private $hn;
        private $un;
        private $pw;
        private $dbn;
        private \mysqli $conn;

        public function __construct($hn, $un, $pw, $dbn) {
            $this->hostname = $hn;
            $this->username = $un;
            $this->password = $pw;
            $this->databasename = $dbn;
    
            $this->conn = new mysqli($this->hn, $this->un, $this->pw, $this->dbn);
        }

        public function OpenConnect()
        {
            $conn = new \mysqli(
                $this->hostname,
                $this->username,
                $this->password,
                $this->databasename
            );
            $this->conn = $conn;
        }
        public function getAllData($tn) {
            $sql = "SELECT * FROM $tn";
            $wyn = $this->conn->query($sql);
            $data = [];
    
            if ($wyn->num_rows > 0) {
                while ($row = $wyn->fetch_assoc()) {
                    $data[] = $row;
                }
            }
    
            return $data;
        }
    
        public function getRowByPrimarykey($tn, $primaryKeyValue) {
            $sql = "SELECT * FROM $tn WHERE id = '$primaryKeyValue'";
            $wyn = $this->conn->query($sql);
    
            if ($wyn->num_rows == 1) {
                return $wyn->fetch_assoc();
            } else {
                return null;
            }
        }
    
        public function getRowByUniqueIndex($tn, $uniqueIndexValue) {
            $sql = "SELECT * FROM $tn WHERE unique_index_column = '$uniqueIndexValue'";
            $wyn = $this->conn->query($sql);
    
            if ($wyn->num_rows == 1) {
                return $wyn->fetch_assoc();
            } else {
                return null;
            }
        }
        function product_help($row){
            $product = new Products();
            $product->setId($row['id']);
            $product->setEan($row['ean']);
            $product->setName($row['name']);
            $product->setDescription($row['description']);
            $product->setPrice($row['price']);
            $product->setCreatedAt($row['created_at']);
            $product->setUpdatedAt($row['updated_at']);
            $product->setDeletedAt($row['deleted_at']);
            return $product;
        }
    }