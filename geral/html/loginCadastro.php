<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="../css/loginCadastro.css">
</head>

<body>
    <script src="../js/teste.js"></script>
    <header class="menu">
        <nav>
            <ul>
                <li><a href="">Home</a></li>
                <li><a href="">Sobre Nós</a></li>
                <li><a href="">Contato</a></li>
            </ul>
        </nav>
    </header>
    <div class="estrutura">
        <div class="slide-titulo">
            <div class="titulo login">
                Login
            </div>
            <div class="titulo cadastro">
                Crie sua conta
            </div>
        </div>
        <div class="form-container">
            <div class="slide-controles" onclick="handlerTab(this, event)">
                <input type="radio" name="slide" id="login" checked>
                <input type="radio" name="slide" id="signup">
                <label for="login" class="slide-botão login">Login</label>
                <label for="signup" class="slide-botão signup">Cadastro</label>
                <div class="slider-button-tab"></div>
            </div>
            <div class="form-interno">
                <form class="login" action="loginCadastro.php" method="post">
                    <div class="quadro">
                        <input type="email" placeholder="E-mail" name="emaillogin" required>
                    </div>
                    <div class="quadro">
                        <input type="password" placeholder="Senha" name="senhalogin" required>
                    </div>
                    <div class="btn-senha">
                        <a href="esq-senha.php">Esqueceu a senha?</a>
                    </div>
                    <div class="quadro btn">
                        <input type="submit" value="Entrar">
                    </div>
                    <div class="contato">
                        Não tem conta?<a href="">Crie agora</a>
                    </div>
                </form>


                <form class="signup" action="loginCadastro.php" method="post">
                    <div class="quadro">
                        <input type="text" placeholder="Nome" name="nome" required>
                    </div>
                    <div class="quadro">
                        <input type="email" placeholder="E-mail" name="email" required>
                    </div>
                    <div class="quadro">
                        <input type="password" placeholder="Senha" name="senha" required>
                    </div>
                    <div class="quadro">
                        <input type="password" placeholder="Confirme sua senha" name="confirmarsenha" required>
                    </div>
                    <div class="quadro btn">
                        <input type="submit" value="Entrar">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <footer>
        <div class="footer-container">
            <!--  -->
            <div class="footer-section contact">
                <h3>Contato</h3>
                <p>Telefone: (11) 1234-5678</p>
                <p>Email: vote.f@outlook.com</p>
                <p>Endereço: R. Santo André, 680 - Boa Vista, São Caetano do Sul - SP, 09572-000</p>
            </div>

            <!--  -->
            <div class="footer-section links">
                <h3>Links</h3>
                <ul>
                    <li><a href="#">Início</a></li>
                    <li><a href="#">Sobre Nós</a></li>
                    <li><a href="#">Serviços</a></li>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Contato</a></li>
                </ul>
            </div>

            <!--  -->
            <div class="footer-section social">
                <h3>Siga-nos</h3>
                <a href="#" target="_blank">Facebook</a> |
                <a href="#" target="_blank">Instagram</a> |
                <a href="#" target="_blank">LinkedIn</a> |
                <a href="#" target="_blank">X</a>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 vote.f. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>

<?php

//formulario de cadastro
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['senha']) && isset($_POST['confirmarsenha'])) {
    
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confirmarsenha = $_POST['confirmarsenha'];


    //vamos abrir o arquivo e salvar os dados
    $cadastroArquivo = "cadastro.txt";
    $handle = fopen($cadastroArquivo, "w");

    if ($senha !== $confirmarsenha) {
        echo "As senhas não coincidem.";
        return;
    }

    $dados = $nome . "," . $email . "," . $senha . "\n";

    $file = fopen($cadastroArquivo, 'a');

    if ($file) {
        fwrite($file, $dados);
        fclose($file);
    } else {
        echo "Erro ao abrir o cadastroArquivo.";
    }
}

//Formulario de Login
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['emaillogin']) && isset($_POST['senhalogin'])) {
    $emaillogin = $_POST['emaillogin'];
    $senhalogin = $_POST['senhalogin'];


    //vamos abrir o arquivo e salvar os dados
    $arquivo = "cadastro.txt";

    $file = fopen($arquivo, 'r');

    if ($file) {
        $credenciaisValidas = false;

        // Lê cada linha do arquivo
        while (($linha = fgets($file)) !== false) {
            $dados = explode(",", trim($linha));


            $emailRegistrado = $dados[1];  // O email está na segunda posição
            $senhaRegistrada = $dados[2];  // A senha está na terceira posição

            // Compara com as credenciais fornecidas
            if ($emailRegistrado === $emaillogin && $senhaRegistrada === $senhalogin) {
                $credenciaisValidas = true;
                break; // Encerra a busca quando encontrar as credenciais corretas
            }
        }

        fclose($file);

        if ($credenciaisValidas) {
            // header('Location: ');
            echo  "<script>alert('FUNCIONOU');</script>";
        } else {
            echo  "<script>alert('Usuário ou Senha incorretos!!');</script>";
        }
    } else {
        echo "Erro ao abrir o arquivo.";
    }
}

?>