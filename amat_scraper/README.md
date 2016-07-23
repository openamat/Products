# AMAT Homepage News Scraper

## Introduzione
Scraper per le news in homepage nel sito ufficiale [AMAT](http://www.amat.pa.it)

## Requisiti di sistema
- NodeJs 4.4.x

## Librerie usate
- [scrape-it](https://github.com/IonicaBizau/scrape-it)
- [restify](https://github.com/restify/node-restify)
- [dotenv](https://github.com/motdotla/dotenv)

## Utilizzo
Una volta clonato il progetto, eseguire i seguenti comandi

    npm install
    cp .env-dist .env
    npm start

## File .env
Il file **.env** contiene delle variabili d'ambiente utili per registrare configurazioni e informazioni "statiche". Quelle fornite attualmente dal sistema sono:

    AMAT_BASE_URL (default su homepage di AMAT senza lo slash finale)
    RESTIFY_PORT (default: 8888)
