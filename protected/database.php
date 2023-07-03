<?php
    abstract class Database 
    {
        private $host = "localhost";
        private $user = "root";
        private $password = "";
        private $db = "sin1049";
        
        protected function connection()
        {
            $connection = mysqli_connect($this->host, $this->user, $this->password, $this->db);
            if (!$connection) {
                die("Erro na conexão com o banco de dados.");
            }
            return $connection;
        }
    }    
?>