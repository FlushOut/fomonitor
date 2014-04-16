<?php require_once("../config.php"); ?>
<?php
/**
 * Created by JetBrains PhpStorm.
 * User: manuel.moyano
 * Date: 18/09/13
 * Time: 10:26
 * To change this template use File | Settings | File Templates.
 */

if ($multipletabmenu){?>
    <ul class="maintabmenu multipletabmenu">
<?php
}else{?>
    <ul class="maintabmenu">
<?php }
       ?>
        <?php foreach ($list_tabs as $tab) {
            if ($current == $tab['url']){?>
                <li class="current">
        <?php }else {?>
                <li>
        <?php
              }
            if ($requierduser){ ?>
                <a href="<?php echo $tab['url'].'?user='.$_GET['user']; ?>"><?php echo $tab['Module']; ?></a></li>
        <?php } else {?>
                <a href="<?php echo $tab['url']; ?>"><?php echo $tab['Module']; ?></a></li>
        <?php
              }
        }?>
</ul>










