// JavaScript Document
function valida_envia_iced(){
    if (document.form_iced.id_entrenador.selectedIndex==0){
       alert("Debe seleccionar un Entrenador.");
       document.form_iced.id_entrenador.focus();
       return false;
    }
	if (document.form_iced.id_instalacion.selectedIndex==0){
       alert("Debe seleccionar una Instalación.");
       document.form_iced.id_instalacion.focus();
       return false;
    }
	if (document.form_iced.id_cancha.selectedIndex==0){
       alert("Debe seleccionar una Cancha.");
       document.form_iced.id_cancha.focus();
       return false;
    }
	if (document.form_iced.id_disciplina.selectedIndex==0){
       alert("Debe seleccionar una Disciplina.");
       document.form_iced.id_disciplina.focus();
       return false;
    }
	if (document.form_iced.capacidad.value.length==0){
       alert("Indique la Capacidad de la clase")
       document.form_iced.capacidad.focus()
       return false;
    }
	if (document.form_iced.id_sexo.selectedIndex==0){
       alert("Debe seleccionar un tipo de sexo para la clase.");
       document.form_iced.id_disciplina.focus();
       return false;
    }
	
	/*if (!document.form_iced.masculino.checked) {
		if (!document.form_iced.femenino.checked) {
 			alert("Seleccione al menos un sexo")
       		document.form_iced.masculino.focus()
	   		return false;}
     }*/
		if (document.form_iced.edad_min.value.length==0){
       alert("Coloque la edad minima para esta clase")
       document.form_iced.edad_min.focus()
       return false;
    }
		if (document.form_iced.edad_max.value.length==0){
       alert("Coloque la edad máxima para esta clase")
       document.form_iced.edad_max.focus()
       return false;
    }

}
function enviar_formulario(){
   document.form_iced.button()
} 