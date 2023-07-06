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
            $query_aluno = "INSERT INTO aluno (nome, email, matricula, datanascimento) VALUES ('$nome', '$email', '$matricula', '$datanascimento')";
            $query_login = "INSERT INTO login_aluno (username, id_aluno, password)
                            SELECT email, id, matricula FROM aluno WHERE nome = '$nome' 
                            AND email = '$email' AND matricula = '$matricula' AND datanascimento = '$datanascimento'";

            $sql_aluno = mysqli_query($this->connection, $query_aluno);
            $sql_login = mysqli_query($this->connection, $query_login);
            if (!$sql_aluno && !$sql_login) {
                die("Falha na consulta ao banco.");
            }
            if (empty($sql_aluno) || empty($sql_login)) {
                return False;
            } else {
                return array($sql_aluno, $sql_login);
            }
        }

        public function updateStudent(string $id, string $nome, string $email, string $matricula, string $datanascimento)
        {
            $query_aluno = "UPDATE aluno SET nome = '$nome', email = '$email', matricula = '$matricula', datanascimento = '$datanascimento' WHERE id = '$id'";
            $query_login = "UPDATE login_aluno SET username = '$email' WHERE id_aluno = '$id'";

            $sql_aluno = mysqli_query($this->connection, $query_aluno);
            $sql_login = mysqli_query($this->connection, $query_login);
            if (!$sql_aluno && !$sql_login) {
                die("Falha na consulta ao banco.");
            }
            if (empty($sql_aluno) || empty($sql_login)) {
                return False;
            } else {
                return array($sql_aluno, $sql_login);
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
            $query = "SELECT P.id, P.nome, P.email, P.datanascimento, D.disciplina, D.id AS id_disciplina from disciplinas_ministradas DM 
                        JOIN professor P ON P.id = DM.id_professor 
                        JOIN disciplinas D ON D.id = DM.id_disciplina";
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

        public function createTeacher(string $nome, string $email, string $datanascimento)
        {
            $query_professor = "INSERT INTO professor (nome, email, datanascimento) VALUES ('$nome', '$email', '$datanascimento')";
            $query_login = "INSERT INTO login_professor (username, id_professor, password)
                            SELECT email, id, datanascimento FROM professor WHERE nome = '$nome' 
                            AND email = '$email' AND datanascimento = '$datanascimento'";

            $sql_professor = mysqli_query($this->connection, $query_professor);
            $sql_login = mysqli_query($this->connection, $query_login);
            if (!$sql_professor && !$sql_login) {
                die("Falha na consulta ao banco.");
            }
            if (empty($sql_professor) || empty($sql_login)) {
                return False;
            } else {
                return array($sql_professor, $sql_login);
            }
        }

        public function updateTeacher(string $id, string $nome, string $email, string $datanascimento)
        {
            $query_professor = "UPDATE professor SET nome = '$nome', email = '$email', datanascimento = '$datanascimento' WHERE id = '$id'";
            $query_login = "UPDATE login_professor SET username = '$email' WHERE id_professor = '$id'";

            $sql_professor = mysqli_query($this->connection, $query_professor);
            $sql_login = mysqli_query($this->connection, $query_login);
            if (!$sql_professor && !$sql_login) {
                die("Falha na consulta ao banco.");
            }
            if (empty($sql_professor) || empty($sql_login)) {
                return False;
            } else {
                return array($sql_professor, $sql_login);
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

        public function getDisciplines()
        {
            $query = "SELECT id, disciplina FROM disciplinas";
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

        public function linkStudentInDiscipline(string $id_aluno, string $id_disciplina)
        {
            $query = "INSERT INTO disciplinas_cursadas (id_aluno, id_disciplina) VALUES ('$id_aluno', '$id_disciplina')";
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
