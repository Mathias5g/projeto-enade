v<h1 align="center">👨‍💻 Projeto ENADE / Projeto Interdisciplinar III 👨‍💻</h1>

## Contexto

Bem-vindo(a). Este é o Projeto ENADE!

O objetivo do projeto é facilitar a consulta de questões de concursos com foco principal em questões do ENADE

O desafio será implementar um sistema para inclusão e consulta de questões que deverá ter as seguintes funcionalidades:
- [ ] Questões
  - [x] Cadastro
  - [x] Listagem
  - [ ] Atualização
  - [ ] Exclusão
  - [x] Filtro

- [ ] Concursos
    - [x] Cadastro
    - [x] Listagem
    - [x] Atualização
    - [ ] Exclusão
    - [x] Filtro

- [ ] Disciplinas
    - [x] Cadastro
    - [x] Listagem
    - [x] Atualização
    - [ ] Exclusão
    - [x] Filtro

- [ ] Cursos
    - [x] Cadastro
    - [x] Listagem
    - [x] Atualização
    - [ ] Exclusão
    - [x] Filtro
    
- [ ] Relatorios com base em filtro

##Resultado

- ### Requisitos
Ter instalado as seguintes ferramentas
    - [Composer](https://getcomposer.org/download/)
    - [Node.js](https://nodejs.org/en/download/)
    - [Yarn](https://classic.yarnpkg.com/lang/en/docs/install/#windows-stable)
    - [Git](https://git-scm.com/downloads)

##  Instalação

1. Clone o projeto
```shell
    git clone https://github.com/Mathias5g/projeto-enade
```

2. Baixa os pacotes composer
```shell
    composer install
```

3. Baixe os pacotes npm
```shell
    yarn install 
```

## Como rodar
1. Primeiro deverá alterar ``.env.example`` na raiz do projeto para ``.env``, alterar as linhas a seguir para o seu
ambiente de banco de dados
```dotenv
DB_DATABASE=projeto_enade
DB_USERNAME=root
DB_PASSWORD=root
```

2. Rodar a migration para gerar as tebelas utilziando o seguinte comando
```shell
php artisan migrate
```

3. Rodar o servidor localmente utilizando o seguinte comando
```shell
php artisan serve
```

4. Acessar o servidor na url ``http://localhost:8000/register`` e criar uma conta 
para utilizar o sistema


## Bibliotecas utilizadas
Algumas bibliotecas foram utilizadas a fim de aprimorar a performance e usabilidade, todas elas estão listadas abaixo:
```json
{
    "laravel/framework": "^8.65",
    "laravel/framework": "^8.65"
    "@inertiajs/inertia": "^0.10.0",
    "@inertiajs/inertia-vue3": "^0.5.1",
    "moment": "^2.29.1",
    "tailwindcss": "^2.0.1",
    "vue": "^3.0.5"
}
```
Lista completa em ``composer.json`` e ``package.json``

<p align="center">👨‍💻 Never Stop Learning 👨‍💻</p>
