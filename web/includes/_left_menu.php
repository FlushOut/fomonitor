<div class="span1">
    <aside class="side-left">
        <ul class="sidebar">
            <?php foreach ($list_modules as $module) { 
                    if (strlen($module['parent'])<=0){ ?>
                    <li class="active first"><a href="<?php echo $module['url']; ?>">
                        <div class="helper-font-24"><i class="<?php echo $module['class']; ?>"></i></div>
                        <span class="sidebar-text"><?php echo $module['Module']; ?></span>
                        </a>
                    <?php 
                        $sub = 0;
                        foreach($list_modules as $subs) {
                            if ($module['id_Module'] == $subs['parent']){
                                $sub++;
                            }
                        }
                        if ($sub>0){ ?>    
                            <ul class="sub-sidebar corner-top shadow-silver-dark">
                            <?php
                            foreach($list_modules as $subm) {
                                if ($module['id_Module']== $subm['parent']){ ?>
                                <li><a href="<?php echo $module['url']; ?>" title="<?php echo $module['Module']; ?>">
                                    <div class="helper-font-24"><i class="<?php echo $module['class']; ?>"></i></div>
                                    <span class="sidebar-text"><?php echo $module['Module']; ?></span></a></li>
                            </ul>
                        <?php 
                                }    
                            } 
                        } ?>
                    </li>
                    <?php
                    }
                }
             ?>
        </ul>
    </aside>
</div>