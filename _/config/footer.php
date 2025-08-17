<?php
    $url = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    if(strpos($url,'localhost') !== false){
        $siteUrl = "/";
    }
    elseif(strpos($url,'kobetsu-review-com.sunplads-staging.com') !== false){
        $siteUrl = "https://kobetsu-review-com.sunplads-staging.com/";
    }
    else {
        $siteUrl = "https://kobetsu-review.com/";
    }
?>
<!--footer-->
<div id="wrap_footer">
    <div id="footer">
        <p class="link">
            <a href="<?php echo $siteUrl; ?>index.html">トップ </a>
            <span class="display_none">|</span>
            <a href="<?php echo $siteUrl; ?>about/index.html">個別指導レビューについて</a>
            <span class="display_none">|</span>
            <a href="<?php echo $siteUrl; ?>course/index.html">個別指導コースボタン </a>
            <span class="display_none">|</span>
            <a href="<?php echo $siteUrl; ?>program/index.html">プログラミングコース </a>
            <span class="display_none">|</span>
            <a href="<?php echo $siteUrl; ?>charge/index.html">料金について</a>
            <span class="display_none">|</span>
            <a href="<?php echo $siteUrl; ?>access/index.html">教室案内</a>
            <span class="display_none">|</span>
            <a href="<?php echo $siteUrl; ?>inquiry/index.html">お問合せ </a>
            <span class="display_none">|</span>
            <a href="<?php echo $siteUrl; ?>privacy/index.html">プライバシーポリシー </a>
        </p>
        <br class="pc_only">
        <div class="footer_logo">
            <img src="<?php echo $siteUrl; ?>images/footer_logo.jpg" width="200" height="54" />
        </div>
        <div class="footer_light">
            <p class="name_corre">
                個別指導レビュー 総社駅前校</p>
            Tel：0866-95-2100<br />
            Email：<a href="mailto:review@x.gmobb.jp">review@x.gmobb.jp</a>
            <br />
            住所：<span class="kakushu_add">岡山県総社市駅前2-2-10新世紀観光ビル２F </span><br />
            入塾･無料体験授業の受付時間　14:00～21:00
        </div>
    </div>
</div>
<div id="wrap_copy">
    <address>
        <?php if(empty($nowPage)): ?>
        Copyright(C) 2012 <a href="../index.html">Kobetsu-review</a>. All Right Reserved
        <?php else: ?>
        Copyright(C) 2012 Kobetsu-review. All Right Reserved
        <?php endif; ?>
    </address>
</div>