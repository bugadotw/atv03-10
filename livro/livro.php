<?php
//Configuração para mostrar os erros
ini_set('display_errors', 1);
error_reporting(E_ALL);

include_once("conexao.php");

$conn = Conexao::getConexao();
//print_r($conn);
 


if (isset($_POST["titulo"])) {
   // echo"User click";
    $titulo = $_POST['titulo'];
    $genero =$_POST['genero'];
    $qtd_paginas =$_POST ['qtd_paginas'];
   // echo$titulo." - ".$genero." - ".$qtdPaginas;
   
   if($qtd_paginas != null && $genero != null&& $titulo!= null){
    $sql='INSERT INTO livros(titulo,genero,qtd_paginas)
   values(?,?,?)';
    $stm = $conn->prepare($sql);
    $stm->execute([$titulo,$genero,$qtd_paginas]) ;
    header("location: livro.php");
   }
   else{
    echo"<br><p name='al'>Insira todos os valores</p>";
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de livros</title>
    <style>
        body{
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;

        }
        p{
            color: brown;
        }
    </style>
</head>
<body>
    <h3>Formulário do livro</h3>
    <form method="POST">

        <input type="text" name="titulo"
            placeholder="Informe o título" />

        <br><br>

        <select name="genero">
            <option value="">---Selecione o gênero---</option>
            <option value="A">Aventura</option>
            <option value="D">Drama</option>
            <option value="F">Ficção</option>
            <option value="R">Romance</option>
            <option value="O">Outro</option>
        </select>

        <br><br>

        <input type="number" name="qtd_paginas" 
            placeholder="Informe a quantidade de páginas" />

        <br><br>

        <input type="submit" value="Gravar" />
        <input type="reset" value="Limpar" />
    </form>


    <?php 
     $sql ="SELECT * FROM livros";
     $stm =$conn->prepare($sql);
     $stm-> execute();
     $livros=$stm-> fetchAll();
    ?>
    <h3>Listagem dos livros</h3>
        <table border="1">
        <tr>
            <td>ID:</td>
            <td>titulo:</td>
            <td>genero:</td>
            <td>paginas:</td>
        </tr>
        <?php foreach($livros as $l): ?>
            <tr>
                <td><?php echo $l['id'] ?></td>
                <td><?php echo $l['titulo']." "?></td>
                <td><?php echo $l['genero'] ?></td>
                <td><?php echo $l['qtd_paginas'] ?></td>
                <td>
                    <a href="livro_del.php?id="<?=$l["id"]?>><button>Excluir</button></a>
                </td>
            </tr>
        <?php endforeach?>

        </table>
</body>
</html>