@extends('_layouts.agency')
@section('title','Dashboard')
@section('content')

	<!-- header -->
	<div class="container-xl">
		<!-- Page title -->
		<div class="page-header d-print-none">
			<div class="row align-items-center">
				<div class="col">
					<!-- Page pre-title -->
					<div class="page-pretitle">
						Overview
					</div>
					<h2 class="page-title">
						Dashboard
					</h2>
				</div>
				<!-- Page title actions -->
				<div class="col-auto ms-auto d-print-none">
					<div class="btn-list">
						<div class="ms-auto lh-1">
							<div class="dropdown">
								<a class="dropdown-toggle btn btn-outline-primary" href="#" data-bs-toggle="dropdown"
									aria-haspopup="true" aria-expanded="false">Last 7 days</a>
								<div class="dropdown-menu dropdown-menu-end">
									<a class="dropdown-item active" href="#">Last 7 days</a>
									<a class="dropdown-item" href="#">Last 30 days</a>
									<a class="dropdown-item" href="#">Last 3 months</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- content -->
	<div class="page-body">
		<div class="container-xl">

			<div class="row row-deck row-cards">

				<div class="col-sm-6 col-lg-3">
					<div class="card">
						<div class="card-body">
							<div class="d-flex align-items-center">
								<div class="subheader">Revenue</div>
							</div>
							<div class="d-flex align-items-baseline">
								<div class="h1 mb-0 me-2">$4,300</div>
								<div class="me-auto">
									<span class="text-green d-inline-flex align-items-center lh-1">
										8%
										<svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24" height="24"
											viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
											stroke-linecap="round" stroke-linejoin="round">
											<path stroke="none" d="M0 0h24v24H0z" fill="none" />
											<polyline points="3 17 9 11 13 15 21 7" />
											<polyline points="14 7 21 7 21 14" />
										</svg>
									</span>
								</div>
							</div>
						</div>
						<div id="chart-revenue-bg" class="chart-sm"></div>
					</div>
				</div>

				<div class="col-sm-6 col-lg-3">
					<div class="card">
						<div class="card-body">
							<div class="d-flex align-items-center">
								<div class="subheader">New clients</div>
							</div>
							<div class="d-flex align-items-baseline">
								<div class="h1 mb-3 me-2">6,782</div>
								<div class="me-auto">
									<span class="text-yellow d-inline-flex align-items-center lh-1">
										0%
										<svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24" height="24"
											viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
											stroke-linecap="round" stroke-linejoin="round">
											<path stroke="none" d="M0 0h24v24H0z" fill="none" />
											<line x1="5" y1="12" x2="19" y2="12" />
										</svg>
									</span>
								</div>
							</div>
							<div id="chart-new-clients" class="chart-sm"></div>
						</div>
					</div>
				</div>

				<div class="col-sm-6 col-lg-3">
					<div class="card">
						<div class="card-body">
							<div class="d-flex align-items-center">
								<div class="subheader">Notifications</div>
							</div>
							<div class="d-flex align-items-baseline">
								<div class="h1 mb-0 me-2">2,300</div>
								<div class="me-auto">
									<span class="text-green d-inline-flex align-items-center lh-1">
										2%
										<svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24" height="24"
											viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
											stroke-linecap="round" stroke-linejoin="round">
											<path stroke="none" d="M0 0h24v24H0z" fill="none" />
											<polyline points="3 17 9 11 13 15 21 7" />
											<polyline points="14 7 21 7 21 14" />
										</svg>
									</span>
								</div>
							</div>
						</div>
						<div id="chart-new-notifications" class="chart-sm"></div>
					</div>
				</div>


				<div class="col-sm-6 col-lg-3">
					<div class="card">
						<div class="card-body">
							<div class="d-flex align-items-center">
								<div class="subheader">Videos</div>
							</div>
							<div class="d-flex align-items-baseline">
								<div class="h1 mb-0 me-2">5,300</div>
								<div class="me-auto">
									<span class="text-green d-inline-flex align-items-center lh-1">
										12%
										<svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24" height="24"
											viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
											stroke-linecap="round" stroke-linejoin="round">
											<path stroke="none" d="M0 0h24v24H0z" fill="none" />
											<polyline points="3 17 9 11 13 15 21 7" />
											<polyline points="14 7 21 7 21 14" />
										</svg>
									</span>
								</div>
							</div>
						</div>
						<div id="chart-new-videos" class="chart-sm"></div>
					</div>
				</div>

			</div>

		</div>
	</div>

