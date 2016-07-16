

# AMAT Palermo SPA - Piattaforma di Gestione Dati + JSON API REST

Questa directory contiene l'implementazione minimale dell web application di content management e del JSON API REST ad essa collegato.

### Sincronizzazione dei Dati

In questo primo rilascio, i dati originali provengono dai JSON parsati nella directory [data/json](https://github.com/openamat/Products/tree/master/data/201607/json). L'obiettivo, per il futuro, è quello di implementare una funzionalità di IMPORT CSV per consentire una puntuale sincronizzazione dei dati.

### JSON REST API

todo

### Requisiti per l'installazione

- Composer
- NodeJS (4.4.2 minimo) e NPM
- GULP
- PHPUNIT

### Installazione

L'applicazione è provvista di Migrations e Seeds base.
Creare un DB MySQL e sincronizzare il nome con il file .env dell'applicazione.

Per installare, seguire i seguenti step:


	composer install
	artisan migrate --seeds

	npm install
	gulp
	
### JSON REST API

L'applicazione fa uso di autenticazione [JWT](https://jwt.io/) per l'utilizzo delle API.
Per avere un'idea di tutti gli endpoint e della configurazione per ottenere un token valido, fai riferimento a questo [link](https://www.getpostman.com/collections/f77461495f6c18d23166) di POSTMAN.

Ciascuna richiesta ha bisogno di un token di autorizzazione, passato mediante header, nella tipica forma:

    Authorization:  Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6XC9cL29wZW5hbWF0LmRldlwvYXBpXC92MVwvbG9naW4iLCJpYXQiOjE0Njg2OTA0NDMsImV4cCI6MTQ2ODY5NDA0MywibmJmIjoxNDY4NjkwNDQzLCJqdGkiOiJjNTY3OGIxMDRjNzMyNzFkYTYxMTAxNzhhNmRkMTA4YyJ9.vlKNYo1-VujUcgWDQud6yQkkdDUk4dl503KhcVfgPMc

Per ottenere tale token, bisognerà far riferimento al seguente endpoint:

[POST] http://openamat.dev/api/v1/login

Payload (body):

    {
    	"email": <email_credential>,
    	"password": <password_credential>  	
    }

(Host e credenziali verranno rese presto pubbliche)

La chiamata restituirà una risposta simile a questa:

    {
      "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6XC9cL29wZW5hbWF0LmRldlwvYXBpXC92MVwvbG9naW4iLCJpYXQiOjE0Njg2OTA4NDEsImV4cCI6MTQ2ODY5NDQ0MSwibmJmIjoxNDY4NjkwODQxLCJqdGkiOiIxNGVmZTVhNzRkODM3YWRiZDU2MmJjOTFiMDJkYjZiYiJ9.YSolqll3fFZpigy5ZoJFW4RYR2MKv8sY1qdn9E56Hio"
    }
    
Da questo momento in poi, sarà possibile far riferimento a tutte le entità (agencies, routes, trips) identificate dall'applicazione.    

Un esempio di API è il seguente:

    {
      "total": 1,
      "per_page": 25,
      "current_page": 1,
      "last_page": 1,
      "next_page_url": null,
      "prev_page_url": null,
      "from": 1,
      "to": 1,
      "data": [
        {
          "id": 1,
          "agency_id": "test",
          "agency_name": "test",
          "agency_url": "test",
          "agency_timezone": "test",
          "agency_lang": "test",
          "agency_phone": "test",
          "agency_fare_url": "test",
          "created_at": null,
          "updated_at": null
        }
      ]
    }
    


N.B.: Non appena l'applicazione sarà in deploy, verranno inserite specifiche API dettagliate di ciascun endpoint.