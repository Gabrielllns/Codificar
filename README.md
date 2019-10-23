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
