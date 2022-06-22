<?php
//DECLARAÇÃO DE VARIAVEIS
$erroNome = "";
$erroEmail = "";
$erroSenha = "";
$erroRepeteSenha = "";

    //Verificar se o POST nome esta vazio
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(empty($_POST['nome'])){
            $erroNome = "Preencha um nome";
        }else{
            //Pegar o valor vindo do POST e limpar
            $nome = limpaPost($_POST['nome']);

            //Verificar se tem somente letras
            if(!preg_match("/^[a-zA-Z-' ]*$/", $nome)){
              $erroNome = "Apenas letras e espaços";
            }
        }

        //Verificar se o POST EMAIL esta vazio
        if(empty($_POST['email'])){
          $erroEmail = "Informe um email";
        }else{
      //Pegar o valor vindo do POST e limpar
          $email = limpaPost($_POST['email']);
         if(filter_var($email, FILTER_VALIDATE_EMAIL)){
             $erroEmail = "Email invalido!";
          }  
      }

      //Verificar se o POST SENHA esta vazio
      if(empty($_POST['senha'])){
          $erroSenha = "Preencha um senha";
      }else{
          //Pegar o valor vindo do POST e limpar
          $senha = limpaPost($_POST['senha']);

          //Verificar se tem somente letras
          if(strlen($senha) < 6){
            $erroSenha = "Senha com no mínimo 6 digitos";//strlen : conta letras
          }
      }

      //Verificar se o POST REPETE_SENHA esta vazio
      if(empty($_POST['repete_senha'])){
        $erroRepeteSenha = "Repita a senha corretamente!";
       }else{
        //Pegar o valor vindo do POST e limpar
        $repete_senha = limpaPost($_POST['repete_senha']);
        //Verificar se tem somente letras
        if($repete_senha !== $senha){
            $erroRepeteSenha = "Senha diferente";
        }
    }

    if(($erroNome == "") && ($erroEmail == "")  &&  ($erroRepeteSenha == "")){
      header('Location: obrigado.php');
    }

  }

    function limpaPost($valor){
        $valor = trim($valor);
        $valor = stripslashes($valor);
        $valor = htmlspecialchars($valor);
        return $valor;
    }
?>




<!--   HTML    -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validação de Formulário</title>
    <link href="css/estilo.css" rel="stylesheet">
</head>
<body>
    <main>
    <h1><span>CADASTRO</span></h1><br><h2>Validação de Formulário</h2>

     <form method="post">

        <!-- NOME COMPLETO -->
        <label> Nome Completo </label>
        <input type="text" <?php if(!empty($erroNome)){echo "class = 'invalido'";}?><?php if(isset($_POST['nome'])){ echo "value='".$_POST['nome']."'";}?> name="nome" placeholder="Digite seu nome">
        <br><span class="erro"><?php echo $erroNome;?></span>

        <!-- EMAIL -->
        <label> E-mail </label>
        <input type="email" <?php if(!empty($erroEmail)){echo "class = 'invalido'";}?> <?php if(isset($_POST['email'])){ echo "value='".$_POST['email']."'";}?> name="email" placeholder="email@provedor.com">
        <br><span class="erro"><?php echo $erroEmail;?></span>

        <!-- SENHA -->
        <label> Senha </label>
        <input type="password" <?php if(!empty($erroSenha)){echo "class = 'invalido'";}?> <?php if(isset($_POST['senha'])){ echo "value='".$_POST['senha']."'";}?> name="senha" placeholder="Digite uma senha">
        <br><span class="erro"><?php echo $erroSenha;?></span>

        <!-- REPETE SENHA -->
        <label> Repete Senha </label>
        <input type="password" <?php if(!empty($erroRepeteSenha)){echo "class = 'invalido'";}?>  <?php if(isset($_POST['repete_senha'])){ echo "value='".$_POST['repete_senha']."'";}?> name="repete_senha" placeholder="Repita a senha">
        <br><span class="erro"><?php echo $erroRepeteSenha;?></span>

        <button type="submit"> Enviar Formulário </button>

      </form>
    </main>
</body>
</html>