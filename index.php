<?php
$titulo_pagina = "PoupaMais - Seu Aliado Financeiro";

require_once 'crud/header.php'; 
?>

<?php
    if (isset($_GET['sucesso']) && $_GET['sucesso'] == 'cadastro') {
        echo '
        <div id="alerta-cadastro" class="alerta-container">
            <div class="alerta-box sucesso">
                <button class="alerta-fechar" onclick="fecharAlerta(\'alerta-cadastro\')">&times;</button>
                <h4> Cadastro Concluído!</h4>
                <p>Usuário cadastrado com sucesso. Faça login para começar.</p>
            </div>
        </div>';
    }
    if (isset($_GET['erro']) && $_GET['erro'] == 'login_invalido') {
        echo '
        <div id="alerta-login-erro" class="alerta-container">
            <div class="alerta-box erro">
                <button class="alerta-fechar" onclick="fecharAlerta(\'alerta-login-erro\')">&times;</button>
                <h4> Erro no Login</h4>
                <p>E-mail ou senha incorretos. Por favor, tente novamente.</p>
            </div>
        </div>';
    }
    
    if (isset($_GET['alerta']) && $_GET['alerta'] == 'acesso_restrito') {
        echo '
        <div id="alerta-acesso" class="alerta-container">
            <div class="alerta-box atencao">
                <button class="alerta-fechar" onclick="fecharAlerta(\'alerta-acesso\')">&times;</button>
                <h4> Acesso Negado</h4>
                <p>Esta é uma área restrita. Você precisa fazer login para continuar.</p>
            </div>
        </div>';
    }
   
    ?>

<header>
    <div class="container">
        <nav>
            <h1 class="logo"><i class="fa-solid fa-piggy-bank"></i>PoupaMais</h1>
            <ul>
                <li><a href="#recursos"><i class="fa-solid fa-list-check"></i>Recursos</a></li>
                <li><a href="#sobre"><i class="fa-solid fa-circle-info"></i>Sobre</a></li>
                
            </ul>
        </nav>
    </div>
</header>

    <main>
        
        <section class="sec">
            <div class="hero-content">
                <div class="hero-text">
                    <h1>PoupaMais</h1>
                    <h2>Seu aliado para organizar, economizar e alcançar seus objetivos financeiros.</h2>
                    <h3>Aqui, cada centavo importa, e cada decisão conta.</h3>
                    <div class="botoes-hero">
                        <a href="#" id="btn-entrar" class="btn">Entrar</a>
                        <a href="#" id="btn-cadastro" class="btn">Criar conta</a>
                    </div>
                </div>
                <div class="hero-image">
                    <img src="assets/imageminicial.png" alt="Imagem Ilustrativa PoupaMais">
                </div>
            </div>
        </section>

        <br>

        <section id="recursos" class="recursos">
            <h1>Recursos Oferecidos</h1>
            <ul>
                <li>
                    <h2>Registros de Receitas e Despesas</h2>
                    <p>Inserção manual ou automática de entradas e saídas.<br>
                        Possibilidade de classificar cada item em categorias</p>
                </li>
                <li>
                    <h2>Orçamento Pessoal/Mensal </h2>
                    <p>Definição de limites de gastos por categoria.<br>
                        Acompanhamento do quanto já foi usado em cada área.<br>
                        Alertas quando o usuário ultrapassa o limite planejado.</p>
                </li>
                <li>
                    <h2>Metas Financeiras</h2>
                    <p>Definição de objetivos.<br>
                        Exibição do progresso </p>
                </li>
                <li>
                    <h2>Controle de Dívidas</h2>
                    <p>Cadastro de dívidas existentes<br>
                        Informações sobre parcelas, juros e datas de vencimento.</p>
                </li>
                <li>
                    <h2>Alertas e Lembretes</h2>
                    <p>Notificações sobre contas a pagar e contas a receber.<br>
                        Avisos de metas próximas do prazo.<br>
                        Sugestões automáticas de economia.</p>
                </li>
                <li>
                    <h2>Projeção e Planejamento Futuro</h2>
                    <p>Simulações: “Se eu gastar X a menos, quanto economizo até o fim do ano?”.<br>
                        Previsão de saldo futuro com base em padrões de gastos.</p>
                </li>
            </ul>

        </section>

        <section id="sobre" class="sobre">
            <h2>Sobre o PoupaMais</h2>
            <p>O Poupamais é uma plataforma de controle financeiro pessoal projetada para ajudá-lo a organizar suas
                finanças de forma prática e
                inteligente. Com ele, você consegue acompanhar seus gastos, visualizar suas economias e planejar seus
                objetivos com facilidade.
                <br>Nosso objetivo é transformar a maneira como você lida com seu dinheiro, oferecendo ferramentas
                simples e eficientes que tornam o
                planejamento financeiro mais claro e acessível. Com o Poupamais, você poupa mais, toma decisões
                conscientes e conquista a
                liberdade financeira que sempre desejou.
            </p>
        </section>

    </main>

