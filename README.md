# Codificar

Para o desenvolvimento desse projeto foi utilizado o Laravel em sua versão 5.8 (PHP > 7).

Meu objetivo para este projeto, foi fazer as importações e associações de forma mais prática possível, por esse motivo decidi separar as inmportações de dados, inicialmente são carregados os deputados ativos (que estão em exercício), e através desses a aplicação complementa seus dados com algumas informações que achei relevante e os persiste na base local, caso algum erro aconteça toda a operação é desfeita, se a operação for concluída com sucesso, podemos verificar quais as redes sociais mais utilizadas por esse deputados.

Para a listagem dos reembolsos de verbas, decidi separar da parte de'importação' dos 'dados dos deputados', pois pude verificar que a quantidade de informações em alguns casos poderia ser bem extensa causando uma perda de desempenho da aplicação, após a importação dos deputados, a rota de importação dos reembolsos pode ser acessada, caso ocorra algum erro, toda a operação de importação de reembolsos é desfeita, se todos os dados forem importados, podemos ter acesso aos deputados que mais solicitaram reembolsos para o mês informado dentro do ano de 2019.

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

Caso todas as tabelas tenham sido criadas, devemos carregar essas tabelas com as informações presentes na API pública, foi criado uma documentação básida das rotas disponíveis nessa api, a mesma se encontra disponivel no link abaixo.

<code>https://documenter.getpostman.com/view/2000718/SVzxa1Lm?version=latest#dbead6e6-e06a-4788-b4eb-b9d6cbce8039</code>

Caso estejam utilizando o Windows e tenham o <b>POSTMAN</b> instalado, basta clicar no botão <b>"Run in Postman"</b> no canto superior direito e em seguida executarem com a opção para Windows, desta forma todas as rotas mapeadas serão importadas para o
mesmo facilitando assim os testes.

Att. Gabriel Neres da Silva
