<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Painel de Usuários - MeKar</title>
</head>
<body>
    
    <header>

        <?php
            $sessao = 0;
             if(session_status() !== PHP_SESSION_ACTIVE){
                session_start();
            }
            if(empty($_SESSION)){
                unset($_SESSION);
                echo"<P>:(</P>";
            }else{
                $sessao = 1;
                echo"
                <div class="."'user'".">
                <button id="."'btnLogout'"." name="."'btnLogout'"." class="."'botao'"."onClick=".'"location.href='."'voltarProLogin.php'".'"'."> Sair </button>
                <div class="."'infoUser'".">
                    <img src="."'./assets/profilePadrao.png'"." alt="."'icone do perfil.'".">
                    <p>".$_SESSION['nome']."</p>
                </div>
                </div>
                ";
                if($_SESSION['nivel'] == 1){
                    echo"<nav>
                    <a href=".'"home.php"'.">Página Principal</a>
                    <a href=".'"painelUser.php"'.">Usuários</a>
                    <a href=".'"listCars.php"'.">Carros</a>
                    <a href=".'"listSoli.php"'.">Solicitações</a>
                    </nav>";
                }
                if($_SESSION['nivel'] == 2){
                    echo"<nav>
                    <a href=".'"home.php"'.">Página Principal</a>
                    <a href=".'"listCars.php"'.">Carros</a>
                    <a href=".'"listSoli.php"'.">Solicitações</a>
                    </nav>";
                }
            }
            
            ?>

<div class="img">
    <h1>MeKar</h1>
    <img src="./assets/logoPNG.png" alt="Logo da Empresa">
</div>
    </header>

    <main>

            <?php
                if($sessao == 1){
                    if($_SESSION['nivel'] == 1){
                        echo"<h1>Lista - Usuários</h1>
                        <button onClick=location.href="."'addUsers.php'"." id="."'addButton'".">Add</button>";
                        $nivel = 'EMPTY';
                        if(file_exists("./json/users.json")){
                            $arq = file_get_contents("./json/users.json");
                            $arq = json_decode($arq, true);
                            echo"
                            <div class=".'php'.">
                            <table>
                            <tr>
                                <thead>
                                    <td>Nivel</td>
                                    <td>Nome Completo</td>
                                    <td>Nascimento</td>
                                    <td>Usuário</td>
                                    <td>Gênero</td>
                                    <td>E-mail</td>
                                    <td>Telefone</td>
                                    <td>CPF</td>
                                    <td>Senha</td>
                                    <td>Edit</td>
                                </thead>
                            </tr>
                            ";
                            foreach($arq as $el => $dados){
                                $pass = '';
                                for($i=0; $i<strlen($dados['pass']) ; $i++) { 
                                    $pass .= '*';
                                }
                                if($dados['nivel'] == 0){
                                    $nivel = 'User';
                                }
                                if($dados['nivel'] == 1){
                                    $nivel = 'Adm';
                                }
                                if($dados['nivel'] == 2){
                                    $nivel = 'Colaborador';
                                }

                                echo"
                                <tr>
                                <td>".$nivel."</td>
                                <td>".($dados['nome'])."</td>
                                <td>".($dados['nascimento'])."</td>
                                <td>".($dados['username'])."</td>
                                <td>".($dados['genero'])."</td>
                                <td>".($dados['email'])."</td>
                                <td>".($dados['telefone'])."</td>
                                <td>".($dados['cpf'])."</td>
                                <td>".$pass."</td>
                                <td><button  class="."editButton"." onClick=".'"location.href='."'uptUser.php?cod={$el}'".'"'." ><img src="."./assets/editButtom.png"." alt="."Edit"." value=".'"edit"'."></button> <button onClick=".'"location.href='."'delUser.php?cod={$el}'".'"'." ><img src="."./assets/deleteButtom.png"." alt="."Delete"."></button></td>
                                </tr>
                                ";
                            }
                            echo"</table>"; 
                        }else{
                            echo"<p>Parece que não há Arquivos a serem visualizados, ou, você não possui permissão</p>";
                        echo"<button class="."'botao'"." onClick=".'"location.href='."'home.php'".'"'.">Voltar para a Pagina Principal</button>";
                        }
                    }else{
                        echo"<p>Parece que não há Arquivos a serem visualizados, ou, você não possui permissão</p>";
                        echo"<button class="."'botao'"." onClick=".'"location.href='."'home.php'".'"'.">Voltar para a Pagina Principal</button>";
                    }

                }else{
                    echo"<p>Parece que não há Arquivos a serem visualizados, ou, você não possui permissão</p>";
                        echo"<button class="."'botao'"." onClick=".'"location.href='."'index.php'".'"'.">Por Favor, Verifique seu Login! </button>";
                }

            ?>

    </main>

</body>
</html>