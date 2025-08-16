# CRUD de Usuários em PHP com Foco em Segurança

> Um projeto de exemplo para demonstrar um sistema completo de CRUD (Create, Read, Update, Delete) de usuários, utilizando PHP Orientado a Objetos, MySQL, e Bootstrap.

O sistema possui um forte foco em segurança, implementando práticas essenciais para proteger a aplicação e os dados dos usuários. A aplicação também conta com uma funcionalidade de filtragem de registros e utiliza UUIDv4 para identificadores únicos.

## 📸 Screenshots

<p align="center">
  <em>Tela Principal de Listagem de Usuários</em>
  <br>
  <img [![imagem-2025-08-16-174903785.png](https://i.postimg.cc/sxqKzqbZ/imagem-2025-08-16-174903785.png)](https://postimg.cc/bS01HCyz) />
</p>

<p align="center">
  <em>Formulário de Cadastro e Edição</em>
  <br>
  <img src="URL_DA_SUA_IMAGEM_AQUI.png" alt="Formulário de Cadastro" width="700"/>
</p>

## ✨ Funcionalidades Principais

* **CRUD Completo:** Crie, leia, atualize e exclua registros de usuários de forma intuitiva.
* **Foco em Segurança:**
    * **Prepared Statements:** Proteção robusta contra ataques de SQL Injection.
    * **Sanitização de Saídas:** Prevenção contra ataques de Cross-Site Scripting (XSS).
    * **Criptografia de Senhas:** Utilização do `password_hash` do PHP para armazenar senhas de forma segura.
* **Filtro de Registros:** Busque e filtre usuários por nome ou e-mail.
* **Identificadores Únicos:** Uso de UUIDv4 para as chaves primárias, evitando a exposição de IDs sequenciais.

## 🛠️ Tecnologias Utilizadas

* **PHP 8+**
* **Composer** (Gerenciador de dependências)
* **MySQL / MariaDB** (Banco de dados)
* **Bootstrap 5** (Para o front-end)

## 🚀 Começando

Siga estas instruções para obter uma cópia do projeto em funcionamento na sua máquina local para desenvolvimento e testes.

### Pré-requisitos

Antes de começar, você precisará ter as seguintes ferramentas instaladas em seu ambiente:

* **PHP** (versão 8.0 ou superior)
* **Composer**
* Um **servidor de banco de dados** (MySQL, MariaDB, etc.)
* **Git**

### ⚙️ Instalação

Siga o passo a passo abaixo:

1.  **Clone o repositório:**
    ```bash
    git clone [https://github.com/nicolas-mendes/CRUD_PHP.git](https://github.com/nicolas-mendes/CRUD_PHP.git)
    ```

2.  **Navegue até o diretório do projeto:**
    ```bash
    cd CRUD_PHP
    ```

3.  **Instale as dependências com o Composer:**
    Este comando irá baixar e instalar todas as bibliotecas PHP necessárias.
    ```bash
    composer install
    ```

4.  **Configure o Banco de Dados:**

    * Primeiro, crie um novo banco de dados no seu servidor MySQL/MariaDB com o nome `cadastrousuarios`.

    * Em seguida, execute o seguinte script SQL para criar a tabela `usuario` com a estrutura necessária:

    ```sql
    CREATE TABLE `usuario` (
      `id` varchar(40) NOT NULL,
      `nome` varchar(50) NOT NULL,
      `email` varchar(255) NOT NULL,
      `senha` varchar(255) NOT NULL,
      `nasc` date NOT NULL,
      PRIMARY KEY (`id`),
      UNIQUE KEY `email` (`email`)
    );
    ```

## ▶️ Uso

1.  Inicie seu servidor web local (Apache, XAMPP, WAMP, etc.).
2.  Coloque a pasta do projeto no diretório raiz do seu servidor (como `htdocs` ou `www`).
3.  Acesse o projeto através do seu navegador (ex: `http://localhost/CRUD_PHP`).

