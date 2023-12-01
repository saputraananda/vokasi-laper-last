// init Isotope
var $grid = $('.collection-list').isotope({
    // options
  });
  // filter items on button click
  $('.filter-button-group').on( 'click', 'button', function() {
    var filterValue = $(this).attr('data-filter');
    resetFilterBtns();
    $(this).addClass('active-filter-btn');
    $grid.isotope({ filter: filterValue });
  });
  
  var filterBtns = $('.filter-button-group').find('button');
  function resetFilterBtns(){
    filterBtns.each(function(){
      $(this).removeClass('active-filter-btn');
    });
  }



/* ============ TITLE TOOLTIP TOOGLE ============== */
	
$(function () 
{
	$('[data-toggle="tooltip"]').tooltip();
});


/* =========== VALIDATE ADMIN LOGIN FORM ======== */

function validateLoginForm() 
{
	var username_input = document.forms["login-form"]["username"].value;
	var password_input = document.forms["login-form"]["password"].value;
	  
	if (username_input == "" && password_input == "") 
	{
		document.getElementById('username_required').style.display = 'block';
		document.getElementById('password_required').style.display = 'block';
	  return false;
	}
	
	if (username_input == "") 
	{
		document.getElementById('username_required').style.display = 'block';
		return false;
	}
	
	if(password_input == "")
	{
		document.getElementById('password_required').style.display = 'block';
		return false;
	}
}

/* =========== DASHBOARD TOGGLE ORDERS TABS ======== */

function openTab(evt, tabName, tabContent, tabLinks) 
{
    var i, tabcontent, tablinks;

    tabcontent = document.getElementsByClassName(tabContent);

    for (i = 0; i < tabcontent.length; i++) 
    {
        tabcontent[i].style.display = "none";
    }
    
    tablinks = document.getElementsByClassName(tabLinks);

    for (i = 0; i < tablinks.length; i++) 
    {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
  
    document.getElementById(tabName).style.display = "table";
    evt.currentTarget.className += " active";
}