`Tested on Windows GBK`

Needed files not uploaded:
==========================
### /jdb/lib/media_files
### /uestc/db/info.txt
### /uestc/faces/pictures
### /sgk/db/manydbs

 
# How does this work:
* Put the relavant files in the folder, the website will automaticly handler the files and present them to you.
* The first page works in mirroring /uestc/db => /uestc/faces , where the first folder contains a info.txt table, and the second folder contains massive pictures.
* Put media files/folders (images/mp4) in /jdb/lib/ , this website is funcioned as an online player in form of a local filesystem explorer.
* Put text files/folders in /sgk/db/ , it's an search engine of web interface.

### These applications are all very resource-consuming so use with caution and dont get your server down.


In consideration of Security issue:
----------------------------------

### php.ini:
* open_basedir = "somewhere:/IUSTU_INFO_CENTER/"

### apache:
``` 
<Location "/uestc/db">
   Order allow,deny
   Deny from all
</Location>
<Location "/sgk/db">
   Order allow,deny
   Deny from all
</Location>
```
