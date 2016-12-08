function search()
{
    var xhr=false;
    var postData="";
    postData=postData+"name="+document.getElementById("name").value+"&";
    postData=postData+"id="+document.getElementById("id").value+"&";
    postData=postData+"sid="+document.getElementById("sid").value+"&";
    postData=postData+"institution="+document.getElementById("institution").value+"&";
    postData=postData+"major="+document.getElementById("major").value+"&";
    postData=postData+"location="+document.getElementById("location").value+"&";
    postData=postData+"sex="+document.getElementById("sex").value;
    
    postData=encodeURI(postData);
    
    if(window.XMLHttpRequest){
       xhr=new XMLHttpRequest();
    }else if(window.ActiveXObject){
        xhr=new ActiveXObject("Msxml2.XMLHTTP");
    }
    xhr.open("POST", "/uestc/search.php", true);
    xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xhr.onreadystatechange = function(){
    if (xhr.readyState == 4) {
        if (xhr.status == 200) {
            text = xhr.responseText;
            console.log(text);
            document.getElementById("result").innerHTML=text; 
            location.href="#result";
            }
        }
    };
    xhr.send(postData);
   
    return false;
}
