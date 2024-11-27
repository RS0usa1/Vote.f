
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Senha</title>
    <link rel="stylesheet" href="../css/teste3.css">
    <script>
        // Função JavaScript para validar os requisitos da senha
        function validarFormulario() {
            var senha = document.getElementById('senha').value;
            var confirmarSenha = document.getElementById('confirmarSenha').value;

            // Verifica se as senhas são iguais
            if (senha !== confirmarSenha) {
                alert("As senhas não são iguais.");
                return false;
            }

            // Função para validar os requisitos da senha
            function validarInput(senha) {
                var temDigitos = /\d/.test(senha) && (senha.match(/\d/g) || []).length >= 3;
                var temCaracteresEspeciais = /[^a-zA-Z0-9]/.test(senha) && (senha.match(/[^a-zA-Z0-9]/g) || []).length >= 2;
                var temLetras = /[a-zA-Z]/.test(senha) && (senha.match(/[a-zA-Z]/g) || []).length >= 5;
                
                return temDigitos && temCaracteresEspeciais && temLetras;
            }

            // Verifica os requisitos da senha
            if (!validarInput(senha)) {
                alert('A senha deve conter: \n- Pelo menos 3 dígitos \n- Pelo menos 2 caracteres especiais \n- Pelo menos 5 letras');
                return false;
            }

            // Se passar em todas as validações, o formulário é enviado
            return true;
        }
    </script>
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
                <h1>Altere a senha</h1>
                <p>Crie uma senha nova que não seja a mesma que a anterior, possua pelo menos 3 dígitos, 2 caracteres especiais e 5 letras.</p>
            </div>
        </div>
        <form class="form" action="teste3.php" method="post" onsubmit="return validarFormulario()">
            <div class="quadro">
                <input type="password" placeholder="Senha" name="Senha" id="senha" required>
            </div>
            <div class="quadro">
                <input type="password" placeholder="Confirmar Senha" name="confirmarSenha" id="confirmarSenha" required>
            </div>
            <div class="quadro">
                <input class="style-enviar" type="submit" value="Enviar">
            </div>
        </form>
    </div>
    <footer>
        <div class="footer-container">
            <div class="footer-section contact">
                <h3>Contato</h3>
                <p>Telefone: (11) 1234-5678</p>
                <p>Email: vote.f@outlook.com</p>
                <p>Endereço: R. Santo André, 680 - Boa Vista, São Caetano do Sul - SP, 09572-000</p>
            </div>
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
// Definindo as variáveis
$senha = isset($_POST['Senha']) ? $_POST['Senha'] : '';
$confirmar = isset($_POST['confirmarSenha']) ? $_POST['confirmarSenha'] : '';

// Função para validar a senha
function validar_input($senha)
{
    // Verifica se a entrada contém pelo menos 3 dígitos
    $tem_digitos = preg_match_all('/\d/', $senha) >= 3;

    // Verifica se a entrada contém pelo menos 2 caracteres especiais
    $tem_caracteres_especiais = preg_match_all('/[^a-zA-Z0-9]/', $senha) >= 2;

    // Verifica se a entrada contém pelo menos 5 letras
    $tem_letras = preg_match_all('/[a-zA-Z]/', $senha) >= 5;

    // Se todas as condições forem atendidas, retorna true, caso contrário, false
    return $tem_digitos && $tem_caracteres_especiais && $tem_letras;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($senha == $confirmar) {
        // Verifica se o input atende às condições
        if (validar_input($senha)) {
            echo '<script> alert("O input é válido!");</script>';
            header('Location: ../html/teste.html');
        } else {
            echo '<script> alert("O input não é válido. Certifique-se de que possui: \\n- Pelo menos 3 dígitos \\n- Pelo menos 2 caracteres especiais \\n- Pelo menos 5 letras");</script>';
        }
    } else {
        echo '<script> alert("As senhas não são iguais!");</script>';
    }
}
?>
</html>
