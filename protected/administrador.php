<?php
    require_once __DIR__ . "/database.php";

    class Administrador extends Database
    {
        private $connection;

        public function __construct()
        {
            $this->connection = $this->connection();
        }

        public function getStudents()
        {
            $query = "SELECT nome, email, matricula, datanascimento FROM aluno";
            $sql = mysqli_query($this->connection, $query);
            if (!$sql) {
                die("Falha na consulta ao banco.");
            }
            if (empty($sql)) {
                return False;
            } else {
                return $sql;
            }
        }

        public function getTeachers()
        {
            $query = "SELECT nome, email, datanascimento FROM professor";
            $sql = mysqli_query($this->connection, $query);
            if (!$sql) {
                die("Falha na consulta ao banco.");
            }
            if (empty($sql)) {
                return False;
            } else {
                return $sql;
            }
        }

        public function getNotes()
        {
            $query = "SELECT A.nome, D.disciplina, N.nota FROM notas N
                        JOIN disciplinas_cursadas DC ON DC.id_disciplina = N.id_disciplina_cursada 
                        JOIN disciplinas D ON D.id  = DC.id_disciplina 
                        JOIN aluno A ON A.id = DC.id_aluno ";
            $sql = mysqli_query($this->connection, $query);
            if (!$sql) {
                die("Falha na consulta ao banco.");
            }
            if (empty($sql)) {
                return False;
            } else {
                return $sql;
            }
        }
    }
?>
