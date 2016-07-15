# AMAT Palermo SPA - Dati del trasporto pubblico locale su gomma

Questa cartella contiene dataset creati a partire dal dataset ufficiale pubblicato il **15 luglio** del **2016** sul sito del **Comune di Palermo**: [https://www.comune.palermo.it/opendata_dld.php?id=383](https://www.comune.palermo.it/opendata_dld.php?id=383)

I dati originali sono in formato [GTFS](https://developers.google.com/transit/gtfs/). Sono stati qui convertiti in formati più comodi per elaborazioni cartografiche e non.

## PostgreSQL

[`amat201607.sql`](./amat201607.sql) è il dump di un db PostgreSQL 9.3.13.

## PostgreSQL/PostGIS

[`amat201607geo.sql`](./amat201607geo.sql) è il dump di un db PostgreSQL 9.3.13/POSTGIS=2.1.2 r12389.

## SpatiaLite


[`amat201607.sqlite`](./amat201607.sqlite) deriva dall'export del db PostGIS, tramite [ogr2ogr](http://www.gdal.org/ogr2ogr.html):

    ogr2ogr --config PG_LIST_ALL_TABLES YES -f SQLite -dsco SPATIALITE=YES amat201607.sqlite PG:"dbname='amatdbgeo' host='localhost' port='5432' user='amat' password='password'"

## KML

[`amat201607.kml`](./amat201607.kml) in formato KML.