##OPENAMAT API

Rest API realizzate in Node.js con l'utilizzo del framework Hapi.js.
Le API ritornato un oggetto JSON con il seguente formato:
1. Success
    { resultCode: 'OK', resultObj: data }
2. Error
    { resultCode: 'KO', error: err }
    
#Dettaglio API e Path

1. /routes
    Ritorna tutte le rotte
2. /stops
    Ritorna tutte le fermate
    