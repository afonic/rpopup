<?php
defined('_JEXEC') or die;
$image = json_decode($banner->params);
?>
<div id="rpopup-<?php echo $banner->id;?>" class="rpopup-container">
	<div class="rpopup-content">
		<div class="rpopup-close"><div class="rpopup-close-button" data-close="<?php echo $banner->id;?>">X</div></div>
		<div class="rpopup-image">
			<?php if ($banner->clickurl): ?>
			<a class="rpopup-link" data-close="<?php echo $banner->id;?>" href="<?php echo $banner->clickurl; ?>">
			<?php endif; ?>
			<img src="<?php echo $image->imageurl; ?>" alt="<?php echo $image->alt; ?>">
			<?php if ($banner->clickurl): ?>
			</a>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php if ($params->get('inline') == '1'): ?>
<style>
	.rpopup-container {
		position: fixed;
		right: 3%;
		bottom: 0;
		transform: translateY(100%);
		visibility: hidden;
		transition: 0.25s visibility, 0.5s transform;
		z-index: 9999;
	}
	.rpopup-container.open {
		transform: translateY(0);
		visibility: visible;
	}
	.rpopup-close {
		text-align: right;
	}
	.rpopup-close-button {
		display: inline-block;
		font-size: 20px;
		background: #fff;
		padding: 8px 18px;
		cursor: pointer;
		transition: 0.5s background;
	}
	.rpopup-close-button:hover {
		background: #f5f3f3;
	}
</style>
<script>
jQuery.noConflict();
(function($) {
	$(document).ready(function() {
		if ($('.rpopup-container').length > 0) {
			$('.rpopup-container').each(function(){
				var id = $(this).attr('id');
				if (document.cookie.split(';').indexOf(id+'=true') < 0) {
	    			setTimeout(function(){$('#'+id).addClass('open');}, 1500);
				}
			});		
		}
		function setCookie(id) {
			var date = new Date();
			date.setTime(date.getTime()+(3*24*60*60*1000));
			document.cookie = 'rpopup-'+id+'=true;expires='+date.toGMTString()+';path=/';
		}
		$('.rpopup-close-button').click(function(event) {
			var id = $(this).data('close');	
			<?php if ($params->get('gevent') == '1'): ?>
			ga('send','event', {'eventCategory': 'Popup','eventAction': 'Close'});
			<?php endif; ?>
			setCookie(id);
			$('#rpopup-'+id).removeClass('open');

		});
		$('a.rpopup-link').click(function(event) {
			var id = $(this).data('close');
			var href = $(this).href;
			<?php if ($params->get('gevent') == '1'): ?>
			ga('send','event', {'eventCategory': 'Popup','eventAction': 'Click'});
			<?php endif; ?>
			setCookie(id);
			$('#rpopup-'+id).removeClass('open');
			window.location = href;
		});
	});
})(jQuery);
</script>
<?php endif; ?>