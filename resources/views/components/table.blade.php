
<div class="overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-800 dark:text-gray-400">
        <thead class="text-xs text-white uppercase bg-primary hover:bg-secondary hover:text-gray-800">
            {{ $thead }}
        </thead>
        <tbody>
            {{ $tbody }}
        </tbody>
        @isset($tfoot)
            <tfoot class="text-xs text-white uppercase bg-primary hover:bg-secondary hover:text-gray-800">
                {{ $tfoot }}
            </tfoot>
        @endisset
    </table>
</div>
