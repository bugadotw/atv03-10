<?php 
include_once("conexao.php");
$id = 0;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
    if($id != 0 && $id != null){
        $conn = Conexao::getConexao();
        $sql = "DELETE FROM livros WHERE id=?"; 
        $stm =$conn ->prepare($sql);
        $stm->execute($id);
    }
    else{
        echo'falso';
        echo'<a href="livro.php">Voltar</a>';
    }
?>