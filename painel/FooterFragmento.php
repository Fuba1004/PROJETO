<!-- /.content-wrapper -->
<footer class="main-footer">
  <strong>Copyright &copy; 2022 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
  All rights reserved.
  <div class="float-right d-none d-sm-inline-block">
    <b>Version</b> 3.1.0
  </div>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="/painel/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="/painel/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="/painel/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="/painel/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="/painel/dist/js/adminlte.js"></script>
<script src="/painel/plugins/toastr/toastr.min.js"></script>

<script src="/painel/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/painel/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script>
  try {
    $(function() {
      $('#tabela-simples').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  } catch (e) {}
</script>

<?php
if (isset($_SESSION["mensagens_painel"])) {
  if (count($_SESSION["mensagens_painel"]) > 0) {
    echo '<script>';
    for ($i = 0; $i < count($_SESSION["mensagens_painel"]); $i++) {
      echo "toastr." . $_SESSION["mensagens_painel"][$i]["tipo"] . "('" . $_SESSION["mensagens_painel"][$i]["menssagem"] . "');";
    }
    echo '</script>';
    $_SESSION["mensagens_painel"] = array();
  }
}
?>
</body>

</html>