<?php
include("include/connect.php");

if (isset($_POST['ins'])) {
	$produto_nome = $_POST['name'];
	$categoria = $_POST['categoria'];
	$descricao = $_POST['descricao'];
	$quantity = $_POST['quantity'];
	$preco = $_POST['preco'];
	$marca = $_POST['marca'];
	$image = $_FILES['photo']['name'];
	$temp_image = $_FILES['photo']['tmp_name'];

	if ($categoria == "all") {
		echo "<script> alert('select category'); setTimeout(function(){ window.location.href = 'inventory.php'; }, 100); </script>";
		exit();
	}

	move_uploaded_file($temp_image, "product_images/$image");

	$query = "insert into `produtos`(produto_nome, categoria, descricao, preco, qtdavali, img, marca) values ('$produto_nome', '$categoria', '$descricao', '$preco', '$quantity', '$image', '$marca')";

	$result = mysqli_query($con, $query);

	if ($result) {
		echo "<script> alert('Produto inserido com sucesso') </script>";
	}
}

if (isset($_GET['id_produto'])) {

	$id = $_GET['id_produto'];
	$query = "DELETE FROM produtos WHERE id_produto = '$id'";

	mysqli_query($con, $query);

}

if (isset($_POST['submitt'])) {
	$produto_nome = $_POST['name1'];
	$categoria = $_POST['categoria1'];
	$descricao = $_POST['descricao1'];
	$quantity = $_POST['quantity1'];
	$preco = $_POST['preco1'];
	$marca = $_POST['marca1'];
	$image = $_FILES['photo1']['name'];
	$temp_image = $_FILES['photo1']['tmp_name'];
	$id_produto2 = $_POST['id_produto1'];
	$image2 = $_POST['prevphoto'];
	$prevcat = $_POST['prev'];
	if ($categoria == "all") {
		$categoria = $prevcat;
	}

	if (!empty($image))
		move_uploaded_file($temp_image, "product_images/$image");

	if (!empty($image))
		$query = "Update `produtos` set produto_nome = '$produto_nome', categoria = '$categoria', descricao = '$descricao', qtdavali = $quantity, marca ='$marca', preco1 = $preco, img ='$image' where id_produto = $id_produto2";
	else
		$query = "Update `produtos` set produto_nome = '$produto_nome', categoria = '$categoria', descricao = '$descricao', qtdavali = $quantity, marca ='$marca', preco1 = $preco, img ='$image2' where id_produto = $id_produto2";

	$result = mysqli_query($con, $query);

	if ($result) {
		echo "<script> alert('Produto atualizado com sucesso!') </script>";
	}
}

