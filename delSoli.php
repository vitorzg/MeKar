<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>MeKar</title>
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
            if($_SESSION['nivel'] >= 1){
                echo"<nav>
                    <a href=".'"home.php"'.">Página Principal</a>
                    <a href=".'"painelUser.php"'.">Usuários</a>
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

                $cod = filter_input(INPUT_GET, "cod", FILTER_VALIDATE_INT);
                if($_SESSION['nivel'] == 1 || $_SESSION['nivel'] == 2){

                    
                    if(file_exists("./json/solicitacoes.json")){
                        $arq = file_get_contents("./json/solicitacoes.json");
                        $arq = json_decode($arq,true);
                        unset($arq[$cod]);
                        $arq = json_encode($arq);
                        file_put_contents("./json/solicitacoes.json", $arq);
                        header("location: listSoli.php");
                    }else{
                        echo"<p>Parece que não há Arquivos a serem visualizados, ou, você não possui permissão</p>";
                        echo"<button class="."'botaoVoltar'"." onClick=".'"location.href='."'home.php'".'"'.">Voltar para a Pagina Principal</button>";
                    }

                }else{
                    echo"<p>Parece que não há Arquivos a serem visualizados, ou, você não possui permissão</p>";
                    echo"<button class="."'botaoVoltar'"." onClick=".'"location.href='."'home.php'".'"'.">Voltar para a Pagina Principal</button>";
                }

            ?>

        </main>


</body>
</html>


