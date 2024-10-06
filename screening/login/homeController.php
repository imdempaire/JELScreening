<?php
    class homeController{
        private $MODEL;
        public function __construct()
        {
            require_once("homeModel.php");
            $this->MODEL = new homeModel();
        }
        public function guardarUsuario($nombre,$correo,$contraseña,$colegio,$tipo,$pais,$NoCompara,$baja,$provincia,$localidad,$logo){
            // Le saco el encriptado para grabar la contraseña
            // $valor = $this->MODEL->agregarNuevoUsuario($nombre,$this->limpiarcorreo($correo),$this->encriptarcontraseña($this->limpiarcadena($contraseña)),$colegio,$tipo,$pais,$NoCompara,$baja,$provincia,$localidad);
            $valor = $this->MODEL->agregarNuevoUsuario($nombre,$this->limpiarcorreo($correo),$contraseña,$colegio,$tipo,$pais,$NoCompara,$baja,$provincia,$localidad,$logo);
            return $valor;
        }
        public function limpiarcadena($campo){
            $campo = strip_tags($campo);
            $campo = filter_var($campo, FILTER_UNSAFE_RAW);
            $campo = htmlspecialchars($campo);
            return $campo;
        }
        public function limpiarcorreo($campo){
            $campo = strip_tags($campo);
            $campo = filter_var($campo, FILTER_SANITIZE_EMAIL);
            $campo = htmlspecialchars($campo);
            return $campo;
        }
        public function encriptarcontraseña($contraseña){
            return password_hash($contraseña,PASSWORD_DEFAULT);
        }
        public function verificarusuario($correo,$contraseña){
            $keydb = $this->MODEL->obtenerclave($correo);
            // Le saco el encriptado para verirficar la contraseña
            // return (password_verify($contraseña,$keydb)) ? true : false;
            return ($contraseña == $keydb) ? true : false;
        }
        public function verificarusuariodocente($correo,$contraseña){
            $keydb = $this->MODEL->obtenerclavedocente($correo);
            // Le saco el encriptado para verirficar la contraseña
            // return (password_verify($contraseña,$keydb)) ? true : false;
            return ($contraseña == $keydb) ? true : false;
        }
    }
?>