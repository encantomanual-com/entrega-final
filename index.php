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
    <link rel="stylesheet" href="css/btn-banner.css">


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
            <style>
                .hero button {
  background-image: linear-gradient(45deg, #ff4500, #ff9900);
  background-color: transparent;
  color: #ffffff;
  border: 0;
  padding: 14px 80px 14px 65px;
  background-repeat: no-repeat;
  cursor: pointer;
  font-weight: 700;
  font-size: 16px;
  border-radius: 8px; /* Bordas arredondadas */
  box-shadow: 0px 4px 10px rgba(255, 69, 0, 0.5);
  position: relative;
  overflow: hidden;
  transition: all 0.4s ease;
}

.hero button:hover {
  animation: jump 0.6s ease-in-out;
  background-image: linear-gradient(45deg, #ff9900, #ff4500);
  box-shadow: 0px 8px 20px rgba(255, 69, 0, 0.8);
  transform: translateY(-2px) scale(1.05); /* Efeito de leve subida */
}

/* Efeito de brilho pulsante */
.hero button::before {
  content: "";
  position: absolute;
  top: 50%;
  left: 50%;
  width: 120%;
  height: 120%;
  background: radial-gradient(circle, rgba(255, 255, 255, 0.6) 0%, transparent 60%);
  transform: translate(-50%, -50%) scale(0);
  border-radius: 50%;
  z-index: 0;
  opacity: 0.7;
  transition: all 0.4s ease;
}

.hero button:hover::before {
  transform: translate(-50%, -50%) scale(1.2);
  opacity: 1;
}

/* Efeito 3D de texto */
.hero button span {
  position: relative;
  z-index: 1;
  text-shadow: 0px 3px 3px rgba(0, 0, 0, 0.2);
}

            </style>
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
        <button class="normal"><span>COMPRE AGORA</span></button>
    </a>
    </section>


    <section class="banner3" id="banner3">
        <div class="banner-box">
            <h2>ITENS DE DECORAÇÃO</h2>
            <h3> 25% OFF</h3>
            <a href="shop.php" class="normal-link"><button class="normal">Comprar agora</button></a>
        </div>
        <div class="banner-box banner-box2">
            <h2>OBRAS DE ARTE</h2>
            <h3>30% OFF</h3>
            <a href="shop.php" class="normal-link"><button class="normal">Comprar agora</button></a>
        </div>
        <div class="banner-box banner-box3">
            <h2>ACESSÓRIOS</h2>
            <h3>50% OFF</h3>
            <a href="shop.php" class="normal-link"><button class="normal">Comprar agora</button></a>
        </div>
    </section>

    <section id="page-header" class="about-header">
        <h2>O encanto que realmente é manual.</h2>

        <p style="color: #000;">Arte feita a mão para você!</p>

        
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