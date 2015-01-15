@extends('guest')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Log In</h3>
                </div>
                <div class="panel-body">
                    @include('partials.errors.basic')
                    <form role="form" method="POST" action="/user/login">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <fieldset>
                            <div class="form-group">                                
                                <input type="email" id="email" name="email" class="form-control" placeholder="Email" autocapitalize="off" value="{{ old('email') }}" autofocus>
                            </div>
                            <div class="form-group">                                
                                <input type="password" name="password" class="form-control" placeholder="Password">
                            </div>                                                       
                            <div class="modal-footer">                                
                                <button type="submit" class="btn mod-action">Login</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
