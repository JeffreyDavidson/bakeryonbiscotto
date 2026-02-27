@props([])

<table style="width: 100%; border-collapse: collapse;" {{ $attributes }}>
    @if(isset($head))
        <thead>
            <tr style="background: var(--brand-50);">
                {{ $head }}
            </tr>
        </thead>
    @endif
    <tbody>
        {{ $slot }}
    </tbody>
    @if(isset($foot))
        <tfoot>
            {{ $foot }}
        </tfoot>
    @endif
</table>

@once
<style>
    [data-admin-table] thead th {
        padding: 0.75rem 1rem;
        text-align: left;
        font-size: 0.7rem;
        font-weight: 700;
        color: var(--brand-500);
        text-transform: uppercase;
        letter-spacing: 0.08em;
        border-bottom: 1px solid var(--brand-150);
        background: var(--brand-50);
    }
    [data-admin-table] tbody td {
        padding: 0.75rem 1rem;
        vertical-align: middle;
        font-size: 0.875rem;
        color: var(--brand-800);
    }
    [data-admin-table] tbody tr {
        border-bottom: 1px solid var(--brand-150);
        transition: background 0.1s;
    }
    [data-admin-table] tbody tr:last-child {
        border-bottom: none;
    }
    [data-admin-table] tbody tr:hover {
        background: var(--brand-50);
    }
    [data-admin-table] tfoot td {
        padding: 1rem;
        border-top: 2px solid var(--brand-200);
    }
</style>
@endonce
