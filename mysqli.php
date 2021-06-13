<?php
    class MySQLBase {
        
        protected $connection;
        public $hostinfo;

        public function __construct($hostname, $database, $username, $password) {
            $this->connection = new mysqli($hostname, $username, $password, $database);
            if ($this->connection->connect_errno) {
                echo "Failed to connect to MySQL: (" . $this->connection->connect_errno . ") " . $this->connection->connect_error;
            }
            $this->hostinfo = $this->connection->host_info ;
        }

        function __destruct() {
            $this->connection->close();
        }

        public function query($query) {
            $result = $this->connection->query($query);
            
            return $result;
        }
        
        public function getBy($tableName, $keyWhere, $valueWhere) {
            $query = "SELECT * FROM " . $tableName . " WHERE " . $keyWhere . " = " . $valueWhere;
            $result = $this->connection->query($query);
            
            return $result;
        }

        public function update($tableName, $dataArray, $keyWhere, $valueWhere) {
            /*
                UPDATE table_name
                SET column1 = value1, column2 = value2, ...
                WHERE condition;
            */
            $set = null;
            $arrayKeys = array_keys($dataArray);
            foreach ($arrayKeys as $key) {
                if (is_numeric($dataArray[$key])) {
                    $set = $set . $key . " = " . $dataArray[$key] . ", ";
                }else {
                    if (preg_match("/\/[a-z]*>/i", $dataArray[$key] ) != 0) {
                        $set = $set . $key . " = '" . addslashes($dataArray[$key]) . "', ";
                    } else {
                        $set = $set . $key . " = '" . $dataArray[$key] . "', ";
                    }
                }
            }
            $set = rtrim($set, ", ");
            $query = "UPDATE " . $tableName . " SET " . $set . " WHERE " . $keyWhere . " = " . $valueWhere;
        
            $queryact = $this->connection->query($query);
            
            $result = null;
            
            if (!$this->connection->affected_rows) {
                $result['status'] = 0;
                $result['message'] = "Query failed: (" . $this->connection->errno . ") " . $this->connection->error;
            }else{
                $result['status'] = 1;
                $result['message'] = "Edit successful!";
            }
            
            return $result;
        }
    }
