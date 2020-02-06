( function( $ ) {
	//alert("bloque planes1");
	var bloqueplanes = function( $scope, $ ) {
		//alert("bloque planes2");

		$('#modalContratacion').on('show.bs.modal', function (event) {
			// Button that triggered the modal
			var button = $(event.relatedTarget); 
			// Extract info from data-* attributes
			var producto= button.data('producto');
			// Extract info from data-* attributes
			var precio= button.data('precio') ;
			console.log("producto:" + producto + "\nprecio: " + precio);
			
			// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
			// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
			var modal = $(this);
			modal.find('.detalleModalProducto span').text(producto);
			modal.find('.detalleModalProducto p').text(precio);
		})
	};
	
	/*
	 */
	
	
	// Make sure we run this code under Elementor
	/*
	 * 
	 */
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bq planes.default', bloqueplanes );
	} );
} )( jQuery );