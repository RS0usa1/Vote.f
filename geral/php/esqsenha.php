<?php
session_start();
?>
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
        <form class="form" action="./esqsenha.php" method="post">
            <div class="quadro">
                <input class="style-email" type="email" placeholder="E-mail" name="email" required>
            </div>
            <div class="quadro">
                <input class="style-senha" onblur="validarFormulario()" type="password" placeholder="Senha" id="novaSenha" name="novaSenha" required>
            </div>
            <div class="quadro">
                <input class="conf-senha" onblur="validarConfirmar()" type="password" placeholder="Confirmar Senha" id="confirmarNovaSenha" name="confirmarNovaSenha" required>
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
    <script>
        // alert();
        // Função JavaScript para validar os requisitos da senha
        function validarFormulario() {
            var novaSenha = document.getElementById('novaSenha');
            var confirmarNovaSenha = document.getElementById('confirmarNovaSenha').value;

            if (novaSenha.value != "") {
                // Função para validar os requisitos da senha
                function validarInput(senha) {
                    var temDigitos = /\d/.test(novaSenha.value) && (novaSenha.value.match(/\d/g) || []).length >= 3;
                    var temCaracteresEspeciais = /[^a-zA-Z0-9]/.test(novaSenha.value) && (novaSenha.value.match(/[^a-zA-Z0-9]/g) || []).length >= 2;
                    var temLetras = /[a-zA-Z]/.test(novaSenha.value) && (novaSenha.value.match(/[a-zA-Z]/g) || []).length >= 5;

                    return temDigitos && temCaracteresEspeciais && temLetras;
                }

                // Verifica os requisitos da senha
                if (!validarInput(novaSenha.value)) {
                    alert('A senha deve conter: \n- Pelo menos 3 dígitos \n- Pelo menos 2 caracteres especiais \n- Pelo menos 5 letras');
                    novaSenha.value = "";
                    novaSenha.focus();
                    return false;
                }
            }
            // Se passar em todas as validações, o formulário é enviado
            return true;
        }

        function validarConfirmar() {
            var novaSenha = document.getElementById('novaSenha').value;
            var confirmarNovaSenha = document.getElementById('confirmarNovaSenha');

            if (confirmarNovaSenha.value != '') {
                // Verifica se as senhas são iguais
                if (novaSenha !== confirmarNovaSenha.value) {
                    alert("As senhas não são iguais.");
                    confirmarNovaSenha.value = "";
                    confirmarNovaSenha.focus();
                    return false;
                }

            }
            // Se passar em todas as validações, o formulário é enviado
            return true;
        }
    </script>


    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $novaSenha = $_POST['novaSenha'];
        $confirmarSenha = $_POST['confirmarNovaSenha'];
        $email = $_POST['email'];
        print_r($_POST);
        // Validação de senha
        if ($novaSenha !== $confirmarSenha) {
            echo "<script>alert('phpAs senhas não coincidem.');</script>";
            exit;
        }

        // Critérios: 3 dígitos, 2 caracteres especiais e 5 letras
        // if (!preg_match('/^(?=.*[0-9]{3})(?=.*[!@#$%^&*]{2})(?=.*[a-zA-Z]{5}).{10,}$/', $novaSenha)) {
        //     echo "<script>alert('phpA senha deve conter ao menos 3 dígitos, 2 caracteres especiais e 5 letras.');</script>";
        //     exit;
        // }

        // Manipulação do arquivo cadastro.txt
        $arquivo = 'cadastro.txt';
        $dadosAlterados = '';
        $senhaAlterada = false;

        if (file_exists($arquivo)) {
            $linhas = file($arquivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

            foreach ($linhas as $linha) {
                $dados = explode(',', $linha);
                print_r($dados);
                // Verifica se o e-mail corresponde
                if (trim($dados[1]) === $email) {
                    $dados[2] = $novaSenha; // Atualiza a senha
                    $senhaAlterada = true;
                }

                // Reconstrói a linha
                $dadosAlterados .= implode(',', $dados) . PHP_EOL;
            }
            print $dadosAlterados;
            // Sobrescreve o arquivo com os dados atualizados
            file_put_contents($arquivo, $dadosAlterados);

            if ($senhaAlterada == true) {
                echo "<script>alert('phpSenha alterada com sucesso!');</script>";
                session_destroy(); // Limpa a sessão após redefinição
                header('Location: loginCadastro.php');
            } else {
                echo "<script>alert('phpErro: Email não encontrado no registro.');</script>";
            }
        } else {
            echo "<script>alert('phpErro: Arquivo de usuários não encontrado.');</script>";
        }
    }
    ?>