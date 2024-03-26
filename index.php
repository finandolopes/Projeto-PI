<?php
    include_once('php/conexao.php');
    $query = "SELECT * FROM empresa WHERE id_empresa = 1";
    $res = mysqli_query($con, $query);
    $row2 = mysqli_fetch_array($res);
?>

<!doctype html>
<html lang="pt-br">
<head>
    <title>CONFINTER</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Scripts -->   
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        // Remover a máscara de data antes de enviar o formulário
        $('#form-requisicao').submit(function () {
            // Remover a máscara de data antes de enviar o formulário
            var dataNascimento = $('#data_nascimento').val();
            // Remover qualquer caractere que não seja número
            var dataLimpa = dataNascimento.replace(/\D/g, '');
            // Formatar a data para o padrão YYYY-MM-DD
            var dataFormatada = dataLimpa.replace(/(\d{2})(\d{2})(\d{4})/, '$3-$2-$1');
            // Atribuir a data formatada de volta ao campo
            $('#data_nascimento').val(dataFormatada);
        });
    });
</script>


<!-- Script JavaScript para validar o formulário -->
<script>
    $(document).ready(function(){
        // Função para validar o formulário antes do envio
        $('#form-requisicao').submit(function(event){
            // Verifica se o campo nome está vazio
            if ($('#nome').val().trim() === '') {
                alert('Por favor, preencha o campo nome.');
                event.preventDefault(); // Impede o envio do formulário
                return;
            }

            // Verifica se o campo data de nascimento está vazio
          //  if ($('#data_nascimento').val().trim() === '') {
           //     alert('Por favor, preencha o campo data de nascimento.');
           //     event.preventDefault(); // Impede o envio do formulário
           //     return;
          //  }

            // Verifica se o campo telefone está vazio
            if ($('#telefone').val().trim() === '') {
                alert('Por favor, preencha o campo telefone.');
                event.preventDefault(); // Impede o envio do formulário
                return;
            }

            // Verifica se o campo email está vazio
            if ($('#email').val().trim() === '') {
                alert('Por favor, preencha o campo email.');
                event.preventDefault(); // Impede o envio do formulário
                return;
            }

            // Verifica se o campo horário de contato está vazio
            if ($('#horario_contato').val().trim() === '') {
                alert('Por favor, preencha o campo horário de contato.');
                event.preventDefault(); // Impede o envio do formulário
                return;
            }

            // Verifica se pelo menos uma opção de categoria foi selecionada
            if ($('input[name="categoria[]"]:checked').length === 0) {
                alert('Por favor, selecione pelo menos uma categoria.');
                event.preventDefault(); // Impede o envio do formulário
                return;
            }
        });
    });
</script>

    <!-- Bootstrap CSS redirect with our offline SASS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Requiring the file "estilo.scss" -->
    <link rel="stylesheet" href="css/estilo.css">

    <!-- Requiring the file "font-awesome.css" -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    
</script>
<script>
    $(document).ready(function () {
        // Máscara para data (DD/MM/AAAA)
      //  $('#data_nascimento').mask('00/00/0000');

        // Máscara para hora (HH:MM)
        $('#horario_contato').mask('00:00');

        // Máscara para e-mail
        $('#email').mask('A', {
            translation: {
                'A': { pattern: /[\w@\-.+]/, recursive: true }
            }
        });

        // Validação do formulário
        $('#modalForm').submit(function (event) {
            // Limpar mensagens de erro
            $('.error-msg').remove();

            // Flag para validação
            var isValid = true;

            // Validar nome
            var nome = $('#nome').val();
            if (!nome.trim()) {
                $('#nome').after('<div class="error-msg">Por favor, preencha o nome.</div>');
                isValid = false;
            }

            // Validar data de nascimento
            var dataNascimento = $('#data_nascimento').val();
            if (!dataNascimento.trim()) {
                $('#data_nascimento').after('<div class="error-msg">Por favor, preencha a data de nascimento.</div>');
                isValid = false;
            }

            // Validar telefone
            var telefone = $('#telefone').val();
            if (!telefone.trim()) {
                $('#telefone').after('<div class="error-msg">Por favor, preencha o telefone.</div>');
                isValid = false;
            }

            // Validar e-mail
            var email = $('#email').val();
            if (!email.trim()) {
                $('#email').after('<div class="error-msg">Por favor, preencha o e-mail.</div>');
                isValid = false;
            } else if (!isValidEmail(email)) {
                $('#email').after('<div class="error-msg">Por favor, preencha um e-mail válido.</div>');
                isValid = false;
            }

            // Validar horário de contato
            var horarioContato = $('#horario_contato').val();
            if (!horarioContato.trim()) {
                $('#horario_contato').after('<div class="error-msg">Por favor, preencha o horário de contato.</div>');
                isValid = false;
            }

            // Validar categoria
            var categoria = $('#categoria').val();
            if (!categoria.trim()) {
                $('#categoria').after('<div class="error-msg">Por favor, selecione a categoria.</div>');
                isValid = false;
            }

            // Se algum campo estiver inválido, impedir o envio do formulário
            if (!isValid) {
                event.preventDefault();
                $('#modalAlert').addClass('alert alert-danger').html('Por favor, corrija os campos destacados.');
            }
        });

        // Função para verificar se o e-mail é válido
        function isValidEmail(email) {
            var pattern = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/;
            return pattern.test(email);
        }
    });
    
