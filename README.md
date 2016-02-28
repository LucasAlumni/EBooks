# EBooks

EBooks est un site de e-commerce de livres.

### Creation de la Base de Donnee

```sh
$ app/console doctrine:database:create
$ app/console doctrine:schema:update --force
```

### Installation

```sh
$ composer install
```

### Charger les Produits et les TVA

```sh
$ app/console doctrine:fixtures:load 
```
