# AMAT Palermo SPA - Dati del trasporto pubblico locale su gomma

Questa cartella contiene dataset creati a partire dal dataset ufficiale pubblicato il **22 luglio** del **2016** sul sito del **Comune di Palermo**: [https://www.comune.palermo.it/opendata_dld.php?id=386](https://www.comune.palermo.it/opendata_dld.php?id=386)

I dati originali sono in formato [GTFS](https://developers.google.com/transit/gtfs/). Sono stati qui convertiti in formati più comodi per elaborazioni cartografiche e non.


## SpatiaLite

[`amatdbgeoV10.sqlite`](./amatdbgeoV10.sqlite) deriva dall'export del db PostGIS, tramite [ogr2ogr](http://www.gdal.org/ogr2ogr.html):

## KML

[`amat_feed_gtfs_v10.kml`](./amat_feed_gtfs_v10.kml) in formato KML.
