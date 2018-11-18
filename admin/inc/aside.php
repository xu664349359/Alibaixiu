<?php
$id = $_SESSION['user_id'];

$sql = "select * from users where id = $id ";
$date = my_query($sql);
//  echo '<pre>';
// print_r($date);
// echo '</pre>';
$date = $date[0];
$postsDate = in_array($page,['posts','post-add','categories']);

?>


<div class="aside">
        <div class="profile">
          <img class="avatar" src="../<?php echo $date['avatar'] ?>">
          <h3 class="name"><?php echo $date['nickname'] ?></h3>
          <p style = "color :red" ><?php echo $page?></p>
        </div>
        <ul class="nav">
          <li class="<?php echo $page ==='index1'?'active':''?>">
            <a href="index1.php"><i class="fa fa-dashboard"></i>仪表盘</a>
          </li>
          <li class = "<?php echo $postsDate?'active':'' ?>">
            <a href="#menu-posts" data-toggle="collapse" class="<?php echo $postsDate ? '':'collapsed'  ?>" >
              <i class="fa fa-thumb-tack"></i>文章<i class="fa fa-angle-right"></i>
            </a>
            <ul id="menu-posts" class="collapse <?php echo $postsDate?'in':''?> ">
              <li class = "<?php echo $page === 'posts'?'active':'' ?>"><a href="posts.php">所有文章</a></li>
              <li class = "<?php echo $page === 'post-add'?'active':'' ?>"><a href="post-add.php">写文章</a></li>
              <li class = "<?php echo $page === 'categories'?'active':'' ?>"><a href="categories.php">分类目录</a></li>
            </ul>
          </li>
          <li class ="<?php echo $page ==='comments'?'active':'' ?>" >
            <a href="comments.php"><i class="fa fa-comments"></i>评论</a>
          </li>
          <li class = "<?php echo $page ==='users'?'active':'' ?>" >
            <a href="users.php"><i class="fa fa-users"></i>用户</a>
          </li>
          <li>
            <a href="#menu-settings" class="collapsed" data-toggle="collapse">
              <i class="fa fa-cogs"></i>设置<i class="fa fa-angle-right"></i>
            </a>
            <ul id="menu-settings" class="collapse">
              <li><a href="nav-menus.php">导航菜单</a></li>
              <li><a href="slides.php">图片轮播</a></li>
              <li><a href="settings.php">网站设置</a></li>
            </ul>
          </li>
        </ul>
      </div>