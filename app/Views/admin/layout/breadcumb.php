<i class="fas fa-sitemap text-muted mr-1"></i>
<ol class="breadcrumb">
    <?php
        for($i=0;$i<count($breadcrumb);$i++){
            echo '<li class="breadcrumb-item'.(($i==count($breadcrumb)-1) ? ' active' : '').'">'.(($i==count($breadcrumb)-1) ? '' : '<a href="'.$breadcrumb[$i]['link'].'">').$breadcrumb[$i]['title'].'</a></li>';
        }
    ?>
</ol>