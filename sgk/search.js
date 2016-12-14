function sgksearch()
{
    var record = new Array();
    var index=0;
    var stop=false;
    var num=0;
    var domtext='<div class="col-sm-10 col-sm-offset-2 alert alert-warning" role="alert"><strong>正在搜索，请稍等</div>';
    domtext+='<table id="restable" class="col-sm-offset-1 table table-hover table-bordered">';
    domtext+='</tbody></table>';
    document.getElementById("result").innerHTML=domtext; 

    (function getnextpage(){
        if(num>500)return false;   // result sum uplimit = 1000
        var xhr=false;
        var postData="keywords="+document.getElementById("keywords").value;
        postData=postData+"&index="+index++;
        postData=encodeURI(postData);
        if(window.XMLHttpRequest){
           xhr=new XMLHttpRequest();
        }else if(window.ActiveXObject){
            xhr=new ActiveXObject("Msxml2.XMLHTTP");
        }
        xhr.open("POST", "./sgk/search.php", true);
        xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xhr.onreadystatechange = function(){
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                text = xhr.responseText;
                if(text.indexOf("CODE:NULL")!=-1)
                {
                    
                        var domtext1='<div class="col-sm-10 col-sm-offset-2 alert alert-danger" role="alert"><strong>无搜索条件!</strong>请重新输入</div><br/><br/>';;
                        document.getElementById("result").innerHTML=domtext1;
                        return false;
                }
                else
                {
                    if(text.indexOf("CODE:FAIL")!=-1)
                        {
                            stop=true;
                            document.getElementById("result").innerHTML+='<div id="finalinfo" class="col-sm-10 col-sm-offset-2 alert alert-success" role="alert">'+'<strong>搜索完成!</strong>共有'+num+'条结果</div><br/>';;
                            return false;
                        }
                    else{
                        
                        var recs=text.split("\n");
                        for(var i in recs)
                        {
                            try{
                            if(i==0||recs[i]==""||recs[i]==" "||recs[i]=="\n"||recs[i]=="\r\n")continue;
                            var msg=recs[i].split("::::",2);
                            var currentrow=document.getElementById("restable").insertRow(num++);
                            currentrow.insertCell(0).innerHTML=msg[1].replace(" ","&nbsp;").replace("\t","&nbsp;&nbsp;&nbsp;&nbsp;");
                            var fpath=msg[0].split("/");
                            for(var i in fpath)
                            {
                                if(i==0)continue;
                                var currentcell=currentrow.insertCell(i);
                                currentcell.setAttribute("bgcolor","#FFFFCC");
                                if(i==fpath.length-1)currentcell.setAttribute("bgcolor","#CCFFCC");
                                currentcell.innerHTML=fpath[i];
                            }
                            }catch(e){}
                        }
                        if(stop==true)
                            return false;
                        else
                            getnextpage();
                        }
                }
                }
            }
        };
        xhr.send(postData);
        })();

        location.href="#result";

        return false;
}
