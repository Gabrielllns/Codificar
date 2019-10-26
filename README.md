# Codificar

Para o desenvolvimento desse projeto foi utilizado o Laravel em sua versão 5.8 (PHP > 7).

<h3>Instalação</h3>

É necessário que o Composer esteja instalado.

Após a instalação do Composer, clone o projeto e execute o comando:

<code>composer install</code>

Depois da instação concluída abra o terminal dentro da pasta do projeto, execute o comando:

<code>php -S localhost:80 -t ./public</code>

Para o banco de dados foi utilizado o MySQL, as demais configurações do banco se encontram no arquivo:

<code>.env</code> e/ou  <code>.env.example</code>

Após a criação do banco de dados <b>bd_codificar_api</b>, digite no terminal o comando para que as tabelas sejam criadas:

<code>php artisan migrate</code>

Caso todas as tabelas tenham sido criadas, devemos carregar essas tabelas com as informações presentes na API pública,
foi criado uma documentação básida das rotas disponíveis nessa api, a mesma se encontra disponivel no link abaixo.

<code>https://documenter.getpostman.com/view/2000718/SVzxa1Lm?version=latest#dbead6e6-e06a-4788-b4eb-b9d6cbce8039</code>

Caso estejam utilizando o Windows e tenham o POSTMAN instalado, basta clicar no botão "Run in Postman" no cando superior
direito e em seguida executarem com a opção para o Windows, desta forma todas as rotas mapeadas serão importadas para o
mesmo facilitando assim os testes.

Att. Gabriel Neres da Silva
