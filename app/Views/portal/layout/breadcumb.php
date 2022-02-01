<?php if(isset($breadcrumb)) { ?>
<ol class="breadcrumb float-sm-right">
    <?php
        for($i=0;$i<count($breadcrumb);$i++){
            echo '<li class="breadcrumb-item'.(($i==count($breadcrumb)-1) ? ' active' : '').'">'.(($i==count($breadcrumb)-1) ? '' : '<a href="'.base_url().'/'.$breadcrumb[$i]['link'].'">').$breadcrumb[$i]['title'].'</a></li>';
        }
    ?>
</ol>
<?php } ?>