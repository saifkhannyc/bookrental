<div class="footer">
 <div class="container">
  <b class="copyright">&copy; 2021 Online Library Portal - Queens Library </b>All rights reserved.
 </div>
</div>
<script src="./scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="./scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
<script src="./bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="./scripts/flot/jquery.flot.js" type="text/javascript"></script>
<script src="./scripts/flot/jquery.flot.resize.js" type="text/javascript"></script>
<script src="./scripts/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="./scripts/common.js" type="text/javascript"></script>
<!-- CK Editor  -->
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script>
CKEDITOR.replace('cat_desc');
</script>
<script>
CKEDITOR.replace('book_desc');
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
// When the document is ready
$(document).ready(function() {

 $('#datereceived').datepicker({
  autoclose: true,
  todayHighlight: true,
  format: "yyyy-mm-dd"
 }).datepicker('update', new Date());

});
</script>

<?php 
 ob_end_flush();
?>
</body>