@endsection

@section('footer')

	<script src="{{ asset('admin_panel/dist/libs/apexcharts/dist/apexcharts.min.js') }}"></script>

	<script>
		// @formatter:off
		document.addEventListener("DOMContentLoaded", function () {
			window.ApexCharts && (new ApexCharts(document.getElementById('chart-revenue-bg'), {
				chart: {
					type: "area",
					fontFamily: 'inherit',
					height: 40.0,
					sparkline: {
						enabled: true
					},
					animations: {
						enabled: false
					},
				},
				dataLabels: {
					enabled: false,
				},
				fill: {
					opacity: .16,
					type: 'solid'
				},
				stroke: {
					width: 2,
					lineCap: "round",
					curve: "smooth",
				},
				series: [{
					name: "Profits",
					data: [37, 35, 44, 28, 36, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53, 61, 27, 54, 43, 19, 46, 39, 62, 51, 35, 41, 67]
				}],
				grid: {
					strokeDashArray: 4,
				},
				xaxis: {
					labels: {
						padding: 0,
					},
					tooltip: {
						enabled: false
					},
					axisBorder: {
						show: false,
					},
					type: 'datetime',
				},
				yaxis: {
					labels: {
						padding: 4
					},
				},
				labels: [
					'2020-06-21', '2020-06-22', '2020-06-23', '2020-06-24', '2020-06-25', '2020-06-26', '2020-06-27', '2020-06-28', '2020-06-29', '2020-06-30', '2020-07-01', '2020-07-02', '2020-07-03', '2020-07-04', '2020-07-05', '2020-07-06', '2020-07-07', '2020-07-08', '2020-07-09', '2020-07-10', '2020-07-11', '2020-07-12', '2020-07-13', '2020-07-14', '2020-07-15', '2020-07-16', '2020-07-17', '2020-07-18', '2020-07-19', '2020-07-20'
				],
				colors: ["#2fb344"],
				legend: {
					show: false,
				},
			})).render();
		});
		// @formatter:on
	</script>

	<script>
		// @formatter:off
		document.addEventListener("DOMContentLoaded", function () {
			window.ApexCharts && (new ApexCharts(document.getElementById('chart-new-clients'), {
				chart: {
					type: "line",
					fontFamily: 'inherit',
					height: 40.0,
					sparkline: {
						enabled: true
					},
					animations: {
						enabled: false
					},
				},
				fill: {
					opacity: 1,
				},
				stroke: {
					width: [2, 1],
					dashArray: [0, 3],
					lineCap: "round",
					curve: "smooth",
				},
				series: [{
					name: "May",
					data: [37, 35, 44, 28, 36, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53, 61, 27, 54, 43, 4, 46, 39, 62, 51, 35, 41, 67]
				},{
					name: "April",
					data: [93, 54, 51, 24, 35, 35, 31, 67, 19, 43, 28, 36, 62, 61, 27, 39, 35, 41, 27, 35, 51, 46, 62, 37, 44, 53, 41, 65, 39, 37]
				}],
				grid: {
					strokeDashArray: 4,
				},
				xaxis: {
					labels: {
						padding: 0,
					},
					tooltip: {
						enabled: false
					},
					type: 'datetime',
				},
				yaxis: {
					labels: {
						padding: 4
					},
				},
				labels: [
					'2020-06-21', '2020-06-22', '2020-06-23', '2020-06-24', '2020-06-25', '2020-06-26', '2020-06-27', '2020-06-28', '2020-06-29', '2020-06-30', '2020-07-01', '2020-07-02', '2020-07-03', '2020-07-04', '2020-07-05', '2020-07-06', '2020-07-07', '2020-07-08', '2020-07-09', '2020-07-10', '2020-07-11', '2020-07-12', '2020-07-13', '2020-07-14', '2020-07-15', '2020-07-16', '2020-07-17', '2020-07-18', '2020-07-19', '2020-07-20'
				],
				colors: ["#206bc4", "#a8aeb7"],
				legend: {
					show: false,
				},
			})).render();
		});
		// @formatter:on
	</script>


	<script>
		// @formatter:off
		document.addEventListener("DOMContentLoaded", function () {
			window.ApexCharts && (new ApexCharts(document.getElementById('chart-new-notifications'), {
				chart: {
					type: "area",
					fontFamily: 'inherit',
					height: 40.0,
					sparkline: {
						enabled: true
					},
					animations: {
						enabled: false
					},
				},
				dataLabels: {
					enabled: false,
				},
				fill: {
					opacity: .16,
					type: 'solid'
				},
				stroke: {
					width: 2,
					lineCap: "round",
					curve: "smooth",
				},
				series: [{
					name: "Profits",
					data: [37, 35, 44, 28, 36, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53, 61, 27, 54, 43, 19, 46, 39, 62, 51, 35, 41, 67]
				}],
				grid: {
					strokeDashArray: 4,
				},
				xaxis: {
					labels: {
						padding: 0,
					},
					tooltip: {
						enabled: false
					},
					axisBorder: {
						show: false,
					},
					type: 'datetime',
				},
				yaxis: {
					labels: {
						padding: 4
					},
				},
				labels: [
					'2020-06-21', '2020-06-22', '2020-06-23', '2020-06-24', '2020-06-25', '2020-06-26', '2020-06-27', '2020-06-28', '2020-06-29', '2020-06-30', '2020-07-01', '2020-07-02', '2020-07-03', '2020-07-04', '2020-07-05', '2020-07-06', '2020-07-07', '2020-07-08', '2020-07-09', '2020-07-10', '2020-07-11', '2020-07-12', '2020-07-13', '2020-07-14', '2020-07-15', '2020-07-16', '2020-07-17', '2020-07-18', '2020-07-19', '2020-07-20'
				],
				colors: ["#f59f00"],
				legend: {
					show: false,
				},
			})).render();
		});
		// @formatter:on
	</script>

	<script>
		// @formatter:off
		document.addEventListener("DOMContentLoaded", function () {
			window.ApexCharts && (new ApexCharts(document.getElementById('chart-new-videos'), {
				chart: {
					type: "area",
					fontFamily: 'inherit',
					height: 40.0,
					sparkline: {
						enabled: true
					},
					animations: {
						enabled: false
					},
				},
				dataLabels: {
					enabled: false,
				},
				fill: {
					opacity: .16,
					type: 'solid'
				},
				stroke: {
					width: 2,
					lineCap: "round",
					curve: "smooth",
				},
				series: [{
					name: "Profits",
					data: [37, 35, 44, 28, 36, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53, 61, 27, 54, 43, 19, 46, 39, 62, 51, 35, 41, 67]
				}],
				grid: {
					strokeDashArray: 4,
				},
				xaxis: {
					labels: {
						padding: 0,
					},
					tooltip: {
						enabled: false
					},
					axisBorder: {
						show: false,
					},
					type: 'datetime',
				},
				yaxis: {
					labels: {
						padding: 4
					},
				},
				labels: [
					'2020-06-21', '2020-06-22', '2020-06-23', '2020-06-24', '2020-06-25', '2020-06-26', '2020-06-27', '2020-06-28', '2020-06-29', '2020-06-30', '2020-07-01', '2020-07-02', '2020-07-03', '2020-07-04', '2020-07-05', '2020-07-06', '2020-07-07', '2020-07-08', '2020-07-09', '2020-07-10', '2020-07-11', '2020-07-12', '2020-07-13', '2020-07-14', '2020-07-15', '2020-07-16', '2020-07-17', '2020-07-18', '2020-07-19', '2020-07-20'
				],
				colors: ["#17a2b8"],
				legend: {
					show: false,
				},
			})).render();
		});
		// @formatter:on
	</script>

@endsection