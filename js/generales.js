/*
Función que carga los formularios por medio de ajax dependiendo del llamado
*/
function load_form(url, id_div, nform){
	var dialog = bootbox.dialog({
		message: '<p style="text-align: center; font-size: 50px"><i class="fa fa-spin fa-spinner"></i> Loading form...</p>',
		size:'large',
		onEscape: true,
		backdrop: true,
		closeButton: true
	})
	dialog.init(function(){
		setTimeout(function(){
			$.ajax({
				url: "vista/" + url, 
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
						$("#i-edad").number(true);
						initialize_select("genero");
						get_data_select("controller/consultar.php", "genero");
						initialize_select("semestre");
						get_data_select("controller/consultar.php", "semestre");
						initialize_select("carrera");
						get_data_select("controller/consultar.php", "carrera");
						initialize_select("nacionalidad");
						get_data_select("controller/consultar.php", "nacionalidad");
					}
				},
				error:function (a, b, c){
					dialog.find('.bootbox-body').html('<p> Your form could not be loaded. Close and try again.</p>');					
				}		
			});
		}, 1000);
	});
}

/*
Funcion que obtiene los datos de un determinado formulario
Retorna un array con los datos del formulario en formato get y en formato array u objeto
*/
function get_form_data(id_form){
	$("#f-" + id_form + " :input[form-data=form]").each(function(){
		$(this).val($.trim($(this).val()).replace(/(\n)/g,"<br />"));
	});
	return [$("#f-" + id_form).serialize(), $("#f-" + id_form).serializeArray()];
}

/*
función que se ejecuta al oprimir el botón del formulario de creación de un nuevo estudiante
En esta funcion se verifica si hay algún campo en blanco.
si todos los campos estan bien digitados se implementa el codigo ajax para hacer la inserción de los nuevos datos
*/
function submit_form_createUser(){
	var data = get_form_data("create-user");
	var form_vacio = false;
	for(i in data[1]){
		if(data[1][i].value == "" || data[1][i].value == 0){
			form_vacio = true;
			break;
		}
	}
	if(form_vacio){
		alert("Digite todos los campos");
	}else{
		$.ajax({
			url:"controller/crear_estudiante.php",
			cache:false,
			type:'GET',
			data: data[0],
			beforeSend:function(){
				$("#cargando").show();
			},
			success: function(data){
				if(data == 1){
					mostrar_alert("Creación Exitosa","","color: green; font-size: 25px;");
					window.location.href = 'index.php';
				}else{
					mostrar_alert(data);
					$("#cargando").hide();
				}
			},
			error:function (a, b, c){
				console.log(a);
				console.log(b);
				console.log(c);
			}
		});
	}
}

/*
Funcion que muestra mensajes con la libreria bootbox
*/
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

/*
Función que inicializa los selects con la libreria select2
*/
function initialize_select(id_select){
	ph = "Seleccion un " + id_select;
	$("#s-" + id_select).select2({
		theme: "bootstrap",
		placeholder: ph,
		allowClear: false,
		containerCssClass: ':all:'
	});
	$("#s-" + id_select).parents('.bootbox').removeAttr('tabindex');
}

/*
Funcion que obtiene la informacion por medio del ajax
*/
function get_data_select(url, id_select){
	$.ajax({
		url:url,
		cache:false,
		type:'GET',
		data: "data=" + id_select,
		beforeSend:function(){
		},
		success: function(array_data){
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

/*
Función que carga los selects con susrespectivas opciones
*/
function load_select(data, id_select){
	var selected = 0;
	var s_option = "<option value='0'>Seleccion un " + id_select + "</option>";
	if ($.trim($("#s-" + id_select).html()) !== ""){
		selected = $("#s-" + id_select).val();
		$("#s-" + id_select).html("");
	}
	for(dep in data.results){
		s_option = (data.results[dep].id == selected)? s_option + "<option value='" + data.results[dep].id + "' selected='selected'>" + data.results[dep].name + "</option>" : s_option + "<option value='" + data.results[dep].id + "'>" + data.results[dep].name + "</option>";
	}
	$("#s-" + id_select).append(s_option);
}

/*
función que se ejecuta al oprimir el botón del formulario de actualización de un nuevo estudiante
En esta funcion se verifica si hay algún campo en blanco.
si todos los campos estan bien digitados se implementa el codigo ajax para hacer la actualización de los nuevos datos
*/
function submit_form_updateUser(id_est){
	var data = get_form_data("update-user");
	var form_vacio = false;
	for(i in data[1]){
		if(data[1][i].value == "" || data[1][i].value == 0){
			form_vacio = true;
			break;
		}
	}
	if(form_vacio){
		alert("Digite todos los campos");
	}else{
		$.ajax({
			url:"controller/actualizar_estudiante.php",
			cache:false,
			type:'GET',
			data: "id_est=" + id_est + "&" + data[0],
			beforeSend:function(){
				$("#cargando").show();
			},
			success: function(data){
				if(data == 1){
					mostrar_alert("Actualización Exitosa","","color: green; font-size: 25px;");
					setTimeout(function(){location.reload()},2000);
				}else{
					mostrar_alert(data);
				}
			},
			error:function (a, b, c){
				console.log(a);
				console.log(b);
				console.log(c);
			}
		});
	}
}

/*
Funcion que se ejecuta al oprimir el boton de eliminación de un estudiante.
Esta función pide la confirmación del usuario para eliminar algún estudiante
*/
function confirm_delete(id_est){
	bootbox.confirm({
		message: "Desea eliminar este estudiante?",
		buttons: {
			confirm: {
				label: 'SI',
				className: 'btn-success'
			},
			cancel: {
				label: 'NO',
				className: 'btn-danger'
			}
		},
		callback: function (result) {
			if(result){
				$.ajax({
					url:"controller/eliminar_estudiante.php",
					cache:false,
					type:'GET',
					data: "id_est=" + id_est,
					beforeSend:function(){
						$("#cargando").show();
					},
					success: function(data){
						if(data == 1){
							mostrar_alert("Eliminación Exitosa","","color: green; font-size: 25px;");
							setTimeout(function(){location.reload()},2000);
						}else{
							mostrar_alert(data);
						}
					},
					error:function (a, b, c){
						console.log(a);
						console.log(b);
						console.log(c);
					}
				});
			}
		}
	});
}