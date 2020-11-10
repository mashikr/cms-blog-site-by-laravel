<form action="{{ route('searchpost') }}" method="POST">
    @csrf
    <div class="input-group">
        {{ Form::text('key',"", ['placeholder' => 'Search..', 'class' => 'form-control', 'required']) }}
        <div class="input-group-append">
            <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
        </div>                            
    </div>
</form>

<div class="jumbotron mt-3">
    <h5 class="text-center border-bottom mb-2 pb-1">Categories</h5>

    @if(!$categories->isEmpty())
        @foreach ($categories as $category)
<a href="{{ route('categorypost', $category->category) }}" class="btn btn-sm btn-light mb-2 @isset($current_id)@if($current_id == $category->id) active @endif @endisset">{{ $category->category }}</a>   
        @endforeach
    @else
        <div class="text-center">No category available</div>
    @endif
</div>