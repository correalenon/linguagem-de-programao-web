<?php
    abstract class RouteSwitch
    {
        protected function inicio()
        {
            require __DIR__ . "/pages/inicio.php";
        }

        protected function login()
        {
            require __DIR__ . "/pages/login.php";
        }

        protected function administrador()
        {
            require __DIR__ . "/pages/administrador.php";
        }

        protected function administrador_actions()
        {
            require __DIR__ . "/pages/administrador_actions.php";
        }

        protected function professor()
        {
            require __DIR__ . "/pages/professor.php";
        }

        protected function aluno()
        {
            require __DIR__ . "/pages/aluno.php";
        }

        protected function logout()
        {
            require __DIR__ . "/pages/logout.php";
        }
        
        public function __call($name, $arguments)
        {
            http_response_code(404);
            require __DIR__ . "/pages/not-found.php";
        }
    }
?>