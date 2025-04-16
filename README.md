<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## 🛍️ E-pedidos Delivery
Este projeto, criado sem fins comerciais, tem como principal objetivo colocar em prática minhas habilidades em diferentes cenários da programação, tanto no front-end quanto no back-end. Iniciei minha carreira em 2018, e desde então venho estudando e explorando continuamente comandos, bibliotecas e componentes que tornam meus projetos mais robustos, funcionais e visualmente atrativos. Ao longo dessa jornada, cada projeto e estudo me permitiu construir uma base sólida que me permite enfrentar e solucionar desafios técnicos com eficiência, sempre buscando as melhores práticas de desenvolvimento.

## 🚀 Tecnologias Utilizadas no projeto

Front-end:
- HTML
- CSS
- JavaScript
- Jquery
- Bootstrap
- Ajax
- Jquery Toast Plugin

Back-end:
- PHP
- Laravel
- MySql
- ACL (Controle de Acesso)
- Livewire
- Laravel Charts
- MailTrap (Simulação de envio de e-mails)

## ✨ Principais Funcionalidades

- Login com autenticação
- Recuperação de senha com envio de e-mail
- Validação de formulários
- Listagem e edição de dados
- Busca em tempo real de pedidos via Id ou nome do cliente
- Gerenciamento de pedidos em tempo real
- Alertas de baixo estoque, item desativado, delivery desligado
- Dashboard com comparativo de vendas ao longo dos meses
- Filtragem de vendas por mês
- Informações de itens mais vendidos
- Informações de bairros com mais vendas
- Comparativo de venda de hoje com as vendas de ontem
- Filtragem de endereço via API de Cep
- Realização de um novo pedido
- Acompanhamento de pedidos em tempo real (cliente)
- Verificação dos pedidos anteriores (Cliente)
- Escolha de quais adicionais podem ser postos em quais produtos
- Ativação/Desativação de produtos e bairros
- Ativação/Desativação do delivery
- Aplicação de cupons
- Notificações sobre problemas em estoque, delivery, bairros e produtos
- Escolha de motoboy para realizar cada entrega

Gerenciamento total (CRUD) de:

- Cupons
- Bairros
- Usuários
- Produtos, Adicionais para Produtos

## 🛠️ Como rodar o projeto

1. Tenha em sua máquina um ambiente que faça a emulação de um servidor, como Xampp ou Docker instalado e parametrizado.
2. Clone o repositório:
```bash
git clone git@github.com:gabrieltec97/portfolio-delivery.git
```
3. Copie o arquivo .env.example para .env e configure as variáveis do banco de dados e do servidor de e-mails (MailTrap ou seu servidor).
4. Instale as dependências com o Composer:
```bash
composer install
```
5. Rode as migrations e seeders necessárias para dar a configuração inicial para o sistema executar corretamente.
```bash
php (ou sail) artisan migrate --seed
```
7. Inicie o servidor.
```bash
php artisan serve
```
8. Pronto! Agora é só acessar http://localhost:8000

## 📸 Screenshots

<h4>Dashboard com informativo de vendas sobre os meses (Outras informações ao rolar a página no sistema).</h4>

![Dashboard](assets/dashboard.png)

<h4>Gestão de pedidos em tempo real.</h4>

![TempoReal](assets/realtime.png)

<h4>Gestão de Produtos.</h4>

![Produtos](assets/produtos.png)

<h4>Cadastro de Bairro.</h4>

![Bairro](assets/produtos.png)

<h4>Acompanhamento de Pedido (Visão do Cliente).</h4>

![Cliente](assets/cliente-acompanhamento.png)

<h4>Histórico de Pedidos (Visão do Cliente).</h4>

![ClienteHistorico](assets/meus-pedidos.png)
