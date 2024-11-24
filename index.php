<?php
session_start();

if (empty($_SESSION['id_conta']))
    $_SESSION['id_conta'] = -1;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>

    <link rel="stylesheet" href="style.css"/>

    <title>Encanto Manual - Valorizando o talento local e transformando o comércio!</title>


</head>

<body>
    <section class="header" id="header">
        <a href="index.php"><img src="img/em-logo.png" class="logo" alt="" width="100px" /></a>

        <div>
            <ul class="navbar" id="navbar">
                <li><a class="active" href="index.php">Home</a></li>
                <li><a href="shop.php">Produtos</a></li>
                <li><a href="contato.php">Contato</a></li>

                <?php

                if ($_SESSION['id_conta'] < 0) {
                    echo 
                        "<li><a href='login.php'>Login</a></li>
                        <li><a href='cadastrar.php'>Cadastre-se</a></li>";
                } else {
                    echo 
                        "<li><a href='profile.php'>Perfil</a></li>";
                }
                ?>
                <li><a href="admin.php">Admin</a></li>
                <li id="lg-bag">
                    <a href="carrinho.php"><i class="far fa-shopping-bag"></i></a>
                </li>
                <a href="#" id="close"><i class="far fa-times"></i></a>
            </ul>
        </div>
        <div class="mobile" id="mobile">
            <a href="carrinho.php"><i class="far fa-shopping-bag"></i></a>
            <i id="bar" class="fas fa-outdent"></i>
        </div>
    </section>

    <section class="hero" id="hero">
        <h2>Valorizando o talento local</h2>
        <h1>e transformando o comércio!</h1>
        <p>Cada peça é única assim como quem cria!</p>
        <a href="shop.php">
            <button>Ver ofertas</button>
        </a>
    </section>

    <section id="feature" class="section-p1">
        <div class="fe-box">
            <img src="img/features/f1.png" alt="" />
            <h6>Frete grátis</h6>
        </div>
        <div class="fe-box">
            <img src="img/features/f2.png" alt="" />
            <h6>Entrega rápida</h6>
        </div>
        <div class="fe-box">
            <img src="img/features/f3.png" alt="" />
            <h6>Econômico</h6>
        </div>
        <div class="fe-box">
            <img src="img/features/f4.png" alt="" />
            <h6>Promoções</h6>
        </div>
        <div class="fe-box">
            <img src="img/features/f5.png" alt="" />
            <h6>Bom atendimento</h6>
        </div>
        <div class="fe-box">
            <img src="img/features/f6.png" alt="" />
            <h6>Suporte 24h</h6>
        </div>
    </section>


    <section id="banner" class="section-m1">
        <h4>Promoções</h4>
        <h2>Mais de <span>70% Off</span> - Todos os produtos!</h2>
        <a href="shop.php">
            <button class="normal">COMPRE AGORA</button>
        </a>
    </section>



    <section class="banner3" id="banner3">
        <div class="banner-box">
            <h2>Itens de decoração</h2>
            <h3> 25% OFF</h3>
        </div>
        <div class="banner-box banner-box2">
            <h2>Obras de arte</h2>
            <h3>30% OFF</h3>
        </div>
        <div class="banner-box banner-box3">
            <h2>Acessórios</h2>
            <h3>50% OFF</h3>
        </div>
    </section>

    <section id="page-header" class="about-header">
        <h2>O encanto que realmente é manual.</h2>

        <p style="color: white;">Arte feita a mão para você!</p>

        
    <style>
        #page-header.about-header {
        background-image: url("img/banner/banner006.jpg");
        }

        #about-head {
        display: flex;
        align-items: center;
        }

        #about-head img {
        width: 50%;
        height: auto;
        }

        #about-head div {
        padding-left: 40px;
        }
    </style>    
    </section>

    <section id="about-head" class="section-p1">
        <img src="img/banner/banner003.jpg" alt="" />
        <div>
            <h2>Sobre nós</h2>
            <p class="paragraph">
                Criando uma ponte entre artesãos talentosos e consumidores que valorizam o trabalho manual e o design autêntico. Aqui, cada peça conta uma história única, feita com dedicação por mãos habilidosas. 
            </p>
            <p class="paragraph">
                Queremos fortalecer essa conexão, proporcionando um espaço onde a arte e o consumo consciente se encontram, promovendo a valorização do feito à mão e o impacto positivo na sociedade.
            </p>
            <br /><br />
        
        </div>
    </section>

    <div class="section-divider"></div>
<footer class="section-p1">
    <div class="col">
        <img class="logo" src="img/em-logo.png" width="100px" alt="Encanto Manual Logo" />
        <h4>Contato</h4>
        <p><strong>Endereço:</strong> Av. Cesário de Melo</p>
        <p><strong>Telefone:</strong> +55 (21) 99604-5109</p>
        <p><strong>Horário:</strong> 9:00 - 17:00</p>
        <div class="social-icons">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
        </div>
    </div>

    <div class="col">
        <h4>Minha conta</h4>
        <a href="carrinho.php">Meu carrinho</a>
        <a href="wishlist.php">Lista de desejos</a>
        <a href="profile.php">Perfil</a>
    </div>

    <div class="col install">
        <h4>Formas de Pagamento</h4>
        <p>Oferecemos várias opções para você:</p>
        <img src="img/pay/pay.png" alt="Formas de pagamento" />
    </div>

    <div class="copyright">
        <p>&copy; 2024 Encanto Manual. Todos os direitos reservados.</p>
    </div>
</footer>
<!-- Scrip JS do Menu lateral -->
    <script src="script.js"></script>
</body>

</html>

<script>
window.addEventListener("onunload", function() {
  // Chamando script PHP para afzer logout de usuário
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "logout.php", false);
  xhr.send();
});
</script>