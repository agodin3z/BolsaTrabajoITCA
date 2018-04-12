<?php if (isset($_SESSION['register_err']) && $_SESSION['register_err'][0]) { ?>
  <script type="text/javascript">
    setTimeout(Swal('Oops...', '<?= $_SESSION['register_err'][1] ?>', 'error'),2000);
  </script>
<?php } elseif (isset($_SESSION['register_err']) && !$_SESSION['register_err'][0]) { ?>
  <script type="text/javascript">
    setTimeout(Swal('', '<?= $_SESSION['register_err'][1] ?>', 'success'),2000);
  </script>
<?php } unset($_SESSION['register_err']); ?>
