
<?php

function imgblock($imgurl)
{

if(!file_exists($imgurl))
{
    $imgurl="noimg.jpg";
    $id=substr(hash("md5",rand(1,60000)),0,16);
    $blk='<img src="/uestc/'.rtrim($imgurl).'" class="img-rounded col-sm-6" data-toggle="modal" data-target="#'.$id.'" />

    <div class="modal fade" id="'.$id.'" role="dialog" aria-hidden="true">
        <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
        <div class="modal-dialog">
        <div class="modal-content  col-sm-12">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times</button>
            <h4 class="modal-title">无图片</h4>
        </div>
        <div class="modal-body  col-sm-12">
                <h3 class=" col-sm-8  col-sm-offset-2">没有与本条数据对应的图片</h3>
            </div>
        </div>
        </div>
    </div>
    ';
    
    
}
else
{
    $id=explode(".",explode("/",rtrim($imgurl))[1])[0];
    $blk='<img src="/uestc/'.rtrim($imgurl).'" class="img-rounded col-sm-6" data-toggle="modal" data-target="#'.$id.'" />

    <div class="modal fade" id="'.$id.'" role="dialog" aria-hidden="true">
        <br/><br/><br/><br/><br/><br/><br/>
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
}
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

    echo '<table class="col-sm-offset-1 table table-hover table-bordered">';
    echo '<thead><tr ><th style="text-align: center" >姓名</th><th style="text-align: center" >性别</th><th style="text-align: center" >学历</th><th style="text-align: center" >学号</th><th style="text-align: center" >身份证号</th><th style="text-align: center" >户籍</th><th style="text-align: center" >学院</th><th style="text-align: center" >专业</th><th style="text-align: center" >图片</th></tr></thead><tbody>';

    for($i=0; $i<$l&& $filterout<$pagelimit ; $i++)
    {
        $ps=explode("\t",rtrim($f[$i]));
        
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
        
        $locations=[];$tmp=[];
        if($location)
            $locations=explode(" ",$location);
        foreach($locations as $loci)
        {
            if($loci!="")array_push($tmp,$loci);
        }
        $locations=$tmp;
        unset($tmp);
        
        if(($sid||$id||$sex||$name||$institution||$major||$locations)==false)
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
            echo "<tr>";
            echo "<td>$ps[0]</td><td>$ps[1]</td><td>$ps[2]</td><td>$ps[3]</td><td>$ps[4]</td>";
            if($ps[5]=="未知")
                echo "<td class='danger'>".$ps[5];
            else
                echo "<td>".$ps[5];
            echo "</td><td>$ps[6]</td>";
            if(strpos($ps[7],"0")==0)
                echo "<td class='danger'>未知";
            else
                echo "<td>".$ps[7];
            if(file_exists($ps[8]))
                echo '</td><td>';
            else
                echo '</td><td class="danger">';
            echo imgblock($ps[8])."</td></tr>";
        }

    }
    echo "</tbody></table>";
    
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
    }
    else
    {
        echo '
        <div class="col-sm-10 col-sm-offset-2 alert alert-danger" role="alert">
            <strong>未找到记录</strong>
        </div><br/><br/>
        ';
    }
   
}

?>