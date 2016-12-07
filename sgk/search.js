function sgksearch()
{
    var xhr=false;
    var postData="keywords="+document.getElementById("keywords").value;
    postData=encodeURI(postData);
    if(window.XMLHttpRequest){
       xhr=new XMLHttpRequest();
    }else if(window.ActiveXObject){
        xhr=new ActiveXObject("Msxml2.XMLHTTP");
    }
    xhr.open("POST", "/sgk/search.php", true);
    xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xhr.onreadystatechange = function(){
    if (xhr.readyState == 4) {
        if (xhr.status == 200) {
            text = xhr.responseText;
            document.getElementById("result").innerHTML=text; 
            location.href="#result";
            }
        }
    };
    xhr.send(postData);
   
    return false;
}