</script>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div id="inicio" class="container">
        <a class="navbar-brand h1 mb-0" href="#">CONFINTER</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSite">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSite">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#inicio">Início</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#servicos">Serviços</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#sobre">Sobre</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#depoimentos">Depoimentos</a>
                </li>
            </ul>
            <!-- Botão de Login na lateral esquerda ao final -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <button type="button" class="btn btn-outline-primary mt-md-0 mt-3" data-toggle="modal" data-target="#loginModal">Login</button>
                </li>
            </ul>
            <!-- Formulário de busca -->
            <form class="form-inline">
                <input class="form-control ml-4 mr-2 mt-2 mt-md-0" type="search" placeholder="Buscar...">
                <button class="btn btn-dark mt-md-0 mt-3" type="Submit">OK</button>
            </form>
        </div>
    </div>
</nav>

    <!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" center id="loginModalLabel">Painel Administrativo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="loginForm" action="admin.php" method="post">
                    <div class="form-group">
                        <label for="username">Usuário</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Digite seu nome de usuário" required>
                        <div class="invalid-feedback">Por favor, insira seu nome de usuário.</div>
                    </div>
                    <div class="form-group">
                        <label for="password">Senha</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Digite sua senha" required>
                        <div class="invalid-feedback">Por favor, insira sua senha.</div>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-success btn-sm">Login</button>
                    </div>
                </form>
                <!-- Mensagem de erro -->
                <div id="loginError" class="alert alert-danger d-none" role="alert">
                    Usuário ou senha inválidos.
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .modal-title {
        text-align: center;
        width: 100%;
        margin: 0 auto;
    }
</style>
<script>
    document.getElementById('loginForm').addEventListener('submit', function(event) {
        var username = document.getElementById('username').value;
        var password = document.getElementById('password').value;

        // Verifica se os campos estão vazios
        if (!username || !password) {
            event.preventDefault(); // Impede o envio do formulário
            document.getElementById('loginError').classList.remove('d-none'); // Exibe a mensagem de erro
            return;
        }

        // Se tudo estiver ok, a submissão do formulário continua normalmente
    });
