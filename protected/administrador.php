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
            $query = "SELECT id, nome, email, matricula, datanascimento FROM aluno";
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

        public function createStudent(string $nome, string $email, string $matricula, string $datanascimento)
        {
            $query = "INSERT INTO aluno (nome, email, matricula, datanascimento) VALUES ('$nome', '$email', '$matricula', '$datanascimento')";
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

        public function updateStudent(string $id, string $nome, string $email, string $matricula, string $datanascimento)
        {
            $query = "UPDATE aluno SET nome = '$nome', email = '$email', matricula = '$matricula', datanascimento = '$datanascimento' WHERE id = '$id'";
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

        public function deleteStudent(string $id)
        {
            $query = "DELETE FROM aluno WHERE id = '$id'";
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
            $query = "SELECT id, nome, email, datanascimento FROM professor";
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

        public function updateTeacher(string $id, string $nome, string $email, string $datanascimento)
        {
            $query = "UPDATE professor SET nome = '$nome', email = '$email', datanascimento = '$datanascimento' WHERE id = '$id'";
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

        public function deleteTeacher(string $id)
        {
            print($id);
            $query = "DELETE FROM professor WHERE id = '$id'";
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
            $query = "SELECT N.id, A.nome AS aluno, D.disciplina, N.nota, P.nome as professor FROM notas N
                        JOIN disciplinas_cursadas DC ON DC.id_disciplina = N.id_disciplina_cursada 
                        JOIN disciplinas D ON D.id  = DC.id_disciplina 
                        JOIN disciplinas_ministradas DM ON DM.id_disciplina = D.id
                        JOIN professor P ON P.id = DM.id_professor
                        JOIN aluno A ON A.id = DC.id_aluno";
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

        public function updateNote(string $id, string $nota)
        {
            $query = "UPDATE notas SET nota = '$nota' WHERE id = '$id'";
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

        public function deleteNote(string $id)
        {
            $query = "DELETE FROM notas WHERE id = '$id'";
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
