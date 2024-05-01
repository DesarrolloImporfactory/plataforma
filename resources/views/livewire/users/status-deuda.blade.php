<div class="mb-4">
    <x-adminlte-info-box title="Progreso de la deuda" text="{{ $abonos }}$/{{ $totalDeuda }}$"
        icon="fas fa-lg fa-tasks text-orange" theme="warning" icon-theme="dark" progress="{{ $porcentaje }}"
        progress-theme="dark" description="Se han completado el {{ intval($porcentaje) }}%  de la deuda." />

</div>
