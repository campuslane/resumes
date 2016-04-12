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

	.modal-lg {
		width:82%;
	}

	.container {
		max-width:800px;
	}

	.sortable-item {
		cursor:move;
	}
</style>

@endsection

@section('content')



	<h1>Resume</h1>

	<a tabindex="0" class="btn btn-default" role="button" data-toggle="popover" data-trigger="focus" title="Actions" data-placement="bottom" data-content="Edit | Delete">Dismissible popover</a> 

	<!-- Button trigger modal -->
	<button type="button" class="btn btn-primary add-section-header">
	  Add Section Header
	</button> 
	<button type="button" class="btn btn-primary add-job">
	  Add Job
	</button> 
	<button type="button" class="btn btn-primary add-custom">
	  Add Custom
	</button> 
	<br><br>

	<!-- resume container -->
	<div id="resume"></div>

	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
	      </div>
	      <div class="modal-body">
	        ...
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="dismiss-button btn btn-default" data-dismiss="modal">Close</button>
	        
	      </div>
	    </div>
	  </div>
	</div>

<script id="resume-items-template" type="text/x-handlebars-template">
	@{{#each items}}

		<div style="margin-bottom:20px;" class="sortable-item" id="item_@{{ id }}" >

		<!-- <div class="tools" style="display:none; height:20px; margin-left:-200px; "><a href="#">Edit | Add Below | Add Above</a></div> -->
			
			@{{#ifequal type 'section_header'}}
	  			<h2>@{{ section_header }}</h2>
	  		@{{/ifequal}}

			@{{#ifequal type 'job'}}
				<div class="clearfix">
		  			<h4 class="pull-left">
		  				@{{ job_company }} | 
		  				@{{ job_role}}
		  			</h4>
		  			<h4 class="pull-right">
		  				@{{ job_start_month }} @{{ job_start_year }} to 

		  				@{{#if present_job }}
		  					Present
		  				@{{else}}
		  					@{{ job_end_month }} @{{ job_end_year }}
		  				@{{/if}}
		  			</h4>
		  		</div>

		  		@{{{ job_content }}}

	  		@{{/ifequal}}

	  	</div>

  	@{{/each}}
</script>

<script id="add-job-template" type="text/x-handlebars-template">
<div class="row">
	<div class="col-lg-12">
		<button class="btn btn-default job-company-add">Company</button>
		<button class="btn btn-default job-role-add">Role</button>
		<button class="btn btn-default job-content-add">Content</button>
	</div>
	<hr>
</div>

<div class="row">
	<div class="col-lg-6">
		<textarea id="text-holder" class="form-control" style="height:400px"></textarea>
	</div>

<div class="col-lg-6">
  <div class="form-group">
  	<label for="job_company">Company</label>
  	<input type="text" id="job-company" name="job_company" class="form-control" value="@{{job_company}}">
  </div>

  <div class="form-group">
		<label for="job_role">Role/Job Title</label>
		<input type="text" id="job-role" name="job_role" class="form-control" value="@{{job_role}}">
	</div>

  <div class="row">
  	<div class="col-lg-3">
  		<div class="form-group">
	  	<label for="job_start_month">Start Month</label>
	  	<input type="text" id="job-start-month" name="job_start_month" class="form-control" value="@{{job_start_month}}">
	  	</div>
  	</div>

  	<div class="col-lg-3">
  		<div class="form-group">
	  	<label for="job_start_year">Start Year</label>
	  	<input type="text" id="job-start-year" name="job_start_year" class="form-control" value="@{{job_start_year}}">
	  	</div>
  	</div>
  	<div class="col-lg-3">
  		<div class="form-group">
	  	<label for="job_end_month">End Month</label>
	  	<input type="text" id="job-end-month" name="job_end_month" class="form-control" value="@{{job_end_month}}">
	  	</div>
  	</div>

  	<div class="col-lg-3">
  		<div class="form-group">
	  	<label for="job_end_year">End Year</label>
	  	<input type="text" id="job-end-year" name="job_end_year" class="form-control" value="@{{job_end_year}}">
	  	</div>c
  	</div>
  </div>

 
	<div class="form-group">
		<label for="job_role">Content</label>
		<textarea id="job-content" name="job_content" class="summernote form-control" rows="12">@{{job_content}}</textarea>
	</div>
</div>
</div>
</script>

@endsection

@section('scripts')

<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.hoverintent/1.8.1/jquery.hoverIntent.min.js"></script>

<script>

	function guid() {
	  function s4() {
	    return Math.floor((1 + Math.random()) * 0x10000)
	      .toString(16)
	      .substring(1);
	  }
	  return s4() + s4() + '-' + s4() + '-' + s4() + '-' +
	    s4() + '-' + s4() + s4() + s4();
	}

	function getSelectionText() {
	    var text = "";
	    if (window.getSelection) {
	        text = window.getSelection().toString();
	    } else if (document.selection && document.selection.type != "Control") {
	        text = document.selection.createRange().text;
	    }
	    
	    return text;
	}

	$(function(){

		currentSelection = '';

		$('.btn').popover();

		Handlebars.registerHelper('ifequal', function(value1, value2, options) {
		  if(value1 === value2) {
		    return options.fn(this);
		  }
		  return options.inverse(this);
		});

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		var resume_id = '{{$resumeId}}';

		$.ajax({
			type: 'post', 
			url: '/resume', 
			data: {resume_id: resume_id}, 
			dataType: 'json', 
			success: function(items) {

				
				var source   = $("#resume-items-template").html();
				var template = Handlebars.compile(source);

				var context = {items:items};
				var html  = template(context);

				$('#resume').append(html);

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

		$(document).on('select', '#text-holder', function(e){
			e.preventDefault();
			currentSelection = getSelectionText();
		});

		$(document).on('click', '.job-company-add', function(e){
			e.preventDefault();
			$('#job-company').val(currentSelection);
		});

		$(document).on('click', '.job-role-add', function(e){
			e.preventDefault();
			$('#job-role').val(currentSelection);
		});

		$(document).on('click', '.job-content-add', function(e){
			e.preventDefault();
			currentSelection = currentSelection.replace(/\n/g, "<br>");
			$('.summernote').summernote('code', currentSelection);
		});

		$(document).on('dblclick', '.sortable-item', function(e){

			
			e.preventDefault();

			$('#myModal').modal('show');
			$('.modal-title').html('Edit Job Experience');
			$('.modal-body').html('loading...');


			var id = parseInt($(this).attr('id').replace('item_', ''));

			$.ajax({
				type: 'post', 
				url: '/edit-item', 
				data: {id: id}, 
				dataType: 'json', 
				success: function(item) {
					var source   = $("#add-job-template").html();
					var template = Handlebars.compile(source);
					var html  = template(item);

					
					$('.modal-body').html(html);
					$('.summernote').summernote({
						minHeight: 300, 
						toolbar: [
						    
						    ['style', ['bold', 'italic', 'underline', 'clear']],
						    ['para', ['ul', 'ol', 'paragraph']],
						    ['view', ['codeview', 'fullscreen']]
						  ], 
						  callbacks: {
					            onPaste: function (e) {
					                var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');

					                e.preventDefault();

					                // Firefox fix
					                setTimeout(function () {
					                    document.execCommand('insertText', false, bufferText);
					                }, 10);
					            }
				        }
					});

					$('.save-job-button').remove();
					$('.dismiss-button').after('<button type="button" class="btn btn-primary save-job-button">Save Job</button>')
					
				}
			});

		});

		$(document).on('click', '.add-job', function(){

			var source   = $("#add-job-template").html();
			var template = Handlebars.compile(source);

			var context = {};
			var html  = template(context);

			$('.modal-title').html('Add Job Experience');
			$('.modal-body').html(html);
			$('.summernote').summernote({
				minHeight: 300, 
				toolbar: [
				    
				    ['style', ['bold', 'italic', 'underline', 'clear']],
				    ['para', ['ul', 'ol', 'paragraph']],
				    ['view', ['codeview', 'fullscreen']]
				  ], 
				  callbacks: {
			            onPaste: function (e) {
			                var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');

			                e.preventDefault();

			                // Firefox fix
			                setTimeout(function () {
			                    document.execCommand('insertText', false, bufferText);
			                }, 10);
			            }
		        }
			});

			$('.save-job-button').remove();
			$('.dismiss-button').after('<button type="button" class="btn btn-primary save-job-button">Save Job</button>')
			$('#myModal').modal('show');

		});

		$(document).on('click', '.save-job-button', function(e){

			e.preventDefault();

			//var markupStr = $('.summernote').summernote('code');
			
			var job_company = $('#job-company').val();
			var job_role = $('#job-role').val();
			var job_content = $('#job-content').val();
			var job_start_month = $('#job-start-month').val();
			var job_start_year = $('#job-start-year').val();
			var job_end_month = $('#job-end-month').val();
			var job_end_year = $('#job-end-year').val();

			var tempId = guid();
	

			var items = [];
			var job = {
				resume_id: resume_id, 
				type: 'job', 
				job_company: job_company, 
				job_role: job_role, 
				job_start_month: job_start_month, 
				job_start_year: job_start_year, 
				job_end_month: job_end_month,
				job_end_year: job_end_year, 
				job_content: job_content
			}

			items.push(job);

			$.ajax({
				type: 'post', 
				url: '/job-add', 
				data: {item:job}, 
				dataType: 'json', 
				success: function(dbJob) {
					console.log(dbJob);
					$('#item_' + tempId).attr('id', dbJob.id);
					console.log('updated!');
				}
			});
			
			var source   = $("#resume-items-template").html();
			var template = Handlebars.compile(source);

			var context = {items:items};
			var html  = template(context);
			console.log(html);
			$('#resume').append(html);

			$('#myModal').modal('hide');

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