</script>


    </ul>
    </div>

    </div>

    </nav>


    <div id="carouselSite" class="carousel slide" data-ride="carousel">

        <ol class="carousel-indicators">
            <li data-target="#carouselSite" data-slide-to="0" class="active"></li>
            <li data-target="#carouselSite" data-slide-to="1"></li>
            <li data-target="#carouselSite" data-slide-to="2"></li>
        </ol>


        <div class="carousel-inner">

            <div class="carousel-item active">
                <img src="imgs/slide-01.jpg" class="img-fluid d-block">
                <div class="carousel-caption d-none d-md-block">

                </div>
            </div>

            <div class="carousel-item">
                <img src="imgs/slide-02.jpg" class="img-fluid d-block">
                <div class="carousel-caption d-none d-md-block">
                    <h1 class="disp-2">Nosso Foco</h1>
                    <p class="lead disp-2">Seu parceiro ideal para realizar seus sonhos com crédito consignado, Somos especialistas em oferecer soluções financeiras personalizadas para servidores públicos, aposentados, pensionistas e trabalhadores CLT...</p>
                </div>
            </div>

            <div class="carousel-item">
                <img src="imgs/slide-03.jpg" class="img-fluid d-block">
                <div class="carousel-caption d-none d-md-block">
                    <h1 class="disp-2">Com a CONFINTER, você pode:</h1>
                    <p class="lead disp-2">
                        Realizar aquele sonho de consumo que você tanto espera, como comprar um carro novo, viajar para o exterior ou reformar a sua casa. Obter crédito com segurança e tranquilidade, sem comprometer o seu orçamento.
                        Contar com a assessoria de uma equipe especializada que te ajudará a escolher a melhor opção de crédito para você.
                    </p>
                </div>
            </div>

        </div>

        <a class="carousel-control-prev" href="#carouselSite" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
            <span class="sr-only">Anterior</span>
        </a>


        <a class="carousel-control-next" href="#carouselSite" role="button" data-slide="next">
            <span class="carousel-control-next-icon"></span>
            <span class="sr-only">Avançar</span>
        </a>

    </div>


    <div class="container">

        <div class="row">
            <div class="col-11 col-md-12 text-center ml-md-0 ml-2 my-5">

  </div>

            <div id="servicos" class="row justify-content-sm-center">

                <div id="app" class="col-sm-6 col-md-4 disp">
                    <div class="card mb-5">
                        <img class="card-img top" src="imgs/item-01.jpg
">
                        <div class="card-body">
                            <h4 class="card-title">Taxas de juros baixas:</h4>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Oferecemos as melhores taxas do mercado para que você possa realizar</li>

                        </ul>
                        <div class="card-footer text-muted">

                        </div>
                    </div>
                </div>

                <div id="web" class="col-sm-6 col-md-4 disp">
                    <div class="card mb-5">
                        <img class="card-img top" src="imgs/item-02.jpg">
                        <div class="card-body">
                            <h4 class="card-title">Prazos longos para pagar:</h4>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Você pode parcelar o seu crédito em até 84 vezes,</li>
                            <li class="list-group-item">facilitando o pagamento das suas parcelas.</li>
                        </ul>
                        <div class="card-footer text-muted">

                        </div>
                    </div>
                </div>

                <div id="aut" class="col-sm-6 col-md-4 disp">
                    <div class="card mb-5">
                        <img class="card-img top" src="imgs/item-03.jpg">
                        <div class="card-body">
                            <h4 class="card-title">Atendimento personalizado e prioritário</h4>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Uma equipe de especialistas está à disposição para, te orientar e ajudar a escolher a melhor opção de crédito para você.</li>
                        </ul>
                        <div class="card-footer text-muted">

                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="jumbotron jumbotron-fluid">

            <div id="Missão, Visão e Valores" class="container">

                <div class="row">
                    <div class="col-12 text-center">
                        <h1 class="display-4">
                            <i class="fa fa-video-camera text-success col-12 col-md-1 esp" aria-hidden="true"></i>
                            Missão, Visão e Valores

                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <ul class="nav nav-pills justify-content-center mb-4" id="pills-nav" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="nav-pills-01" data-toggle="pill" href="#nav-item-01">
                                    Missão
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="nav-pills-02" data-toggle="pill" href="#nav-item-02">
                                    Visão
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="nav-pills-03" data-toggle="pill" href="#nav-item-03">
                                    Valores
                                </a>
                            </li>

                        </ul>

                        <div class="tab-content" id="nav-pills-content">
                            <div class="tab-pane fade show active" id="nav-item-01" role="tabpanel">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="embed-responsive embed-responsive-16by9">
                                            <iframe class="embed-responsive-item"
                                                    src="videos/site.mp4">
                                            </iframe>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 mt-4 mt-md-0">
                                        <p>
                                            Ser a empresa de consignados mais querida e admirada do Brasil,
                                            oferecendo soluções financeiras inteligentes que realizam sonhos e
                                            constroem relacionamentos de confiança com nossos clientes, colaboradores
                                            e parceiros.
                                            <br><br>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="nav-item-02" role="tabpanel">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="embed-responsive embed-responsive-16by9">
                                            <iframe class="embed-responsive-item"
                                                    src="videos/aplicativo.mp4">
                                            </iframe>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 mt-4 mt-md-0">
                                        <p>
                                            Ser a líder absoluta em crédito consignado no Brasil, reconhecida pela excelência em atendimento,
                                            inovação e responsabilidade social, impactando positivamente a vida de milhões de pessoas.

                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="nav-item-03" role="tabpanel">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="embed-responsive embed-responsive-16by9">
                                            <iframe class="embed-responsive-item"
                                                    src="videos/automatizacao.mp4">
                                            </iframe>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 mt-4 mt-md-0">
                                        <p>
                                            Confiança: Agimos com transparência, ética e responsabilidade em todas as nossas relações;
                                            Respeito: Valorizamos a individualidade e a diversidade, promovendo um ambiente de trabalho inclusivo e acolhedor;
                                            Excelência: Buscamos a superação contínua em tudo que fazemos, com foco na qualidade dos nossos produtos, serviços e atendimento;
                                            Inovação: Somos uma empresa ágil e disruptiva, que busca constantemente novas soluções para atender às necessidades dos nossos clientes;
                                            Sustentabilidade: Nos comprometemos com a gestão ambientalmente responsável e com o desenvolvimento social das comunidades onde atuamos;
                                            Acreditamos que o crédito consignado pode ser uma ferramenta poderosa para realizar sonhos e construir um futuro melhor para todos.
                                            Por isso, estamos comprometidos em oferecer soluções financeiras acessíveis, justas e transparentes. Junte-se a nós e faça parte da nossa história;
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

   

