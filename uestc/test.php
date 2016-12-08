<?php
$a=<<<EOF

<table class="col-sm-offset-1 table table-hover table-bordered"><thead><tr><th>姓名</th><th>性别</th><th>学历</th><th>学号</th><th>身份证号</th><th>户籍</th><th>学院</th><th>专业</th><th>图片</th></tr></thead><tbody><tr><td>李峰</td><td>男</td><td>本科</td><td>2016060601031</td><td>360731199804044830</td><td>江西省赣州市于都县</td><td>计算机科学与工程学院</td><td class='danger'>未知</td><td><img src="/uestc/faces/2016060601031.jpg" class="img-rounded col-sm-6" data-toggle="modal" data-target="#2016060601031" />

<div class="modal fade" id="2016060601031" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content  col-sm-12">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times</button>
        <h4 class="modal-title">详细图片</h4>
    </div>
    <div class="modal-body  col-sm-12">
            <img src="/uestc/faces/2016060601031.jpg
" class="img-rounded col-sm-8  col-sm-offset-2" />
        </div>
    </div>
    </div>
</div>
</td></tr><tr><td>布次旦</td><td>男</td><td>本科</td><td>2016060601030</td><td>542424199704240012</td><td>西藏自治区那曲地区聂荣县</td><td>计算机科学与工程学院</td><td class='danger'>未知</td><td><img src="/uestc/faces/2016060601030.jpg" class="img-rounded col-sm-6" data-toggle="modal" data-target="#2016060601030" />

<div class="modal fade" id="2016060601030" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content  col-sm-12">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times</button>
        <h4 class="modal-title">详细图片</h4>
    </div>
    <div class="modal-body  col-sm-12">
            <img src="/uestc/faces/2016060601030.jpg
" class="img-rounded col-sm-8  col-sm-offset-2" />
        </div>
    </div>
    </div>
</div>
</td></tr>
</td></tr></tbody></table>
            <div class="col-sm-10 col-sm-offset-2 alert alert-warning" role="alert">
                <strong>搜索完成!</strong>
                共有200条结果。请注意搜索结果上限为200条.
            </div><br/><br/>
            

EOF;


echo $a;

?>