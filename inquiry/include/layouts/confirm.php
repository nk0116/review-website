<br class="pc_only">
<br />
<p>下記内容をご確認いただき送信ボタンをクリックしてください。</p><br />

<table border="0" cellpadding="0" cellspacing="0" class="mailform" summary="mailform main">
    <tr class="mfptr" style="background-color: rgb(232, 238, 249);">
        <th><img src="images/mfp_must.gif" width="30" height="16" alt="必須" class="must" />お名前</th>
        <td>
            <?php if(!empty($postdatas->PostData['name'])) {  echo $postdatas->PostData['name']; } ?>
        </td>
    </tr>
    <tr class="mfptr">
        <th>郵便番号</th>
        <td>
            <?php if(!empty($postdatas->PostData['postcode'])) {  echo $postdatas->PostData['postcode']; } ?>
        </td>
    </tr>
    <tr class="mfptr" style="background-color: rgb(232, 238, 249);">
        <th><img src="images/mfp_must.gif" width="30" height="16" alt="必須" class="must" />ご住所</th>
        <td>
            <ol>
                <li>
                    <span>都道府県</span>
                    <?php if(!empty($postdatas->PostData['prefectures'])) {  echo $postdatas->PostData['prefectures']; } ?>
                </li>
                <li>
                    <span>市町村</span>
                    <?php if(!empty($postdatas->PostData['city'])) {  echo $postdatas->PostData['city']; } ?>
                </li>
                <li>
                    それ以降の住所
                    <br />
                    <span>市町村</span>
                    <?php if(!empty($postdatas->PostData['address'])) {  echo $postdatas->PostData['address']; } ?>
                </li>
            </ol>
        </td>
    </tr>
    <tr class="mfptr">
        <th><img src="images/mfp_must.gif" width="30" height="16" alt="必須" class="must" />電話番号</th>
        <td>
            <?php if(!empty($postdatas->PostData['tel'])) {  echo $postdatas->PostData['tel']; } ?>
        </td>
    </tr>
    <tr class="mfptr" style="background-color: rgb(232, 238, 249);">
        <th>携帯番号</th>
        <td>
            <?php if(!empty($postdatas->PostData['mobiletel'])) {  echo $postdatas->PostData['mobiletel']; } ?>
        </td>
    </tr>
    <tr class="mfptr">
        <th>
            <img src="images/mfp_must.gif" width="30" height="16" alt="必須" class="must" />メールアドレス
        </th>
        <td>
            <?php if(!empty($postdatas->PostData['email'])) {  echo $postdatas->PostData['email']; } ?>
        </td>
    </tr>
    <tr class="mfptr" style="background-color: rgb(232, 238, 249);">
        <th>メールアドレス確認用</th>
        <td>
            <?php if(!empty($postdatas->PostData['emailconfirm'])) {  echo $postdatas->PostData['emailconfirm']; } ?>
        </td>
    </tr>
    <tr class="mfptr">
        <th>
            <img src="images/mfp_must.gif" width="30" height="16" alt="必須" class="must" />内容
        </th>
        <td>
            <?php echo nl2br($postdatas->PostData['contact']); ?>
        </td>
    </tr>
    <tr class="mfptr" style="background-color: rgb(232, 238, 249);">
        <th>備考</th>
        <td>
            <?php echo nl2br($postdatas->PostData['biko']); ?>
        </td>
    </tr>
    <tr class="mfptr mfptrLast">
        <th></th>
        <td>
            <p>【個人情報の利用目的】<br />
                個人情報の取り扱いに関しては、「<a href="../privacy/index.php">プライバシーポリシー</a>」をご確認ください。プライバシーポリシーをご確認の上、同意をいただける場合は「確認画面へ」ボタンをクリックしてお進みください。<br />
            </p>
            <p></p>
        </td>
    </tr>
</table>


<div id="mfp_buttons">
    <ul style="    display: flex; align-items: center;    justify-content: space-between;">
        <li style="width: 100px;">
            <form action="index.php" method="post">
                <?php $postdatas->FormDataBack(); ?>
                <input class="form_submit_button" type="image" src="images/mfp_resetSp.png" value="入力画面へ戻る" style="width: 100%;margin:2% 0 0 0;">
            </form>
        </li>
        <li>
            <form action="thanks.php" method="post">
                <?php $postdatas->FormDataBack(); ?>
                <input type="hidden" name="csrfthanks" value="<?php echo $_SESSION['csrf_token_thanks']; ?>">
                <input class="form_submit_button" type="image" src="images/mfp_send.gif" value="送信する">
            </form>
        </li>
    </ul>


</div>