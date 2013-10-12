(function() {

  $(function() {
    // $("#btn-register").click(function() {
    //   $(".form-login").hide();
    //   $(".form-register").show();
    //   $(".form-forgot").hide();
    //   $("#register-container").show();
    //   $("#btn-register-user").show();
    //   $(".form-register .alert").hide();
    // });
    // $(".btn-back").click(function() {
    //   $(".form-login").show();
    //   $(".form-register").hide();
    //   $(".form-forgot").hide();
    // });
    // $("#link-forgot").click(function() {
    //   $(".form-login").hide();
    //   $(".form-register").hide();
    //   $(".form-forgot").show();
    // });
    // $("#btn-register-user").click(function() {
    //   $(".form-register .alert").show();
    //   $("#register-container").hide();
    //   $("#btn-register-user").hide();
    // });
    $('#loading-block').fadeOut();
    $('#btn-signin').click(function() {
      var self = $(this);
      self.html('正在登录...');
      self.attr('disabled', 'disabled');
      $('#loading-block').show();
      $.post(self.parents('form').attr('action'), {
        account: $('#account').val(),
        password: $('#password').val()
      }, function(data){
        console.log(data);
        if (data.code == 1) {
          location.href= "/";
        } else {
          self.html('登录');
          self.removeAttr('disabled');  
        }
        
      },'json');

      return false;
    });
  });

}).call(this);
