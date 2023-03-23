<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Paginá Principal - MeKar</title>
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
            echo"<button id="."'btnLogout'"." name="."'btnLogout'"." class="."'botao'"."onClick=".'"location.href='."'voltarProLogin.php'".'"'.">Logar</button>";
        }else{
            $sessao = 1;
            echo"
            <div class="."'user'".">
            <button id="."'btnLogout'"." name="."'btnLogout'"." class="."'botao'"."onClick=".'"location.href='."'voltarProLogin.php'".'"'.">Sair</button>
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
        <h1>Página Principal</h1>
            <div class="carros">
                <?php
                    if(file_exists("./json/cars.json")){
                        $arq = file_get_contents("./json/cars.json");
                        $arq = json_decode($arq, true);
                        if(!empty($arq)){
                            foreach($arq as $el => $dados){
                                echo"
                                <fieldset>
                                <div class="."'infoCar1'".">";

                                if($dados['estilo'] == 'Luxo'){
                                    echo"<img src="."'./assets/iconCarLuxo.png'"." alt="."'Icon Carro'".">";
                                }if($dados['estilo'] == 'Passeio'){
                                    echo"<img src="."'./assets/iconCarPasseio.png'"." alt="."'Icon Carro'".">";
                                }
                                if($dados['estilo'] == 'Esportivo'){
                                    echo"<img src="."'./assets/iconCarEsport.png'"." alt="."'Icon Carro'".">";
                                }
                                    
                                    echo"<h3>".$dados['marca']." - ".$dados['modelo']."</h3>
                                </div>
                                <div class="."'infoCar2'".">
                                    <div class="."'info2'".">
                                        <p>Estilo: ".$dados['estilo']."</p>
                                        <p>Cor: ".$dados['cor']."</p>
                                        <p>Ano: ".$dados['ano']."</p>
                                        
                                    </div>
                                    <div class="."'info2'".">
                                        <p>Câmbio: ".$dados['cambio']."</p>
                                        <p>Preço: R$".$dados['preco']."</p>
                                        <button onClick=".'"location.href='."'confAlugar.php?cod={$el}'".'"'.">Alugar!</button>
                                    </div>
                                </div>
                            </fieldset>
                                ";
                            }
                        }else{
                            echo"<p>Parece que não há Arquivos a serem visualizados.</p>";
                        }
                    }else{
                        echo"<p>Parece que não há Arquivos a serem visualizados</p>";
                    }
                
                ?>

            </div>
        </main>
        

</body>
</html>


