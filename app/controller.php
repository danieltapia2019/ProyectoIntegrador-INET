<?php
    session_start();

    include_once 'repository.php';

    /**
     * Clase controlador, utiliza PDO statement para sus operaciones
     */
    class Controlador{
        /**
         * Inserta usuarios en la base de datos
         */
        public static function insertarUsuario(Usuario $user){
            
        }
        /**
         * Crea la sesion para un usuario
         */
        public static function abrirSesionUsuario(Usuario $user){
            $_SESSION['usuario'] = $user;
        }
        /**
         * Destruye una sesion
         */
        public static function cerrarSesionUsuario(){
            session_unset();
            session_destroy();
        }
        /**
         * Crea la cookie del usuario
         * Param.: 
         *      $flag = bandera;
         *      $objValue = objeto || string;.
         */
        public static function hornear($flag,$objValue = null){
            switch ($flag) {
                case 'mode':
                    setcookie("UserMode",$objValue,time()+60*60*24*31,"/");
                    break;
                case 'user':
                    // setcookie("User[0]","logged",time()+60*60*24*31,true);
                    // setcookie("User[1]",$objValue->getUserName(),time()+60*60*24*31,true);
                    // setcookie("User[2]",$objValue->getEmail(),time()+60*60*24*31,true);
                    // setcookie("User[3]",$objValue->getFoto(),time()+60*60*24*31,true);
                    // setcookie("User[4]",$objValue->getAcceso(),time()+60*60*24*31,true);
                    break;
                default:
                    echo "Error<br/>Path:Controlador | hornear()<br/>";
                    break;
            }
        }
        /**
         * Destruye las cookies
         * Param.: 
         *      $flag = bandera;
         *      $objValue = objeto, string, etc.
         */
        public static function consumir($flag){
            switch ($flag) {
                case 'mode':
                    setcookie("UserMode","",time()-60*60*24*31*2,"/");
                    break;
                case 'user':
                    // setcookie("Usuario"," ",time()-60*60*24*31*2);
                    // setcookie("UserEmail"," ",time()-60*60*24*31*2);
                    // setcookie("UserFoto"," ",time()-60*60*24*31*2);
                    // setcookie("UserAcceso"," ",time()-60*60*24*31*2);
                    break;
                default:
                    break;
            }
        }
    }

?>