@extends("layouts.adminLayout")
@section("contents")

<script>
    $(function(){
        $(".back_button").click(function(){
            location.href = "{{URL::to('admin/users')}}"
        });

    });
</script>

<div class="content-wrapper" style="min-height: 916px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           Edit Users
        </h1>
       
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <!-- /.box -->
                <div class="box box-info">
                    <!-- form start -->

                    <form class="form-horizontal" id="user_form" name="user_form" action="{{url('admin/users/'.$user->id )}}" method = "post">

                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <div class="box-body">
                            <div class="form-group custom_input {{ $errors->has('firstname') ? ' has-error' : '' }}">
                                <label class="col-sm-2 control-label">First Name<span class="required">*</span></label>
                                <div class="col-xs-4">
                                    <input class="form-control" name="firstname" type="text" value="{{ $user->firstname }}" placeholder="First Name" required>
                                    @if ($errors->has('firstname'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('firstname') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group custom_input {{ $errors->has('lastname') ? ' has-error' : '' }}">
                                <label class="col-sm-2 control-label">Last<span class="required">*</span></label>
                                <div class="col-xs-4">
                                    <input class="form-control" name="lastname" type="text" value="{{ $user->lastname }}" placeholder="Last Name" required>
                                    @if ($errors->has('lastname'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('lastname') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group custom_input {{ $errors->has('email') ? ' has-error' : '' }}">
                                <label class="col-sm-2 control-label">Email<span class="required"></span></label>
                                 <div class="col-xs-4">
                                    <input class="form-control" name="email" type="text" value="{{ $user->email }}" placeholder="Email" required>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group custom_input {{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label class="col-sm-2 control-label">Phone<span class="required"></span></label>
                                 <div class="col-xs-4">
                                    <input class="form-control" name="phone" type="text" value="{{ $user->phone }}" placeholder="Phone" required>
                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group custom_input {{ $errors->has('role') ? ' has-error' : '' }}">
                                <label class="col-sm-2 control-label">Role<span class="required"></span></label>
                                 <div class="col-xs-4">

                                    
                                    <select class = "form-control" name = "role" requried>
                                        @foreach ($roles as $role)
                                            @if(Auth::user()->role == 2)
                                           
                                                @if($role->id == 3)
                                                <option {{($user->role == $role->id)?"selected":""}} value= {{$role->id}}>{{$role->title}}</option>
                                                @endif
                                            @else
                                                <option {{($user->role == $role->id)?"selected":""}} value= {{$role->id}}>{{$role->title}}</option>
                                            @endif
                                        @endforeach
                                    
                                    </select>
                                    @if ($errors->has('role'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('role') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            @if (Auth::user()->role == 1 && $user->role == 3)
                            <div class="form-group custom_input {{ $errors->has('password') ? ' has-error' : '' }}">
                                <label class="col-sm-2 control-label">Password<span class=""></span></label>
                                <div class="col-xs-4">
                                    <input class="form-control" name="password" type="text" placeholder="New password" >
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group custom_input">
                                <label class="col-sm-2 control-label">Confirm Password<span class=""></span></label>
                                <div class="col-xs-4">
                                    <input class="form-control" name="password_confirmation" type="text" placeholder="Confirm password" >
                                </div>
                            </div>
                            @endif
                           
                        </div>
                        <div class="box-footer">
                            <!--<button type="submit" class="btn btn-default">Cancel</button>-->
                            <button type="submit" class="btn btn-info save_button">Save</button>
                            <button type="button" class="btn btn-info back_button">Back</button>
                        </div>
                    </form>
                </div>
                <!-- /.col -->
            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>

@endsection