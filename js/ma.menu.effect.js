$jq(document).ready(function(){	
	
	// form search
	(function($jq){
		$jq('.search-contain').mouseenter(function() {
			$jq(this).find(".search-content").stop(true, true).slideDown();
		});
		$jq('.search-contain').mouseleave(function() {
			$jq(this).find(".search-content").stop(true, true).slideUp();
		});
	})($jq);
	
});