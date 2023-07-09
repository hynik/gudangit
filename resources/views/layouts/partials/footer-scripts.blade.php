<script>
    <?php

    if ($errors->any()) :
      foreach ($errors->all() as $err) : ?>
        toastr.error('<?= $err ?>')
    <?php
      endforeach;
    endif;
    ?>
</script>