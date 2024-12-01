<?php
include("include/connect.php");

if (isset($_POST['submit'])) {
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmpassowrd = $_POST['confirmPassword'];
    $cpf = $_POST['cpf'];
    $data_nasc = $_POST['data_nasc'];
    $contato = $_POST['contato'];
    $genero = $_POST['genero'];
    $email = $_POST['email'];

    $query = "select * from contas where username = '$username' or cpf='$cpf' or contato='$contato' or email='$email'";

    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    if (!empty($row['id_conta'])) {
        echo "<script> alert('Essa conta já existe.'); setTimeout(function(){ window.location.href = 'cadastrar.php'; }, 100); </script>";
        exit();
    }
    if ($password != $confirmpassowrd) {
        echo "<script> alert('As senhas não coincidem!'); setTimeout(function(){ window.location.href = 'cadastrar.php'; }, 100); </script>";
        exit();
    }
    if ($password < 8) {
        echo "<script> alert('Senha muito curta. Sua senha deve ter no mínimo 8 caracteres!'); setTimeout(function(){ window.location.href = 'cadastrar.php'; }, 100); </script>";
        exit();
    }
    // Valida o formato usando regex
    if (!preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $data_nasc)) {
        echo "<script> alert('Data de nascimento inválida!'); setTimeout(function(){ window.location.href = 'cadastrar.php'; }, 100); </script>";
        exit();
    }

    // Converte para o formato AAAA-MM-DD para inserir no banco, se necessário
    $dataFormatada = DateTime::createFromFormat('d/m/Y', $data_nasc);
    if (!$dataFormatada) {
        echo "<script> alert('Data de nascimento inválida!'); setTimeout(function(){ window.location.href = 'cadastrar.php'; }, 100); </script>";
        exit();
    }
    $data_nasc = $dataFormatada->format('Y-m-d');


    if ($genero == "S") {
        echo "<script> alert('Selecione o seu gênero!'); setTimeout(function(){ window.location.href = 'cadastrar.php'; }, 100); </script>";
        exit();
    }
    $cpf = preg_replace('/\D/', '', $cpf); // Remove a máscara antes de validar

    if (strlen($cpf) != 11) {
        echo "<script> alert('CPF inválido'); setTimeout(function(){ window.location.href = 'cadastrar.php'; }, 100); </script>";
        exit();
    }
    // Remove a máscara do contato
    $contato = preg_replace('/\D/', '', $contato);

    if (strlen($contato) != 11) {
        echo "<script> alert('Número de celular inválido'); setTimeout(function(){ window.location.href = 'cadastrar.php'; }, 100); </script>";
        exit();
    }

    $query = "insert into `contas` (nome, sobrenome, contato, email,cpf, data_nasc, username, genero,password) values ('$nome', '$sobrenome', '$contato','$email', '$cpf', '$data_nasc', '$username', '$genero','$password')";

    $result = mysqli_query($con, $query);



    if ($result) {
        echo "<script> alert('Conta criada com sucesso!'); setTimeout(function(){ window.location.href = 'login.php'; }, 100); </script>";
    }

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

    <title>Cadastre-se - Encanto Manual</title>

</head>

<body>
    <section class="header" id="header">
        <a href="#"><img src="img/em-logo.png" class="logo" alt="" width="100px"/></a>
        <div>
            <ul class="navbar" id="navbar">
                <li><a href="index.php">Home</a></li>
                <li><a href="shop.php">Produtos</a></li>
                <li><a href="contato.php">Contato</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a class="active" href="cadastrar.php">Cadastre-se</a></li>
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


    <form method="post" id="form">
        <h3 style="color: darkred; margin: auto"></h3>
        <input class="input1" id="nome" name="nome" type="text" placeholder="Nome *" required="required">
        <input class="input1" id="sobrenome" name="sobrenome" type="text" placeholder="Sobrenome *" required="required">
        <input class="input1" id="user" name="username" type="text" placeholder="Nome de usuário *" required="required">
        <input class="input1" id="email" name="email" type="text" placeholder="Email *" required="required">
        <input class="input1" id="pass" name="password" type="password" placeholder="Senha*" maxlength="8" required="required">
        <input class="input1" id="cpass" name="confirmPassword" type="password" placeholder="Confirme sua senha *" maxlength="8" required="required">
        <input class="input1" id="cpf" name="cpf" type="text" placeholder="CPF *" required="required" maxlength="14" oninput="mascararCPF(this)">
        <input class="input1" id="data_nasc" name="data_nasc" type="text" placeholder="Data de nascimento" maxlength="10" oninput="mascararData(this)" required="required">
        <input class="input1" id="contato" name="contato" type="text" placeholder="Número de celular*" required="required" oninput="mascararCelular(this)" maxlength="15">
        <select class="select1" id="genero" name="genero" required="required">
            <option value="S">Gênero</option>
            <option value="M">Masculino</option>
            <option value="F">Feminino</option>
            <option value="O">Outros</option>
        </select>
        <button name="submit" type="submit" class="btn">Enviar</button>

    </form>

    <div class="sign">
        <a href="login.php" class="signn">Você já possuí uma conta?</a>
    </div>


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

<!-- Script JS menu lateral -->
    <script src="script.js"></script>
    
<!-- SCRIPT PARA MASCARAR Celular -->
    <script src="js/mascararCelular.js"></script>

<!-- Script para Mascarar CPF -->
    <script src="js/mascararCpf.js"></script>

<!-- Script para Mascarar Data de Nascimento -->
    <script src="js/mascararData.js"></script>
</body>

</html>

<script>
window.addEventListener("unload", function() {
  // Chamando script PHP para fazer logout de usuário
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "logout.php", false);
  xhr.send();
});
</script>