'use strict'

$('.btn').click(function(event){
  event.preventDefault()
  event.stopPropagation()
	$.ajax({
		url:'index.php',
		type:'POST',
		data:$('.form').serialize(),
		beforeSend:function (){
			$('.loader').fadeIn()
		},
		success:function(responce){
			$('.loader').fadeOut('slow', function(){
				let res = JSON.parse(responce);
				console.log(res);
				$('.form').trigger('reset')

			});
		},
		error:function(){
			alert('erroR!!')
		}
	})
})