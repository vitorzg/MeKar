<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, max-scale=1.0">
    <link rel="stylesheet" href="./css/login.css">
    <title>Login - MeKar</title>
</head>
<body>


     <?php
        
    $post = $_POST;
    if(isset($_POST['subButton'])){
         unset($post['subButton']);
        if(file_exists('./json/users.json')){
            $arq = file_get_contents('./json/users.json');
            $arq = json_decode($arq,true);
            foreach($arq as $el){
                if($el['username'] == $post['username'] && $el['pass'] == $post['pass'] ){
                    session_start();
                    $_SESSION = array(
                        'nome' => $el['nome'],
                        'username' => $el['username'],
                        'email' => $el['email'],
                        'telefone' => $el['telefone'],
                        'nivel' => $el['nivel'],
                    );
                    header("Refresh: 0.2, url = home.php");
                    die;
                }
            }
            if(session_status() !== PHP_SESSION_ACTIVE){
                echo"<dialog open><h2>AVISO: </h2><p>Usuário ou senha incorretos ou Usuário não registrado!</p> </dialog>";
            }

        }else{
        echo"<dialog open><h2>AVISO: </h2><p>Usuário ou senha incorretos/Usuário não registrado!</p> </dialog>";
        }
     }

    ?>

    <div class="container">
        <fieldset id="home" name="home" class="home">
            <img src="./assets/logoPNG.png" alt="Logo" name="logopng" id="logopng">
            <div class="bemvindo">
                <h1>Welcome To Mekar!</h1>
                <p>Bem vindo! Porfavor efetuar Login para continuar</p>
            </div>
            <form method="post" name="form" id="form">
                <div class="usuario">
                    <div class="label">
                        <label>Usuário:</label>
                    </div>
                    <input type="text" name="username" id="username" class="input" placeholder="Digite Seu Usuário !">
                </div>
                <div class="senha">
                    <div class="label">
                        <label>Senha:</label>
                    </div>
                    <input type="password" name="pass" id="pass" class="input" placeholder="Digite Sua Senha !">
                </div>
                <button type="submit" name="subButton" id="subButton" value="logar">Logar</button>
            </form>
            <div class="registrar">
                <a href="cadUser.php" nome="registrar" id="registrar" >Não possui Log-in ? REGISTRE-SE!</a>
            </div>
        </fieldset>
    </div>


</body>
</html>