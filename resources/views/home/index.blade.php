<x-app>
    <x-card class="p-10 max-w-lg mx-auto mt-24">
        <h1>Dashboard</h1>
        @if($role)
        @if($role=='student')
        <h3>Student Dashboard</h3>
        <p>Student-specific content goes here...</p>
        <!-- https://cortexjs.io/mathlive/guides/interacting/ -->
        <label>Mathfield</label><br>
        <math-field style="
          display: block;
            font-size: 32px;
            margin: 3em;
            padding: 8px;
            border-radius: 8px;
            border: 1px solid rgba(0, 0, 0, .3);
            box-shadow: 0 0 8px rgba(0, 0, 0, .2);
            --caret-color: red;
            --selection-background-color: lightgoldenrodyellow;
            --selection-color: darkblue;
            ">
        </math-field>
        <!-- Student content -->
        @elseif($role == 'teacher')
        <h3>Teacher Dashboard</h3>
        <p>Teacher-specific content goes here...</p>
        @else
        <p>Invalid role</p>
        @endif
        @else
        <h3>Welcome to the Homepage</h3>
            <p>Regular homepage content for guests goes here...</p>
            <!-- Guest content -->
        @endif
    </x-card>
</x-app>