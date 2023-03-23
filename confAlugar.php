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
            header("location: index.php");
            die;
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
                <a href=>Solicitações</a>
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



<?php
            $reg = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            if(isset($_POST['subButton']) ){
                unset($reg['subButton']);
                if (file_exists('./json/solicitacoes.json')) {
                    $arq = file_get_contents('./json/solicitacoes.json');
                    $arq = json_decode($arq,true);
                    array_push($arq,$reg);
                    $reg_json = json_encode($arq);
                    file_put_contents("./json/solicitacoes.json", $reg_json);
                    if(file_put_contents("./json/solicitacoes.json",$reg_json)){
                        header("location: home.php");
                    }
                }else{
                    $arq = array(0=>$reg);
                    $arq = json_encode($arq);
                    file_put_contents("./json/solicitacoes.json", $arq);
                    if(file_put_contents("./json/solicitacoes.json", $arq)){
                        header("location: home.php");
                    }
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
                $cod = filter_input(INPUT_GET, "cod", FILTER_VALIDATE_INT);

                if(file_exists("./json/cars.json")){
                    $arq = file_get_contents("./json/cars.json");
                    $arq = json_decode($arq,true);
                }else{
                    echo"<p>Parece que não há Arquivos a serem visualizados, ou, você não possui permissão</p>";
                    echo"<button class="."'botaoVoltar'"." onClick=".'"location.href='."'home.php'".'"'.">Voltar para a Pagina Principal</button>";
                }
            }

        ?>

        <fieldset class="Ffull">
            <fieldset class="Fuser">
                    <img src="./assets/profilePadrao.png" alt="Icone de Perfil">
                    <label>Nome: <?php echo$_SESSION['nome'];?></label>
                    <label>Usuário: <?php echo$_SESSION['username'];?></label>
                    <label>E-mail: <?php echo$_SESSION['email'];?></label>
                    <label>Telefone: <?php echo$_SESSION['telefone'];?></label>
            </fieldset>
            <fieldset class="Fcarro">
                <?php
                    if($sessao == 1){
                        $cod = filter_input(INPUT_GET, "cod", FILTER_VALIDATE_INT);
        
                        if(file_exists("./json/cars.json")){
                            $arq = file_get_contents("./json/cars.json");
                            $arq = json_decode($arq,true);

                            if($arq[$cod]['estilo'] == 'Luxo'){
                                echo"<img src="."'./assets/iconCarLuxo.png'"." alt="."'Icon Carro'".">";
                            }
                            if($arq[$cod]['estilo'] == 'Passeio'){
                                echo"<img src="."'./assets/iconCarPasseio.png'"." alt="."'Icon Carro'".">";
                            }
                            if($arq[$cod]['estilo'] == 'Esportivo'){
                                echo"<img src="."'./assets/iconCarEsport.png'"." alt="."'Icon Carro'".">";
                            }
                            echo"
                            <div class="."'Fcarro2'".">
                                <div>
                                    <label>Marca: ".$arq[$cod]['marca']."</label>
                                    <label>Modelo: ".$arq[$cod]['modelo']."</label>
                                    <label>Cor: ".$arq[$cod]['cor']."</label>
                                    <label>Ano: ".$arq[$cod]['ano']."</label>
                                </div>
                                <div>
                                    <label>Estilo: ".$arq[$cod]['estilo']."</label>
                                    <label>Combustível: ".$arq[$cod]['combustivel']."</label>
                                    <label>Câmbio: ".$arq[$cod]['cambio']."</label>
                                    <label>Preço: R$".$arq[$cod]['preco']."</label>
                                </div>
                            </div>
                            ";

                        }
                    }
                ?>
            </fieldset>
            <fieldset>
                <form action="confAlugar.php" method="post" enctype="multpart/form-data">
                    <input type="hidden" name="nome" id="nome" value="<?php echo $_SESSION['nome']?>">
                    <input type="hidden" name="username" id="username" value="<?php echo $_SESSION['username']?>">
                    <input type="hidden" name="email" id="email" value="<?php echo $_SESSION['email']?>">
                    <input type="hidden" name="telefone" id="telefone" value="<?php echo $_SESSION['telefone']?>">
                    <input type="hidden" name="marca" id="marca" value="<?php echo $arq[$cod]['marca']?>">
                    <input type="hidden" name="modelo" id="modelo" value="<?php echo $arq[$cod]['modelo']?>">
                    <input type="hidden" name="cor" id="cor" value="<?php echo$arq[$cod]['cor']?>">
                    <input type="hidden" name="ano" id="ano" value="<?php echo$arq[$cod]['ano']?>">
                    <input type="hidden" name="estilo" id="estilo" value="<?php echo $arq[$cod]['estilo']?>">
                    <input type="hidden" name="preco" id="preco" value="<?php echo $arq[$cod]['preco']?>">
                    <label>Data de Retirada do Veículo: </label>
                    <input type="date" name="data_retirada" id="data_retirada" class="input" required>
                    <label>Data de Entrega do Veículo: </label>
                    <input type="date" name="data_devolucao" id="data_devolucao" class="input" required>
    
                    <button type="submit" name="subButton" id="subButton" value="confirmar">Confirmar</button>
                </form>
            </fieldset>
        </fieldset>



    </main>



</body>
</html>