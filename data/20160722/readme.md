# AMAT Palermo SPA - Dati del trasporto pubblico locale su gomma

Questa cartella contiene dataset creati a partire dal dataset ufficiale pubblicato il **22 luglio** del **2016** sul sito del **Comune di Palermo**: [https://www.comune.palermo.it/opendata_dld.php?id=384](https://www.comune.palermo.it/opendata_dld.php?id=384)

I dati originali sono in formato [GTFS](https://developers.google.com/transit/gtfs/). Sono stati qui convertiti in formati più comodi per elaborazioni cartografiche e non.

## PostgreSQL

[`amatdbgeoV9.sql`](./amatdbgeoV9.sql) è il dump di un db PostgreSQL 9.3.13.

## PostgreSQL/PostGIS

[`amatdbgeoV9.sql`](./amatdbgeoV9.sql) è il dump di un db PostgreSQL 9.3.13/POSTGIS=2.1.2 r12389.

## SpatiaLite

[`amatdbgeoV9.sqlite`](./amatdbgeoV9.sqlite) deriva dall'export del db PostGIS, tramite [ogr2ogr](http://www.gdal.org/ogr2ogr.html):

    ogr2ogr --config PG_LIST_ALL_TABLES YES -f SQLite -dsco SPATIALITE=YES amatdbgeoV9.sqlite PG:"dbname='amatdbgeoV9' host='localhost' port='5432' user='amat' password='password'"

## KML

[`amat_feed_gtfs_v9.kml`](./amat_feed_gtfs_v9.kml) in formato KML.
