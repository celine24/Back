@extends('admin.app')

@section('content')

    <div class="container rw-gestion-groupe">

        <!-- gestion développé par Pauline & Céline -->
        <div class="row"> 
            <section class="col-lg-12">

                
                {!! Form::open(array('route' => 'gestion_utilisateur')) !!}
               

                <h4>Groupe <span class="green">{{$groupe->name}}</span> : </h4>

                <table class="table-bordered table-striped table-condensed col-lg-12">

                    {!! Form::label('add_user', 'Ajouter un utilisateur :') !!}
                    {!! Form::text('username', null, array('id' => 'add_user')) !!}
                    {!! Form::hidden('groupe_id', $groupe->id) !!}

                    {!! Form::submit('Ajouter l\'utilisateur au groupe', array('name' => 'add_user_action')) !!}
                    <thead>
                        <tr>
                            <th class="col-lg-1">Pseudo</th>
                            <th class="col-lg-1">Prénom Nom</th>
                            <th class="col-lg-1">Email</th>
                            <th class="col-lg-1">Emweb</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{$user->username}}</td>
                            <td>{{$user->first_name}} {{$user->last_name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->emweb}}</td>
                        </tr>
                         @endforeach
                    </tbody>
                </table>

                

                {!! Form::close() !!}
            </section>
        </div>

    </div>
@endsection