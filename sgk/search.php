<?php
$path = './db';
$filelist=[];
getfilelist();

function getfilelist()
{
    global $filelist;
    if(file_exists("./db/filelist.txt"))
    {
         $filelist=file("./db/filelist.txt");
         return $filelist;
    }else
    {
        $f=fopen("./db/filelist.txt","w");
        searchdir("./db");
        foreach($filelist as $fp)fwrite($f,$fp);
        fclose($f);
    }
}

function searchdir($dir)
{
    global $filelist;
	if(is_dir($dir))
   	{
     	if ($dh = opendir($dir)) 
		{
        	while (($file = readdir($dh)) !== false)
			{
     			if((is_dir($dir."/".$file)) && $file!="." && $file!="..")
                    searchdir($dir."/".$file);
				elseif($file!="." && $file!="..")
                    array_push($filelist,($dir."/".$file."\n"));
        	}
        	closedir($dh);
     	}
   	}
}

if($_POST)
{
    global $filelist;
    $found = false;
    $limit=50;$resnum=0;            // data sum can be filtered out of a single file
    if(!isset($_POST['keywords']))exit();else $keywords=$_POST['keywords'];
    if(!isset($_POST['index']))$fileindex=0;else $fileindex=$_POST['index'];
    $keyword=[];
    if($keywords)
        $keyword=explode(" ",$keywords);
    if($keyword==[])
    {
        echo 'CODE:NULL';
        exit();
    }
    if($fileindex<0||$fileindex>count($filelist)-1){
        echo "CODE:FAIL";
        exit();
    }
    
    $fname=trim($filelist[$fileindex]);
    $f=file($fname);
    $l=count($f);

    for($m=0;$m<$l&&$resnum<$limit;$m++)
    {
        $ps=preg_replace("/\s\s+/"," ",$f[$m]);
        foreach ($keyword as $i){
            if(strpos($ps,$i)===0 || strpos($ps,$i)>0)
            {
                echo substr($fname,strlen($path),strlen($fname)-strlen($path))."::::".$f[$m]."\n";
                $resnum++;
            }
        }
    }
    unset($f);
}
?>
