<?php
session_start();

if (isset($_POST['sub'])) {
    include("include/connect.php");

    $id_conta = $_SESSION['id_conta'];
    $end = $_POST['endereco'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $num_cartao = $_POST['num_cartao'];
    $query = "";

    if (empty($num_cartao)) {
        $query = "insert into `pedidos` (data_pedido, data_entrega, id_conta, endereco, cidade, estado, num_cartao, total) values(CURDATE(), NULL, '$id_conta', '$end', '$cidade', '$estado', NULL, 0)";
    } else {
        if (preg_match('/\D/', $num_cartao) || strlen($num_cartao) < 16) {
            echo "<script> alert('Número de cartão inválido!'); setTimeout(function(){ window.location.href = 'checkout.php'; }, 100); </script>";
            exit();
        }

        $query = "insert into `pedidos` (data_pedido, data_entrega, id_conta, endereco, cidade, estado, num_cartao, total) values(CURDATE(), NULL, '$id_conta', '$end', '$cidade', '$estado', '$num_cartao', 0)";
    }
    $result = mysqli_query($con, $query);

    $id_pedido = mysqli_insert_id($con);

    $query = "SELECT * FROM carrinho JOIN produtos ON carrinho.id_produto = produtos.id_produto WHERE id_conta = $id_conta";

    $result = mysqli_query($con, $query);
    global $tott;
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
        $tott = $preco * $cqtd;

        $query = "insert into `detal_pedidos` (id_pedido, id_produto, qtd) values ($id_pedido, $id_produto, $cqtd)";

        mysqli_query($con, $query);

        $query = "update produtos set qtdavali = qtdavali - $cqtd where id_produto = $id_produto";

        mysqli_query($con, $query);
    }

    $query = "delete from carrinho where id_conta = $id_conta";

    mysqli_query($con, $query);

    $query = "update pedidos set total = $tott where id_pedido = $id_pedido";

    mysqli_query($con, $query);


    header("Location: profile.php");
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
    <link rel="stylesheet" href="css/checkout.css">


    <title>Formulário de Pedido - Encanto Manual</title>

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
                    echo "<li><a href='login.php'>Login</a></li>
                          <li><a href='cadastrar.php'>Cadastrar-se</a></li>";
                } else {
                    echo "<li><a href='profile.php'>Perfil</a></li>";
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

    <div class="container">
        <div class="titlecheck">
            <h2>Formulário de Pedido</h2>
        </div>
        <div class="d-flex">
            <form method="post" id="form1">

                <h3 style="color: darkred; margin: auto"></h3>
                <input class="input11" type="text" name="endereco" placeholder="Endereço" required>
                <input class="input11" type="text" name="cidade" placeholder="Cidade" required>
                <input class="input11" type="text" name="estado" placeholder="Estado" maxlength="2" required>
                <input class="input11" id="num_cartao-field" type="text" name="num_cartao" placeholder="Número de cartão">
                <div>
                    <input class="input2" type="radio" id="ac1" name="dbt" value="cod" onchange="showInputBox()"> Pagamento
                    por boleto
                </div>
                <div>
                    <input class="input2" type="radio" id="ac2" name="dbt" value="bank" checked
                        onchange="showInputBox()">Cartão de Crédito<span>
                        <img src="img/pay/pay.png" alt="">
                    </span>
                </div>
                <button name="sub" type="submit" class="btn112">Comprar</button>
            </form>
            <div class="Yorder">
                <table class="table12">
                    <tr class='tr1'>
                        <th class='th1' colspan='2'>Seu Pedido</th>
                    </tr>

                    <?php
                    include("include/connect.php");

                    $id_conta = $_SESSION['id_conta'];

                    $query = "SELECT * FROM carrinho JOIN produtos ON carrinho.id_produto = produtos.id_produto WHERE id_conta = $id_conta";

                    $result = mysqli_query($con, $query);

                    global $tot;

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
                        $tot = $tot + $a;

                        echo 
                            "<tr class='tr1'>
                                <td class='td1'>$produto_nome x $cqtd(Qtd)</td>
                                <td class='td1'>R$$a</td>
                            </tr>";
                    }
                        echo 
                            "<tr class='tr1'>
                                <td class='td1'>Total</td>
                                <td class='td1'>R$$tot.00</td>
                            </tr>
                            <tr class='tr1'>
                                <td class='td1'>Frete</td>
                                <td class='td1'>Frete Grátis</td>
                            </tr>";
                    ?>


                </table><br>
            </div><!-- Yorder -->
        </div>
    </div>

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

    <script src="script.js"></script>
</body>

</html>

<script>
    function showInputBox() {
        var select = document.querySelector('#ac1');
        var inputBox = document.getElementById("num_cartao-field");
        if (!select.checked) {
            inputBox.style.display = "block";
        } else {
            inputBox.style.display = "none";
        }
    }
</script>

<script>
window.addEventListener("unload", function() {
  // Chamando o script PHP para fazer logout de usuário
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "logout.php", false);
  xhr.send();
});
</script>