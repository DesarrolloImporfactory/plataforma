@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col">
            <x-adminlte-info-box title="Vendedores" text="{{ $vendedores }}" icon="fas fa-lg fa-user-group text-dark"
                theme="gradient-light" />
        </div>
        <div class="col">
            <x-adminlte-info-box title="Alumnos" text="{{ $alumnos }}" icon="fas fa-lg fa-user-graduate text-light"
                theme="gradient-primary" />
        </div>
        <div class="col">
            <x-adminlte-info-box title="Valor recaudado" text="USD {{ $pagado }}$"
                icon="fas fa-lg fa-sack-dollar text-warning" theme="gradient-teal" />
        </div>
        <div class="col">
            <x-adminlte-info-box title="Valor pendiente" text="USD {{ $deuda }}$"
                icon="fas fa-lg fa-wallet text-light" theme="gradient-danger" />
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <figure class="highcharts-figure">
                        <div id="chart1"></div>
                    </figure>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <figure class="highcharts-figure">
                        <div id="pie"></div>
                    </figure>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        Highcharts.chart('chart1', {
            chart: {
                type: 'column'
            },
            title: {
                align: 'left',
                text: 'Vendedores por comisiones'
            },
            accessibility: {
                announceNewData: {
                    enabled: false
                }
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'Cuota de mercado porcentual total'
                }
            },
            legend: {
                enabled: false
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        format: '{point.y:.1f}%'
                    }
                }
            },

            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> del total<br/>'
            },
            series: [{
                name: 'Comisiones',
                colorByPoint: true,
                data: JSON.parse(`<?php echo $data; ?>`)
            }]
        });
        Highcharts.chart('pie', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Estado de las deudas',
                align: 'left'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.name}</b>: {point.y}'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },

            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    }
                }
            },
            series: [{
                name: 'Estado',
                colorByPoint: true,
                data: JSON.parse(`<?php echo $data2; ?>`)
            }]
        });
    </script>
@stop
