<?php
class loginController extends controller {
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        
        $dados = array(
        	'aviso' => ''
        );

        if(isset($_POST['usuario']) && !empty($_POST['usuario'])) {

        	$u = addslashes($_POST['usuario']);
        	$s = md5($_POST['senha']);

        	$sql = "SELECT * FROM admins WHERE usuario = '$u' AND senha = '$s'";
            $sql = $this->db->query($sql);

            if($sql->rowCount() > 0) {
                $sql = $sql->fetch();
                $_SESSION['admlogin'] = $sql['id'];

                header("Location: /lojatupperware/painel");
            } else {
                $dados['aviso'] = 'Usuario e/ou senha errados!';
            }

        }

        $this->loadView('login', $dados);
    }

    public function sair() {
    	unset($_SESSION['admlogin']);
    	header("Location: /lojatupperware");
    }

}