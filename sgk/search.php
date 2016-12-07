<?php

$path = './db';
searchdir($path);


function searchdir($dir)
{
	if(is_dir($dir))
   	{
     	if ($dh = opendir($dir)) 
		{
        	while (($file = readdir($dh)) !== false)
			{
     			if((is_dir($dir."/".$file)) && $file!="." && $file!="..")
                    searchdir($dir."/".$file."/");
				elseif($file!="." && $file!="..")
                    searchinfile($dir."/".$file);
        	}
        	closedir($dh);
     	}
   	}
}

function searchinfile($file)
{
if($_POST)
{
    $pagelimit=200;
    $filterout=0;
    
    $found = false;
    $tablehtml="";
    $tablehtml.='<table class="col-sm-10 col-sm-offset-1 table table-hover table-bordered ">';
    $tablehtml.="<thead><tr><th>已有记录</th></tr></thead><tbody>";

    $f=file($file);
    $l=count($f);
    for($i=0; $i<$l&& $filterout<$pagelimit ; $i++)
    {
        
        $ps=explode(" ",preg_replace("/\s\s+/"," ",$f[$i]));
        
        if(!isset($_POST['keywords']))exit();

        $keyword=[];
        if($keyword)
            $keyword=explode(" ",$keywords);
        
        
        if($keyword==[])
        {
            echo '
            <div class="col-sm-10 col-sm-offset-2 alert alert-danger" role="alert">
                <strong>无搜索条件!</strong>
                请重新输入
            </div><br/><br/>
            ';
            exit();
        }
        
        foreach ($keyword as $i){
            if(strpos($_POST['keywords'],$i)===0 || strpos($_POST['keywords'],$i)>0)
            {
                $found=true;
                $filterout++;
                $tablehtml.="<tr'>";
                $tablehtml.="<td>$ps</td>";
                $tablehtml.="</tr>";
            }
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
}

?>