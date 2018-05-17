<section id="home_section">
	
	<h1 class="section-title">REMONTÉES DE SKI</h1>
	<hr class="separator">
	<p class="section-subtitle">
		Projet de simulation d'un système de remontées mécaniques de ski.
	</p>

	<a id="about_button" class="btn-rounded block-center page-scroll" href="#calc_section">COMMENCER</a>

</section>

<section id="calc_section">

	<h2 class="section-title">Définition du problème</h2>

	<div class="container-fluid">
		
		<div class="row">
			
			<div class="col-md-12">

				<hr class="separator">

				<div class="col-md-12">

					<h3 class="section-subtitle">Veuillez saisir le paramètre λ de la loi suivie par les arrivées dans le système, ainsi que le nombre d'intervalles souhaité (T).</h3>
                    <p class="indication"> Pour saisir un réel, il faut utiliser la virgule (,) et non le point (.). </p>				

					<div class="col-md-12">

                        <div class="col-md-6">
                            
                            <p class="field-name">Lambda (λ) :</p>
                            <input type="number" id="lambda_input" class="field block-center" step="any">

                        </div>  

                        <div class="col-md-6">

                            <p class="field-name">Temps (T) :</p>
						    <input type="number" id="t_input" class="field block-center">

                        </div>                                              

					</div>

					<div class="col-md-12">

						<a id="simulation_button" class="btn-rounded block-center page-scroll" href="#sim_section">SIMULER</a>

					</div>

					<div class="col-md-12">

                		<div id="graph_container"></div>

            		</div>

				</div>

			</div>

		</div>

	</div>

</section>

<section id="sim_section">

    <h2 class="section-title">Simulation du phénomène</h2>

    <div class="container-fluid">
        
        <div class="row">
            
            <div class="col-md-12">

                <hr class="separator simu">

            </div>

            <div class="col-md-12">

                    <h3 class="section-subtitle">La mise à jour des nombres est faite en temps réel.</h3>

            </div>

        </div>


        <div class="row">
            
            <div class="col-md-3">

                <div class="cases">
                    <p>Arrivées :</p>
                    <span></span>
                </div>

            </div>

            <div class="col-md-1">

                <div class="arrows">
                    <i class="arrow fa fa-5x fa-arrow-circle-right"></i>
                </div>
            </div>

            <div class="col-md-4">

                <div class="cases">
                    <p>File d'attente :</p>
                    <span></span>
                </div>

            </div>

            <div class="col-md-1">

                <div class="arrows">
                    <i class="arrow fa fa-5x fa-arrow-circle-right"></i>
                </div>
            </div>

            <div class="col-md-3">

                <div class="cases">
                    <p>Traitement :</p>
                    <span></span>
                </div>

            </div>

        </div>
    </div>

</section>

<script type="text/javascript">

    loiExponentielle = function(lambda)
    {
        return -(Math.log(1.0 - Math.random()) / lambda);
    };
        
    // Fonction d'affichage d'un graphique initial sans données
    $(function()
    {
        $('#graph_container').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: null
            },
            yAxis: {
                title: {
                    text: "Nombre d'Occurrences"
                },
                max: 1.0
            },
            xAxis: {
                title: {
                    text: "Temps"
                }
            },
            plotOptions: {
                column: {
                    pointPadding: 0.5,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Occurrences',
                data: [ ],
                color: '#e84c0fff'
            }]
        });

        // Action qui suit le clic du bouton "SIMULER"
        $('#simulation_button').on('click', function()
        {
            // Initialisation & récupération des variables
            let chart  = $('#graph_container').highcharts();
            let lambda = parseFloat($('#lambda_input').val());
            let t   = parseInt($('#t_input').val(), 10);
            let cpt = 0;
            let i = 1;
            let moy = 0;

            // On initialise directement le timer à une valeur aléatoire et non à 0
            let timer = loiExponentielle(lambda)

            // On vide la console
            console.clear();

            // On vide le graphe
            chart.series[0].remove(true);
            chart.addSeries({
                name: 'Occurrences',
                data: [ ],
                color: '#e84c0fff'
            });


            for (timer; timer < t; timer += loiExponentielle(lambda))
            {
                if (t <= 100) // On ne réalise la partie graphique que si T <= 100
                {
                    chart.series[0].addPoint(
                    // timer = abscisse & 1 = ordonnée
                    [ timer, 1 ], true
                    );
                }                        

                if (timer > i) // A chaque dépassement d'intervalles, on affiche le nombre d'Occurrences du précédent, on remet les compteurs à 0
                {
                    console.log("Pour l'intervalle n°" + i + ", il y a " + cpt + " Occurrences.");
                    moy = moy + cpt;
                    cpt = 0;
                    i++;
                }

                cpt++;

            }
            console.log("Pour l'intervalle n°" + i + ", il y a " + cpt + " Occurrences.");
            moy = moy + cpt;

            // Calcul et affichage du nombre moyen constaté d'Occurrences 
            moy = moy/i;
            console.log("Le nombre moyen constaté d'Occurrences/intervalle est de : " + moy);
        });

        /// Permet la gestion de pression sur la touche "Entrée" pour valider les saisies utilisateur
        // Champ d'entrée
        var lambda_input = document.getElementById("lambda_input");
        var t_input = document.getElementById("t_input");

        // Réalise un clic sur le bouton "SIMULER" si l'utilisateur appuie sur entrée
        lambda_input.addEventListener("keyup", function(event) 
        {
            // Annule l'action par défaut au cas où...
            event.preventDefault();
            // 13 correspond à la touche entrée
            if (event.keyCode === 13) {
                // Déclenche le bouton "SIMULER"
                document.getElementById("simulation_button").click();
            }
        });
        // Même chose pour l'autre champ
        t_input.addEventListener("keyup", function(event) 
        {
            event.preventDefault();
            if (event.keyCode === 13) {
                document.getElementById("simulation_button").click();
            }
        });

    });

</script>