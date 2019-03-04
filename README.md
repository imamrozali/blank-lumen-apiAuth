> **blank-lumen-apiAuth**, licencia [MIT](https://github.com/rogerforner/blank-lumen-apiAuth/blob/master/LICENCE.md).

---

- [1. Info](#1-info)
- [2. Instalación](#2-instalación)
  - [2.1. Configuración](#21-configuración)

---


# 1. Info

> API realizada con el framework de _PHP_ **Lumen** (Laravel).

```bash
> lumen new nombreProyecto
```

La intención de este repositorio es la de ahorrarnos tiempo cada vez que queramos iniciar un proyecto **API** que requiera de autenticación de usuarios.


# 2. Instalación

```bash
> git clone https://github.com/rogerforner/blank-lumen-apiAuth.git nombreProyecto
> php composer install
> cp .env.example .env
```

# 2.1. Configuración

```bash
> cp .env.example .env
> php artisan key:generate
```

Insertamos todos los datos necesarios del archivo _.env_.

**Sin SQLite**

```bash
> php artisan migrate
```

**Con SQLite**

```bash
> touch database\database.sqlite
> php artisan migrate
```