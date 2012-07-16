$(function () {
	$('.datepicker').datepicker({
		closeText: '关闭',
		currentText: '今天：yy/mm/dd',
		dateFormat: 'yy/mm/dd (D)',
		dayNames: ['日', '一', '二', '三', '四', '五', '六'],
		dayNamesMin: ['日', '一', '二', '三', '四', '五', '六'],
		dayNamesShort: ['日', '一', '二', '三', '四', '五', '六'],
		hideIfNoPrevNext: true,
		maxDate: '+1y',
		minDate: new Date(),
		monthNames: ['/01', '/02', '/03', '/04', '/05', '/06', '/07', '/08', '/09', '/10', '/11', '/12'],
		navigationAsDateFormat: true,
		nextText: 'yy/mm',
		numberOfMonths: 2,
		prevText: 'yy/mm',
		showButtonPanel: true,
		showMonthAfterYear: true,
		showOtherMonths: true,
		stepMonths: 2
	});
});