<div id="loginModal" class="modal">
    <div class="modal-content">
        <span class="close-button">&times;</span>

        <form style="width: 100%;" method="POST" action="login.php">
            <h1>Login</h1>

            <div class="input-box">
                <input placeholder="Usuário ou e-mail" type="email" name="email" required>
                <i class='bx bxs-user'></i>
            </div>

            <div class="input-box">
                <input type="password" placeholder="Senha" class="password-input" name="senha" required>
                <i class="fa-regular fa-eye-slash password-icon"></i>
            </div>

            <div class="remember-forgot">
                <label>
                    <input type="checkbox">
                    Lembrar minha senha
                </label>
                <a href="#">Esqueceu senha?</a>
            </div>

            <button type="submit" class="login">Entrar</button>

        </form>
    </div>
</div>

<div id="cadastroModal" class="modal">
    <div class="modal-content">
        <span class="close-cadastro">&times;</span>

        <div id="form_header">
            <h1 id="form_title">Cadastre-se já!</h1>
        </div>

        <form method="POST" action="cadastro.php" id="form">
            <div id="input_container">
                <div class="input-box">
                    <label for="name" class="form-label">Primeiro nome</label>
                    <div class="input-field">
                        <input type="text" name="primeiro_nome" id="name" class="form-control" placeholder="Digite seu nome" required>
                        <i class="fa-regular fa-user"></i>
                    </div>
                </div>
                <div class="input-box">
                    <label for="last_name" class="form-label">Último nome</label>
                    <div class="input-field">
                        <input type="text" name="ultimo_nome" id="last_name" class="form-control"
                            placeholder="Digite seu sobrenome">
                        <i class="fa-regular fa-user"></i>
                    </div>
                </div>
                <div class="input-box">
                    <label for="birthdate" class="form-label">Nascimento</label>
                    <div class="input-field">
                        <input type="date" name="nascimento" id="birthdate" class="form-control">
                    </div>
                </div>
                <div class="input-box">
                    <label for="email" class="form-label">E-mail</label>
                    <div class="input-field">
                        <input type="email" name="email" id="email" class="form-control"
                            placeholder="exemplo@gmail.com" required>
                        <i class="fa-regular fa-envelope"></i>
                    </div>
                </div>
                <div class="input-box">
                    <label for="password" class="form-label">Senha</label>
                    <div class="input-field">
                        <input type="password" name="senha" id="password" class="form-control"
                            placeholder="*******" required>
                        <i class="fa-regular fa-eye-slash password-icon"></i>
                    </div>
                </div>
                <div class="input-box">
                    <label for="confirm_password" class="form-label">Confirmar senha</label>
                    <div class="input-field">
                        <input type="password" name="confirmar_senha" id="confirm_password" class="form-control"
                            placeholder="*******" required>
                        <i class="fa-regular fa-eye-slash password-icon"></i>
                    </div>
                </div>
                <div class=" radio-container">
                    <label id="genero">Gênero:</label>

                    <div class="genero-opcoes">
                        <input type="radio" id="masculino" name="genero" value="M">
                        <label for="masculino">Masculino</label>

                        <input type="radio" id="feminino" name="genero" value="F">
                        <label for="feminino">Feminino</label>

                        <input type="radio" id="outro" name="genero" value="O">
                        <label for="outro">Outro</label>
                    </div>
                </div>
            </div>

            <button type="submit" class="login">
                <i class="fa-solid fa-check"></i>
                Criar conta
            </button> 
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', (event) => {
    const passwordIcons = document.querySelectorAll('.password-icon');

    passwordIcons.forEach(icon => {
        icon.addEventListener('click', () => {
            const passwordInput = icon.closest('.input-box, .input-field').querySelector('input[type="password"], input[type="text"]');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            }
        });
    });
});
</script>

<script>
    
    function fecharAlerta(id) {
        const elemento = document.getElementById(id);
        if (elemento) {
            elemento.style.display = 'none';
        }
    }
</script>

<?php 
require_once 'crud/footer.php'; 
?>