if (isset($_GET['odd'])) {
	$id_pedido = $_GET['odd'];

	$query = "UPDATE pedidos set data_entrega = CURDATE() where id_pedido = $id_pedido";

	$result = mysqli_query($con, $query);

	header("Location: inventory.php");
	exit();
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="css/inventory.css">

	<title>Controle de Estoque Encanto Manual</title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
    <div class="container1">
        <div class="form-container">
            <h2>Inserir produto</h2>
            <form id="insert-form" action="inventory.php" enctype="multipart/form-data" method="post">
                <label for="name">Nome do produto:</label>
                <input type="text" id="name" name="name" required>
                <label for="category">Categoria:</label>
                <select id="category-filter" name="categoria" required>
                    <option value="Decoração">Decoração</option>
                    <option value="Acessório">Acessórios</option>
                </select>
                <label for="description">Descrição</label>
                <input type="text" id="description" name="descricao" required>
                <label for="preco">Preço:</label>
                <input type="number" id="preco" name="preco" required min='0'>
                <label for="quantity">Quantidade:</label>
                <input type="number" id="quantity" name="quantity" required min='0'>
                <label for="image">Imagem:</label>
                <input type="file" name="photo" id="fileInput" required>
                <label for="marca">Marca:</label>
                <input type="text" id="marca" name="marca" required>
                <button name="ins" type="submit" class="insert-btn">Salvar</button>
            </form>
        </div>
        <div class="search-container">
            <h2>Buscar produto</h2>
            <form id="search-form" action="inventory.php" method="post">
                <label for="search">Procure:</label>
                <input type="text" id="search" name="search">
                <label for="category-filter">Categoria:</label>
                <select id="category-filter" name="cat">
					<!-- <option value="...">Selecione uma categoria</option> -->
                    <option value="all">Todos</option>
                    <option value="Decoração">Decoração</option>
                    <option value="Acessório">Acessórios</option>
                </select>
                <button type="submit" id="search-btn" name="search1">Buscar</button>
            </form>
            <div class="inventory-container">
                <div id="product-list">

                    <?php
					if (isset($_GET['id_produtod'])) {
						$id = $_GET['id_produtod'];
						$query = "select * FROM produtos WHERE id_produto = $id";

						$result = mysqli_query($con, $query);
						$row = mysqli_fetch_assoc($result);
						$id_produto = $row['id_produto'];
						$produto_nome = $row['produto_nome'];
						$desc = $row['descricao'];
						$qtd = $row['qtdavali'];
						$preco = $row['preco'];
						$cat = $row['categoria'];
						$img = $row['img'];
						$marca = $row['marca'];
						echo "<form id='insert-form' action='inventory.php' enctype='multipart/form-data' method='post'>
									<input type='number' style='display: none;' name='id_produto1' value=$id_produto>
									<input type='text' style='display: none;' name='prevphoto' value=$img>
									<input type='text' style='display: none;' name='prev' value=$cat>
									<label for='name'>Nome do produto:</label>
									<input type='text' id='name' name='name1' value='$produto_nome' required>
									<label for='category'>Categoria:</label>
									<select id='category-filter' name='categoria1'>
										<<option value='Todos'>Todos</option>
                                        <option value='Decoração'>Decoração</option>
                                        <option value='Acessório'>Acessórios</option>
									</select>
									<label for='description' >Descrição:</label>
									<input type='text' id='descricao' name='descricao1' value='$desc' required>
									<label for='preco'>Preço:</label>
									<input type='number' id='preco' name='preco' value=$preco required min='0'>
									<label for='quantity'>Quantidade:</label>
									<input type='number' id='quantity' name='quantity1' value=$qtd required min='0'>
									<label for='image'>Imagem:</label>
									<input type='file' name='photo1' id='fileInput'>
									<label for='marca'>Marca:</label>
									<input type='text' id='marca' name='marca1' value='$marca' required>
									<button name='submitt' type='submitt' class='insert-btn'>Salvar</button>
								</form >";
					}
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
							echo "
										<table>
										<thead>
											<tr>
												<th>Nome do produto</th>
												<th>Descrição</th>
												<th>Categoria</th>
												<th>Preço</th>
												<th>Quantidade</th>
												<th>Imagem</th>
												<th>Marca</th>
												<th>Apagar</th>
												<th>Atualizar</th>
											</tr>
										</thead>
										<tbody>";
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

							echo 
									"<tr>
										<td>$produto_nome</td>
										<td style='max-width: 300px; max-height: 100px; overflow-x: auto; overflow-y: auto;'>$desc</td>
										<td>$cat</td>
										<td>$preco</td>
										<td>$qtd</td>
										<td><img src='product_images/$img' alt='' /></td>
										<td>$marca</td>
									
										<td><a href ='inventory.php?id_produto=$id_produto' class='insert-btn'>Apagar</button></td>
										<td><a href ='inventory.php?id_produtod=$id_produto' class='insert-btn'>Atualizar</button></td>

									</tr>";
						}

						if ($result) {
							echo 
								"</tbody>
								</table>";
						}
					}
					?>


                </div>
            </div>

        </div>
    </div>



    <div class="container11">
        <div class="order-container">

            <h1>Lista de pedidos</h1>
            <div class="btns">
                <a href='inventory.php?a=1'><button id="all-btn">Todos</button></a>
                <a href='inventory.php?d=1'><button id="delivered-btn">Entregue</button></a>
                <a href='inventory.php?u=1'><button id="undelivered-btn">Não entregue</button></a>

            </div>


            <table id="tab1" style="width: auto; margin: 0 auto;">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>ID do Pedido</th>
                        <th>Data do Pedido</th>
                        <th>Data de Entrega</th>
                        <th>Preço Pago</th>
                        <th>Endereço</th>
                        <th>Definir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
					if (isset($_GET['d'])) {
						include("include/connect.php");
						$query = "SELECT * FROM pedidos join contas on pedidos.id_conta = contas.id_conta where data_entrega is not NULL";


						$result = mysqli_query($con, $query);

						while ($row = mysqli_fetch_assoc($result)) {
							$aname = $row['username'];
							$id_pedido = $row['id_pedido'];
							$data_pedido = $row['data_pedido'];
							$data_entrega = $row['data_entrega'];
							$end = $row['endereco'];
                            $pri = $row['total'];

							if (empty($data_entrega))
								$data_entrega = "Não entregue";
							echo "
										

										<tr>
										<td>$aname</td>
										<td>$id_pedido</td>
												<td>$data_pedido</td>
												<td>$data_entrega</td>
										<td>$pri</td>
										<td>$end</td>";

							if ($data_entrega == "Não entregue")
								echo "<td><a href='inventory.php?odd=$id_pedido'><button id='oupdate-btn'>ENTREGUE</button></a></td>";


							echo "</tr>";
						}
					} elseif (isset($_GET['u'])) {
						include("include/connect.php");
						$query = "SELECT * FROM pedidos join contas on pedidos.id_conta = contas.id_conta where data_entrega is NULL";


						$result = mysqli_query($con, $query);

						while ($row = mysqli_fetch_assoc($result)) {
							$aname = $row['username'];
							$id_pedido = $row['id_pedido'];
							$data_pedido = $row['data_pedido'];
							$data_entrega = $row['data_entrega'];
							$end = $row['endereco'];
                            $pri = $row['total'];

							if (empty($data_entrega))
								$data_entrega = "Não entregue";
							echo "
										

										<tr>
										<td>$aname</td>
										<td>$id_pedido</td>
												<td>$data_pedido</td>
												<td>$data_entrega</td>
										<td>$pri</td>
										<td>$end</td>";

							if ($data_entrega == "Não entregue")
								echo "<td><a href='inventory.php?odd=$id_pedido'><button id='oupdate-btn'>ENTREGUE</button></a></td>";


							echo "</tr>";
						}
					} elseif (isset($_GET['a'])) {
						include("include/connect.php");
						$query = "SELECT * FROM pedidos join contas on pedidos.id_conta = contas.id_conta";


						$result = mysqli_query($con, $query);

						while ($row = mysqli_fetch_assoc($result)) {
							$aname = $row['username'];
							$id_pedido = $row['id_pedido'];
							$data_pedido = $row['data_pedido'];
							$data_entrega = $row['data_entrega'];
							$end = $row['endereco'];
                            $pri = $row['total'];

							if (empty($data_entrega))
								$data_entrega = "Não entregue";
							echo "
										

										<tr>
										<td>$aname</td>
										<td>$id_pedido</td>
												<td>$data_pedido</td>
												<td>$data_entrega</td>
										<td>$pri</td>
										<td>$end</td>";

							if ($data_entrega == "Não entregue")
								echo "<td><a href='inventory.php?odd=$id_pedido'><button id='oupdate-btn'>SET</button></a></td>";


							echo "</tr>";
						}
					} else {

						include("include/connect.php");
						$query = "SELECT * FROM pedidos join contas on pedidos.id_conta = contas.id_conta";


						$result = mysqli_query($con, $query);

						while ($row = mysqli_fetch_assoc($result)) {
							$aname = $row['username'];
							$id_pedido = $row['id_pedido'];
							$data_pedido = $row['data_pedido'];
							$data_entrega = $row['data_entrega'];
							$end = $row['endereco'];
                            $pri = $row['total'];


							if (empty($data_entrega))
								$data_entrega = "Não entregue";
							echo "
										

										<tr>
										<td>$aname</td>
										<td>$id_pedido</td>
												<td>$data_pedido</td>
												<td>$data_entrega</td>
										<td>$pri</td>
										<td>$end</td>";

							if ($data_entrega == "Não entregue")
								echo "<td><a href='inventory.php?odd=$id_pedido'><button id='oupdate-btn'>ENTREGUE</button></a></td>";


							echo "</tr>";
						}

					}



					?>

                </tbody>
            </table>


        </div>
    </div>
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