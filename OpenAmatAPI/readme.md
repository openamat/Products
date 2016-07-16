##OPENAMAT API

Rest API realizzate in Node.js con l'utilizzo del framework Hapi.js.
Le API ritornato un oggetto JSON con il seguente formato:
1. Success
    { resultCode: 'OK', resultObj: data }
2. Error
    { resultCode: 'KO', error: err }
    
#Dettaglio API e Path

1. GET /routes
    Ritorna tutte le rotte ( linee )
2. GET /stops
    Ritorna tutte le fermate
3. GET /stops/{routeId}/{directionId}
    Ritorna le fermate per la linea indicata e la direzione in ordine crescente
    
    