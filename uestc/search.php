
<?php

function imgblock($imgurl)
{
$id=explode(".",explode("/",rtrim($imgurl))[1])[0];
$blk='<img src="/uestc/'.rtrim($imgurl).'" class="img-rounded col-sm-6" data-toggle="modal" data-target="#'.$id.'" />

<div class="modal fade" id="'.$id.'" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content  col-sm-12">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times</button>
        <h4 class="modal-title">详细图片</h4>
    </div>
    <div class="modal-body  col-sm-12">
            <img src="/uestc/'.$imgurl.'" class="img-rounded col-sm-8  col-sm-offset-2" />
        </div>
    </div>
    </div>
</div>
';
return $blk;

}

function contains($a,$b)
{
    if(is_array($b))
    {
        $flag=true;
        foreach($b as $i)
        {
            $flag=$flag&&(($i && strstr($a,$i)) || !$i);
        }
        echo $flag;
        return $flag;
    }
    else
    {
        return (($b && strstr($a,$b)) || !$b);
    }
}

if($_POST)
{
    $f=file("db/info.txt");
    $l=count($f);

    $pagelimit=200;
    $filterout=0;
    
    $found = false;
    $tablehtml="";
    $tablehtml.='<table class="col-sm-10 col-sm-offset-1 table table-hover table-bordered ">';
    $tablehtml.="<thead><tr><th>姓名</th><th>性别</th><th>学历</th><th>学号</th><th>身份证号</th><th>户籍</th><th>学院</th><th>专业</th><th>图片</th></tr></thead><tbody>";

    for($i=0; $i<$l&& $filterout<$pagelimit ; $i++)
    {
        $ps=explode("\t",$f[$i]);
        
        $id=isset($_POST['id'])?$_POST['id']:false;
        $sid=isset($_POST['sid'])?$_POST['sid']:false;
        $name=isset($_POST['name'])?$_POST['name']:false;
        $institution=isset($_POST['institution'])?$_POST['institution']:false;
        $major=isset($_POST['major'])?$_POST['major']:false;
        $location=isset($_POST['location'])?$_POST['location']:false;

        
        
        if(isset($_POST['sex'])){
            if($_POST['sex']==1)
                $sex="男";
            elseif($_POST['sex']==2)
                $sex="女";
            else
                $sex=false;
        }else{
            $sex=false;
        }
        $locations="";
        if($location)
            $locations=explode(" ",$location);
        
        
        if(($sid||$id||$sex||$name||$institution||$major||$location)==false)
        {
            echo '
            <div class="col-sm-10 col-sm-offset-2 alert alert-danger" role="alert">
                <strong>无搜索条件!</strong>
                请重新输入
            </div><br/><br/>
            ';
            exit(0);
        }
        

        if(
            contains($ps[3],$sid) &&
            contains($ps[4],$id) &&
            contains($ps[1],$sex)&&
            contains($ps[0],$name)&&
            contains($ps[6],$institution)&&
            contains($ps[7],$major)&&
            contains($ps[5],$locations)
        )
        {
            $found=true;
            $filterout++;
            $tablehtml.="<tr'>";
            $tablehtml.="<td>$ps[0]</td><td>$ps[1]</td><td>$ps[2]</td><td>$ps[3]</td><td>$ps[4]</td>";
            if($ps[5]=="未知")
                $tablehtml.="<td class='danger'>".$ps[5];
            else
                $tablehtml.="<td>".$ps[5];
            $tablehtml.="</td><td>$ps[6]</td>";
            if(strpos($ps[6],"0")==0)
                $tablehtml.="<td class='danger'>未知";
            else
                $tablehtml.="<td>".$ps[6];
            $tablehtml.="</td><td>".imgblock($ps[8])."</td>";
            $tablehtml.="</tr>";
        }

    }
    $tablehtml.="</tbody></table>";
    
    if($found)
    {
        if($filterout<200){
            echo '
            <div class="col-sm-10 col-sm-offset-2 alert alert-success" role="alert">
                <strong>搜索完成!</strong>
                共有'.$filterout.'条结果
            </div><br/><br/>
            ';
        }else{
            echo '
            <div class="col-sm-10 col-sm-offset-2 alert alert-warning" role="alert">
                <strong>搜索完成!</strong>
                共有'.$filterout.'条结果。请注意搜索结果上限为200条.
            </div><br/><br/>
            ';
        }
    echo $tablehtml;
    }
    else
    {
        echo '
        <div class="col-sm-10 col-sm-offset-2 alert alert-danger" role="alert">
            <strong>未找到记录</strong>
            共有'.$filterout.'条结果
        </div><br/><br/>
        ';
    }
   
}

?>