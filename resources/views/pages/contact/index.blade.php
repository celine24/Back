{{-- Balises HEAD --}}
@section('title')Formulaire de contact de roadweb.@endsection()
@section('description')Pour toute demande ou suggestion sur Road-Web, remplissez ce formulaire.@endsection()

@extends('pages.app')

@section('content')
    @include('pages.components.header')
    <img class="rw-fond-exagone-top not_mobile" src="{{ asset('images/exagonefond.png')}}"/>

<div class="container">
    <div class="rw-contact-container">

        <h1>Nous contacter</h1>

        <p>Un souci, une demande, des suggestions ? N'hésitez pas à remplir le formulaire ci-dessous et à nous le faire parvenir !
            <br/> Nous vous recontacterons par mail au plus vite et ferons notre possible pour régler votre problème :) </p>

        <ul class="rw-contact-error">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>

        @if(Session::has('message'))
            <p class="rw-contact-success">
                {{Session::get('message')}}
            </p>
        @endif

        <h2>Formulaire à remplir</h2>

        {!! Form::open(array('route' => 'contact_store', 'files' => 'true', 'enctype' => 'multipart/form-data', 'class'=>'not_mobile')) !!}

            <fieldset>

                <div class="rw-contact-field">
                    {!! Form::label('prenom', 'Prénom :', ['class'=>'not_mobile'] ) !!}
                    {!! Form::text('firstname', null, 
                    array('required', 
                        'placeholder'=>'Votre Prénom')) !!}
               </div>

                <div class="rw-contact-field">
                    {!! Form::label('nom', 'Nom :', ['class'=>'not_mobile'] ) !!}
                    {!! Form::text('lastname', null, 
                    array('required', 
                        'placeholder'=>'Votre Nom')) !!}
                </div>

                <div class="rw-contact-field">
                    {!! Form::label('email', 'Email :', ['class'=>'not_mobile'] ) !!}
                    {!! Form::email('email', null, 
                    array('required', 
                        'placeholder'=>'votremail@mail.fr')) !!}
                </div>

                <div class="rw-contact-field">
                    {!! Form::label('objet', 'Objet de votre Email :', ['class'=>'not_mobile'] ) !!}
                    {!! Form::select('objet', array (
                    'Site web' => array('Demande d\'informations' => 'Demande d\'informations', 'bug sur le site' => 'Je veux signaler un bug', 'problème d\'accès au site' => 'Je n\'ai pas accès au site', 'problème d\'inscription au site' => 'Je n\'arrive pas à m\'inscrire au site', 'à propos du site' => 'Autre'),
                    'Blog' => array('remarque sur un article' => 'J\'ai une remarque à faire concernant un article', 'à propos du blog' => 'Autre'),
                    'Association' => array('demande d\'infos sur l\'association' => 'J\'aimerais obtenir plus de renseignements sur l\'association', 'à propos de l\'association' => 'Autre'),
                    'Autre' => array('sans objet' => 'Autre')
                    )) !!}
                </div>

                <div class="rw-contact-field">
                    {!! Form::label('message', 'Message :', ['class'=>'not_mobile'] ) !!}
                    {!! Form::textarea('message', null, 
                    array('required', 
                          'placeholder'=>'Entrez votre message')) !!}
                </div>

                <div class="rw-contact-field">
                    {!! Form::label('url', 'Url de la page concernée :', ['class'=>'not_mobile'] ) !!}
                    {!! Form::url('url', null, 
                    array('placeholder'=>'Copiez-collez l\'url de la page concernée si besoin' )) !!}
                </div>

                <div class="rw-sub-input-file-container">
                    <p class="not_mobile">Capture d'écran :</p>
                    <div>
                        {!! Form::label('my-file', 'Joindre une image...',
                        array('class' => 'rw-sub-input-file-trigger',
                            'tabindex' => '0' )) !!}
                        {!! Form::file('file', ['class' => 'rw-sub-input-file', 'id' => 'my-file']) !!}
                        <p class="rw-sub-file-return"></p>
                    </div>
                </div>

                <div class="rw-contact-field">
                    {!! Form::checkbox('copie', 'yes', false, 
                        array('id'=>'copie')) !!}
                    {!! HTML::decode(Form::label('copie', '<span class="ui"></span> Je désire recevoir une copie de mon message par email')) !!}
                        
                </div>
                <div class="rw-contact-field">
                    {!! Form::submit('Envoyer', 
                    array ('required', 
                            'name' => 'envoyer', 
                            'id' => 'envoyer'
                    )) !!}
                </div>

            </fieldset>

        {!! Form::close() !!}


        {!! Form::open(array('route' => 'contact_store', 'files' => 'true', 'enctype' => 'multipart/form-data', 'class'=>'not_screen')) !!}

        <fieldset>

            <div class="rw-contact-field-mobile">
                {!! Form::text('firstname', null,
                array('required',
                    'placeholder'=>'Votre Prénom')) !!}
            </div>

            <div class="rw-contact-field-mobile">
                {!! Form::text('lastname', null,
                array('required',
                    'placeholder'=>'Votre Nom')) !!}
            </div>

            <div class="rw-contact-field-mobile">
                {!! Form::email('email', null,
                array('required',
                    'placeholder'=>'votremail@mail.fr')) !!}
            </div>

            <div class="rw-contact-field-mobile">
                {!! Form::select('objet', array (
                'Site web' => array('Demande d\'informations' => 'Demande d\'informations', 'bug sur le site' => 'Je veux signaler un bug', 'problème d\'accès au site' => 'Je n\'ai pas accès au site', 'problème d\'inscription au site' => 'Je n\'arrive pas à m\'inscrire', 'à propos du site' => 'Autre'),
                'Blog' => array('remarque sur un article' => 'J\'ai une remarque à faire', 'à propos du blog' => 'Autre'),
                'Association' => array('demande d\'infos sur l\'association' => 'Recevoir des Infos', 'à propos de l\'association' => 'Autre'),
                'Autre' => array('sans objet' => 'Autre')
                )) !!}
            </div>

            <div class="rw-contact-field-mobile">
                {!! Form::textarea('message', null,
                array('required',
                      'placeholder'=>'Entrez votre message')) !!}
            </div>

            {{--<div class="rw-contact-field-mobile">--}}
                {{--{!! Form::url('url', null,--}}
                {{--array('placeholder'=>'Copiez-collez l\'url de la page concernée si besoin' )) !!}--}}
            {{--</div>--}}

            {{--<div class="rw-sub-input-file-container-mobile">--}}
                {{--<p class="not_mobile">Capture d'écran :</p>--}}
                {{--<div>--}}
                    {{--{!! Form::file('file', ['class' => 'rw-sub-input-file', 'id' => 'my-file']) !!}--}}
                    {{--<p class="rw-sub-file-return"></p>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="rw-contact-field-mobile">--}}
                {{--{!! Form::checkbox('copie', 'yes', false,--}}
                    {{--array('id'=>'copie')) !!}--}}
                {{--{!! HTML::decode(Form::label('copie', '<span class="ui"></span> Je désire recevoir une copie de mon message par email')) !!}--}}

            {{--</div>--}}
            <div class="rw-contact-field-mobile">
                {!! Form::submit('Envoyer',
                array ('required',
                        'name' => 'envoyer',
                        'id' => 'envoyer'
                )) !!}
            </div>

        </fieldset>

        {!! Form::close() !!}

    </div>
</div>

    @include('pages.components.footer')

@stop