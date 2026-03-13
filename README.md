# Symfony + Vue.js Progetto gestione articoli

Questo progetto è un catalogo di articoli ed autori sviluppato con **Symfony 7** (PHP 8.2+), **Doctrine ORM** e **Vue.js**. L'intero ambiente è gestito tramite **Docker** con FrankenPHP per garantire la massima portabilità.

---

## Prerequisiti

Prima di iniziare, assicurati di avere installato sul tuo computer:
* [Docker Desktop](https://www.docker.com/products/docker-desktop/)
* [Git](https://git-scm.com/)

---

## Installazione Rapida

Segui questi passaggi per clonare il progetto e avviarlo localmente:

### 1. Clona il repository
```
git clone <IL_TUO_URL_GITHUB>
cd <NOME_DELLA_CARTELLA>
```

### 2. Avvia i container Docker
Questo comando scaricherà le immagini e avvierà i servizi (PHP, Database MariaDB, Web Server):
```
docker compose up -d
```

### 3. Installa le dipendenze PHP
```
docker compose exec php composer install
```

### 4. Configura il Database e le Migrazioni
Esegui questi comandi per generare le tabelle partendo dalle entità Doctrine:
```
docker compose exec php bin/console doctrine:database:create --if-not-exists

docker compose exec php bin/console doctrine:migrations:migrate --no-interaction
```

---

## Utilizzo

Una volta avviato, il progetto è disponibile ai seguenti indirizzi:
* Homepage (Symfony): [http://localhost](http://localhost)

### Generazione dei dati

Per popolare il database con un autori di prova utilizza il comando personalizzato:
```
docker compose exec php bin/console app:create-author
```

Per popolare il database con un articolo di prova utilizza il comando personalizzato:
```
docker compose exec php bin/console app:create-article
```

Per visualizzare le informazioni principali di un articolo utilizza il comando personalizzato:
```
docker compose exec php bin/console app:show-article
```

---
