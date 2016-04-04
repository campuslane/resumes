@extends('layouts.resume_layout')

@section('title', 'Resume')

@section('styles')

<style>
	#resume {
		padding:20px;
		border: 1px dotted silver;
	}

	ul {
		margin-bottom:0px;
	}
</style>

@endsection

@section('content')



	<h1>Resume</h1>

	<!-- resume container -->
	<div id="resume"></div>

@endsection

@section('scripts')

<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.hoverintent/1.8.1/jquery.hoverIntent.min.js"></script>

<script>
	$(function(){

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$.ajax({
			type: 'post', 
			url: '/resume', 
			dataType: 'json', 
			success: function(items) {

				var output = '';

				

				$.each(items, function(index, item){

					output += '<div style="margin-bottom:20px;" class="sortable-item" id="item_' + item.id + '" >';

					output += '<div class="tools pull-right" style="display:none; height:20px;"><a href="#">Edit | Add Below | Add Above</a></div>';

					output += '<div class="tools-spacer pull-right"  style="height:20px;"></div>';

					if(item.type == 'section_header') {

						output += '<h2>' + item.section_header + '</h2>';

					} else if (item.type == 'job') {

						output += '<h4>' + item.job_company + ' | ' + item.job_role + '</h4>';
						output += item.job_content;
						
					}
					

					output += '</div>';

						

				});

				

				$('#resume').append(output);

				$(".sortable-item").hoverIntent({
					over: highlight, 
					out: unHighlight, 
					sensitivity: 6, 
					timeout: 300, 
					
				});
			}
		});

		$('#resume').sortable({
			stop: function( event, ui ) {

				var order = $(this).sortable( "toArray");
				//alert(order);
			}

		});

	});

	function highlight () {
		console.log('highlight');
		//$('.sortable-item').not(this).css('opacity', '0.5');
		$('.tools', this).show();
		$('.tools-spacer', this).hide();
	}

	function unHighlight () {
		console.log('un-highlight');
		//$('.sortable-item').css('opacity', '1');
		$('.tools', this).hide();
		$('.tools-spacer', this).show();
	}


</script>


@endsection