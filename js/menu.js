$(document).ready(function() {
	$('#menu2').click(function() {
		$('#content2').css('display', 'block');
		$('#content1').css('display', 'none');
		$('#menu1').css({
			'background-color': '#A6A6A6',
			'color': '#595959',
			'cursor': 'pointer',
			'font-size': '18px'
		});
		$('#menu2').css({
			'background-color': '#F2F2F2',
			'color': '#595959',
			'cursor': 'default',
			'font-size': '22px'
		});
	});
	
	$('#menu1').click(function() {
		$('#content2').css('display', 'none');
		$('#content1').css('display', 'block');
		$('#menu2').css({
			'background-color': '#A6A6A6',
			'color': '#595959',
			'cursor': 'pointer',
			'font-size': '18px'
		});
		$('#menu1').css({
			'background-color': '#F2F2F2',
			'color': '#595959',
			'cursor': 'default',
			'font-size': '22px'
		});
	});
});