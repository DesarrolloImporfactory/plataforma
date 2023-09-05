<div class="relative overflow-x-auto sm:rounded-lg">
    <div class="col-span-12">
        <div class="overflow-auto lg:overflow-visible ">
            {{ $slot }}
        </div>
    </div>

</div>
<style>
    .table {
        border-spacing: 0 15px;
    }

    i {
        font-size: 1rem !important;
    }

    .table tr {
        border-radius: 20px;
    }

    tr td:nth-child(n+6),
    tr th:nth-child(n+6) {
        border-radius: 0 .625rem .625rem 0;
    }

    tr td:nth-child(1),
    tr th:nth-child(1) {
        border-radius: .625rem 0 0 .625rem;
    }
</style>
