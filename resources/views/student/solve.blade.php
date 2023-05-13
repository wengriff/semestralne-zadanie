<x-app>
    <x-card class="p-10 w-50 mx-auto mt-24">

     <!-- Display the problem image -->
     @php
            $imagePathParts = explode("/", $assignment->mathProblem->image_path);
            $imageFileName = end($imagePathParts);
        @endphp
      <img class="img-fluid" src="{{ asset('storage/images/' . $imageFileName) }}" alt="Problem Image">
                  

       <!-- https://cortexjs.io/mathlive/guides/interacting/ -->
       <br>
        <math-field id="mathField" style="
          display: block;
            font-size: 32px;
            margin: 1em;
            padding: 8px;
            
            border-radius: 8px;
            border: 1px solid rgba(0, 0, 0, .3);
            box-shadow: 0 0 8px rgba(0, 0, 0, .2);
            --caret-color: red;
            --selection-background-color: lightgoldenrodyellow;
            --selection-color: darkblue;
            ">
        </math-field>
        <div class="d-flex container justify-content-center">
        <form action="{{ route('submit.solution') }}" method="post">    
        @csrf
        <input type="hidden" name="problemId" value="{{ $assignment->id }}">  
        <textarea style="display:none" name="solution" class="output" id="latex" autocapitalize="none" autocomplete="off" autocorrect="off" spellcheck="false">
          </textarea> 
          <button class="btn btn-lg bg-laravel text-white rounded py-2 px-4 hover:bg-black" type="submit">      Submit      </button>
          </form>
</div>   
        </x-card>
</x-app>

<script>
  const mf = document.getElementById("mathField");
const latex = document.getElementById("latex");

mf.addEventListener("input",(ev) => latex.value = mf.value);

latex.value = mf.value;

// Listen for changes in the "latex" text field, and reflect its value in
// the mathfield.

latex.addEventListener("input", (ev) =>
mf.setValue( ev.target.value, {suppressChangeNotifications: true})
);
</script>




