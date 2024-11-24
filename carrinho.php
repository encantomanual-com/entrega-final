<?php
session_start();

if ($_SESSION['id_conta'] < 0) {
    header("Location: login.php");
}

if (isset($_GET['re'])) {
    include("include/connect.php");
    $id_conta = $_SESSION['id_conta'];
    $id_produto = $_GET['re'];
    $query = "DELETE FROM CARRINHO WHERE id_conta = $id_conta and id_produto = $id_produto";

    $result = mysqli_query($con, $query);
    header("Location: carrinho.php");
    exit();
}

if (isset($_POST['check'])) {
    include("include/connect.php");

    $id_conta = $_SESSION['id_conta'];

    $query = "SELECT * FROM carrinho JOIN produtos ON carrinho.id_produto = produtos.id_produto WHERE id_conta = $id_conta";

    $result = mysqli_query($con, $query);

    $result2 = mysqli_query($con, $query);
    $row2 = mysqli_fetch_assoc($result2);

    if (empty($row2['id_produto'])) {
        header("Location: shop.php");
        exit();
    }

    while ($row = mysqli_fetch_assoc($result)) {
        $id_produto = $row['id_produto'];
        $produto_nome = $row['produto_nome'];
        $desc = $row['descricao'];
        $qtd = $row['qtdavali'];
        $preco = $row['preco'];
        $cat = $row['categoria'];
        $img = $row['img'];
        $marca = $row['marca'];
        $cqtd = $row['cqtd'];
        $a = $preco * $cqtd;

        $newqtd = $_POST["$id_produto-qt"];

        $query = "UPDATE CARRINHO SET cqtd = $newqtd where id_conta = $id_conta and id_produto = $id_produto";

        mysqli_query($con, $query);


    }
    header("Location: checkout.php");
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
    <!-- <link rel="stylesheet" href="css/carrinho.css"> -->

    <title>Carrinho de Compras - Encanto Manual</title>


</head>

<body onload="totala()">
    <section class="header" id="header">
        <a href="index.php"><img src="img/em-logo.png" class="logo" alt="" width="100px"/></a>

        <div>
            <ul class="navbar" id="navbar">
                <li><a href="index.php">Home</a></li>
                <li><a href="shop.php">Produtos</a></li>
                <li><a href="contato.php">Contato</a></li>

                <?php

                if ($_SESSION['id_conta'] < 0) {
                    echo "<li><a href='login.php'>Login</a></li>
                        <li><a href='cadastrar.php'>Cadastre-se</a></li>";
                } else {
                    echo "<li><a href='profile.php'>Perfil</a></li>";
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
        <h2>Carrinho de Compras</h2>

        <p>Quase lá! Falta pouco para essas criações exclusivas serem suas!</p>
    </section>


    <section id="cart" class="section-p1">
        <table width="100%">
            <thead>
                <tr>
                    <td>Remover</td>
                    <td>Imagem</td>
                    <td>Produto</td>
                    <td>Preço</td>
                    <td>Quantidade</td>
                    <td>Valor Total</td>
                </tr>
            </thead>
            <tbody>

                <?php

                include("include/connect.php");

                $id_conta = $_SESSION['id_conta'];

                $query = "SELECT * FROM carrinho JOIN produtos ON carrinho.id_produto = produtos.id_produto WHERE id_conta = $id_conta";

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
                    $cqtd = $row['cqtd'];
                    $a = $preco * $cqtd;
                    
                    echo 

                        "<tr>
                            <td>
                                <a href='carrinho.php?re=$id_produto'><i class='far fa-times-circle'></i></a>
                            </td>
                            <td><img src='product_images/$img' alt='' /></td>
                            <td>$produto_nome</td>
                            <td class='pr'>R$$preco</td>
                            <td><input type='number' class = 'aqt' value='$cqtd' min = '1' max = '$qtd' onchange='subprice()' /></td>
                            <td class = 'atd'>$$a</td>
                        </tr>";
                }
                ?>

            </tbody>
        </table>
    </section>

    <section id="cart-add" class="section-p1">
        <div id="coupon">

        </div>
        <div id="subtotal">
            <h3>Total no Carrinho</h3>
            <table>
                <tr>
                    <td>Valor do(s) Produto(s)</td>
                    <td id='tot1' onload="totala()">R$</td>
                </tr>
                <tr>
                    <td>Frete</td>
                    <td>Grátis</td>
                </tr>
                <tr>
                    <td><strong>Total</strong></td>
                    <td id='tot' onload="totala()"><strong>$</strong></td>
                </tr>
            </table>

            <form method="post">
                <?php

                include("include/connect.php");

                $id_conta = $_SESSION['id_conta'];

                $query = "SELECT * FROM carrinho JOIN produtos ON carrinho.id_produto = produtos.id_produto WHERE id_conta = $id_conta";

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
                    $cqtd = $row['cqtd'];
                    $a = $preco * $cqtd;
                    echo 
                    "<input style='display: none;' name='$id_produto-p' class='inp' type = 'number' value = '$id_produto'/>
                    <input style='display: none;' name='$id_produto-qt' class='inq' type = 'number' value = '$cqtd'/>";
                }
                ?>
                <button class="normal" name="check">Prosseguir com a Compra</button>
            </form>
            </a>
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
    <!-- Menu lateral -->
    <script src="script.js"></script>

</body>

</html>

<script>
function subprice() {
    var qtd = document.getElementsByClassName("aqt");
    var sub = document.getElementsByClassName("atd");
    var pri = document.getElementsByClassName("pr");
    var upd = document.getElementsByClassName("inq");

    for (var i = 0; i < qtd.length; i++) {
        var quantity = parseInt(qtd[i].value);
        var price = parseFloat(pri[i].innerText.replace('$', ''));
        sub[i].innerHTML = `$${quantity * price}`;
        upd[i].value = parseInt(qtd[i].value);
    }

    totala();
}

function totala() {
    var pri = document.getElementsByClassName("atd");
    let yes = 0;
    for (var i = 0; i < pri.length; i++) {
        yes = yes + parseFloat(pri[i].innerText.replace('$', ''));
    }


    document.getElementById('tot').innerHTML = '$' + yes;
    document.getElementById('tot1').innerHTML = '$' + yes;
}
</script>

<script>
window.addEventListener("unload", function() {
  // Chamada script PHP para fazer logout de usuário
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "logout.php", false);
  xhr.send();
});
</script>