var path="./lib";
function listdir(url)
{
    path=url;
    var requrl=encodeURI("/jdb/func.php?url="+path);
    $('#webcontent').load(requrl);
}
