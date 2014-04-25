$(document).ready(function($) {
    $('textarea').attr('placeholder', 'message');
	$('#gwidget-text-4-1').attr('placeholder', 'name');
	$('#gwidget-text-4-2').attr('placeholder', 'e-mail address');
});
$(function() {
	$('[placeholder]').ahPlaceholder({
		placeholderColor : 'silver',
		placeholderAttr : 'placeholder',
		likeApple : false
		});
		

   $('div[class*="textwidget"]').each(function(){
  	$(this).replaceWith($(this).html());
  });
  
});
</script>
<?php wp_enqueue_script(
    'function', //�X�N���v�g�̌ŗL��
    get_template_directory_uri() . '/js/jquery.ah-placeholder.js', //�X�N���v�g�t�@�C���ւ̃p�X
    array('jquery') //�g�����C�u����
); ?>