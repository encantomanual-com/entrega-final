<?php
session_start();


if (isset($_GET['lo'])) {
  $_SESSION['id_conta'] = -1;
  header("Location: index.php");
  exit();

}

if (isset($_POST['submit'])) {
  include("include/connect.php");
  $id_conta = $_SESSION['id_conta'];

  $nome = $_POST['a1'];
  $sobrenome = $_POST['a2'];
  $email = $_POST['a3'];
  $cpf = $_POST['a4'];
  $contato = $_POST['a5'];
  $data_nasc = $_POST['a6'];

  $query = "select * from contas where (cpf='$cpf' or contato='$contato' or email='$email') and id_conta != $id_conta ";

  $result = mysqli_query($con, $query);
  $row = mysqli_fetch_assoc($result);
  if (!empty($row['id_conta'])) {
    echo "<script> alert('Essa conta já existe!'); setTimeout(function(){ window.location.href = 'profile.php'; }, 10); </script>";
    exit();
  }
  if (strtotime($data_nasc) > time()) {
    echo "<script> alert('Data inválida!'); setTimeout(function(){ window.location.href = 'profile.php'; }, 10); </script>";
    exit();
  }
  if (preg_match('/\D/', $cpf) || strlen($cpf) < 11) {
    echo "<script> alert('CPF inválido!'); setTimeout(function(){ window.location.href = 'profile.php'; }, 10); </script>";
    exit();
  }
  if (preg_match('/\D/', $contato) || strlen($contato) < 11) {
    echo "<script> alert('Número de contato inválido. Número deve conter 11 dígitos!'); setTimeout(function(){ window.location.href = 'profile.php'; }, 10); </script>";
    exit();
  }

  $query = "UPDATE contas SET nome = '$nome', sobrenome='$sobrenome', email='$email', contato='$contato', cpf='$cpf', data_nasc='$data_nasc' WHERE id_conta = $id_conta";

  $result = mysqli_query($con, $query);
  header("Location: profile.php");
  exit();
}


if (isset($_POST['abc'])) {
  include("include/connect.php");

  $id_pedido = $_GET['odd'];

  $query = "select * from `detal_pedidos` where id_pedido = $id_pedido";
  $result = mysqli_query($con, $query);

  while ($row = mysqli_fetch_assoc($result)) {
    include("include/connect.php");

    $id_produto = $row['id_produto'];


    $text = $_POST["$id_produto-te"];
    $star = $_POST["$id_produto-rating"];
    $query;
    if (empty($text))
      $query = "insert into `reviews` (id_pedido, id_produto, texto_avalia, rating) values ($id_pedido, $id_produto, NULL, $star)";
    else
      $query = "insert into `reviews` (id_pedido, id_produto, texto_avalia, rating) values ($id_pedido, $id_produto, '$text', $star)";


    $result2 = mysqli_query($con, $query);
  }

  header("Location: profile.php");
  exit();
}

