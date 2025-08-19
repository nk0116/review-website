<!-- <?php
    $url = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    if(strpos($url,'localhost') !== false){
        $siteUrl = "/";
    }
    elseif(strpos($url,'sunplads.onamaeweb.jp') !== false){
        $siteUrl = "https://sunplads.onamaeweb.jp/test_up/okayama/kobetsu-review.com/";
    }
    elseif(strpos($url,'web-pack.jp') !== false){
        $siteUrl = "http://kobetsu-review.web-pack.jp/";
    }
    else {
        $siteUrl = "https://kobetsu-review.com/";
    }
?> -->
<?php require_once __DIR__ . '/site_url.php'; ?>

<div id="side">

    <div id="kakushu">
        <picture class="kakushu_btn_Top">
            <source media="(min-width: 768px)" srcset="<?php echo $siteUrl; ?>images/ti_kakushu.jpg"><!--PC画像-->
            <source media="(max-width: 768px)" srcset="<?php echo $siteUrl; ?>images/ti_kakushuSp.jpg"><!--SP画像-->
            <img src="<?php echo $siteUrl; ?>images/ti_kakushu.jpg" alt="各種お問合せ" width="250" height="30" />
        </picture>
        <div class="kakushu_btn02">
            <a class="kakushuThumbs kakushuThumbs01" href="<?php echo $siteUrl; ?>inquiry/index.html">
                <picture>
                    <source media="(min-width: 768px)" srcset="<?php echo $siteUrl; ?>images/link_contact.jpg"><!--PC画像-->
                    <source media="(max-width: 768px)" srcset="<?php echo $siteUrl; ?>images/link_contactSp.jpg"><!--SP画像-->
                    <img src="<?php echo $siteUrl; ?>images/link_contact.jpg" alt="お問合せ" width="231" height="54" class="kakushu_btn" />
                </picture>
            </a>
            <a  class="kakushuThumbs kakushuThumbs02" href="<?php echo $siteUrl; ?>access/index.html">
                <picture>
                    <source media="(min-width: 768px)" srcset="<?php echo $siteUrl; ?>images/link_annnai.jpg"><!--PC画像-->
                    <source media="(max-width: 768px)" srcset="<?php echo $siteUrl; ?>images/link_annnaiSp.jpg"><!--SP画像-->
                    <img src="<?php echo $siteUrl; ?>images/link_annnai.jpg" alt="教室案内" width="231" height="54" class="kakushu_btn" />
                </picture>
            </a>
            <br />
            <div class="kakushu_btn">
                <img src="<?php echo $siteUrl; ?>images/side_map.jpg" width="232" height="162" />
                <table width="232" border="0" cellspacing="0" cellpadding="0" class="side_img">
                    <tr>
                        <td class="side_img_td" width="125">
                            <picture>
                                <source media="(min-width: 768px)" srcset="<?php echo $siteUrl; ?>images/side_img1.jpg"><!--PC画像-->
                                <source media="(max-width: 768px)" srcset="<?php echo $siteUrl; ?>images/side_img1Sp.jpg"><!--SP画像-->
                                <img src="<?php echo $siteUrl; ?>images/side_img1.jpg" width="113" height="84" />
                            </picture>
                        </td>
                        <td class="side_img_td" width="107">
                            <picture>
                                <source media="(min-width: 768px)" srcset="<?php echo $siteUrl; ?>images/side_img2.jpg"><!--PC画像-->
                                <source media="(max-width: 768px)" srcset="<?php echo $siteUrl; ?>images/side_img2Sp.jpg"><!--SP画像-->
                                <img src="<?php echo $siteUrl; ?>images/side_img2.jpg" width="113" height="84" />
                            </picture>
                        </td>
                    </tr>
                </table>

                <div class="kakushu_add">
                    <p class="name_corre">
                        個別指導レビュー 総社駅前校
                    </p>
                    〒719-1136<br />岡山県総社市駅前2-2-10<br />
                    新世紀観光ビル2F
                    <br />
                    入塾･無料体験授業の受付時間：<br />
                    14:00～21:00
                    <br />
                    <div class="name_corre_bottom">
                         <picture>
                            <source media="(min-width: 768px)" srcset="<?php echo $siteUrl; ?>images/side_tel.jpg"><!--PC画像-->
                            <source media="(max-width: 768px)" srcset="<?php echo $siteUrl; ?>images/side_telSp.png"><!--SP画像-->
                            <img src="<?php echo $siteUrl; ?>images/side_tel.jpg" alt="TEL0866-95-2100" width="187" height="31" />
                        </picture>
                    </div>
                    <strong>Email：</strong><a href="mailto:review@x.gmobb.jp">review@x.gmobb.jp</a>
                </div>
            </div>
            <br />
        </div>

    </div>
</div>
