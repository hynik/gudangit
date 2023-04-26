<script>
  <?php $parseParams = explode('/', url()->current())[5] ?>
  $(function() {
    $('#tbMasterBarang').DataTable({
      responsive: true,
      searchPanes: {
        layout: 'columns-2'
      },
    });
    $('.toastrDefaultError').click(function() {
      console.log("clicked");
    });
    <?php

    if ($errors->any()) :
      foreach ($errors->all() as $err) : ?>
        toastr.error('<?= $err ?>')
    <?php
      endforeach;
    endif;
    ?>

    <?php if ($parseParams == "data-barang") : ?>
      if ($("#customRadioMasuk").is(":checked")) {
        $("#selectorDist").attr("disabled", true);
      }

      $("#customRadioMasuk").click(() => {
        $("#selectorDist").attr("disabled", true);
      });
      $("#customRadioKeluar").click(() => {
        $("#selectorDist").attr("disabled", true);
      });

      $("#customRadioDist").click(() => {
        $("#selectorDist").attr("disabled", false);
      });
    <?php endif ?>
  });
</script>