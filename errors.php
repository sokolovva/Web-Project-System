<?php  
if (count($errors) > 0) : ?>
  <div class="error">
  	<?php foreach ($errors as $error) : ?>
  	  <p style="font-size:15px">
        <font color="red"><?php echo "*".$error ?></font>
    </p>
  	<?php endforeach ?>
  </div>
<?php  endif ?>