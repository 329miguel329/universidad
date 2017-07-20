function load_form(url, id_div, nform)
{
	var dialog = bootbox.dialog({
		message: '<p style="text-align: center; font-size: 50px"><i class="fa fa-spin fa-spinner"></i> Loading form...</p>',
		size:'large',
		onEscape: true,
		backdrop: true,
		closeButton: true
	})
	dialog.init(function()
	{
		setTimeout(function()
		{
			$.ajax(
			{
				url: url, 
				cache:false,
				beforeSend:function(){
					dialog.find('.bootbox-body').html('<p style="text-align: center; font-size: 50px"><i class="fa fa-spin fa-spinner"></i> Loading form...</p>');
				},
				type:'GET',
				dataType: "html",
				data: "id_div=" + id_div,
				success: function(data){
					dialog.find('.bootbox-body').html(data);
					$(".bootbox-body").height($("#d-form-" + nform).height());
					
					if(nform == "update-user" || nform == "create-user"){
						initialize_select("profile");
						get_data_select("../controller/consult_profile.php", "profile");
					}
					dialog.on("shown.bs.modal", function(e){
						$(document).ready(function(){
							console.log(get_form_data(nform));
							$("#i-name").focus();
						});
					});
				},
				error:function (a, b, c){
					//alert("Error al cargar"+a+b+c);
					dialog.find('.bootbox-body').html('<p> Your form could not be loaded. Close and try again.</p>');					
				}		
			});
		}, 1000);
	});
}

function mostrar_alert(message, time, style){
	var time = time || 2000;
	var style = style || "color: red; font-size: 25px;";
	var alert_message = bootbox.dialog({
		message: '<p class="text-center" style="' + style + '">' + message + '</p>',
		closeButton: false
	});
	
	setTimeout(function(){
		alert_message.modal('hide');
	}, time);
}

function save_reto(){
	if($.trim($("#i-name_reto").val()) == "" || $.trim($("#ta-des_reto").val()) == "" ){
		mostrar_alert("Rellene todos los campos. Aún hay campos vacios");
	}else{
		var data = get_form_data("f-new_reto");
		console.log(data);
		$.ajax(
		{
			url:"../controller/registrar_reto.php",
			cache:false,
			type:'GET',
			data: data,
			beforeSend:function(){
				mostrar_alert("cargando");
			},
			success: function(data){
				if(data == 1){
					mostrar_alert("registro exitoso");
					setTimeout(function(){
						location.reload();
					}, 2000);
				}else{
					console.log(data);
					mostrar_alert(data, 5000);
				}
				//$("#errors")html(data);
			},
			error:function (a, b, c){
				console.log(a);
				console.log(b);
				console.log(c);
			}
		});
	}
}

function submit_form_createUser(){
	var data = get_form_data("create-user");
	$.ajax(
	{
		url:"../controller/register_user.php",
		cache:false,
		type:'GET',
		data: data,
		beforeSend:function(){
			$("#cargando").show();
		},
		success: function(data){
			if(data == 1){
				mostrar_alert("Creación Exitosa");
				window.location.href = 'desarrolladores.php';
			}else{
				mostrar_alert(data);
				$("#cargando").hide();
			}
			//$("#errors")html(data);
		},
		error:function (a, b, c){
			console.log(a);
			console.log(b);
			console.log(c);
		}
	});
}

function submit_form_updateUser(){
	var data = get_form_data("update-user");
	$.ajax(
	{
		url:"../controller/update_user.php",
		cache:false,
		type:'GET',
		data: data,
		beforeSend:function(){
			$("#cargando").show();
		},
		success: function(data){
			if(data == 1){
				mostrar_alert("Actualización Exitosa");
				location.reload();
			}else{
				mostrar_alert(data);
			}
			//$("#errors")html(data);
		},
		error:function (a, b, c){
			console.log(a);
			console.log(b);
			console.log(c);
		}
	});
}

function get_form_data(id_form){
	console.log(id_form);
	$("#f-" + id_form + " :input[form-data=form]").each(function(){
		$(this).val($.trim($(this).val()).replace(/(\n)/g,"<br />"));
	});
	return $("#f-" + id_form).serialize();
}

function initialize_select(id_select)
{
	ph = "Select a " + id_select;
	$("#s-" + id_select).select2({
		theme: "bootstrap",
		placeholder: ph,
		allowClear: false,
		containerCssClass: ':all:'
	});
	//$("#s-" + id_select).parents('.bootbox').removeAttr('tabindex');
}

function get_data_select(url, id_select)
{
	//console.log(data.id_div);
	$.ajax(
	{
		url:url,
		cache:false,
		type:'GET',
		data: id_select,
		beforeSend:function(){
			//$("#sp-" + id_select).css({"background-position":"center center", "background-image":"url('images/indicator.gif')", "background-repeat":"no-repeat"});
		},
		success: function(array_data){
			//console.log(array_data);
			load_select(array_data, id_select);
		},
		error:function (a, b, c){
			console.log(a);
			$("#errors").html(a);
			console.log(b);
			console.log(c);
		}
	});
}

function load_select(data, id_select)
{
	//$("#sp-" + id_select).css({"background-image":"url('images/Search.png')"});
	//var s_option = "<option value='0'>select a " + id_select + "</option>";
	var s_option = "";
	for(dep in data.results)
	{
		s_option += "<option value='" + data.results[dep].id + "'>" + data.results[dep].name + "</option>";
	}
	$("#s-" + id_select).html(s_option);
}