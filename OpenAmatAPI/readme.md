##OPENAMAT API

Rest API realizzate in Node.js con l'utilizzo del framework Express.js e l'SDK Parse.

#Primo Avvio

Dopo aver effettuato un npm install bisogna lanciare app.js con node ( forever o pm2 per lanciarlo come servizio ).
N.B. Per configurare il tutto correttamente dovrete prima importare il database postgres amat201607.sql e poi lanciare l'utility utils/seed.js.
La seed.js si occuperà di esportare i dati dal db in formato JSON e successivamente effettuare la migrazione su MongoDB tramite Parse.

#API: formato e utilizzo
Le API ritornato un oggetto JSON in formato JSEND:
1. Success
    { status: 'success', data: data }
2. Error
    { status: 'error', message: message }

#Dettaglio API e Path

1. GET /api/routes
    Ritorna tutte le rotte ( linee )
2. GET /api/directions/{routeId}
    Ritorna le direzioni di una linea
3. GET /api/stops
    Ritorna tutte le fermate
4. GET /api/stops/{routeId}/{directionId}
    Ritorna le fermate per la linea indicata e la direzione in ordine crescente
    
    