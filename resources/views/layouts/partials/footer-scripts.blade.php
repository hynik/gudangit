@if (!empty(session()->get('success')))
<script>
    toastr.success("<?= session()->get('success')[0] ?>", "Yeayy.. Berhasil");
</script>
<?php session()->now('success', session()->get('success')); ?>
@elseif (!empty(session()->get('info')))
<script>
    toastr.info("<?= session()->get('info')[0] ?>", "Info Maseh");
</script>
<?php session()->now('info', session()->get('info')); ?>
@elseif (!empty(session()->get('warning')))
<script>
    toastr.warning("<?= session()->get('warning')[0] ?>", "Awass..");
</script>
<?php session()->now('warning', session()->get('warning')); ?>
@elseif (!empty(session()->get('error')))
<script>
    toastr.error("<?= session()->get('error')[0] ?>", "Gak Bahaya Taa..");
</script>
<?php session()->now('error', session()->get('error')); ?>
@endif