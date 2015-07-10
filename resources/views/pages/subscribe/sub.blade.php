@extends('pages.app')

@section('content')

    <!---------------------
 développé par Pauline: Inscription : creation de compte et proposition d'adhésion association
----------------------->

<div class="rw-sub-container">

    <div class="rw-sub-header">
       <h1>Bienvenue sur le site de <span>Road-Web</span></h1>
        <h2>Tu veux faire partie de la communauté? <br/>
        Incris toi vite.</h2>

    </div>

    <div class="rw-sub-content">
        <form action="" method="" class="rw-sub-form">

            <fieldset>
                <input type="text" name="nom" placeholder="Nom"/>
                <input type="text" name="prenom" placeholder="Prénom"/>
            </fieldset>

            <fieldset>
                <input type="text" name="pseudo" placeholder="Pseudonyme"/>
                <input type="email" name="mail" placeholder="Adresse mail"/>
            </fieldset>


            <fieldset>
            <input type="password" name="password" placeholder="Mot de passe"/>
            <input type="password" name="password" placeholder="Confirmation de mot de passe"/>
            </fieldset>

            <fieldset class="rw-sub-checkbox">

                <p>
                    <input type="checkbox" id="emweb" />
                    <label for="emweb">
            <span class="ui">

            </span>Je suis ou j'ai été élève de l'EMWeb</label>
                </p>
            <!---------------------
             upload de fichier uniquement si checkbox élèves EmWeb sélectionnée
            ----------------------->
               <p>
                La validation de votre inscription en tant qu'élève ou ancien élève de l'EMWeb se fait par l'envoi d'un certificat de scolarité à votre nom directement par ce formulaire.

               </p>

                <div class="rw-sub-input-file-container">
                    <input class="rw-sub-input-file" id="my-file" type="file">
                    <label for="my-file" class="rw-sub-input-file-trigger" tabindex="0">Choisir un fichier...</label>
                </div>
                <p class="rw-sub-file-return"></p>

                <p>
                    <input type="checkbox" id="assorw" />
                    <label for="assorw">
            <span class="ui">

            </span>Je désire des renseignements concernant l'association Road Web.</label>
                </p>


            </fieldset>
            <!---------------------
             validation du formulaire
            ----------------------->

            <button>Valider</button>


        </form>


    </div>

    <div class="rw-sub-advantages">

        <div class="rw-sub-advantages-zone">

            <h3>Une Communauté active</h3>

            <img src="{{asset('images/picto-avantage1.png')}}" alt="icône communauté"/>

            <p>Road-Web est un lieu d'échange et d'entraide pour tous les utilisateurs mais aussi pour les élèves et anciens élèves de l’EmWeb qui participent à son développement. Rejoindre Road-Web c’est intégrer une communauté active dans l’apprentissage et l’évolution des métiers du web.
            </p>

        </div>

        <div class="rw-sub-advantages-zone">

            <h3>Un complément d'apprentissage</h3>

            <img src="{{asset('images/picto-avantage2.png')}}" alt="icône apprentissage"/>

            <p>Road-Web se propose d’être une épaule sur laquelle s’appuyer pour approfondir les connaissances et les compétences liées aux métiers du web. Que vous soyez autodidacte ou faisant partie de l’EmWeb, vous trouverez ici des conseils et des informations qui pourront compléter vos connaissances. Et tout peut se faire à votre rythme !
            </p>

        </div>

        <div class="rw-sub-advantages-zone">

            <h3>Des contenus exclusifs</h3>

            <img src="{{asset('images/picto-avantage3.png')}}" alt="icône contenu"/>

            <p>Road-Web est une plate-forme qui se veut complémentaire pour vous dans votre apprentissage. La communauté Road-Web vous donne accès à des contenus spécifiquement écrits et étudiés pour ce site. Le but étant que vous ayez accès à des compléments exclusifs pour accroître vos compétences.
            </p>

        </div>

    </div>


</div>


@stop