/* 
	Funcoes referentes a acessibilidade

*/

	
	var fator_multiplicativo = 0;

	//Funcao para aumentar o tamanho da Fonte
	function increaseFontSize(multiplier){
		// if (document.body.style.fontSize == "") {
  //   		document.body.style.fontSize = "0.8em";
  // 		}
  		
  // 		document.body.style.fontSize = parseFloat(document.body.style.fontSize) + (multiplier * 0.01) + "em";
  		//var multiplier = 1.03;

  		for(var i = 0; i < $("textarea").size(); i++) {
  			var anterior = $("textarea").eq(i).css("font-size").split("px")[0];
  			var newTam = parseFloat(anterior)+(multiplier * 0.9); 
  		 	$("textarea").eq(i).css("font-size",newTam+"px");
  		 	console.log(newTam);
  		 }
  		
  		fator_multiplicativo = multiplier;
  		Cookies.create("letra",fator_multiplicativo,7);
	}


	//Funcao que seta exclusivamente o contraste assim que carrega
	function setContraste(){
		var body_node = document.getElementById('contentWrapper');
		body_node.style.background = Cookies['cor'];

	}

	 //Mudar Contraste
	 function mudarContraste(){

	  		for(var i = 0; i < $(".file_content").size(); i++) {
	  			var atual = $(".file_content").eq(i)
	  			var anterior = atual.css("background-color");
	  			if(anterior ==  "rgb(246, 240, 185)" ){
	  				atual.css("background", "black");
	  				atual.css("color", "white");
	  			}else{
					atual.css("background", "#f6f0b9");
					atual.css("color", "#595959");
				}
  		 	}
	  }

	function limparAcessibilidade(){
		Cookies.erase('cor');
		Cookies.erase('letra');
		alert('Suas configurações de acessibilidade foram resetadas! A página será colocada nas configurações padrões');
		document.body.style.fontSize = "0.8em";
		document.getElementById('contentWrapper').style.background="";
	}