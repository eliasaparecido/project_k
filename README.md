# project_k

Descrição do Projeto

Backend feito em PHP sem framework, eu criei o meu framework MVC somente para organizar os arquivos,

o backend disponibliza url para que possa ser feito o CRUD.

Cadastro de Users

list get in /users

create post in /users/create

edit get in /users/edit?id={id}

update post in /users/update?id={id}

delete get in /users/delete?id={id}

Cadastro de Cliente

list get in /clients

create post in /clients/create

edit get in /clients/edit?id={id}

update post in /clients/update?id={id}

delete get in /clients/delete?id={id}

Cadastro de Endereços Clientes

list get in /clients/address

create post in /clients/address/create

delete get in /clients/adress/delete?id={id}

Frontend feito em VueJS com requisições em axios no endpoint.

#Backend

Requer 
PHP
Composer

Na pasta Backend

Rodar composer install

entrar na pasta public e rodar o comando php -S localhost:8888

#Frontend

Requer 
Node

tem o arquivo da api para setar a url em frontend/src/router/api.js
esse url caso o backend esteja rodando em uma url diferente.

Na pasta frontend rodar o compando 

npm install

npm run dev

Requisitos solicitados:

1 - Uma área administrativa onde o(s) usuário(s) devem acessar através de login e senha.

Esse requisito eu não tive tempo hábil para terminar, eu fiz o cadastro de cliente mas não fiz o login.
Eu iria criar o login com jwt, mas preferi entregar assim do que entregar o login sem funcionar.

2 - Criar um gerenciador de clientes (Listar, Incluir, Editar e Excluir)

    2.1 - O cadastro do Cliente deve conter: Nome; Data Nascimento;CPF; RG; Telefone.
    2.2 - O Cliente pode ter 1 ou N endereços.

Esse requisito foi realizado e está em funcionamento. Está também com o cadastro de usuário



