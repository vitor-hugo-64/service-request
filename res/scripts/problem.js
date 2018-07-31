( function ( w, d) {
	'use strict';

	var $search = d.querySelector("[data-js='search']");
	var $btn = d.querySelector("[data-js='btn']");

	var imgLoading = '<img src="/service-request/res/img/gif/loading.gif" style="width: 20px;" data-js="img-loading">';
	var imgSearch = '<i class="fa fa-search" style="width: 20px;" data-js="icon-search"></i>';

	function createAjax() {

		var request;

		try{
			request = new XMLHttpRequest();        
		}catch (IEAtual){

			try{
				request = new ActiveXObject("Msxml2.XMLHTTP");       
			}catch(IEAntigo){

				try{
					request = new ActiveXObject("Microsoft.XMLHTTP");          
				}catch(falha){
					request = false;
				}
			}
		}

		if (!request) 
			alert("Seu Navegador não suporta Ajax!");
		else
			return request;
	}

	$btn.addEventListener( 'click', function () {

		this.innerHTML = imgLoading;
		var ajax = createAjax();

		if ( $search.value) {
			ajax.open( 'GET', '/service-request/admin/problem/search/' + $search.value);
		} else {
			ajax.open( 'GET', '/service-request/admin/problem/show-all');
		}

		ajax.send( null);

		ajax.addEventListener( 'readystatechange', function () {
			
			if ( this.readyState === 4) {
				
				var $imgLoading = d.querySelector("[data-js='img-loading']");
				$imgLoading.remove();
				$btn.innerHTML = imgSearch;

				if ( this.status === 200) {
					var $table = d.querySelector("[data-js='table']");
					$table.innerHTML = ajax.responseText;
				}

			}

		}, false);

	}, false);

	$search.addEventListener( 'focusout', function () {
		
		if (!this.value) {

			var $btn = d.querySelector("[data-js='btn']");
			var imgLoading = '<img src="/service-request/res/img/gif/loading.gif" style="width: 20px;" data-js="img-loading">';
			var imgSearch = '<i class="fa fa-search" style="width: 20px;" data-js="icon-search"></i>';

			$btn.innerHTML = imgLoading;
			var ajax = createAjax();

			ajax.open( 'GET', '/service-request/admin/problem/show-all');

			ajax.send( null);

			ajax.addEventListener( 'readystatechange', function () {

				if ( this.readyState === 4) {

					var $imgLoading = d.querySelector("[data-js='img-loading']");
					$imgLoading.remove();
					$btn.innerHTML = imgSearch;

					if ( this.status === 200) {
						var $table = d.querySelector("[data-js='table']");
						$table.innerHTML = ajax.responseText;
					}

				}

			}, false);

		}

	}, false);


	
})( window, document);