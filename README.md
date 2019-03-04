> **blank-lumen-apiAuth**, licencia [MIT](https://github.com/rogerforner/blank-lumen-apiAuth/blob/master/LICENCE.md).

---

- [1. Info](#1-info)
- [2. Instalación](#2-instalación)
  - [2.1. Configuración](#21-configuración)
  - [2.2. Servidor de desarrollo](#22-servidor-de-desarrollo)

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

Insertamos todos los datos necesarios del archivo _.env_ y después [ejecutamos las migraciones](https://laravel.com/docs/5.8/migrations#running-migrations).

**Sin SQLite**

```bash
> php artisan migrate
```

**Con SQLite**

```bash
> touch database\database.sqlite
> php artisan migrate
```

# 2.2. Servidor de desarrollo

```bash
> php -S localhost:8000 -t public
```

# Bibliografía

PACKAGIST (flipbox/lumen-generator). _A Lumen Generator You Are Missing_. < [https://packagist.org/packages/flipbox/lumen-generator](https://packagist.org/packages/flipbox/lumen-generator) >
<br>[Última consulta: 4 de marzo de 2019]

LUMEN. _The stunningly fast micro-framework by Laravel_. < [https://lumen.laravel.com/](https://lumen.laravel.com/) >
<br>[Última consulta: 4 de marzo de 2019]