<!DOCTYPE html>
<html lang="pt-Br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="../css/esqsenha.css">
</head>
<body>
    <header class="menu">
        <nav>
            <ul>
                <li><a href="">Home</a></li>
                <li><a href="">Sobre Nós</a></li>
                <li><a href="">Contato</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <div class="container-title">
            <div class="title">
                <h1>Redefina sua senha</h1>
                <p>Crie uma senha nova que não seja a mesma que a anterior, possua pelo menos 3 digitos, 2 caracteres especiais e 5 letras. </p>
            </div>
        </div>
        <form class="form" action="" method="post">
            <div class="quadro">
                <input class="style-email" type="email" placeholder="E-mail" name="nova_email" required>
            </div>
            <div class="quadro">
                <input class="style-senha" type="password" placeholder="Senha" name="novasenha" required>
            </div>
            <div class="quadro">
                <input class="conf-senha" type="password" placeholder="Confirmar Senha" name="confirmarsenha" required>
            </div>
            <div class="quadro">
                <input class="style-enviar" type="submit" value="Enviar">
            </div>
        </form>
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

    <?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $novaSenha = $_POST['novaSenha'];
    $confirmarNovaSenha = $_POST['confirmarNovaSenha'];

    // Validação da senha
    function validarSenha($senha) {
        if (strlen($senha) < 10) {
            return "A senha deve ter pelo menos 10 caracteres.";
        }
        if (preg_match_all("/[!@#$%^&*(),.?\":{}|<>]/", $senha) < 2) {
            return "A senha deve conter pelo menos 2 caracteres especiais.";
        }
        if (preg_match_all("/[a-zA-Z]/", $senha) < 5) {
            return "A senha deve conter pelo menos 5 letras.";
        }
        return true;
    }

    if ($novaSenha !== $confirmarNovaSenha) {
        die("As senhas não coincidem. <a href='javascript:history.back()'>Voltar</a>");
    }

    $validacao = validarSenha($novaSenha);
    if ($validacao !== true) {
        die($validacao . " <a href='javascript:history.back()'>Voltar</a>");
    }

    // Atualizar senha no arquivo
    $arquivo = "cadastro.txt";
    $linhas = file($arquivo, FILE_IGNORE_NEW_LINES);
    $usuarioEncontrado = false;

    foreach ($linhas as &$linha) {
        $dados = explode(",", $linha);
        if ($dados[1] === $email) {
            $dados[2] = $novaSenha; // Atualiza a senha
            $linha = implode(",", $dados);
            $usuarioEncontrado = true;
        }
    }

    if ($usuarioEncontrado) {
        file_put_contents($arquivo, implode("\n", $linhas));
        echo "<script>alert('Senha redefinida com sucesso!');</script>";
    } else {
        echo "<script>alert('E-mail não encontrado!');</script>";
    }
}
?>