if (isset($_GET['c'])) {
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
    <link rel="stylesheet" href="css/profile.css">

    <title>Perfil - Encanto Manual</title>


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
                <li><a  href='cadastrar.php'>Cadastre-se</a></li>";
          } else {
            echo 
                "<li><a class='active'  href='profile.php'>Perfil</a></li>";
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

    <div class="navbar-top">
        <div class="title">
            <h1>Perfil</h1>
        </div>
    </div>
    <!-- Fim -->

    <!-- Menu Lateral -->
    <div class="sidenav">
        <div class="profile">
            <img src="img/people/user.png" alt="" width="100" height="100">

            <?php

                include("include/connect.php");

                $id_conta = $_SESSION['id_conta'];
                $query = "SELECT * FROM contas WHERE id_conta = $id_conta";

                $result = mysqli_query($con, $query);

                $row = mysqli_fetch_assoc($result);

                $nome = $row['nome'];
                $sobrenome = $row['sobrenome'];
                $contato = $row['contato'];
                $email = $row['email'];
                $cpf = $row['cpf'];
                $data_nasc = $row['data_nasc'];
                $user = $row['username'];
                $genero = $row['genero'];
                $name = $nome . " " . $sobrenome;

                echo 
                  "<div class='name'>
                    $name
                  </div>
                <div class='job'>
                  Cliente
                </div>
                </div>;"
            ?>

            <div class="sidenav-url">
                <div class="url">
                    <a href='profile.php?lo=1' class="btn logup">Sair</a>
                    <hr allign="center">
                </div>
                <div class="url">
                    <a href='profile.php?upd=1' class="btn logup">Atualizar</a>
                    <hr allign="center">
                </div>

              <?php
                if (isset($_GET['odd'])) {
                  echo 
                            "<div class='url'>
                            <a href='profile.php' class='btn logup'>Cancelar</a>
                            <hr allign='center'>
                            </div>";
                }
              ?>
            </div>
        </div>
        <!-- Fim -->

        <!-- Main -->
        <div class="main">
            <h2>Dados Pessoais</h2>
            <div class="card">
                <div class="card-body">
                    <i class="fa fa-pen fa-xs edit"></i>
                    <table>
                        <tbody>
                            <?php


              if (isset($_GET['upd'])) {
                include("include/connect.php");

                $id_conta = $_SESSION['id_conta'];

                $query = "SELECT * FROM contas WHERE id_conta = $id_conta";

                $result = mysqli_query($con, $query);

                $row = mysqli_fetch_assoc($result);

                $nome = $row['nome'];
                $sobrenome = $row['sobrenome'];
                $contato = $row['contato'];
                $email = $row['email'];
                $cpf = $row['cpf'];
                $data_nasc = $row['data_nasc'];
                $user = $row['username'];
                $genero = $row['genero'];

                echo 
                  "<form class='form1' method='post'>
                    <tr>
                      <td>Nome</td>
                      <td>:</td>
                      <td><input name='a1' type='text' value='$nome'></td>
                    </tr>
                    <tr>
                      <td>Sobrenome</td>
                      <td>:</td>
                      <td><input name='a2' type='text' value='$sobrenome'></td>
                    </tr>
                    <tr>
                      <td>Email</td>
                      <td>:</td>
                      <td><input name='a3' type='text' value='$email'></td>
                    </tr>
                    <tr>
                      <td>CPF</td>
                      <td>:</td>
                      <td><input name='a4' type='text' value='$cpf' maxlength='11'></td>
                    </tr>
                    <tr>
                    <td>Celular</td>
                    <td>:</td>
                    <td><input name='a5' type='text' value='$contato' maxlength='11'></td>
                    </tr>
                    <tr>
                    <td>Data de nascimento</td>
                    <td>:</td>
                    <td><input name='a6' type='date' value='$data_nasc'></td>
                    </tr>

                    <tr>
                    <td><button name='submit' type='submit' class='btn' style='width: 50%;'>Enviar</button></td>
                    </tr>

                  </form>";



              } else {
                include("include/connect.php");

                $id_conta = $_SESSION['id_conta'];
                $query = "SELECT * FROM contas WHERE id_conta = $id_conta";

                $result = mysqli_query($con, $query);

                $row = mysqli_fetch_assoc($result);

                $nome = $row['nome'];
                $sobrenome = $row['sobrenome'];
                $contato = $row['contato'];
                $email = $row['email'];
                $cpf = $row['cpf'];
                $data_nasc = $row['data_nasc'];
                $user = $row['username'];
                $genero = $row['genero'];
                $name = $nome . " " . $sobrenome;

                echo "
                    <tr>
                      <td>Nome</td>
                      <td>:</td>
                      <td>$nome</td>
                    </tr>
                    <tr>
                      <td>Sobrenome</td>
                      <td>:</td>
                      <td>$sobrenome</td>
                    </tr>
                    <tr>
                      <td>Email</td>
                      <td>:</td>
                      <td>$email</td>
                    </tr>
                    <tr>
                      <td>CPF</td>
                      <td>:</td>
                      <td>$cpf</td>
                    </tr>
                    <tr>
                      <td>Celular</td>
                      <td>:</td>
                      <td>$contato</td>
                    </tr>
                    <tr>
                      <td>Data de Nascimento</td>
                      <td>:</td>
                      <td>$data_nasc</td>
                    </tr>
                    <tr>
                      <td>Username</td>
                      <td>:</td>
                      <td>$user</td>
                    </tr>
                    <tr>
                      <td>Gênero</td>
                      <td>:</td>
                      <td>$genero</td>
                    </tr>";
              }
              ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <?php

      if (isset($_GET['odd'])) {
        include("include/connect.php");

        $id_pedido = $_GET['odd'];

        $query = "select * from `detal_pedidos` where id_pedido = $id_pedido";
        $result = mysqli_query($con, $query);

        echo "<h2>Avaliação</h2>
                  <div class='card'>
                  <div class='card-body'>
                      <i class='fa fa-pen fa-xs edit'></i>
                      <div class='tb' style: 'height: 700px; max-height: 700px;'>
                      <form method='post'> <table style='display:table; max-height: 700px;' class='tb'><thead>
                <tr>
                  <th>Nome</th>
                  <th>Imagem</th>
                  <th>Preço</th>
                  <th>Avaliação</th>
                  <th>Classificação</th>
                </tr>
                </thead><tbody>";

        while ($row = mysqli_fetch_assoc($result)) {
          include("include/connect.php");

          $id_produto = $row['id_produto'];
          $query = "select * from produtos where id_produto = $id_produto";

          $result2 = mysqli_query($con, $query);

          $row2 = mysqli_fetch_assoc($result2);

          $img = $row2['img'];
          $produto_nome = $row2['produto_nome'];
          $preco = $row2['preco'];

          echo " <tr>
                    <td>$produto_nome</td>
                    <td><img src='product_images/$img' width='50px' height='50px' alt='Product 1'></td>
                    <td>$preco</td>
                    <td><textarea name='$id_produto-te'> </textarea></td>
                    <td>
                      <fieldset class='rating' style='width: 300px; padding: 0;' id = 'a-$id_produto-rating'>
                        <input type='radio' onclick='bruh(`$id_produto`)' id='$id_produto-rating1' name='$id_produto-rating' value='1' required><label for='$id_produto-rating1' style='padding: 10px;'></label>
                        <input type='radio' onclick='bruh(`$id_produto`)' id='$id_produto-rating2' name='$id_produto-rating' value='2' ><label for='$id_produto-rating2' style='padding: 10px;'></label>
                        <input type='radio' onclick='bruh(`$id_produto`)' id='$id_produto-rating3' name='$id_produto-rating' value='3' ><label for='$id_produto-rating3' style='padding: 10px;'></label>
                        <input type='radio' onclick='bruh(`$id_produto`)' id='$id_produto-rating4' name='$id_produto-rating' value='4' ><label for='$id_produto-rating4' style='padding: 10px;'></label>
                        <input type='radio' onclick='bruh(`$id_produto`)' id='$id_produto-rating5' name='$id_produto-rating' value='5' ><label for='$id_produto-rating5' style='padding: 10px;'></label>
                      </fieldset>
                    </td>
                  </tr><script>bruh(`$id_produto`);</script>";
        }
        echo "</tbody></table><div class='asd'><button type='submit' name='abc' class = 'btn' >Enviar</button></div>
                </form></tbody>
                  </table>
              </div>
          </div>";

      } else {
        echo "<h2>Informações do Pedido</h2>
                <div class='card'>
                <div class='card-body'>
                    <i class='fa fa-pen fa-xs edit'></i>
                    <div class='tb'>
                        <table style='display:table;' class='tb'>
                            <thead>
                                <tr>
                                    <th>ID do Pedido</th>
                                    <th>Data do Pedido</th>
                                    <th>Data de Entrega</th>
                                    <th>Total</th>
                                    <th>Endereço</th>
                                    <th>Avaliação</th>
                                </tr>
                            </thead>
                            <tbody>";

        include("include/connect.php");

        $id_conta = $_SESSION['id_conta'];

        $query = "SELECT * FROM pedidos join contas on pedidos.id_conta = contas.id_conta where pedidos.id_conta = $id_conta";


        $result = mysqli_query($con, $query);

        while ($row = mysqli_fetch_assoc($result)) {
          $id_pedido = $row['id_pedido'];
          $data_pedido = $row['data_pedido'];
          $data_entrega = $row['data_entrega'];
          $end = $row['endereco'];
          $pri = $row['total'];
          if (empty($data_entrega))
            $data_entrega = "Não entregue";
          echo "


                <tr>
                <td>$id_pedido</td>
                    <td>$data_pedido</td>
                    <td>$data_entrega</td>
                    <td>$pri</td>
                <td style='max-width: 300px; max-height: 100px; overflow-x: auto; overflow-y: auto;'>$end</td>";

          if ($data_entrega != "Não entregue") {

            $query1 = "select* from reviews where id_pedido = $id_pedido";
            $r = mysqli_query($con, $query1);
            $w = mysqli_fetch_assoc($r);
            if (empty($w))
              echo "<td><a href='profile.php?odd=$id_pedido'><button class='insert-btn'>Avaliar</button></a></td>";
            else
              echo "<td>Avaliado</td>";
          }
          echo "</tr>";
        }

        echo "</tbody>
                  </table>
              </div>
          </div>
      </div>";
      }
      ?>



        </div>
        <!-- Fim -->

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


        <script src="script.js"></script>

        <script>
        // Pegando todos os campos de ratings na página
        function bruh(param) {
            console.log(param);
            const ratingFields = document.querySelectorAll('#a-' + param + '-rating');

            // Vai fazer um loop em cada campo de classificação
            ratingFields.forEach(ratingField => {
                // Pegando todas as estrelas neste campo de "rating"
                const stars = ratingField.querySelectorAll('input[type="radio"]');

                // Vai fazer umm loop em cada estrela
                stars.forEach(star => {
                    // Evento de escuta no click na estrela
                    star.addEventListener('click', function() {
                        // Define a estrela clicada e todas as outras estrelas anteriores para verificar e preencher


                        for (let i = 0; i < star.value; i++) {
                            console.log('hello');
                            stars[i].checked = true;
                            stars[i].nextElementSibling.classList.add('checked');
                        }

                        // Define todas as estrelas depois da estrela clicada como as desmarcadas e vazias
                        for (let i = star.value; i < stars.length; i++) {
                            stars[i].checked = false;
                            console.log('hello');

                            stars[i].nextElementSibling.classList.remove('checked');
                        }
                    });
                });
            });
        }
        </script>



</body>

</html>

<script>
window.addEventListener("unload", function() {
  // Chamando o script PHP para fazer logout
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "logout.php", false);
  xhr.send();
});
</script>