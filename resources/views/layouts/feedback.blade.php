
<link rel="stylesheet" href="{{ url('assets/css/bootstrap.min.css') }}">

@if(session('success'))
  <div class="alert alert-success fade in">
    <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    {!! session('success') !!}
  </div>
@endif

@if(session('error'))
  <div class="alert alert-danger fade in">
    <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    {!! session('error') !!}
  </div>
@endif

@if(session('info'))
  <div class="alert alert-info fade in">
    <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    {!! session('info') !!}
  </div>
@endif

@if(session('warning'))
  <div class="alert alert-warning fade in">
    <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    {!! session('warning') !!}
  </div>
@endif

@if(count($errors) > 0)
  <div class="alert alert-danger fade in">
    <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <p>Warning.</p>
    <ul>
      @foreach ($errors->all() as $error)
      <li> {{ $error }} </li>
      @endforeach
    </ul>
  </div>
@endif