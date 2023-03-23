<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Carros - MeKar</title>
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

    <h1>Lista - Solicitações</h1>
    <?php
                if($sessao == 1){
                    if($_SESSION['nivel'] == 1 ||$_SESSION['nivel'] == 2){
                        $nivel = 'EMPTY';
                        if(file_exists("./json/solicitacoes.json")){
                            $arq = file_get_contents("./json/solicitacoes.json");
                            $arq = json_decode($arq, true);
                            if(!empty($arq)){
                                echo"
                                <div class=".'php'.">
                                <table>
                                <tr>
                                    <thead>
                                        <td>Nome</td>
                                        <td>E-mail</td>
                                        <td>Telefone</td>
                                        <td>Marca</td>
                                        <td>Modelo</td>
                                        <td>Cor</td>
                                        <td>Ano</td>
                                        <td>Estilo</td>
                                        <td>Preço</td>
                                        <td>Data_Retirada</td>
                                        <td>Data_Entrega</td>
                                        <td>Edit</td>
                                    </thead>
                                </tr>
                                ";
                                foreach($arq as $el => $dados){
                                    echo"
                                    <tr>
                                    <td>".($dados['nome'])."</td>
                                    <td>".($dados['email'])."</td>
                                    <td>".($dados['telefone'])."</td>
                                    <td>".($dados['marca'])."</td>
                                    <td>".($dados['modelo'])."</td>
                                    <td>".($dados['cor'])."</td>
                                    <td>".($dados['ano'])."</td>
                                    <td>".($dados['estilo'])."</td>
                                    <td>R$".($dados['preco'])."</td>
                                    <td>".($dados['data_retirada'])."</td>
                                    <td>".($dados['data_devolucao'])."</td>
                                    <td><button  class="."editButton"." onClick=".'"location.href='."'uptCars.php?cod={$el}'".'"'." ><img src="."./assets/editButtom.png"." alt="."Edit"." value=".'"edit"'."></button> <button onClick=".'"location.href='."'delSoli.php?cod={$el}'".'"'." ><img src="."./assets/deleteButtom.png"." alt="."Delete"."></button></td>
                                    </tr>
                                    ";
                                }
                                echo"</table>"; 
                            }else{
                                echo"<p>Parece que não há Arquivos a serem visualizados, ou, você não possui permissão</p>";
                                echo"<button onClick=location.href="."'cadCars.php'".">Add</button>";
                            }
                        }else{
                            echo"<p>Parece que não há Arquivos a serem visualizados, ou, você não possui permissão</p>";
                            echo"<button onClick=location.href="."'cadCars.php'".">Add</button>";
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