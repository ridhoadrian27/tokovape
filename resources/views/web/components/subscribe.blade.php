<div class="suscribe-area margin-bottom-80">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="subscribe">
          <div class="subscribe-brief">
            <h3>enter your email address</h3>
            {{-- <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</p> --}}

          </div>
          <div class="subscribe-form">
            <form method="post" action="/subscribe" id="updateform">
              @csrf
              <input type="text" name="email" id="email" placeholder="Enter email to subscribe" />
              <button type="button" id="submitcontact">Submit</button>
            </form>
            <script type="text/javascript">
                $(document).ready(function() {

                  $("#submitcontact").click(function(){

                    var dataform = $("#updateform").serialize();

                    var token = $("input[name='_token']").val();
                    var email = $("#email").val();

                    if(email.length == 0){
                      alert("Maaf, Email tidak boleh kosong");
                      $("#email").focus();
                      return (false);
                    }

                    $.ajax({
                      type: "POST",
                      url : "/subscribe",
                      data: dataform,
                      beforeSend: function() {
                        $.LoadingOverlay("show");
                      },
                      success: function(msg){
                        document.location.href="/subscribesuccess";
                        //location.reload();
                      }
                    });

                  });

                });
          </script>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
