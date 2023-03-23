<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <script src="./js/script.js" defer></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
    <script src="./js/plentz-jquery-maskmoney-cdbeeac/src/jquery.maskMoney.js"></script>
    <title>Update de Carros - MeKar</title>
</head>
<body>
    <header>


    <?php
        $sessão = 0;
        if(session_status() !== PHP_SESSION_ACTIVE){
            session_start();
        }
        if(empty($_SESSION)){
            unset($_SESSION);
            echo"<P>:(</P>";
        }else{
            $sessão = 1;
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

            $sessao = 0;
            if(session_status() !== PHP_SESSION_ACTIVE){
                session_start();
            }
            if(empty($_SESSION)){
                unset($_SESSION);
                echo"<P>:(</P>";
                echo"<p>Parece que não há Arquivos a serem visualizados, ou, você não possui permissão</p>";
                echo"<button class="."'botaoVoltar'"." onClick=".'"location.href='."'home.php'".'"'.">Voltar para a Pagina Principal</button>";
                exit();
            }else{
                $sessao = 1;
                $cod = filter_input(INPUT_GET, "cod", FILTER_VALIDATE_INT);
                if($_SESSION['nivel'] == 1){
                    if(file_exists("./json/cars.json")){
                        $arq = file_get_contents("./json/cars.json");
                        $arq = json_decode($arq,true);
    
                        $dados = filter_input_array(INPUT_POST);
                        if(isset($dados)){
                            $cod = $dados['cod'];
                            unset($dados['salvar'], $dados['cod']);
    
                            $arq[$cod] = $dados;
                            $arq = json_encode($arq);
                            file_put_contents("./json/cars.json", $arq);
                            if(file_put_contents("./json/cars.json", $arq)){
                                header("Refresh: 0.2, url = listCars.php");
                                exit();
                            }
                        }
                        
                        extract($arq[$cod]);
    
    
                    }else{
                        echo"<p>Parece que não há Arquivos a serem visualizados, ou, você não possui permissão</p>";
                        echo"<button class="."'botaoVoltar'"." onClick=".'"location.href='."'home.php'".'"'.">Voltar para a Pagina Principal</button>";
                        exit();
                    }
    
                }else{
                    echo"<p>Parece que não há Arquivos a serem visualizados, ou, você não possui permissão</p>";
                    echo"<button class="."'botaoVoltar'"." onClick=".'"location.href='."'home.php'".'"'.">Voltar para a Pagina Principal</button>";
                    exit(); 
                }
            }




            ?>




            <h2>Editar - Cars</h2>
            <form method="post" name="form" id="form">
                <div class="form_btn">
                    <div class="form1">
                        <div class="marca">
                            <div class="label">
                                <label>Marca: </label>
                            </div>
                            <input type="text" name="marca" id="marca" class="input" placeholder="Digite a Marca do Veículo..." required value="<?php echo $marca ?>">
                        </div>
                        <div class="modelo">
                            <div class="label">
                                <label>Modelo:</label>
                            </div>
                            <input type="text" name="modelo" id="modelo" class="input" placeholder="Digite o Modelo do Veículo..." required value="<?php echo $modelo ?>">
                        </div>
                        <div class="cor">
                            <div class="label">
                                <label>Cor: </label>
                            </div>
                            <input type="text" name="cor" id="cor" class="input" placeholder="Qual a cor do veículo..." required value="<?php echo $cor ?>">
                        </div>
                        <div class="ano">
                            <div class="label">
                                <label>Ano: </label>
                            </div>
                            <input type="text" name="ano" id="ano" class="input" placeholder="Ano de fabricação do veículo..." min="1000" max="9999" required value="<?php echo $ano ?>">
                        </div>
                    </div>
    
                    <div class="form2">
                        <div class="estilo">
                            <div class="label">
                                <label>Estilo: </label>
                            </div>
                            <input type="radio" name="estilo" id="estilo" value="Passeio" checked required><label>Passeio</label>
                            <input type="radio" name="estilo" id="estilo" value="Esportivo" required><label>Esportivo</label>
                            <input type="radio" name="estilo" id="estilo" value="Luxo" required><label>Luxo</label>
                        </div>
                        <div class="combustivel">
                            <div class="label">
                                <label>Combustível:</label>
                            </div>
                            <input type="radio" name="combustivel" id="combustivel" value="Gasolina" checked required><label>Gasolina</label>
                            <input type="radio" name="combustivel" id="combustivel" value="Álcool" required><label>Álcool</label>
                            <input type="radio" name="combustivel" id="combustivel" value="Flex"><label required>Flex</label>
                        </div>
                        <div class="cambio">
                            <div class="label">
                                <label>Câmbio :</label>
                            </div>
                            <input type="radio" name="cambio" id="cambio" value="Manual" checked required><label>Manual</label>
                            <input type="radio" name="cambio" id="cambio" value="Automático" required><label>Automático</label>
                        </div>
                        <div class="preco">
                            <div class="label">
                                <label>Aluguel: </label>
                            </div>
                            <input type="text" name="preco" id="preco" class="input" placeholder="R$10.000,00" value="<?php echo $preco ?>">
                        </div>
                    </div>
                </div>

                <input type="hidden" name="cod" value="<?php echo $cod ?>">

                <button type="submit" name="subButton" id="subButton" value="update">Atualizar</button>

            </form>
        </main>

<script src="./js/masks.js"></script>
</body>
</html>


