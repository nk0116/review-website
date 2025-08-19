<?php
$_SESSION['csrf_token'] = sha1(session_id());
?>

<br class="pc_only">
<br />
<p>必要事項をご記入いただき送信ボタンをクリックしてください。<br class="sp_only"><br class="sp_only">
    <img src="images/mfp_must.gif" width="30" height="16" alt="必須" class="must01" />の項目は必須入力となります。
</p><br />

<?php include 'err.php'; ?>

<form action="confirm.php" method="post">
    <script type="text/javascript" src="https://www.kobetsu-review.com/inquiry/mailformpro/include.cgi" charset="UTF-8"></script>
    <noscript>
        <p><input type="hidden" name="javascript_flag" value="0" /></p>
    </noscript>
    <div id="mailfrom_hidden_object">
        <input type="submit" value="submit" />
        <input type="hidden" name="must_id" value="(必須)" />
        <input type="hidden" name="input_time" value="0" />
        <input type="hidden" name="sitein_referrer" value="" />
        <input type="hidden" name="mailform_confirm_mode" value="1" />
    </div>
    <table border="0" cellpadding="0" cellspacing="0" class="mailform" summary="mailform main">
        <tr class="mfptr" style="background-color: rgb(232, 238, 249);">
            <th><img src="images/mfp_must.gif" width="30" height="16" alt="必須" class="must" />お名前</th>
            <td>
                <input type="text" name="name" size="20" class="mfp mfpname" value="<?php if(!empty($postdatas->PostData['name'])) { echo $postdatas->PostData['name']; } ?>" required />
            </td>
        </tr>
        <tr class="mfptr">
            <th>郵便番号</th>
            <td>
                <input type="text" name="postcode" pattern="\d{3}-?\d{4}" size="8" class="mfp mfp_50" value="<?php if(!empty($postdatas->PostData['postcode'])) { echo $postdatas->PostData['postcode']; } ?>" required>
                <a href="http://www.post.japanpost.jp/zipcode/" target="_blank">郵便番号を調べる</a>
            </td>
        </tr>
        <tr class="mfptr" style="background-color: rgb(232, 238, 249);">
            <th><img src="images/mfp_must.gif" width="30" height="16" alt="必須" class="must" />ご住所</th>
            <td>
                <ol>
                    <li>
                        <span>都道府県</span>
                        <select name="prefectures" id="mfp_el07" class="mfp" required>
                            <option value="" selected="selected">【選択して下さい】</option>
                            <option value="北海道" <?php if(!empty($postdatas->PostData['prefectures']) and $postdatas->PostData['prefectures']==="北海道"){ echo 'selected'; } ?>>北海道</option>
                            <option value="青森県" <?php if(!empty($postdatas->PostData['prefectures']) and $postdatas->PostData['prefectures']==="青森県"){ echo 'selected'; } ?>>青森県</option>
                            <option value="岩手県" <?php if(!empty($postdatas->PostData['prefectures']) and $postdatas->PostData['prefectures']==="岩手県"){ echo 'selected'; } ?>>岩手県</option>
                            <option value="宮城県" <?php if(!empty($postdatas->PostData['prefectures']) and $postdatas->PostData['prefectures']==="宮城県"){ echo 'selected'; } ?>>宮城県</option>
                            <option value="秋田県" <?php if(!empty($postdatas->PostData['prefectures']) and $postdatas->PostData['prefectures']==="秋田県"){ echo 'selected'; } ?>>秋田県</option>
                            <option value="山形県" <?php if(!empty($postdatas->PostData['prefectures']) and $postdatas->PostData['prefectures']==="山形県"){ echo 'selected'; } ?>>山形県</option>
                            <option value="福島県" <?php if(!empty($postdatas->PostData['prefectures']) and $postdatas->PostData['prefectures']==="福島県"){ echo 'selected'; } ?>>福島県</option>
                            <option value="茨城県" <?php if(!empty($postdatas->PostData['prefectures']) and $postdatas->PostData['prefectures']==="茨城県"){ echo 'selected'; } ?>>茨城県</option>
                            <option value="栃木県" <?php if(!empty($postdatas->PostData['prefectures']) and $postdatas->PostData['prefectures']==="栃木県"){ echo 'selected'; } ?>>栃木県</option>
                            <option value="群馬県" <?php if(!empty($postdatas->PostData['prefectures']) and $postdatas->PostData['prefectures']==="群馬県"){ echo 'selected'; } ?>>群馬県</option>
                            <option value="埼玉県" <?php if(!empty($postdatas->PostData['prefectures']) and $postdatas->PostData['prefectures']==="埼玉県"){ echo 'selected'; } ?>>埼玉県</option>
                            <option value="千葉県" <?php if(!empty($postdatas->PostData['prefectures']) and $postdatas->PostData['prefectures']==="千葉県"){ echo 'selected'; } ?>>千葉県</option>
                            <option value="東京都" <?php if(!empty($postdatas->PostData['prefectures']) and $postdatas->PostData['prefectures']==="東京都"){ echo 'selected'; } ?>>東京都</option>
                            <option value="神奈川県" <?php if(!empty($postdatas->PostData['prefectures']) and $postdatas->PostData['prefectures']==="神奈川県"){ echo 'selected'; } ?>>神奈川県</option>
                            <option value="新潟県" <?php if(!empty($postdatas->PostData['prefectures']) and $postdatas->PostData['prefectures']==="新潟県"){ echo 'selected'; } ?>>新潟県</option>
                            <option value="富山県" <?php if(!empty($postdatas->PostData['prefectures']) and $postdatas->PostData['prefectures']==="富山県"){ echo 'selected'; } ?>>富山県</option>
                            <option value="石川県" <?php if(!empty($postdatas->PostData['prefectures']) and $postdatas->PostData['prefectures']==="石川県"){ echo 'selected'; } ?>>石川県</option>
                            <option value="福井県" <?php if(!empty($postdatas->PostData['prefectures']) and $postdatas->PostData['prefectures']==="福井県"){ echo 'selected'; } ?>>福井県</option>
                            <option value="山梨県" <?php if(!empty($postdatas->PostData['prefectures']) and $postdatas->PostData['prefectures']==="山梨県"){ echo 'selected'; } ?>>山梨県</option>
                            <option value="長野県" <?php if(!empty($postdatas->PostData['prefectures']) and $postdatas->PostData['prefectures']==="長野県"){ echo 'selected'; } ?>>長野県</option>
                            <option value="岐阜県" <?php if(!empty($postdatas->PostData['prefectures']) and $postdatas->PostData['prefectures']==="岐阜県"){ echo 'selected'; } ?>>岐阜県</option>
                            <option value="静岡県" <?php if(!empty($postdatas->PostData['prefectures']) and $postdatas->PostData['prefectures']==="静岡県"){ echo 'selected'; } ?>>静岡県</option>
                            <option value="愛知県" <?php if(!empty($postdatas->PostData['prefectures']) and $postdatas->PostData['prefectures']==="愛知県"){ echo 'selected'; } ?>>愛知県</option>
                            <option value="三重県" <?php if(!empty($postdatas->PostData['prefectures']) and $postdatas->PostData['prefectures']==="三重県"){ echo 'selected'; } ?>>三重県</option>
                            <option value="滋賀県" <?php if(!empty($postdatas->PostData['prefectures']) and $postdatas->PostData['prefectures']==="滋賀県"){ echo 'selected'; } ?>>滋賀県</option>
                            <option value="京都府" <?php if(!empty($postdatas->PostData['prefectures']) and $postdatas->PostData['prefectures']==="京都府"){ echo 'selected'; } ?>>京都府</option>
                            <option value="大阪府" <?php if(!empty($postdatas->PostData['prefectures']) and $postdatas->PostData['prefectures']==="大阪府"){ echo 'selected'; } ?>>大阪府</option>
                            <option value="兵庫県" <?php if(!empty($postdatas->PostData['prefectures']) and $postdatas->PostData['prefectures']==="兵庫県"){ echo 'selected'; } ?>>兵庫県</option>
                            <option value="奈良県" <?php if(!empty($postdatas->PostData['prefectures']) and $postdatas->PostData['prefectures']==="奈良県"){ echo 'selected'; } ?>>奈良県</option>
                            <option value="和歌山県" <?php if(!empty($postdatas->PostData['prefectures']) and $postdatas->PostData['prefectures']==="和歌山県"){ echo 'selected'; } ?>>和歌山県</option>
                            <option value="鳥取県" <?php if(!empty($postdatas->PostData['prefectures']) and $postdatas->PostData['prefectures']==="鳥取県"){ echo 'selected'; } ?>>鳥取県</option>
                            <option value="島根県" <?php if(!empty($postdatas->PostData['prefectures']) and $postdatas->PostData['prefectures']==="島根県"){ echo 'selected'; } ?>>島根県</option>
                            <option value="岡山県" <?php if(!empty($postdatas->PostData['prefectures']) and $postdatas->PostData['prefectures']==="岡山県"){ echo 'selected'; } ?>>岡山県</option>
                            <option value="広島県" <?php if(!empty($postdatas->PostData['prefectures']) and $postdatas->PostData['prefectures']==="広島県"){ echo 'selected'; } ?>>広島県</option>
                            <option value="山口県" <?php if(!empty($postdatas->PostData['prefectures']) and $postdatas->PostData['prefectures']==="山口県"){ echo 'selected'; } ?>>山口県</option>
                            <option value="徳島県" <?php if(!empty($postdatas->PostData['prefectures']) and $postdatas->PostData['prefectures']==="徳島県"){ echo 'selected'; } ?>>徳島県</option>
                            <option value="香川県" <?php if(!empty($postdatas->PostData['prefectures']) and $postdatas->PostData['prefectures']==="香川県"){ echo 'selected'; } ?>>香川県</option>
                            <option value="愛媛県" <?php if(!empty($postdatas->PostData['prefectures']) and $postdatas->PostData['prefectures']==="愛媛県"){ echo 'selected'; } ?>>愛媛県</option>
                            <option value="高知県" <?php if(!empty($postdatas->PostData['prefectures']) and $postdatas->PostData['prefectures']==="高知県"){ echo 'selected'; } ?>>高知県</option>
                            <option value="福岡県" <?php if(!empty($postdatas->PostData['prefectures']) and $postdatas->PostData['prefectures']==="福岡県"){ echo 'selected'; } ?>>福岡県</option>
                            <option value="佐賀県" <?php if(!empty($postdatas->PostData['prefectures']) and $postdatas->PostData['prefectures']==="佐賀県"){ echo 'selected'; } ?>>佐賀県</option>
                            <option value="長崎県" <?php if(!empty($postdatas->PostData['prefectures']) and $postdatas->PostData['prefectures']==="長崎県"){ echo 'selected'; } ?>>長崎県</option>
                            <option value="熊本県" <?php if(!empty($postdatas->PostData['prefectures']) and $postdatas->PostData['prefectures']==="熊本県"){ echo 'selected'; } ?>>熊本県</option>
                            <option value="大分県" <?php if(!empty($postdatas->PostData['prefectures']) and $postdatas->PostData['prefectures']==="大分県"){ echo 'selected'; } ?>>大分県</option>
                            <option value="宮崎県" <?php if(!empty($postdatas->PostData['prefectures']) and $postdatas->PostData['prefectures']==="宮崎県"){ echo 'selected'; } ?>>宮崎県</option>
                            <option value="鹿児島県" <?php if(!empty($postdatas->PostData['prefectures']) and $postdatas->PostData['prefectures']==="鹿児島県"){ echo 'selected'; } ?>>鹿児島県</option>
                            <option value="沖縄県" <?php if(!empty($postdatas->PostData['prefectures']) and $postdatas->PostData['prefectures']==="沖縄県"){ echo 'selected'; } ?>>沖縄県</option>
                        </select>
                    </li>
                    <li>
                        <span>市町村</span>
                        <input name="city" type="text" class="mfp" id="市町村(必須)" size="50" value="<?php if(!empty($postdatas->PostData['city'])) { echo $postdatas->PostData['city']; } ?>" required />
                    </li>
                    <li>
                        それ以降の住所
                        <br />
                        <input type="text" name="address" size="60" class="mfp" value="<?php if(!empty($postdatas->PostData['address'])) { echo $postdatas->PostData['address']; } ?>" required />
                    </li>
                </ol>
            </td>
        </tr>
        <tr class="mfptr">
            <th><img src="images/mfp_must.gif" width="30" height="16" alt="必須" class="must" />電話番号</th>
            <td>
                <input type="tel" name="tel" size="12" class="mfp mfp_50" value="<?php if(!empty($postdatas->PostData['tel'])) { echo $postdatas->PostData['tel']; } ?>" required />
                <br class="sp_only">（半角数字　例:123-456-7890）
            </td>
        </tr>
        <tr class="mfptr" style="background-color: rgb(232, 238, 249);">
            <th>携帯番号</th>
            <td>
                <input name="mobiletel" type="mobiletel" class="mfp" id="携帯番号 mfp_50" size="20" value="<?php if(!empty($postdatas->PostData['mobiletel'])) { echo $postdatas->PostData['mobiletel']; } ?>" /><br class="sp_only">
                （半角数字　例:123-456-7890）
            </td>
        </tr>
        <tr class="mfptr">
            <th>
                <img src="images/mfp_must.gif" width="30" height="16" alt="必須" class="must" />メールアドレス
            </th>
            <td>
                <input type="email" name="email" size="40" class="mfp" id="email(必須)" value="<?php if(!empty($postdatas->PostData['email'])) { echo $postdatas->PostData['email']; } ?>" required />
                <div id="errormsg_email" class="mfp_err"></div>
            </td>
        </tr>
        <tr class="mfptr" style="background-color: rgb(232, 238, 249);">
            <th>メールアドレス確認用</th>
            <td>
                <input name="emailconfirm" type="text" class="mfp" id="メールアドレス確認用" size="40" value="<?php if(!empty($postdatas->PostData['emailconfirm'])) { echo $postdatas->PostData['emailconfirm']; } ?>" />
            </td>
        </tr>
        <tr class="mfptr">
            <th>
                <img src="images/mfp_must.gif" width="30" height="16" alt="必須" class="must" />内容
            </th>
            <td>
                <textarea name="contact" id="内容(必須)" rows="5" cols="60" class="mfp" required><?php if(!empty($postdatas->PostData['contact'])) { echo $postdatas->PostData['contact']; } ?></textarea>
            </td>
        </tr>
        <tr class="mfptr" style="background-color: rgb(232, 238, 249);">
            <th>備考</th>
            <td>
                <textarea name="biko" id="備考" rows="5" cols="60" class="mfp"><?php if(!empty($postdatas->PostData['biko'])) { echo $postdatas->PostData['biko']; } ?></textarea>
            </td>
        </tr>
        <tr class="mfptr mfptrLast">
            <th></th>
            <td>
                <p>【個人情報の利用目的】<br />
                    個人情報の取り扱いに関しては、「<a href="../privacy/index.html">プライバシーポリシー</a>」をご確認ください。プライバシーポリシーをご確認の上、同意をいただける場合は「確認画面へ」ボタンをクリックしてお進みください。<br />
                </p>
                <p></p>
            </td>
        </tr>
    </table>
    <br class="sp_only">
    <div id="mfp_buttons">
        <ul>
            <li>
                <input type="reset" id="button_mfp_reset" value="" src="images/mfp_reset_over.gif">
            </li>
            <li>
                <input type="submit" id="button_mfp_goconfirm" value="" src="images/mfp_goconfirm.gif">
            </li>
        </ul>
    </div>
    <br class="sp_only">
    <input type="hidden" name="csrf" value="<?php echo $_SESSION['csrf_token']; ?>">
</form>