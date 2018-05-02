<section id="home_section">
	
	<h1 class="section-title">PROCESSUS DE POISSON</h1>
	<hr class="separator">
	<p class="section-subtitle">
		Le processus de Poisson . Son utilisation est parfaite pour simuler l'arrivée d'individus dans une file d'attente.
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

					<h3 class="section-subtitle"> Pour simuler un processus de poisson, il est nécessaire de renseigner la cadence (lambda) et l'intervalle de temps (deltaT)</h3>

					<div class="col-md-12">
						
						<hr class="separator">

					</div>

					<div class="col-md-12">

						<input type="number" id="deltaT_input" class="field block-center" placeholder="deltaT">
						<input type="number" id="lambda_input" class="field block-center" placeholder="Lambda" step="any">

					</div>

					<div class="col-md-12">

						<a id="simulation_button" class="btn-rounded block-center">SIMULER</a>

					</div>

					<div class="col-md-12">

                		<div id="graph_container"></div>

            		</div>

				</div>

			</div>

		</div>

	</div>

</section>

<script type="text/javascript">
        
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
                    text: "Nombre d'occurences"
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
                    pointPadding: 1,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Occurences',
                data: [ ],
                color: 'blue'
            }]
        });

        // Action lors du clic sur le bouton de simulation d'un processus de
        // Poisson.
        $('#simulation_button').on('click', function()
        {
            let chart  = $('#graph_container').highcharts();
            let lambda = parseFloat($('#lambda_input').val());
            let stop   = parseInt($('#deltaT_input').val(), 10);

            // On vide le graphique.
            chart.series[0].remove(true);
            chart.addSeries({
                name: 'Événements',
                data: [ ],
                color: 'blue'
            });

            for (let timer = 0; timer < stop; timer += Math.expRandom(lambda))
            {
                chart.series[0].addPoint(
                    [ timer, 1 ], true
                );
            }
        });
    });

</script>