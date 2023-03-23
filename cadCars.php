<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/cadUser.css">
    <script src="./js/script.js" defer></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
    <script src="./js/plentz-jquery-maskmoney-cdbeeac/src/jquery.maskMoney.js"></script>
    <title>Registre - MeKart</title>
</head>
<body>

    <?php


        $reg = $_POST;
        if(isset($_POST['subButton']) ){
            unset($reg['subButton']);
            if (file_exists('./json/cars.json')) {
                $arq = file_get_contents('./json/cars.json');
                $arq = json_decode($arq,true);
                array_push($arq,$reg);
                $reg_json = json_encode($arq);
                file_put_contents("./json/cars.json", $reg_json);
                if(file_put_contents("./json/cars.json",$reg_json)){
                    echo"<dialog open><h2>SUCESSO:</h2><p>Veículo adicionado com sucesso!</p></dialog>";
                }
            }else{
                $arq = array(0=>$reg);
                $arq = json_encode($arq);
                file_put_contents("./json/cars.json", $arq);
                if(file_put_contents("./json/cars.json", $arq)){
                    echo"<dialog open><h2>SUCESSO:</h2><p>Usuário criado com sucesso!</p></dialog>";
                }
            }
        }
    
    ?>
    <div class="container">
        <fieldset id="home" name="home" class="home">
        <div class="cabecalho">
                <img src="./assets/logoPNG.png" alt="Logo" name="logopng" id="logopng">
                <h3>Cadastrar Carro</h3>
            </div>
            <form method="post" name="form" id="form">
                <div class="form_btn">
                    <div class="form1">
                        <div class="marca">
                            <div class="label">
                                <label>Marca: </label>
                            </div>
                            <input type="text" name="marca" id="marca" class="input" placeholder="Digite a Marca do Veículo..." required>
                        </div>
                        <div class="modelo">
                            <div class="label">
                                <label>Modelo:</label>
                            </div>
                            <input type="text" name="modelo" id="modelo" class="input" placeholder="Digite o Modelo do Veículo..." required>
                        </div>
                        <div class="cor">
                            <div class="label">
                                <label>Cor: </label>
                            </div>
                            <input type="text" name="cor" id="cor" class="input" placeholder="Qual a cor do veículo..." required>
                        </div>
                        <div class="ano">
                            <div class="label">
                                <label>Ano: </label>
                            </div>
                            <input type="text" name="ano" id="ano" class="input" placeholder="Ano de fabricação do veículo..." required>
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
                            <input type="text" name="preco" id="preco" class="input" placeholder="R$ 10.000,00">
                        </div>
                    </div>
                </div>

                <button type="submit" name="subButton" id="subButton" value="cadastrar">Cadastrar</button>

            </form>
            <div class="cadastrar">
                <a href="listCars.php" nome="cadastrar" id="cadastrar">Voltar para o Painel de Carros!</a>
            </div>
        </fieldset>
    </div>
</body>
</html>