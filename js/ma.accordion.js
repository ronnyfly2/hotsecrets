(function($jq){
     $jq.fn.extend({  
         accordion: function() {       
            return this.each(function() {
            	
            	var $jqul = $jq(this);
            	
				if($jqul.data('accordiated'))
					return false;
													
				$jq.each($jqul.find('ul, li>div'), function(){
					$jq(this).data('accordiated', true);
					$jq(this).hide();
				});
				
				$jq.each($jqul.find('span.head'), function(){
					$jq(this).click(function(e){
						activate(this);
						return void(0);
					});
				});
				
				var active = (location.hash)?$jq(this).find('a[href=' + location.hash + ']')[0]:'';

				if(active){
					activate(active, 'toggle');
					$jq(active).parents().show();
				}
				
				function activate(el,effect){
					$jq(el).parent('li').toggleClass('active').siblings().removeClass('active').children('ul, div').slideUp('fast');
					$jq(el).siblings('ul, div')[(effect || 'slideToggle')]((!effect)?'fast':null);
				}
				
            });
        } 
    }); 
})($jq);

$jq(document).ready(function () {
	
	$jq("ul.accordion li.parent").each(function(){
        $jq(this).append('<span class="head"><a href="javascript:void(0)"></a></span>');
      });
	
	$jq('ul.accordion').accordion();
	
	$jq("ul.accordion li.active").each(function(){
		$jq(this).children().next("ul").css('display', 'block');
	});
});