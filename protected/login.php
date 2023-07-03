<?php
    require_once __DIR__ . "/database.php";

    class Login extends Database
    {
        private $connection;

        public function __construct()
        {
            $this->connection = $this->connection();
        }

        public function login(string $type, string $username, string $password)
        {
            $table = "login_$type";
            if ($type == "administrador") {
                $query = "SELECT A.id FROM $table LA
                            JOIN $type A ON A.id = LA.id_administrador
                            WHERE LA.username = '$username' AND LA.password = '$password'";
            } elseif ($type == "professor") {
                $query = "SELECT P.id FROM $table LP
                            JOIN $type P ON P.id = LP.id_professor
                            WHERE LP.username = '$username' AND LP.password = '$password'";
            } elseif ($type == "aluno") {
                $query = "SELECT A.id FROM $table LA
                            JOIN $type A ON A.id = LA.id_aluno
                            WHERE LA.username = '$username' AND LA.password = '$password'";
            }
            $sql = mysqli_query($this->connection,$query);
            if (!$sql) {
                die("Falha na consulta ao banco.");
            }
            $result = mysqli_fetch_assoc($sql);
            if (empty($result)) {
                return False;
            } else {
                $_SESSION["user"] = $result["id"];
                $_SESSION["type"] = $type;
                return True;
            }
        }

        public function checkUserLogged()
        {
            if (!isset($_SESSION["user"])) {
                header("Location: /login");
            }
        }

        public function checkUserType()
        {
            if (!isset($_SESSION["type"])) {
                header("Location: /login");
            } elseif ($_SESSION["type"] == "administrador") {
                $route = $_SERVER["REQUEST_URI"];
                if ($route != "/administrador") {
                    header("Location: /administrador");
                }
            } elseif ($_SESSION["type"] == "professor") {
                $route = $_SERVER["REQUEST_URI"];
                if ($route != "/professor") {
                    header("Location: /professor");
                }
            } elseif ($_SESSION["type"] == "aluno") {
                $route = $_SERVER["REQUEST_URI"];
                if ($route != "/aluno") {
                    header("Location: /aluno");
                }
            }
        }
    }

?>