<?php



	function afficheFormulaireCR($idChantier,$idChantierAdmin){


		//recuperer les variables dates saisies
		$dateDeb="";
		$dateFin="";
		if (isset($_POST['datepicker1'])){
			$dateDeb=$_POST['datepicker1'];
		}
		if (isset($_POST['datepicker2']) ){
			$dateFin=$_POST['datepicker2'];
		}
?>	
	
	<link rel="stylesheet" href="zip-style.css" />
	
	

  	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="/resources/demos/style.css">
  	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	
	
		
		 
	<script type='text/javascript'>
		var i=0;
		var j=0;
		var choix= document.getElementsByName("choix");
		var dateDeb="<?php echo($dateDeb)?>";
		var dateFin="<?php echo($dateFin)?>";
		
		function dateFrToEn(dateFr){
			dateFr=new String(dateFr);
			var mois = new String("");
			var jour = new String("");
			var anne = new String("");
			anne=dateFr.substring(6);
			mois=dateFr.substring(3,6);
			jour=dateFr.substring(0,3);
			mois=mois.concat(jour);
			mois=mois.concat(anne);
			
			return mois;
		}

		function alertDates(){

			var dDebEn = dateFrToEn(document.getElementById('datepicker1').value);
			var dFinEn = dateFrToEn(document.getElementById('datepicker2').value);
			var dateDebEn= new Date(dDebEn);
			var dateFinEn= new Date(dFinEn);

			

			if ( (dateDebEn=="Invalid Date")||(dateFinEn=="Invalid Date")){
				alert("Veuillez saisir une date de debut et une date de fin");
				document.getElementById('datepicker1').value="";
				document.getElementById('datepicker2').value="";
				document.getElementById('btnGenererP').style.visibility="hidden";
				return false;
			}
			if(dateDebEn>dateFinEn){
				alert("Veuillez saisir les dates correctement : date-debut<date-fin\n");
				document.getElementById('datepicker1').value="";
				document.getElementById('datepicker2').value="";
				document.getElementById('btnGenererP').style.visibility="hidden";
				return false;

			}else{
				document.getElementById('btnGenererP').style.visibility="visible";
				return(dateDebEn<=dateFinEn);
			}
			return false;
		}

		function generationForm(){

			if(i==0){
				hideButton();
				var center=document.createElement('center');
				center.id='center';
				document.getElementById('app').append(center);

				//var pere= document.createElement('p');
				//pere.id='input_date';
			
				var form=document.createElement('form');
				form.id='form';
				form.setAttribute('method','post');
				form.setAttribute('action',' ');
				form.setAttribute('autocomplete','off');
				form.setAttribute('onsubmit','return alertDates()');
				document.getElementById('center').appendChild(form);



				var lab1 = document.createElement('label');
				lab1.id='lab1';
				lab1.innerText='Date début   ';
				document.getElementById('form').appendChild(lab1);

				var input1 = document.createElement('input');
				input1.id='datepicker1';
				input1.name='datepicker1';
				input1.type='text';
				document.getElementById('lab1').appendChild(input1);
				if (dateDeb!=""){
					input1.value=dateDeb;
				}

				var lab2 = document.createElement('label');
				lab2.id='lab2';
				lab2.innerText='Date fin   ';
				document.getElementById('form').appendChild(lab2);

				var input2 = document.createElement('input');
				input2.id='datepicker2';
				input2.name='datepicker2';
				input2.type='text';
				document.getElementById('lab2').appendChild(input2);
				if (dateFin!=""){
					input2.value=dateFin;
				}


				var inputSubmit = document.createElement('input');
				inputSubmit.id='inputSubmit';
				inputSubmit.type='submit';
				inputSubmit.value='valider dates';
				document.getElementById('form').appendChild(inputSubmit);	

				$( "#datepicker1" ).datepicker();
		    	$( "#datepicker2" ).datepicker();



		    	i++;
		    }
		}

		
		function hideButton(){
			document.getElementById('btnGenerer').style.visibility="hidden";
		}

		function test()
		{	


			var choix= document.getElementsByName("choix");

			if((choix[0].checked)){
				if (i==1){i--;}
				document.getElementById('btnGenererP').style.visibility="hidden";
				document.getElementById('btnGenerer').style.visibility="visible";
				var centerElem = document.getElementById('center');
				centerElem.parentElement.removeChild(centerElem);	
			}

			else if ((choix[1].checked))
			{
				
				generationForm();
				var link = document.getElementById('link');
				link.parentElement.removeChild(link);
			}
		}

	

	</script>
	
	<body>

	<center>
		<font size="5">
			<I>
				<B>
					<h1>Formulaire génération ZIP avec photos</h1>
				</B>
			</I>
		</font>
	</center>
				
					<label class="container">Récupérer toutes les photos du chantier
  						<input type="radio" name="choix" id="generale" value="generale" onclick="test();">
  						<span class="checkmark"></span></br>
					</label>
					
					<label class="container">Récupérer les photos entre deux dates
  						<input type="radio" name="choix" id="partiel" value="partiel" onclick="test();">
  						<span class="checkmark"></span>
					</label>
				</br>
					<p id='app'></p> 
	</br>
	



	<center><img id="img_generation" src="./imgCreationZip/engine.png" width="450" height="300"  alt="icone_generation" /></center>
	<p id='app2'></p> 
	<center>
		<a id='btnGenerer' href='creationZip.php?idChantier=<?php echo($idChantier)?>&idChantierAdmin=<?php echo($idChantierAdmin)?>&dateDeb="0"&dateFin="0"'  
			class='btn btn-primary'>Générer ZIP général
		</a>
		<a id='btnGenererP' href='creationZip.php?idChantier=<?php echo($idChantier)?>&idChantierAdmin=<?php echo($idChantierAdmin)?>&dateDeb=<?php echo($dateDeb)?>&dateFin=<?php echo($dateFin)?>'  
			class='btn btn-primary'>Générer ZIP partiel
		</a>
	</center>
	<script type="text/javascript">
			$.datepicker.regional['fr'] = {clearText: 'Effacer', clearStatus: '',
		    closeText: 'Fermer', closeStatus: 'Fermer sans modifier',
		    prevText: '&lt;Préc', prevStatus: 'Voir le mois précédent',
		    nextText: 'Suiv&gt;', nextStatus: 'Voir le mois suivant',
		    currentText: 'Courant', currentStatus: 'Voir le mois courant',
		    monthNames: ['Janvier','Février','Mars','Avril','Mai','Juin',
		    'Juillet','Août','Septembre','Octobre','Novembre','Décembre'],
		    monthNamesShort: ['Jan','Fév','Mar','Avr','Mai','Jun',
		    'Jul','Aoû','Sep','Oct','Nov','Déc'],
		    monthStatus: 'Voir un autre mois', yearStatus: 'Voir un autre année',
		    weekHeader: 'Sm', weekStatus: '',
		    dayNames: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
		    dayNamesShort: ['Dim','Lun','Mar','Mer','Jeu','Ven','Sam'],
		    dayNamesMin: ['Di','Lu','Ma','Me','Je','Ve','Sa'],
		    dayStatus: 'Utiliser DD comme premier jour de la semaine', dateStatus: 'Choisir le DD, MM d',
		    dateFormat: 'dd/mm/yy', firstDay: 0, 
		    initStatus: 'Choisir la date', isRTL: false};
		 $.datepicker.setDefaults($.datepicker.regional['fr']);

		hideButton();
		document.getElementById('btnGenererP').style.visibility="hidden";
		if ((dateDeb!="") ||(dateFin!="")){
			generationForm();
			var choix= document.getElementsByName("choix");
			choix[1].checked=true;
			document.getElementById('btnGenererP').style.visibility="visible";
		}
	</script>

	
	


	</br>
</body>

<?php
}

?>
