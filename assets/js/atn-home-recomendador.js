( function( $ ) {
	var bqhomerecomendador = function( $scope, $ ) {
		//alert("home recomendador");
		//var valores = {'nombre':32, 'valor':'jose'};
		var valores = new Array();
		
		$('.atrascuestionario .enlaceatrascuestionario').on('click', function(e){
			//alert ("has pulsado botón de atrás");
			 //quitar al elemento clases y añadir
		    $(this).parents(".bqpreguntacuestionario").removeClass( "d-block" );
		    $(this).parents(".bqpreguntacuestionario").addClass( "d-none" );
		    
		    //mostrar bloque previo
		    $(this).parents(".bqpreguntacuestionario").prev().addClass("d-block");
	    	$(this).parents(".bqpreguntacuestionario").prev().removeClass("d-none");
		});
		
		$('.respuestacuestionario input').on('click', function(e){
		    e.preventDefault();
		    console.log("id:" + this.id);
		    console.log("name:" + this.name);
		    
		    //quitar al elemento clases y añadir
		    $(this).parents(".bqpreguntacuestionario").removeClass( "d-block" );
		    $(this).parents(".bqpreguntacuestionario").addClass( "d-none" );
		    
		    var radioValue = $("input[name='" + this.name + "']:checked").val();
		    console.log("radioValue" + radioValue);
		    valores.push({'nombre': this.name, 'valor': radioValue});
		    
		    if($(this).parents(".bqpreguntacuestionario").next('.bqpreguntacuestionario').length > 0) {
		    	
		    	$(this).parents(".bqpreguntacuestionario").next().addClass("d-block");
		    	$(this).parents(".bqpreguntacuestionario").next().removeClass("d-none");
		        console.log("Exists.");
		    
    
		    } else {
		    	console.log("Entrando....");
		    
		    	
		    	//var n = $( "#bqcuestionario .bqpreguntacuestionario" ).length;
			    //console.log("total elementos: " + n);
		    	$(".formrecomendador").removeClass("formrecomendador");
		    	
			    //RECORREMOS LOS VALORES DE LA ARRAY
			    for (i=0 ; i < valores.length ; i++){
			    	console.log(valores[i]["nombre"]);
			    	console.log(valores[i]["valor"]);
			    }
		    }
		});
	};
	
	/*
	 */
	
	
	// Make sure we run this code under Elementor
	/*
	 * 
	 */
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bqhomerecomendador.default', bqhomerecomendador );
	} );
} )( jQuery );