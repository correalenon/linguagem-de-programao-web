<?php
    require_once __DIR__ . "/database.php";

    class Professor extends Database
    {
        private $connection;

        public function __construct()
        {
            $this->connection = $this->connection();
        }
        
        public function getUser(int $id)
        {
            $query = "SELECT nome, email, datanascimento FROM professor WHERE id = $id";
            $sql = mysqli_query($this->connection,$query);
            if (!$sql) {
                die("Falha na consulta ao banco.");
            }
            if (empty($sql)) {
                return False;
            } else {
                return $sql;
            }
        }

        public function getDisciplines(int $id)
        {
            $query = "SELECT disciplina FROM disciplinas D
                        JOIN disciplinas_ministradas DM on DM.id_disciplina = D.id 
                        JOIN professor P on P.id = DM.id_professor
                        WHERE P.id = $id";
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

        public function getStudents(int $id)
        {
            $query = "SELECT AL.nome, D.disciplina from aluno AL
                        JOIN disciplinas_cursadas DC on DC.id_aluno = AL.id 
                        JOIN disciplinas_ministradas DM on DM.id_disciplina = DC.id_disciplina 
                        JOIN disciplinas D on D.id = DM.id_disciplina 
                        JOIN professor P on P.id = DM.id_professor 
                        where P.id = $id";
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