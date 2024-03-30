
// Cookie to remember what options are selected

$(function() {
    var navValue = localStorage.getItem("navValue");
    if (navValue != null) {
        $("#nav-options").val(navValue);
    }

    $("#nav-options").on("change", function() {
        localStorage.setItem("navValue", $(this).val());
    });
})

$(function() {
    var footerValue = localStorage.getItem("footerValue");
    if (footerValue != null) {
        $("#footer-options").val(footerValue);
    }

    $("#footer-options").on("change", function() {
        localStorage.setItem("footerValue", $(this).val());
    });
})
$(function() {
		var layoutValue = localStorage.getItem("layoutValue");
		if (layoutValue != null) {
			$("#nav-options2").val(layoutValue);
		}

		$("#nav-options2").on("change", function() {
			localStorage.setItem("layoutValue", $(this).val());
		});
})
// colored or white nav

$(document).ready(function() {
    if ($('#nav-options').val() == "colored") {
        $("#main-nav").addClass("colored-nav");
        $(".nav-brand img").attr("src", "img/logo_light.png");
    }
			
	  $(".2-footer").hide();
	  $(".3-footer").hide();
	
});
 

$("#nav-options").on('change', function() {
    if ($(this).val() == "colored") {
        $("#main-nav").addClass("colored-nav");
        $(".nav-brand img").attr("src", "img/logo_light.png");
    } else {
        $("#main-nav").removeClass("colored-nav");
        $(".nav-brand img").attr("src", "img/logo.png");
    }
});

// footer options


$(function () {
  $("#footer-options").on('change', function() {
    var val = $(this).val();
    if(val === "footer2") {
        $(".2-footer").show();
        $(".1-footer").hide();
		 $(".3-footer").hide();
    }
    else if(val === "footer3") {
        
          $(".3-footer").show();
        $(".1-footer").hide();
		 $(".2-footer").hide();
    }
  });
});
$(function () {
  $("#footer-options").on('change', function() {
    var val = $(this).val();
    if(val === "footer1") {
        $(".1-footer").show();
        $(".2-footer").hide();
		 $(".3-footer").hide();
    }
   
  });
});


$(document).ready(function() {
    if ($('#footer-options').val() == "footer1") {
         $(".1-footer").show();
        $(".2-footer").hide();
		 $(".3-footer").hide();
    }
	
	if ($('#footer-options').val() == "footer2") {
         $(".1-footer").hide();
        $(".2-footer").show();
		 $(".3-footer").hide();
    }
	if ($('#footer-options').val() == "footer3") {
         $(".1-footer").hide();
        $(".2-footer").hide();
		 $(".3-footer").show();
    }
});

// scroll to footer when selecting footer options

$('#footer-options').on('change', function() {
  
	 $('html,body').animate({scrollTop: document.body.scrollHeight},"fast");
})

// Boxed or full


			
 //reload page on option changer
	
		
	$(document).ready( function() {
					
		$('#nav-options2').on('change',function() {
		location.reload();
		if (window.location.href.indexOf('?') > -1) {
		window.location.href = window.location.pathname;
		}					
		});


		if ($('#nav-options2').val() == "boxed") {
		$('head').append('<link rel="stylesheet" type="text/css" href="switcher/css/boxed.css">');
		}
		else {
		$('head').append('');

		}
		
		//Force boxed if page has boxed string
		 if (window.location.href.indexOf("?boxed") > -1)  {
				$("#nav-options2").val("boxed").change();	
			};
			
			//Force full if page has full string
		 if (window.location.href.indexOf("?full") > -1)  {
				$("#nav-options2").val("full").change();	
			};
	});

	
 
	//Force active link on home pages

	$(function() {
		var loc = window.location.href; // returns the full URL
		if (/index.php/.test(loc) || /index2.php/.test(loc) || /index3.php/.test(loc)){
			$('.home-menu').addClass('active');
		}
	});
	
	


	//Force selected option page

	$(function() {
		var loc = window.location.href; 
		if (/index.php/.test(loc)){
			$("#page-id").val("index.php");
		}
		var loc = window.location.href;
		if (/index2.php/.test(loc)){
			$("#page-id").val("index2.php");
		}
		var loc = window.location.href; 
		if (/index3.php/.test(loc)){
			$("#page-id").val("index3.php");
		}
	});
	
	   // Close switcher when clicked outside


	$(document).click(function() {
	var container = $(".demo_changer");
	if (!container.is(event.target) && !container.has(event.target).length) {
	container.removeClass('active').css( "left" ,"-300px");
	}
	});

	
		