@extends('layouts.resume_layout')

@section('title', 'Resume')

@section('styles')

<style>
	#resume {
		padding:20px;
		border: 1px dotted silver;
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

					output += '<div style="margin-bottom:40px;" class="sortable-item" id="item_' + item.id + '" >';
					output += '<h4 style="margin-bottom:0px; color:#777;">' + item.start_date + ' to ' + item.end_date + '</h4>';
					output += '<h3 style="margin-top:4px">' + item.company + ' | ' + item.role + '</h3>';
					output += 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid exercitationem eum nobis autem alias. Quasi veritatis, laudantium ut, voluptatum ducimus in reiciendis recusandae reprehenderit unde totam excepturi nam. Voluptatibus, distinctio.';
					output += 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid exercitationem eum nobis autem alias. Quasi veritatis, laudantium ut, voluptatum ducimus in reiciendis recusandae reprehenderit unde totam excepturi nam. Voluptatibus, distinctio.';
					output += 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid exercitationem eum nobis autem alias. Quasi veritatis, laudantium ut, voluptatum ducimus in reiciendis recusandae reprehenderit unde totam excepturi nam. Voluptatibus, distinctio.';
					output += 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid exercitationem eum nobis autem alias. Quasi veritatis, laudantium ut, voluptatum ducimus in reiciendis recusandae reprehenderit unde totam excepturi nam. Voluptatibus, distinctio.';
					output += 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid exercitationem eum nobis autem alias. Quasi veritatis, laudantium ut, voluptatum ducimus in reiciendis recusandae reprehenderit unde totam excepturi nam. Voluptatibus, distinctio.';
					output += '</div>';

				});

				

				$('#resume').append(output);
			}
		});

		$('#resume').sortable({
			stop: function( event, ui ) {

				var order = $(this).sortable( "toArray");
				alert(order);
			}

		});

	});
</script>


@endsection