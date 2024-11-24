<?php
session_start();

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
    <link rel="stylesheet" href="css/shop.css">

    <title>Produtos - Encanto Manual</title>

 
</head>

<body>
    <section class="header" id="header">
        <a href="index.php"><img src="img/em-logo.png" class="logo" alt="" width="100px" /></a>

        <div>
            <ul class="navbar" id="navbar">
                <li><a href="index.php">Home</a></li>
                <li><a class="active" href="shop.php">Produtos</a></li>
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

    <section id="page-header">
        <h2>Produtos Únicos</h2>

        <p style="color: white;">Peças criadas à mão para quem aprecia a essência e a história de cada detalhe!</p>

    </section>

    <div class="search-container">
        <form id="search-form" method="post">
            <label for="search">Pesquisar:</label>
            <input type="text" id="search" name="search">
            <label for="category-filter">Categorias:</label>
            <select id="category-filter" name="cat">
                <option>...</option>
                <option value="all">Todos</option>
                <option value="Decoração">Decoração</option>
                <option value="Acessório">Acessórios</option>
            </select>
            <button type="submit" id="search-btn" name="search1">Buscar</button>
        </form>
    </div>

    <?php
    include("include/connect.php");
    if (isset($_POST['search1'])) {
        $search = $_POST['search'];
        $categoria = $_POST['cat'];
        $query = "";
        if (!empty($search))
            $query = "select* from `produtos` where ((produto_nome like '%$search%') or (marca like '%$search%') or (descricao like '%$search%'))";
        else
            $query = "select * from `produtos`";

        if ($categoria != "all") {
            if (empty($search)) {
                $query = $query . "where categoria = '$categoria'";
            } else {
                $query = $query . "and categoria = '$categoria'";
            }
        }

        $result = mysqli_query($con, $query);

        if ($result) {
            echo "<section id='product1' class='section-p1'>
                    <div class='pro-container'>";


        }

        while ($row = mysqli_fetch_assoc($result)) {
            $id_produto = $row['id_produto'];
            $produto_nome = $row['produto_nome'];
            if (strlen($produto_nome) > 35) {
                $produto_nome = substr($produto_nome, 0, 35) . '...';
            }
            $desc = $row['descricao'];
            $qtd = $row['qtdavali'];
            $preco = $row['preco'];
            $cat = $row['categoria'];
            $img = $row['img'];
            $marca = $row['marca'];

           
                    $query2 = "SELECT id_produto, AVG(rating) AS average_rating FROM reviews where id_produto = $id_produto GROUP BY id_produto ";

            $result2 = mysqli_query($con, $query2);

            $row2 = mysqli_fetch_assoc($result2);

            if ($row2) {
                $stars = $row2['average_rating'];
            } else {
                $stars = 0;
            }
            $stars = round($stars, 0);
            $empty = 5 - $stars;

            echo "
                    <div class='pro' onclick='topage($id_produto)'>
                      <img src='product_images/$img' height='235px' width = '235px' alt='' />
                      <div class='des'>
                        <span>$marca</span>
                        <h5>$produto_nome</h5>
                        <div class='star'>";
            for ($i = 1; $i <= $stars; $i++) {
                echo "<i class='fas fa-star'></i>";

            }
            for ($i = 1; $i <= $empty; $i++) {
                echo "<i class='far fa-star'></i>";

            }
            echo "</div>
                        <h4>R$$preco</h4>
                      </div>
                      <a onclick='topage($id_produto)'><i class='fal fa-shopping-cart cart'></i></a>
                    </div>
                 ";
        }

        if ($result) {

            echo "</section>
                    </div>";
        }
    } else {
        include("include/connect.php");

        $select = "Select* from produtos where qtdavali > 0 order by rand()";
        $result = mysqli_query($con, $select);

        if ($result) {
            echo "<section id='product1' class='section-p1'>
                    <div class='pro-container'>";


        }

        while ($row = mysqli_fetch_assoc($result)) {
            $id_produto = $row['id_produto'];
            $produto_nome = $row['produto_nome'];
            if (strlen($produto_nome) > 35) {
                $produto_nome = substr($produto_nome, 0, 35) . '...';
            }
            $desc = $row['descricao'];
            $qtd = $row['qtdavali'];
            $preco = $row['preco'];
            $cat = $row['categoria'];
            $img = $row['img'];
            $marca = $row['marca'];

            $query2 = "SELECT id_produto, AVG(rating) AS average_rating FROM reviews where id_produto = $id_produto GROUP BY id_produto ";

            $result2 = mysqli_query($con, $query2);

            $row2 = mysqli_fetch_assoc($result2);

            if ($row2) {
                $stars = $row2['average_rating'];
            } else {
                $stars = 0;
            }
            $stars = round($stars, 0);

            $empty = 5 - $stars;

            echo "
                    <div class='pro' onclick='topage($id_produto)'>
                      <img src='product_images/$img' height='235px' width = '235px' alt='' />
                      <div class='des'>
                        <span>$marca</span>
                        <h5>$produto_nome</h5>
                        <div class='star'>";
            for ($i = 1; $i <= $stars; $i++) {
                echo "<i class='fas fa-star'></i>";

            }
            for ($i = 1; $i <= $empty; $i++) {
                echo "<i class='far fa-star'></i>";

            }
            echo "</div>
                        <h4>R$$preco</h4>
                      </div>
                      <a onclick='topage($id_produto)'><i class='fal fa-shopping-cart cart'></i></a>
                    </div>
                 ";
        }

        if ($result) {

            echo "</section>
                    </div>";
        }

    }
    ?>


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

</html>

<script>
    function topage(id_produto) {
        window.location.href = `sproduct.php?id_produto=${id_produto}`;
    }
</script>
    <script>
    window.addEventListener("unload", function() {
        // Chamando script PHP para fazer logout de usuário
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "logout.php", false);
        xhr.send();
    });
    </script>