<!-- Botão para Chamar o Modal de Requisição -->
<div class="text-center">
<a href="#" class="btn btn-warning" data-toggle="modal" data-target="#requisicaoModal">
    <i class="fas fa-exclamation-triangle"></i> Faça aqui sua Requisição de Análise de Crédito
</a>

<!-- Modal -->
<div class="modal fade formulario-modal" id="requisicaoModal" tabindex="-1" role="dialog" aria-labelledby="requisicaoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="requisicaoModalLabel">Requisição de Análise de Crédito</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>  

            <div class="modal-body">
                <form action="process.php" method="POST" id="form-requisicao">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nome">Nome:</label>
                            <input type="text" class="form-control" id="nome" name="nome" placeholder="Insira seu nome" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="data_nascimento">Data de Nasc.:</label>
                            <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="telefone">Telefone:</label>
                            <input type="tel" class="form-control" id="telefone" name="telefone" placeholder="" required>
                        </div>                        
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="email">E-mail:</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu E-mail" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="horario_contato">Horário para Contato:</label>
                            <input type="time" class="form-control" id="horario_contato" name="horario_contato" required>
                        </div>
                    </div>
                   
                    <div class="form-group">
                        <label for="tipo">Tipo:</label>
                        <textarea class="form-control" id="tipo" name="tipo" rows="3" maxlength="250"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Categoria:</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="aposentado" name="categoria[]" value="Aposentado">
                            <label class="form-check-label" for="aposentado">Aposentado</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="pensionista" name="categoria[]" value="Pensionista">
                            <label class="form-check-label" for="pensionista">Pensionista</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="servidor_publico" name="categoria[]" value="Servidor Público">
                            <label class="form-check-label" for="servidor_publico">Servidor Público</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="outros_check" name="categoria[]" value="Outros">
                            <label class="form-check-label" for="outros_check">Outros</label>
                        </div>
                    </div>
                    <div class="form-group" id="outros_info_div" style="display: none;">
                        <label for="outros_info">Insira outras informações se necessário:</label>
                        <input type="text" class="form-control" id="outros_info" name="outros_info" rows="3" maxlength="200">
                    </div>
                    <div class="row justify-content-end">
                        <div class="col-auto">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary">Enviar Requisição</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
                        $(document).ready(function() {
                            $('#celular').mask($('#pais_ddd').val() + ' 00 00000-0000', {
                                onKeyPress: function(val, e, field, options) {
                                    // Validação para 9 dígitos do celular + DDD
                                    var numeros = val.replace(/\D/g, '');
                                    if (numeros.length === 11) {
                                        var novoValor = val.replace(/^(\d{2})(\d{1})(\d{4})(\d{4}).*/, '$1 $2 $3-$4');
                                        $(field).val(novoValor);
                                    }
                                }
                            });
                        });
</script>

<script>

    // Função para exibir o campo "Outros" quando a opção é selecionada

    document.addEventListener('DOMContentLoaded', function() {
        var outrosCheckbox = document.getElementById('outros_check');
        var outrosInfoDiv = document.getElementById('outros_info_div');

        outrosCheckbox.addEventListener('change', function() {
            if (outrosCheckbox.checked) {
                outrosInfoDiv.style.display = 'block';
            } else {
                outrosInfoDiv.style.display = 'none';
            }
        });
    });
