	$(function(){
		/* Load Tabs */
		//$("#tabs").tabs();
		$('#topbar').dropdown()

		//$('.tabs').tabs();
		//$('.qsos').tabs();
		
		$('#qsoTab a').click(function (e) {
		  e.preventDefault();
		  $(this).tab('show');
		})

		/* Theme buttons */
		//$( "button, input:submit", ".wrap_content" ).button();
		//$( "button, input:reset", ".wrap_content" ).button();
		//$( "button, input:submit", ".contest_wrap" ).button();

		/* Subnav options */
		//$( "#admin" ).click(function() {
		//	$( "#submenu" ).toggle( 'blinds', null, 500 );
		///	$( "#clear" ).toggle( 'blinds', null, 500 );
		//	return false;
		//});
	});