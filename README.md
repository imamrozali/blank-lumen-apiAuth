> **blank-lumen-apiAuth**, licencia [MIT](https://github.com/rogerforner/blank-lumen-apiAuth/blob/master/LICENCE.md).

---

- [1. Info](#1-info)
- [2. Instalación](#2-instalación)
  - [2.1. Configuración](#21-configuración)
  - [2.2. Servidor de desarrollo](#22-servidor-de-desarrollo)
- [3. API Routes](#3-api-routes)
- [4. Emails](#4-emails)
  - [4.1. auth/verify](#41-authverify)
  - [4.2. auth/psw-reset](#42-authpsw-reset)
  - [4.3. auth/verify-email](#43-authverify-email)
- [Bibliografía](#bibliografía)

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

## 2.1. Configuración

```bash
> cp .env.example .env
> php artisan key:generate
```

Insertamos todos los datos necesarios del archivo _.env_ y seguimos.

**Migraciones**

Sin SQLite:

```bash
> php artisan migrate
```

Con SQLite:

```bash
> touch database\database.sqlite
> php artisan migrate
```

> **Resetear migraciones** (desarrollo)<br>
>_Para resetear la base de datos y hacer pruebas sin la necesidad de borrarla y volver a crearla_.

```bash
> php artisan migrate:reset && php artisan migrate && php artisan passport:install --force
```

**Passport**

```bash
> php artisan passport:install
```


## 2.2. Servidor de desarrollo

```bash
> php -S localhost:8000 -t public
```

O también

```bash
> php artisan serve
```

# 3. API Routes

Rutas predefinidas en el proyecto, éstas relacionadas con la autenticación de los/las usuarios/rias.

```bash
> php artisan route:list

+--------+------------------------------------------+------------+--------------------------------------------------------------------+------------------+------------+
| Verb   | Path                                     | NamedRoute | Controller                                                         | Action           | Middleware |
+--------+------------------------------------------+------------+--------------------------------------------------------------------+------------------+------------+
| POST   | /oauth/token                             |            | \Dusterio\LumenPassport\Http\Controllers\AccessTokenController     | issueToken       |            |
| GET    | /oauth/tokens                            |            | \Laravel\Passport\Http\Controllers\AuthorizedAccessTokenController | forUser          | auth       |
| DELETE | /oauth/tokens/{token_id}                 |            | \Laravel\Passport\Http\Controllers\AuthorizedAccessTokenController | destroy          | auth       |
| POST   | /oauth/token/refresh                     |            | \Laravel\Passport\Http\Controllers\TransientTokenController        | refresh          | auth       |
| GET    | /oauth/clients                           |            | \Laravel\Passport\Http\Controllers\ClientController                | forUser          | auth       |
| POST   | /oauth/clients                           |            | \Laravel\Passport\Http\Controllers\ClientController                | store            | auth       |
| PUT    | /oauth/clients/{client_id}               |            | \Laravel\Passport\Http\Controllers\ClientController                | update           | auth       |
| DELETE | /oauth/clients/{client_id}               |            | \Laravel\Passport\Http\Controllers\ClientController                | destroy          | auth       |
| GET    | /oauth/scopes                            |            | \Laravel\Passport\Http\Controllers\ScopeController                 | all              | auth       |
| GET    | /oauth/personal-access-tokens            |            | \Laravel\Passport\Http\Controllers\PersonalAccessTokenController   | forUser          | auth       |
| POST   | /oauth/personal-access-tokens            |            | \Laravel\Passport\Http\Controllers\PersonalAccessTokenController   | store            | auth       |
| DELETE | /oauth/personal-access-tokens/{token_id} |            | \Laravel\Passport\Http\Controllers\PersonalAccessTokenController   | destroy          | auth       |
| GET    | /                                        |            | None                                                               | Closure          |            |
| POST   | /auth/login                              |            | App\Http\Controllers\Auth\LoginController                          | METHOD NOT FOUND |            |
| GET    | /auth/logout                             |            | App\Http\Controllers\Auth\LogoutController                         | METHOD NOT FOUND |            |
| POST   | /auth/register                           |            | App\Http\Controllers\Auth\RegisterController                       | METHOD NOT FOUND |            |
| POST   | /auth/register/unverified                |            | App\Http\Controllers\Auth\RegisterUnverifiedController             | METHOD NOT FOUND |            |
| GET    | /auth/register/verify/{token}            |            | App\Http\Controllers\Auth\RegisterVerifyController                 | METHOD NOT FOUND |            |
| POST   | /auth/password/forgotten                 |            | App\Http\Controllers\Auth\Password\PasswordForgottenController     | METHOD NOT FOUND |            |
| GET    | /auth/password/verify/{token}            |            | App\Http\Controllers\Auth\Password\PasswordVerifyController        | METHOD NOT FOUND |            |
| PUT    | /auth/password/reset                     |            | App\Http\Controllers\Auth\Password\PasswordResetController         | METHOD NOT FOUND |            |
| GET    | /auth/user                               |            | App\Http\Controllers\Auth\UserProfile\UserController               | show             |            |
| PUT    | /auth/user                               |            | App\Http\Controllers\Auth\UserProfile\UserController               | update           |            |
| DELETE | /auth/user                               |            | App\Http\Controllers\Auth\UserProfile\UserController               | destroy          |            |
| GET    | /auth/user/email                         |            | App\Http\Controllers\Auth\UserProfile\UserEmailController          | show             |            |
| PUT    | /auth/user/email                         |            | App\Http\Controllers\Auth\UserProfile\UserEmailController          | update           |            |
| GET    | /auth/user/email/two                     |            | App\Http\Controllers\Auth\UserProfile\UserEmailTwoController       | show             |            |
| PUT    | /auth/user/email/two                     |            | App\Http\Controllers\Auth\UserProfile\UserEmailTwoController       | update           |            |
| DELETE | /auth/user/email/two                     |            | App\Http\Controllers\Auth\UserProfile\UserEmailTwoController       | destroy          |            |
| GET    | /auth/user/email/verify/{token}          |            | App\Http\Controllers\Auth\UserProfile\UserEmailVerifyController    | show             |            |
| GET    | /auth/user/name                          |            | App\Http\Controllers\Auth\UserProfile\UserNameController           | show             |            |
| PUT    | /auth/user/name                          |            | App\Http\Controllers\Auth\UserProfile\UserNameController           | update           |            |
| DELETE | /auth/user/name                          |            | App\Http\Controllers\Auth\UserProfile\UserNameController           | destroy          |            |
| GET    | /auth/user/phone                         |            | App\Http\Controllers\Auth\UserProfile\UserPhoneController          | show             |            |
| PUT    | /auth/user/phone                         |            | App\Http\Controllers\Auth\UserProfile\UserPhoneController          | update           |            |
| DELETE | /auth/user/phone                         |            | App\Http\Controllers\Auth\UserProfile\UserPhoneController          | destroy          |            |
| PUT    | /auth/user/password                      |            | App\Http\Controllers\Auth\UserProfile\UserPasswordController       | METHOD NOT FOUND |            |
+--------+------------------------------------------+------------+--------------------------------------------------------------------+------------------+------------+
```

> **Info.** Los controladores con la acción `METHOD NOT FOUND` son _Single Action Controllers_ y los middlewares se aplican en el método `__construct()` de éstos.

# 4. Emails

Los correos electrónicos han sido generador con el framework MJML. El código proporcionado a continuación es el utilizado para generar los correos con dicho framework, es decir, está por compilar.

Todos los correos electrónicos se encuentran en _/resources/views/emails_.

## 4.1. auth/verify

Correo electrónico enviado a través de `Mail::to($user)->send(new VerifyAccount($user));`. Utilizado para verificar la cuenta del/la usuario/ria.

```html
<mjml>
  <mj-head>
    <mj-style inline="inline">
      .footer-links span { border-left: 1px solid #ccc; padding: 0 10px; } .footer-links span:first-child { border-left: none; padding-left: 0; } .footer-links span a { color: #6C757D !important; font-weight: bold; text-decoration: none !important; }
    </mj-style>
  </mj-head>
  <mj-body background-color="#ffffff">
    <mj-raw>
      <!-- Intro text -->
    </mj-raw>
    <mj-section>
      <mj-column>
        <mj-text align="center" font-size="28px">Confirm your account</mj-text>
        <mj-text align="center" font-size="16px" line-height="24px">Hello <strong>{{$username}}</strong>, confirm your email address to finish creating your {{env('APP_NAME')}} account. It's easy, just click the button below.</mj-text>
        <mj-button font-size="16px" background-color="#007BFF" href="{{env('APP_URL').'/auth/register/verify/'.$token}}">Confirm now</mj-button>
      </mj-column>
    </mj-section>
    <mj-raw>
      <!-- Footer -->
    </mj-raw>
    <mj-section background-color="#F8F9FA">
      <mj-column>
        <mj-text font-size="13px" line-height="20px" color="#6C757D">This message was send to {{$email}}. If you have received this email by mistake, please ignore this message.</mj-text>
        <mj-divider border-width="1px" border-style="dashed" border-color="lightgrey" padding="5px 25px" />
        <mj-text font-size="13px" line-height="20px" color="#6C757D" css-class="footer-links">
          <span><a href="#" class="link-nostyle">Privacy Policy</a></span>
          <span><a href="#" class="link-nostyle">Contact Us</a></span>
        </mj-text>
        <mj-text font-size="12px" line-height="20px" font-style="italic" color="#6C757D" css-class="footer-links">Postal address of the company</mj-text>
      </mj-column>
    </mj-section>
  </mj-body>
</mjml>
```

> Es importante tener en cuenta la URL de redirección `{{env('APP_URL').'/auth/register/verify/'.$token}}`.

## 4.2. auth/psw-reset

Correo electrónico enviado a través de `Mail::to($user)->send(new PasswordForgotten($user, $pswReset));`. Utilizado para verificar el token y poder resetear la contraseña.

```html
<mjml>
  <mj-head>
    <mj-style inline="inline">
      .footer-links span { border-left: 1px solid #ccc; padding: 0 10px; } .footer-links span:first-child { border-left: none; padding-left: 0; } .footer-links span a { color: #6C757D !important; font-weight: bold; text-decoration: none !important; }
    </mj-style>
  </mj-head>
  <mj-body background-color="#ffffff">
    <mj-raw>
      <!-- Intro text -->
    </mj-raw>
    <mj-section>
      <mj-column>
        <mj-text align="center" font-size="28px">Password reset</mj-text>
        <mj-text align="center" font-size="16px" line-height="24px">Hello <strong>{{$username}}</strong>, you recently requested to reset your password for your {{env('APP_NAME')}} account. It's easy, just click the button below.</mj-text>
        <mj-button font-size="16px" background-color="#007BFF" href="{{env('APP_URL').'/auth/password/verify/'.$token}}">Reset now</mj-button>
      </mj-column>
    </mj-section>
    <mj-raw>
      <!-- Footer -->
    </mj-raw>
    <mj-section background-color="#F8F9FA">
      <mj-column>
        <mj-text font-size="13px" line-height="20px" color="#6C757D">This message was send to {{$email}}. If you have received this email by mistake, please ignore this message.</mj-text>
        <mj-divider border-width="1px" border-style="dashed" border-color="lightgrey" padding="5px 25px" />
        <mj-text font-size="13px" line-height="20px" color="#6C757D" css-class="footer-links">
          <span><a href="#" class="link-nostyle">Privacy Policy</a></span>
          <span><a href="#" class="link-nostyle">Contact Us</a></span>
        </mj-text>
        <mj-text font-size="12px" line-height="20px" font-style="italic" color="#6C757D" css-class="footer-links">Postal address of the company</mj-text>
      </mj-column>
    </mj-section>
  </mj-body>
</mjml>
```

> Es importante tener en cuenta la URL de redirección `{{env('APP_URL').'/auth/password/verify/'.$token}}`.

## 4.3. auth/verify-email

Correo electrónico enviado a través de `Mail::to($user)->send(new PasswordForgotten($user, $pswReset));`. Utilizado para verificar el token y poder resetear la contraseña.

```html
<mjml>
  <mj-head>
    <mj-style inline="inline">
      .footer-links span { border-left: 1px solid #ccc; padding: 0 10px; } .footer-links span:first-child { border-left: none; padding-left: 0; } .footer-links span a { color: #6C757D !important; font-weight: bold; text-decoration: none !important; }
    </mj-style>
  </mj-head>
  <mj-body background-color="#ffffff">
    <mj-raw>
      <!-- Intro text -->
    </mj-raw>
    <mj-section>
      <mj-column>
        <mj-text align="center" font-size="28px">Confirm your e-mail</mj-text>
        <mj-text align="center" font-size="16px" line-height="24px">Hello <strong>{{$username}}</strong>, confirm your email address. It's easy, just click the button below.</mj-text>
        <mj-button font-size="16px" background-color="#007BFF" href="{{env('APP_URL').'/auth/user/email/verify/'.$token}}">Confirm now</mj-button>
      </mj-column>
    </mj-section>
    <mj-raw>
      <!-- Footer -->
    </mj-raw>
    <mj-section background-color="#F8F9FA">
      <mj-column>
        <mj-text font-size="13px" line-height="20px" color="#6C757D">This message was send to {{$email}}. If you have received this email by mistake, please ignore this message.</mj-text>
        <mj-divider border-width="1px" border-style="dashed" border-color="lightgrey" padding="5px 25px" />
        <mj-text font-size="13px" line-height="20px" color="#6C757D" css-class="footer-links">
          <span><a href="#" class="link-nostyle">Privacy Policy</a></span>
          <span><a href="#" class="link-nostyle">Contact Us</a></span>
        </mj-text>
        <mj-text font-size="12px" line-height="20px" font-style="italic" color="#6C757D" css-class="footer-links">Postal address of the company</mj-text>
      </mj-column>
    </mj-section>
  </mj-body>
</mjml>
```

> Es importante tener en cuenta la URL de redirección `{{env('APP_URL').'/auth/user/email/verify/'.$token}}`.

# Bibliografía

SITIOINFO. _Título_. < [url](url) >
<br>[Última consulta: fecha]

LARAVEL. _Eloquent: Getting Started_. < [https://laravel.com/docs/5.8/eloquent](https://laravel.com/docs/5.8/eloquent) >
<br>[Última consulta: 13 de marzo de 2019]

LARAVEL. _Eloquent: Relationships_. < [https://laravel.com/docs/5.8/controllers#single-action-controllers](https://laravel.com/docs/5.8/eloquent-relationships) >
<br>[Última consulta: 13 de marzo de 2019]

LARAVEL. _Single Action Controllers_. < [https://laravel.com/docs/5.8/controllers#single-action-controllers](https://laravel.com/docs/5.8/controllers#single-action-controllers) >
<br>[Última consulta: 5 de marzo de 2019]

LARAVEL NEWS. _20 Laravel Eloquent Tips and Tricks_. < [https://laravel-news.com/eloquent-tips-tricks](https://laravel-news.com/eloquent-tips-tricks) >
<br>[Última consulta: 13 de marzo de 2019]

LUMEN. _The stunningly fast micro-framework by Laravel_. < [https://lumen.laravel.com/](https://lumen.laravel.com/) >
<br>[Última consulta: 4 de marzo de 2019]

LUMEN. _Mail_. < [https://lumen.laravel.com/docs/5.8/mail](https://lumen.laravel.com/docs/5.8/mail) >
<br>[Última consulta: 7 de marzo de 2019]

MEDIUM (David Ngugi). _Setting up OAuth in Lumen using Laravel Passport_. < [https://medium.com/the-andela-way/setting-up-oauth-in-lumen-using-laravel-passport-2de9d007e0b0](https://medium.com/the-andela-way/setting-up-oauth-in-lumen-using-laravel-passport-2de9d007e0b0) >
<br>[Última consulta: 8 de marzo de 2019]

MJML. _The only framework that makes responsive email easy_. < [https://mjml.io/](https://mjml.io/) >
<br>[Última consulta: 7 de marzo de 2019]

PACKAGIST (dusterio/lumen-passport). _Making Laravel Passport work with Lumen_. < [https://packagist.org/packages/dusterio/lumen-passport](https://packagist.org/packages/dusterio/lumen-passport) >
<br>[Última consulta: 8 de marzo de 2019]

PACKAGIST (flipbox/lumen-generator). _A Lumen Generator You Are Missing_. < [https://packagist.org/packages/flipbox/lumen-generator](https://packagist.org/packages/flipbox/lumen-generator) >
<br>[Última consulta: 4 de marzo de 2019]

STACKOVERFLOW. _Laravel Lumen Ensure JSON response_. < [https://stackoverflow.com/questions/37296654/laravel-lumen-ensure-json-response](https://stackoverflow.com/questions/37296654/laravel-lumen-ensure-json-response) >
<br>[Última consulta: 6 de marzo de 2019]