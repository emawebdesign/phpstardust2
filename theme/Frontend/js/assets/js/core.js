var infinitePagination = 1;

var loadingScroll = false;

function infiniteLoadContent(url, maxPage, q, noDataMessage) {
				
	if (parseInt(infinitePagination)<=parseInt(maxPage)) {

		$.ajax({
			url: url,
			dataType: 'html',
			data: "page=" + infinitePagination + "&q=" + encodeURIComponent(q),
			success: function(json) {
				
				var obj = JSON.parse(json);
				
				loadingScroll = false;
				
				if (obj.response=="ok") {
					$('#infiniteContent').append(obj.html);
					infinitePagination++;
				} else alert(noDataMessage);	
				
			}
		});
	
	} else {
		loadingScroll = false;
		alert(noDataMessage);
	}
	
}

function infiniteScroll(infiniteUrl, maxPage, qselector, noDataMessage) {
	
	$(window).scroll(function() {
	
		if ($(window).scrollTop() == $(document).height() - $(window).height()) {
			
			if (loadingScroll === false) {
				loadingScroll = true;
				var q = $(qselector).val();
				infiniteLoadContent(infiniteUrl, maxPage, q, noDataMessage);
			}
			
		}
				
	});
	
}

$(document).on('keydown', "#q", function() {
    infinitePagination = 1;
	loadingScroll = false;
	$('#infiniteContent').html('');
});