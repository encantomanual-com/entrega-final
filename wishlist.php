<?php
session_start();

if ($_SESSION['id_conta'] < 0) {
    header("Location: login.php");
}

if (isset($_GET['re'])) {
    include("include/connect.php");
    $id_conta = $_SESSION['id_conta'];
    $id_produto = $_GET['re'];
    $query = "DELETE FROM wishlist WHERE id_conta = $id_conta and id_produto = $id_produto";

    $result = mysqli_query($con, $query);
    header("Location: wishlist.php");
    exit();
}
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

    <title>Lista de Desejos - Encanto Manual</title>


</head>

<body>
    <section class="header" id="header">
        <a href="index.php"><img src="img/em-logo.png" class="logo" alt="" width="100px"/></a>

        <div>
            <ul class="navbar" id="navbar">
                <li><a href="index.php">Home</a></li>
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
                    <a class="active" href="carrinho.php"><i class="far fa-shopping-bag"></i></a>
                </li>
                <a href="#" id="close"><i class="far fa-times"></i></a>
            </ul>
        </div>
        <div class="mobile" id="mobile">
            <a href="carrinho.php"><i class="far fa-shopping-bag"></i></a>
            <i id="bar" class="fas fa-outdent"></i>
        </div>
    </section>

    <section id="page-header" class="about-header">
        <h2>Lista de Desejos</h2>

        <p>Guarde aqui os produtos que conquistaram seu coração.</p>
    </section>

    <section id="cart" class="section-p1">
        <table width="100%">
            <thead>
                <tr>
                    <td>Remover</td>
                    <td>Imagem</td>
                    <td>Produto</td>
                    <td>Preço</td>
                </tr>
            </thead>
            <tbody>
                <?php

                include("include/connect.php");

                $id_conta = $_SESSION['id_conta'];

                $query = "SELECT * FROM wishlist JOIN produtos ON wishlist.id_produto = produtos.id_produto WHERE id_conta = $id_conta";

                $result = mysqli_query($con, $query);



                while ($row = mysqli_fetch_assoc($result)) {
                    $id_produto = $row['id_produto'];
                    $produto_nome = $row['produto_nome'];
                    $desc = $row['descricao'];
                    $qtd = $row['qtdavali'];
                    $preco = $row['preco'];
                    $cat = $row['categoria'];
                    $img = $row['img'];
                    $marca = $row['marca'];
                    
                    echo 

                      "<tr>
                        <td>
                          <a href='wishlist.php?re=$id_produto'><i class='far fa-times-circle'></i></a>
                        </td>
                        <td><img src='product_images/$img' alt='' /></td>
                        <td>$produto_nome</td>
                        <td class='pr'>$$preco</td>
                      </tr>";
                }
                ?>
            </tbody>
        </table>
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
<!-- Menu Lateral -->
    <script src="script.js"></script>
</body>

</html>

<script>
window.addEventListener("beforeunload", function() {
  // Chamando script PHP para fazer logout de usuário
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "logout.php", false);
  xhr.send();
});
</script>