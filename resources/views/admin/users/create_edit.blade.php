@extends('admin.app')

@section('title', $title)

@section('css')


@endsection

@section('content')

    <!-- Main content -->
    <section class="content">

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <!-- general form elements -->
                    <header class="card card-primary">

                        <!-- form start -->
                        {!! Form::open(['url' => isset($row) ? URL::route('admin.users.update') : URL::route('admin.users.store'), 'method' => isset($row) ? 'put' : 'post']) !!}

                        {!! isset($user) ? Form::hidden('id', $user->id) : '' !!}

                        <div class="card-body">

                            <p>*-обязательные поля</p>

                            <div class="form-group">

                                {!! Form::label('name', 'Имя') !!}

                                {!! Form::text('name', old('name', $row->name ?? null), ['class' => 'form-control', 'placeholder' => 'Имя']) !!}

                                @if ($errors->has('name'))
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                @endif
                            </div>

                            <div class="form-group">

                                {!! Form::label('login', 'Логин') !!}

                                {!! Form::text('login', old('login', $user->login ?? null), [ 'placeholder' => 'Логин', 'class' => 'form-control']) !!}

                                @if ($errors->has('login'))
                                    <p class="text-danger">{{ $errors->first('login') }}</p>
                                @endif

                            </div>

                            @if ((isset($user->id) && $user->id != Auth::user()->id) || !isset($user->id))

                                <div class="form-group">

                                    {!! Form::label('password', 'пароль') !!}

                                    {!! Form::password('password', ['class' => 'form-control']) !!}

                                    @if ($errors->has('password'))
                                        <p class="text-danger">{{ $errors->first('password') }}</p>
                                    @endif

                                </div>

                                <div class="form-group">

                                    {!! Form::label('password_again', 'повтор пароля') !!}

                                    {!! Form::password('password_again', ['class' => 'form-control']) !!}

                                    @if ($errors->has('password_again'))
                                        <p class="text-danger">{{ $errors->first('password_again') }}</p>
                                    @endif

                                </div>

                            @endif

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                {{ isset($user) ? 'редактировать' : 'добавить' }}
                            </button>
                            <a class="btn btn-default" href="{{ URL::route('admin.index') }}">
                               назад
                            </a>
                        </div>

                        {!! Form::close() !!}

                    </header>

                </div>
                <!-- /.card -->
            </div>
        </div>

    </section>
    <!-- /.content -->

@endsection

@section('js')


@endsection

