<?php
    $url = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    if(strpos($url,'localhost') !== false){
        $siteUrl = "/";
    }
    elseif(strpos($url,'sunplads.onamaeweb.jp') !== false){
        $siteUrl = "https://sunplads.onamaeweb.jp/test_up/okayama/kobetsu-review.com/";
    }
    elseif(strpos($url,'kobetsu-review-com.sunplads-staging.com') !== false){
        $siteUrl = "https://kobetsu-review-com.sunplads-staging.com/";
    }
    else {
        $siteUrl = "https://kobetsu-review.com/";
    }
?>
<header>
    <div class="pc_only">
        <div id="header">
            <h1>
                <?php if(empty($nowPage)): ?>
                <a href="<?php echo $siteUrl; ?>">
                <?php endif; ?>
                <img src="<?php echo $siteUrl; ?>images/header_logo.jpg" alt="学校成績保証の個別指導塾「レビュー」" width="439" height="75" />
                <?php if(empty($nowPage)): ?>
                </a>
                <?php endif; ?>
            </h1>
            <p class="head_tel">
                <?php if(empty($nowPage)): ?>
                <a href="../index.html"><img src="../images/btn_top.jpg" alt="トップページ" width="95" height="21" class="top_btn"></a>
                <?php endif; ?>
                <img src="<?php echo $siteUrl; ?>images/header_tel.jpg" alt="電話番号　0866-95-2100" width="232" height="75" />
            </p>
        </div>

        <div id="gnav_wrap">
            <div id="gnav">
                <ul>
                    <li><a href="<?php echo $siteUrl; ?>about/index.html"><img src="<?php echo $siteUrl; ?>images/gnav_about.png" alt="個別指導レビューについて" width="153" height="34" /></a></li>
                    <li><a href="<?php echo $siteUrl; ?>course/index.html"><img src="<?php echo $siteUrl; ?>images/gnav_course.png" alt="コースについて" width="153" height="34" /></a></li>
             		<li><a href="<?php echo $siteUrl; ?>program/index.html"><img src="<?php echo $siteUrl; ?>images/gnav_pcourse.png" alt="コースについて" width="153" height="34" /></a></li>
                    <li><a href="<?php echo $siteUrl; ?>charge/index.html"><img src="<?php echo $siteUrl; ?>images/gnav_ryokin.png" alt="料金について" width="153" height="34" /></a></li>
                    <li><a href="<?php echo $siteUrl; ?>access/index.html"><img src="<?php echo $siteUrl; ?>images/gnav_annai.png" alt="教室案内" width="153" height="34" /></a></li>
                    <li><a href="<?php echo $siteUrl; ?>inquiry/index.html"><img src="<?php echo $siteUrl; ?>images/gnav_contact.png" alt="お問合せ" width="153" height="34" /></a></li>
                </ul>
            </div>
        </div>
    </div>
    
    <div class="sp_only">
        <div id="headerSp">
            <div class="headerSpwap">
	            <h1 class="headerSpwaph1">
	                <?php if(empty($nowPage)): ?>
	                <a href="<?php echo $siteUrl; ?>">
	                <?php endif; ?>
	                <img src="<?php echo $siteUrl; ?>images/header_logoSp.jpg" alt="学校成績保証の個別指導塾「レビュー」" width="439" height="75" />
	                <?php if(empty($nowPage)): ?>
	                </a>
	                <?php endif; ?>
	            </h1>
                <p class="head_telSp">
                    <img src="<?php echo $siteUrl; ?>images/header_telSp.jpg" alt="電話番号　0866-95-2100" width="158" height="77" />
                </p>
                <div id="menubBtn" class="menubBtn off">
                    <img class="off" src="<?php echo $siteUrl; ?>images/menubBtn.svg" alt="メニューボタン" width="44" height="44" />
                    <img class="on" src="<?php echo $siteUrl; ?>images/menubBtnOn.svg" alt="メニューボタン" width="44" height="44" />
                </a>
            </div>
        </div>

        <div id="gnav_wrapSp">
            <div id="gnavSp">
                <ul class="gnavSpul">
                    <li class="gnavSpli"><a class="gnavSplink" href="<?php echo $siteUrl; ?>about/index.html">レビューについて</a></li>
                    <li class="gnavSpli"><a class="gnavSplink" href="<?php echo $siteUrl; ?>course/index.html">個別指導指導コース</a></li>
            		<li class="gnavSpli"><a class="gnavSplink" href="<?php echo $siteUrl; ?>program/index.html">プログラミングコース</a></li>
                    <li class="gnavSpli"><a class="gnavSplink" href="<?php echo $siteUrl; ?>charge/index.html">料金案内</a></li>
                    <li class="gnavSpli"><a class="gnavSplink" href="<?php echo $siteUrl; ?>access/index.html">教室案内</a></li>
                    <li class="gnavSpli"><a class="gnavSplink" href="<?php echo $siteUrl; ?>inquiry/index.html">お問合せ</a></li>
                </ul>
            </div>
        </div>
    </div>
</header>
