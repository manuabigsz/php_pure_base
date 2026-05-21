# PHP Base Project

Este projeto é um exemplo de API REST em PHP puro, com roteamento robusto, versionamento e suporte a middlewares.

## Funcionalidades

- **Roteador customizado:**
  - Agrupamento de rotas (route groups)
  - Prefixos e versionamento (ex: `/api/v1`)
  - Middlewares encadeados
  - Fácil expansão
- **Conexão com banco PostgreSQL**
- **Migrations simples**


## Estrutura de Rotas

As rotas são definidas em `src/Routes/web.php` usando a classe `Router`.

Exemplo de rota:

```php
$router->add('GET', '/api/v1/exemplo', function() {
    echo json_encode(['msg' => 'Nova rota']);
});
```

## Como funciona o roteamento

1. O arquivo `public/index.php` carrega o autoloader, configura o ambiente e instancia o roteador.
2. O roteador lê o método HTTP e o caminho da URL, despachando para o handler correto.
3. Todos os endpoints da API ficam sob `/api/v1` (ex: `/api/v1/users`).

## Migrations

Para criar as tabelas do banco, rode:

```bash
composer migrate
```

Ou:

```bash
php database/migrate.php
```


## Como adicionar uma nova rota

No arquivo `src/Routes/web.php`, basta adicionar:

```php
$router->add('GET', '/api/v1/exemplo', function() {
    echo json_encode(['msg' => 'Nova rota']);
});
```

## Estrutura do Projeto

- `public/index.php` — Entrypoint da aplicação
- `src/Core/Router.php` — Classe do roteador
- `src/Routes/web.php` — Definição das rotas
- `src/Core/Database.php` — Conexão com o banco
- `database/migrate.php` — Runner de migrations
- `database/migrations/` — Arquivos de migration

---

Sinta-se à vontade para expandir o roteador, adicionar middlewares ou criar novas versões da API!
