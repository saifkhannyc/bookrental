<!-- Footer section code starts from here -->
<footer>
 <div class="container">
  <div class="row">
   <div class="col-md-3">
    <h4>About</h4>
    <ul>
     <li><a href="">Our Library History</a></li>
     <li><a href="">Our Staff</a></li>
     <li><a href="">Rental Rules</a></li>
     <li><a href="">Terms & Conditions</a></li>
     <li><a href="">Privary Policy</a></li>
    </ul>
   </div>
   <div class="col-md-3">
    <h4>Member Services</h4>
    <ul>
     <li><a href="">How to Reserve</a></li>
     <li><a href="">Our Collections</a></li>
     <li><a href="">Booking Status</a></li>
     <li><a href="">Renewal</a></li>
     <li><a href="">Subscription</a></li>
    </ul>
   </div>
   <div class="col-md-6">
    <h3>Newsletter</h3>
    <p>Join Our Mailing List Today!</p>
    <form class="form-inline my-2 my-md-0">
     <div class="input-group mb-3">
      <input type="text" class="form-control" placeholder="" aria-label="Recipient's username"
       aria-describedby="basic-addon2" />
      <div class="input-group-append">
       <span class="input-group-text" id="basic-addon2"><i class="fa fa-paper-plane"></i></span>
      </div>
     </div>
    </form>
    <div class="social-icons">
     <ul>
      <li><i class="fa fa-instagram"></i></li>
      <li><i class="fa fa-facebook"></i></li>
      <li><i class="fa fa-twitter"></i></li>
      <li><i class="fa fa-whatsapp"></i></li>
     </ul>
    </div>
   </div>
  </div>
 </div>
</footer>
<!-- Footer section code ends here -->
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="assets/js/jquery-modal-video.min.js"></script>
<script src="assets/js/script.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
// When the document is ready
$(document).ready(function() {

 $('#from_date').datepicker({
  autoclose: true,
  todayHighlight: true,
  format: "yyyy-mm-dd"
 }).datepicker('update', new Date());

 $('#to_date').datepicker({
  autoclose: true,
  todayHighlight: true,
  format: "yyyy-mm-dd"
 }).datepicker('update', new Date());

});
</script>
</body>
<?php 
 ob_end_flush();
?>

</html>