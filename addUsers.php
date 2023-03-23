<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/cadUser.css">
    
    <title>Registre - MeKart</title>
</head>
<body>

    <?php
        $sessao = 0;
        if(session_status() !== PHP_SESSION_ACTIVE){
           session_start();
       }
       if(empty($_SESSION)){
           unset($_SESSION);
           echo"<a>Parece que você não possui permissão para estar aqui</a>";
       }else{
           $sessao = 1;
           echo"";
           if($_SESSION['nivel'] == 1){
               $reg = $_POST;
               $exists = 0;
               if(isset($_POST['subButton']) ){
                   unset($reg['subButton']);
                   unset($reg['confPass']);
                   if (file_exists('./json/users.json')) {
                       $arq = file_get_contents('./json/users.json');
                       $arq = json_decode($arq,true);
                       foreach($arq as $el){
                           if($el['username'] == $reg['username'] || $el['email'] == $reg['email']){
                               $exists += 1;
                               break;
                           }
                       }
                       if($exists >= 1){
                           echo"<dialog name=".'"avisoreg"'.' id='.'"avisoreg"'."open><h2>AVISO:</h2><p>Usuário ou Email já está registrado!</p></dialog>";
                       }else{
                           array_push($arq,$reg);
                           $reg_json = json_encode($arq);
                           file_put_contents("./json/users.json", $reg_json);
                           if(file_put_contents("./json/users.json",$reg_json)){
                               echo"<dialog open><h2>SUCESSO:</h2><p>Usuário criado com sucesso!</p></dialog>";
                               header("Refresh: 1.3, url = painelUser.php");
                           }
                       }
                   }else{
                       $arq = array(0=>$reg);
                       $arq = json_encode($arq);
                       if(file_put_contents("./json/users.json", $arq)){
                           echo"<dialog open><h2>SUCESSO:</h2><p>Usuário criado com sucesso!</p></dialog>";
                           header("Refresh: 1, url = painelUser.php");
                        }
                   }
               }
           }
        }
    
    ?>
    <div class="container">
        <fieldset id="home" name="home" class="home">
        <div class="cabecalho">
                <img src="./assets/logoPNG.png" alt="Logo" name="logopng" id="logopng">
                <h3>Add!</h3>
            </div>
            <form method="post" name="form" id="form">
                <div class="form_btn">
                    <div class="form1">
                        <div class="nome">
                            <div class="label">
                                <label>Nome Completo:</label>
                            </div>
                            <input type="text" name="nome" id="nome" class="input" placeholder="Digite seu nome completo !" required>
                        </div>
        
                        <div class="usuario">
                            <div class="label">
                                <label>Usuário:</label>
                            </div>
                            <input type="text" name="username" id="username" class="input" placeholder="Crie Seu Usuário !" required>
                        </div>
                        <div class="genero">
                            <div class="label">
                                <label>Gênero:</label>
                            </div>
                            <div class="ipt_radio">
                                <input type="radio" name="genero" id="genero" value="Feminino" required checked><label> Feminino</label>
                                <input type="radio" name="genero" id="genero" value="Masculino" required><label> Masculino</label>
                                <input type="radio" name="genero" id="genero" value="Outros" required><label> Outros</label>
                            </div>
                        </div>
                        <div class="email">
                            <div class="label">
                                <label>E-mail:</label>
                            </div>
                            <input type="email" name="email" id="email" class="input" placeholder="Digite seu E-mail !" required>
                        </div>
        
                        <div class="telefone">
                            <div class="label">
                                <label>Telefone:</label>
                            </div>
                            <input type="text" name="telefone" id="telefone" class="input" placeholder="(xx) xxxx-xxxx">
                        </div>
                    </div>
                    <div class="form2">
                        <div class="nascimento">
                            <div class="label">
                                <label>Data de Nascimento:</label>
                            </div>
                            <input type="date" name="nascimento" id="nascimento" class="input" required>
                        </div>
        
                        <div class="cpf">
                            <div class="label">
                                <label>CPF:</label>
                            </div>
                            <input type="text" name="cpf" id="cpf" class="input" placeholder="xxx.xxx.xxx-xx" oninput="mascaracpf(this)" required>
                        </div>
        
                        <div class="senha">
                            <div class="label">
                                <label>Senha:</label>
                            </div>
                            <input type="password" name="pass" id="pass" class="input" placeholder="Crie Sua Senha !" required>
                        </div>
        
                        <div class="confSenha">
                            <div class="label">
                                <label>Confirmar Senha:</label>
                            </div>
                            <input type="password" name="confPass" id="confPass" class="input" placeholder="Digite Sua Senha Novamente !" required>
                        </div>
        
                        <div class="hidden">
                            <input type="hidden" name="nivel" value="0">
                        </div>
                    </div>
                </div>
            
                <button type="submit" name="subButton" id="subButton" value="registrar">Adicionar</button>

            </form>
            <div class="registrar">
                <a href="painelUser.php" nome="registrar" id="registrar">Voltar para o Painel de Usuários!</a>
            </div>
        </fieldset>
    </div>
<script src="./js/masks.js"></script>
</body>
</html>