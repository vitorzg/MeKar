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
    <title>Update de Usuários - MeKar</title>
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
                $sessão = 1;
                $cod = filter_input(INPUT_GET, "cod", FILTER_VALIDATE_INT);
                if($_SESSION['nivel'] == 1){
                    if(file_exists("./json/users.json")){
                        $arq = file_get_contents("./json/users.json");
                        $arq = json_decode($arq,true);
    
                        $dados = filter_input_array(INPUT_POST);
                        if(isset($dados)){
                            $cod = $dados['cod'];
                            unset($dados['salvar'], $dados['cod']);
    
                            $arq[$cod] = $dados;
                            $arq = json_encode($arq);
                            file_put_contents("./json/users.json", $arq);
                            if(file_put_contents("./json/users.json", $arq)){
                                header("Refresh: 0.2, url=painelUser.php");
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




            <h2>Editar - Usuário</h2>
            <form method="post" name="form" id="form">

                <div class="nome">
                    <div class="label">
                        <label>Nome Completo:</label>
                    </div>
                    <input type="text" name="nome" id="nome" class="input" value="<?php echo $nome ?>" required>
                </div>

                <div class="usuario">
                    <div class="label">
                        <label>Usuário:</label>
                    </div>
                    <input type="text" name="username" id="username" class="input" value="<?php echo $username ?>" required>
                </div>

                <div class="genero">
                            <div class="label">
                                <label>Gênero:</label>
                            </div>
                            <div class="ipt_radio">
                                <input type="radio" name="genero" id="genero" value="Feminino" required checked><label>Feminino</label>
                                <input type="radio" name="genero" id="genero" value="Masculino" required><label>Masculino</label>
                                <input type="radio" name="genero" id="genero" value="Outros" required><label>Outros</label>
                            </div>
                        </div>

                <div class="email">
                    <div class="label">
                        <label>E-mail:</label>
                    </div>
                    <input type="email" name="email" id="email" class="input" value="<?php echo $email ?>" required>
                </div>

                <div class="telefone">
                    <div class="label">
                        <label>Telefone:</label>
                    </div>
                    <input type="tel" name="telefone" id="telefone" class="input" value="<?php echo $telefone ?>">
                </div>

                <div class="nascimento">
                    <div class="label">
                        <label>Data de Nascimento:</label>
                    </div>
                    <input type="date" name="nascimento" id="nascimento" class="input" value="<?php echo $nascimento ?>" required>
                </div>

                <div class="cpf">
                    <div class="label">
                        <label>CPF:</label>
                    </div>
                    <input type="text" name="cpf" id="cpf" class="input" value="<?php echo $cpf ?>" oninput="mascaracpf(this)" required>
                </div>
                
                <div class="hidden">
                    <div class="label">
                        <label>Nivel de Acesso:</label>
                    </div>
                    <input type="number" name="nivel" id="nivel" min="0" max="2" class="input" value="<?php echo $nivel ?>" required>
                </div>

                <div class="senha">
                    <div class="label">
                        <label>Senha:</label>
                    </div>
                    <input type="password" name="pass" id="pass" class="input" value="<?php echo $pass ?>" required>
                </div>
                
                
                <input type="hidden" name="cod" value="<?php echo $cod ?>">
                
                <button type="submit" name="subButton" id="subButton" value="salvar" >Salvar</button>
            </form>
        </main>

<script src="./js/masks.js"></script>
</body>
</html>


