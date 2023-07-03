<?php
    require_once __DIR__ . "/database.php";

    class Aluno extends Database
    {
        private $connection;

        public function __construct()
        {
            $this->connection = $this->connection();
        }

        public function getUser(int $id)
        {
            $query = "SELECT nome, email, matricula, datanascimento FROM aluno WHERE id = $id";
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
            $query = "SELECT D.disciplina AS disciplina, P.nome AS nome  FROM disciplinas_cursadas DC
                        JOIN disciplinas D on D.id = DC.id_disciplina 
                        JOIN disciplinas_ministradas DM on DM.id_disciplina = DC.id_disciplina 
                        JOIN professor P on P.id = DM.id_professor 
                        WHERE DC.id_aluno = $id";
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

        public function getNotesAndAttendance(int $id)
        {
            $query = "SELECT D.disciplina, au.data_aula, P.presenca, N.nota FROM notas N
                        JOIN disciplinas_cursadas DC ON DC.id = N.id_disciplina_cursada
                        JOIN disciplinas D ON D.id = DC.id_disciplina 
                        JOIN aluno AL ON AL.id = DC.id_aluno 
                        JOIN aulas AU ON AU.id_disciplina_cursada = DC.id 
                        JOIN presencas P ON P.id_aula = AU.id 
                        where DC.id_aluno = $id";
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