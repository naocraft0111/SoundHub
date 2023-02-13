@if (session()->has('flash_message'))
<div class="flash_message bg-success text-center text-white fw-bold py-3 my-0">
    {{ session('flash_message') }}
</div>
@endif