</script>

   <style>
    /* Estilo para tornar o modal responsivo */
    .formulario-modal .modal-dialog {
        width: auto; /* Define a largura do modal em relação à largura da tela */
        max-width: 60%; /* Define uma largura máxima para o modal */
        height: auto; /* Define a altura do modal em relação à altura da tela */
        max-height: 60%; /* Define uma altura máxima para o modal */
    }

    /* Estilo para centralizar o conteúdo dentro do modal */
    .formulario-modal .modal-content {
        height: auto;
    }

    .formulario-modal .modal-body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: auto;
    }
</style>


            

<!-- Compo Footer do Site -->
        <div id="depoimentos" class="row">
            <div class="col-sm-12 mb-3"><hr></div>
            <div class="col-sm-4">
                <h3 class="text-center">Contato</h3>
                <p class="text-center mt-md-5 mt-3">
                    <i class="fa fa-phone text-success" aria-hidden="true"></i>
                    (11) 90000-0000
                </p>
                <p class="text-center mt-md-2 mt-3">
                    <i class="fa fa-mobile-phone text-success" aria-hidden="true"></i>
                    Whatsapp
                </p>
                <p class="text-center">
                    <i class="fa fa-envelope text-success" aria-hidden="true"></i>
                    projetointegrador@univesp.com.br
                </p>
            </div>

            <div class="col-sm-4">
                <h3 class="text-center">Menu</h3>
                <div class="list-group text-center">
                    <a href="#inicio" class="list-group-item list-group-item-action list-group-item-success">
                        Início
                    </a>
                    <a href="#servicos" class="list-group-item list-group-item-action list-group-item-success">
                        Serviços
                    </a>
                    <a href="#Missão, Visão e Valores" class="list-group-item list-group-item-action list-group-item-success">
                        Missão, Visão e Valores
                    </a>
                    <a href="#contato" class="list-group-item list-group-item-action list-group-item-success">
                        Contato
                    </a>
                </div>
            </div>

            <div class="col-sm-4 mt-md-0 mt-4">
                <h3 class="text-center">Social</h3>
                <div class="btn-group-vertical btn-block btn-group-lg" role="group">
                    <a class="btn btn-outline-primary" href="https://web.facebook.com/ProjetoPI/"><i class="fab fa-facebook"></i> Facebook</a>
                    <a class="btn btn-outline-info" href="https://twitter.com/ProjetoPI/"><i class="fab fa-twitter-square"></i> Twitter</a>
                    <a class="btn btn-outline-warning" href="https://www.instagram.com/ProjetoPI/"><i class="fab fa-instagram"></i> Instagram</a>
                    <a class="btn btn-outline-info" href="https://api.whatsapp.com/send?phone=11900000000"><i class="fab fa-whatsapp"></i> Whatsapp</a>
                </div>
            </div>


        </div>
    </div>
    <div class="col-12 mt-5 bg-success pb-2">
        <hr>
        <blockquote class="blockquote text-center text-light">
            <p class="mb-0"><em>"Empresa séria, comprometida com seus clientes, preço justo e entrega no prazo!"</p>
            <footer class="blockquote-footer text-white">Anônimo, <cite tittle="titulo">Depoimento</cite></footer>
        </blockquote>
    </div>
    </div>    

    <!-- jQuery,Popper.js, then Bootstrap JS ... all called from our source/-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
        $(function () {
            $('[data-toggle="popover"]').popover()

            let scroll = $(window).scrollTop();

            if (scroll >= 800) {
                $('.disp').show();
                $('#app').addClass('aplicativos');
                $('#
class= "fa fa-envelope text-success col-12 col-md-1 esp" aria - hidden="true" ></i >
                Entre em contato conosco
                                </h1 >
                            </div >
                        </div >

                    <div class="row justify-content-center mb-5">
                        <div class="col-sm-12 col-md-10 col-lg-8">
                            <form>
                                <div class="form-row">
                                    <div class="form-group col-sm-6">
                                        <label for="inputNome">Seu nome</label>
                                        <input type="text" class="form-control" id="inputNome" placeholder="Digite aqui seu nome">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="inputSobrenome">Seu sobrenome</label>
                                        <input type="text" class="form-control" id="inputSobrenome" placeholder="Digite aqui sobrenome">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-sm-12">
                                        <label for="inputEnd">E-mail</label>
                                        <input type="text" class="form-control" id="inputEnd" placeholder="Digite aqui seu endereço de E-mail">

                                    </div>
                                </div>

                                <div class="form-row">
                                    <textarea name="mensagem" id="mensagem" required="required" class="form-control" rows="12" placeholder="Digite sua mensagem aqui"></textarea>
                                </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-sm-12">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox">Desejo receber novidades no e-mail
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-success">Enviar</button>
                                <a tabindex="0" class="btn btn-secondary ml-2" role="button" data-toggle="popover" data-placement="right" data-trigger="focus"
                                    title="Pintou alguma dúvida?!" data-content="Fale conosco: projetointegrador@univesp.com.br">Ajuda</a>
                            </div>
                        </div>

                    </div>

                            </form >

                        </div >

                    < !--Footer-->
                <div id="depoimentos" class="row">
                    <div class="col-sm-12 mb-3"><hr></div>
                    <div class="col-sm-4">
                        <h3 class="text-center">Contato</h3>
                        <p class="text-center mt-md-5 mt-3"><i class="fa fa-phone text-success" aria-hidden="true"></i>
                            (11) 90000-0000
                        </p>
                        <p class="text-center mt-md-2 mt-3"><i class="fa fa-mobile-phone text-success" aria-hidden="true"></i>
                            Whatsapp
                        </p>
                        <p class="text-center"><i class="fa fa-envelope text-success" aria-hidden="true"></i>
                            projetointegrador@univesp.com.br
                        </p>
                    </div>

                    <div class="col-sm-4">
                        <h3 class="text-center">Menu</h3>
                        <div class="list-group text-center">
                            <a href="#inicio" class="list-group-item list-group-item-action list-group-item-success">
                                Início
                            </a>
                            <a href="#servicos" class="list-group-item list-group-item-action list-group-item-success">
                                Serviços
                            </a>
                            <a href="#Missão, Visão e Valores" class="list-group-item list-group-item-action list-group-item-success">
                                Missão, Visão e Valores
                            </a>
                            <a href="#contato" class="list-group-item list-group-item-action list-group-item-success">
                                Contato
                            </a>
                        </div>
                    </div>

                    <div class="col-sm-4 mt-md-0 mt-4">
                        <h3 class="text-center">Social</h3>
                        <div class="btn-group-vertical btn-block btn-group-lg" role="group">
                            <a class="btn btn-outline-primary" href="https://web.facebook.com/ProjetoPI/"><i class="fab fa-facebook"></i> Facebook</a>
                            <a class="btn btn-outline-info" href="https://twitter.com/ProjetoPI/"><i class="fab fa-twitter-square"></i> Twitter</a>
                            <a class="btn btn-outline-warning" href="https://www.instagram.com/ProjetoPI/"><i class="fab fa-instagram"></i> Instagram</a>
                            <a class="btn btn-outline-info" href="https://api.whatsapp.com/send?phone=11900000000"><i class="fab fa-whatsapp"></i> Whatsapp</a>
                        </div>
                    </div>


                </div>
                    </div >
                    <div class="col-12 mt-5 bg-success pb-2">
                        <hr>
                            <blockquote class="blockquote text-center text-dark">
                                <p class="mb-0"><em>"Empresa séria, comprometida com seus clientes, preço justo e entrega no prazo!"</p>
                                <footer class="blockquote-footer text-dark">Anônimo, <cite tittle="titulo">Depoimento</cite></footer>
                            </blockquote>
                    </div>
                    </div >

<!-- Outros Scripts -->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
    function openModal() {
        $('#requisicaoModal').modal('show');
    }
    </script>
    <script>
    $(document).ready(function(){
        $('#telefone').mask('(00) 0000-00009');
        $('#telefone').blur(function(event) {
            if ($(this).val().length == 15){
                $('#telefone').mask('(00) 00000-0009');
            } else {
                $('#telefone').mask('(00) 0000-00009');
            }
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
    var categoriaSelect = document.getElementById("categoria");
    var outrosCampo = document.getElementById("outrosCampo");

    categoriaSelect.addEventListener("change", function() {
        if (categoriaSelect.value === "Outros") {
            outrosCampo.style.display = "block";
        } else {
            outrosCampo.style.display = "none";
        }
    });
});
 </script>
</body>
</html>

