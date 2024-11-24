===============================================================================================================
Introdução
O projeto que propomos é um site de e-commerce que venda itens feito a mão para entusiastas e usuários comuns. O site oferece uma ampla variedade de produtos, incluindo itens decorativos e acessórios de nossa marca. Estamos desenvolvendo um site fácil de usar e garantindo que a experiência do cliente seja de alta qualidade.
===============================================================================================================
===============================================================================================================
Objetivos
O objetivo do nosso projeto é criar uma plataforma online bem-sucedida para a venda de itens feitos à mão da marca Encanto Manual, oferecendo aos entusiastas de produtos artesanais uma experiência de compra conveniente e encantadora. Pretendemos oferecer os melhores preços para os produtos artesanais de mais alta qualidade disponíveis no mercado, priorizando a experiência do cliente e o fácil acesso a produtos únicos e feitos com dedicação. Além disso, buscamos proporcionar uma comunicação prática e transparente entre o comprador e o artesão.
===============================================================================================================

Funcionalidades
1. Gerenciamento de Conta (Clientes/Admin)
Os clientes podem criar, excluir e atualizar suas contas para acompanhar suas compras e fazer pedidos como cliente, ou adicionar produtos como administrador.

2. Catálogo de Produtos
Um módulo que permite aos usuários navegar e pesquisar uma lista de peças de computador disponíveis, como processadores, placas-mãe, placas de vídeo, entre outros. O catálogo deve permitir que os usuários filtrem por tipo de produto e pesquisem por nome, descrição ou marca.

3. Detalhes do Produto
Um módulo que fornece informações detalhadas sobre cada produto, incluindo especificações, características, imagens e avaliações de outros clientes, além da opção de adicionar o item ao carrinho para compra.

4. Carrinho de Compras
Um módulo que permite aos usuários adicionar produtos ao carrinho e revisar suas escolhas antes de finalizar a compra. Esse módulo deve exibir o custo total do pedido, incluindo impostos e taxas de envio aplicáveis.

5. Finalização de Compra
Um módulo que guia os usuários no processo de finalização da compra, incluindo o preenchimento de informações de cobrança e entrega, escolha do método de pagamento e revisão final do pedido antes de enviá-lo.

6. Envio e Entrega
Um sistema de envio e entrega que permite aos clientes escolher o método de envio preferido e acompanhar o status de seus pedidos.

7. Avaliações e Classificações
Um módulo que permite aos usuários avaliar e comentar sobre os produtos adquiridos, além de ler avaliações de outros clientes. Esse módulo ajuda os usuários a tomarem decisões de compra mais informadas com base nas experiências de outras pessoas.

8. Gerenciamento de Pedidos
Um módulo que permite aos administradores do site gerenciar os pedidos e acompanhar seu status, incluindo revisar novos pedidos, atualizar o status e gerenciar o envio e o atendimento dos pedidos.

9. Gerenciamento de Estoque
Um módulo que ajuda os administradores do site a acompanhar os níveis de estoque e a disponibilidade dos produtos.

10. Lista de Desejos
Um módulo que permite aos usuários criar uma lista de produtos de interesse, mas que ainda não estão prontos para comprar. Esse módulo deve permitir que os usuários salvem itens para referência futura.




# Dependências Funcionais:
id_conta-> (id_conta, nome, sobrenome, contato, email, cpf, data_nasc, username, password, genero) 
id_produto-> (id_produto, produto_nome, categoria, descricao, preco, qtdavali, img, marca) 
id_pedido-> (id_pedido, data_pedido, data_entrega, endereco, cidade, estado, num_cartao,total) 
id_pedido, id_produto-> (cqtd, qtd, texto_avalia, rating) 

id_conta -> CONTA ID
id_produto -> PRODUTO ID
id_pedido -> PEDIDO ID 


# Tabelas
1-Contas

ID_CONTA	Nome	Sobrenone	Contato	 Email	Cpf	 Data_nasc	Username	Password	Genero


2-Produtos

ID_PRODUTO	Produtonome	Categoria	Descricao	Preco	QuantidadeDisponivel	Img	Marca

3-Pedidos

ID_PEDIDO	DataDoPedido	DataEntregue	ID_Conta	Endereco  Cidade    País	NúmeroDeCartão	Total


4-Detalhes_Pedidos

Detal_pedidos	Id_Pedido	Quantidade


5-Carrinho

ID_Conta    ID_Produto	Carrinho_Quantidade


6-Reviews

ID_Pedido   ID_Produto  Texto_Avaliacao     Rating


7-Wishlist

ID_Conta    ID_Produto



               
