$(document).ready(function(){
    
    // Dropdown languages
    // ===============================
    $(".login_nav ul li.languages").hover(
        function(){
            $(this).find("ul").show();
        },
        function(){
            $(this).find("ul").hide();
        }
    );

	// Dropdown topbar nav
    // ===============================
    $("body").bind("click", function (e) {
        $('a.menu').parent("li").removeClass("open");
    });

    $("a.menu").click(function (e) {
		$('a.menu').parent("li").removeClass("open");
        var $li = $(this).parent("li").toggleClass('open');
        return false;
    });
    
    // Close alerts
    // ===============================
    $(".alert-message .close").bind("click", function(e) {
       $(this).parent().fadeOut('slow'); 
    });
    
    // Close item contact modal
    // ===============================
    $(".item-contact .close").bind("click", function(e) {
       $(this).parent().parent().parent().fadeOut('slow'); 
    });
    
    // Select with choosen
    $(".chzn-select").chosen();
    
    
	/*// User_menu show/hide submenu
	$("#user_menu .with_sub").hover(function(){
		$(this).find("ul").show();
	},
	function(){
		$(this).find("ul").hide();
	});
	
	// Flash messages effect
	$("#FlashMessage").slideDown('slow').delay(3000).slideUp('slow');
    
	// Open login box in situ
        $('#login_open').click(function(e) {
            e.preventDefault();
            $('#login').slideToggle('slow', function(){});
        });

	
	// Show advanced search in internal pages
	$("#expand_advanced").click(function(e){
		e.preventDefault();
		$(".search .extras").slideToggle();
	});
	
	// Show/hide Report as 
	$("#report").hover(function(){
		$(this).find("span").show();
	},
	function(){
		$(this).find("span").hide();
	});*/
});