//login modal
$(document).ready(function(){
    // Get the modal
    var modal = document.getElementById("myModalLogin");
    var modal_btn = document.getElementById("login-btn");
    var close_btn = document.getElementById("loginClose-btn");
    
    modal_btn.onclick = function() {
        $("#myModalLogin").fadeIn("slow");
    }
    
    close_btn.onclick = function() {
        $("#myModalLogin").fadeOut("slow");
    }
    
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
});

//sign up modal
$(document).ready(function(){
    // Get the modal
    var modalSign = document.getElementById("myModalSign");
    var sign_btn = document.getElementById("signUp-btn");
    var signClose_btn = document.getElementById("signClose-btn");
    
    sign_btn.onclick = function() {
        $("#myModalSign").fadeIn("slow");
    }
    
    signClose_btn.onclick = function() {
        $("#myModalSign").fadeOut("slow");
    }
    
    window.onclick = function(event) {
      if (event.target == modalSign) {
        modalSign.style.display = "none";
      }
    }
});


//sliding scroll animation right -> left
$(window).scroll( function(){
    var scroll = $(window).scrollTop();
    //hero animation
    $(".hero").css({
      transform:
        "translate3d(0, +" +
        scroll / 100 +
        "%, 0) scale(" +
        (100 - scroll / 100) / 100 +
        ")",
    });

    //slide in from left to center animation
    $('.slideinleft').each( function(i){
        
        var bottom_of_element = $(this).offset().top + $(this).outerHeight();
        var bottom_of_window = $(window).scrollTop() + $(window).height();
        
        if( bottom_of_window > bottom_of_element ){
            $(this).animate({'margin-left':'0px'},1000);
        }
        
    });
    
    $('.slideinright').each( function(i){
        
        var bottom_of_element = $(this).offset().top + $(this).outerHeight();
        var bottom_of_window = $(window).scrollTop() + $(window).height();
        
        if( bottom_of_window > bottom_of_element ){
            $(this).animate({'margin-left':'0px'},1200);
        }
        
    }); 
});


