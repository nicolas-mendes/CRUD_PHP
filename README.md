CRUD de Usuários em PHP
Um projeto de exemplo para demonstrar um sistema completo de CRUD (Create, Read, Update, Delete) de usuários, Utilizando PHP Orientado a Objetos, MySQL, e Bootstrap (HTML/CSS).
o sistema possui um forte foco em segurança. As proteções incluem prepared statements contra SQL Injection, sanitização de saídas para prevenir ataques XSS, e criptografia de senhas com hashing (password_hash).
A aplicação também conta com uma funcionalidade de filtragem de registros e utiliza UUIDv4 para identificadores únicos e seguros.

🛠️ Tecnologias Utilizadas
PHP 8+
Composer (Gerenciador de dependências)
MySQL / MariaDB (Banco de dados)
Bootstrap 5 (Para o front-end - opcional, mas comum)

🚀 Começando
Siga estas instruções para obter uma cópia do projeto em funcionamento na sua máquina local para desenvolvimento e testes.

Pré-requisitos
Antes de começar, você precisará ter as seguintes ferramentas instaladas em seu ambiente:

PHP (versão 8.0 ou superior)

Composer

Um servidor de banco de dados (MySQL, MariaDB, etc.)

Git


⚙️ Instalação
Siga o passo a passo abaixo:

Clone o repositório:
  
  ====Bash====  
  git clone https://github.com/nicolas-mendes/CRUD_PHP.git
  ============
  
Navegue até o diretório do projeto:
  
  ====Bash==== 
  cd CRUD_PHP
  ============
  
Instale as dependências com o Composer:
  Este comando irá baixar e instalar todas as bibliotecas PHP necessárias para o projeto.
  
  ====Bash====
  composer install
  ============
  
Configure o Banco de Dados:
  
  Crie um novo banco de dados no seu servidor MySQL/MariaDB com o nome:
  
  ====SQL====
  cadastrousuarios
  ===========
  
  Execute o seguinte script SQL para criar a tabela usuario com a estrutura necessária:
  
  ====SQL===
  CREATE TABLE `usuario` (
    `id` varchar(40) NOT NULL,
    `nome` varchar(50) NOT NULL,
    `email` varchar(255) NOT NULL,
    `senha` varchar(255) NOT NULL,
    `nasc` date NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `email` (`email`)
  );
  ===========
  

▶️ Uso
Inicie seu servidor web local (Apache, Nginx, etc.).
Acesse o projeto através do seu navegador (ex: http://localhost/CRUD_PHP).
