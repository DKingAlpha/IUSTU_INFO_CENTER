$(document).ready(gotouestc);
$("#navitem1").click(gotouestc);
$("#navitem2").click(gotojdb);
$("#navitem3").click(gotosgk);

function gotouestc()
{
    $("#stubcontainer").load("/uestc/index.html #stub");
    document.title="UESTC信息查询";
    $("#navitem1").attr("class","active");
    $("#navitem2").attr("class","");
    $("#navitem3").attr("class","");
}

function gotojdb()
{
    $("#stubcontainer").html('<div class="container" id="webcontent" align="center"></div>');
    document.title="借贷宝信息查询";
    $("#navitem1").attr("class","");
    $("#navitem2").attr("class","active");
    $("#navitem3").attr("class","");
    listdir(path);
}
function gotosgk()
{
    $("#stubcontainer").load("sgk/index.html #stub");
    document.title="社工库信息查询";
    $("#navitem1").attr("class","");
    $("#navitem2").attr("class","");
    $("#navitem3").attr("class","active");
}
