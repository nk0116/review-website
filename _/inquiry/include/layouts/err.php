<ul class="margin_30 form_err color_ff0000">
    <?php if(is_array($postdatas->err)): foreach ($postdatas->err as $key=> $val): ?>
    <li><?php echo $val; ?></li>
    <?php endforeach; endif; ?>
</ul>