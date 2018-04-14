
@extends('layout.main')
@section('content')

<div class="container" style="width:60%">
    @if($lang == "ro")
        <div class="panel-category marginTop40">
            <div class="panel-header">
                Publicarea anunturilor
                <a>
                    <i class="fa fa-chevron-down trigger" aria-hidden="true" data-id="first"></i>
                </a>
            </div>
            <div id="first" class="panel-content hidden">
                <p>
                    <strong>Pasul 1:</strong> Completeaza formularul de adaugare anunt - il gasesti in coltul din stanga
                    sus al tuturor paginilor din site, cu titlul <b>"Vinde"</b>. Daca ai ajuns in pagina care arata ca mai jos,
                    inseamna ca este la locul potrivit.
                </p>
                <img src="{{URL::asset('/img/help-img/add-item.png')}}">
                <p>
                    <strong>Pasul 2:Completeaza datele din formular:</strong>  nume, categoria potrivita, poze etc. si la final da click pe butonul de publicare:
                </p>
                <img src="{{URL::asset('/img/help-img/save-item.png')}}">
            </div>
        </div>
        <div class="panel-category">
            <div class="panel-header">
                Administrare anunturi
                <a>
                    <i class="fa fa-chevron-down trigger" aria-hidden="true" data-id="second"></i>
                </a>
            </div>
            <div id="second" class="panel-content hidden">
                <p>
                    Intra in cont si iata ce vei vedea (poza de mai jos este un exemplu orientativ):
                </p>
                <img src="{{URL::asset('/img/help-img/admin-messages.png')}}">
                <p>
                    Asadar, aici gasesti <b>fiecare anunt</b>, cu optiunile:<br>
                    - <i>Previzualizare</i> (cand vrei sa vezi cum apare anuntul tau pe site, asa cum il vad cumparatorii)<br>
                    - <i>Edit</i> (atunci cand vrei sa schimbi texte, poze sau alte informatii din anunt)<br>
                    - <i>Delete</i> (cand vinzi si vrei sa marchezi anuntul ca atare)
                </p>
            </div>
        </div>
        <div class="panel-category">
            <div class="panel-header">
                Administrare cont
                <a>
                    <i class="fa fa-chevron-down trigger" aria-hidden="true" data-id="second2"></i>
                </a>
            </div>
            <div id="second2" class="panel-content hidden">
                <p>
                    Pentru a crea un cont pe AllTime, ai nevoie de un username, o adresa de mail si o parola.
                </p>
                <p>
                    Pentru <b>crearea contului</b> urmeaza pasii de mai jos:
                </p>
                <ul>
                    <li>Acceseaza pe AllTime</li>
                    <li>Selecrezi "Inregistrare";</li>
                    <li>Completeaza numele complet si adresa de mail - care nu a mai fost folosita pentru crearea unui alt cont;</li>
                    <li>Seteaza o parola pentru contul tau.</li>
                </ul>
                <img src="{{URL::asset('/img/help-img/add-user.png')}}">
            </div>
        </div>
        <div class="panel-category">
            <div class="panel-header">
                Mesaje
                <a>
                    <i class="fa fa-chevron-down trigger" aria-hidden="true" data-id="third"></i>
                </a>
            </div>
            <div id="third" class="panel-content hidden">
                <p>
                    Ai cea mai eficienta varianta de cautare:
                </p>
                <p>
                    <b>Prin cautare dupa cuvinte-cheie</b>, in pagina prinicipala AllTime; foloseste caseta de cautare de sus si scrie 1-2 cuvinte reprezentative pentru anuntul tau. De exemplu:
                </p>
                <img src="{{URL::asset('/img/help-img/search.png')}}">
                <p>
                    Cand vezi un anunt potrivit, <b>da click pe titlu</b>. Varianta cea mai eficienta de comunicare este crearea
                    de oferte vanzatorilor impreuna cu mesajul clientului sau in cazul cumpararii directe, metoda
                    cea mai eficienta de comunicare este trimiterea unui mesaj.
                </p>
                <img src="{{URL::asset('/img/help-img/message.png')}}">
            </div>
        </div>
        <div class="panel-category">
            <div class="panel-header">
                Despre AllTime
                <a>
                    <i class="fa fa-chevron-down trigger" aria-hidden="true" data-id="fourth"></i>
                </a>
            </div>
            <div id="fourth" class="panel-content hidden">
                <p>
                    AllTime conecteaza oamenii din aceeasi regiune si ii ajuta sa cumpere, sa vanda sau sa liciteze bunuri utilizate/noi intr-un mod foarte rapid si usor, direct de pe calculator.
                </p>
                <p>
                    Fiind noi in domeniul gestiunii vanzarilor si licitatiilor, serviciile noastre de gazduire a anunturilor sunt gratuite indiferent de termenul anuntului stabilit de catre vanzator pe AllTime
                </p>
                <p>
                    Dupa cum se poate vedea clientii nostri isi pot stabili termenul de valabilitate a anuntului indiferent de durata acestuia. Se poate vedea in imaginea de mai jos, la adaugarea unui nou anunt:
                </p>
                <img src="{{URL::asset('/img/help-img/calendar.png')}}">
                <p>
                    Adresa sediu: Str. Intre Lacuri nr. 24, bl. C2, ap. 19<br>
                    E-mail: samy_gui95[at]yahoo.com<br>
                    Tel.: +40748152672
                </p>
            </div>
        </div>
    @elseif($lang == "fr")
        <div class="panel-category marginTop40">
            <div class="panel-header">
                Publication announces
                <a>
                    <i class="fa fa-chevron-down trigger" aria-hidden="true" data-id="first"></i>
                </a>
            </div>
            <div id="first" class="panel-content hidden">
                <p>
                    <strong>Etape 1: </strong> Remplissez le formulaire d'ajout ad - vous pouvez trouver dans le
                    coin superieur gauche de toutes les pages du site, intitule <b>Vendre</b>.
                    Si vous arrivez a la page qui ressemble comme ci-dessous, cela signifie que le bon endroit.
                </p>
                <img src="{{URL::asset('/img/help-img/add-item.png')}}">
                <p>
                    <strong>Etape 2: Remplissez les donnees de formulaire:</strong> nom, les images appropriees, etc. et enfin cliquez sur le bouton Publier:
                </p>
                <img src="{{URL::asset('/img/help-img/save-item.png')}}">
            </div>
        </div>
        <div class="panel-category">
            <div class="panel-header">
                Gerer les annonces
                <a>
                    <i class="fa fa-chevron-down trigger" aria-hidden="true" data-id="second"></i>
                </a>
            </div>
            <div id="second" class="panel-content hidden">
                <p>
                    Connectez-vous et c'est ce que vous verrez (image ci-dessous est un exemple indicatif):
                </p>
                <img src="{{URL::asset('/img/help-img/admin-messages.png')}}">
                <p>
                    Ainsi, vous trouverez ici <b>chaque annonce</b> avec des options:<br>
                    - <i>Apercu</i> (si vous voulez voir comment votre annonce apparait sur le site, comme je vois les acheteurs)<br>
                    - <i>Modifier</i> (si vous voulez changer des textes, des images ou d'autres informations dans l'annonce)<br>
                    - <i>Supprimer</i> (lorsque vous vendez et que vous voulez marquer l'annonce elle-meme)
                </p>
            </div>
        </div>
        <div class="panel-category">
            <div class="panel-header">
                La gestion des comptes
                <a>
                    <i class="fa fa-chevron-down trigger" aria-hidden="true" data-id="second2"></i>
                </a>
            </div>
            <div id="second2" class="panel-content hidden">
                <p>
                    Pour creer un AllTime de compte, vous avez besoin d'un nom d'utilisateur, une adresse e-mail et mot de passe.
                </p>
                <p>
                    Lors de la <b>creation de votre compte</b> suivre les etapes ci-dessous:
                </p>
                <ul>
                    <li>Recherche sur AllTime Mon compte</li>
                    <li>Selecrezi "Register"</li>
                    <li>Completez votre nom et votre adresse e-mail - qui n'a pas ete utilise pour creer un autre compte;</li>
                    <li>Definissez un mot de passe pour votre compte.</li>
                </ul>
                <img src="{{URL::asset('/img/help-img/add-user.png')}}">
            </div>
        </div>
        <div class="panel-category">
            <div class="panel-header">
                Messages
                <a>
                    <i class="fa fa-chevron-down trigger" aria-hidden="true" data-id="third"></i>
                </a>
            </div>
            <div id="third" class="panel-content hidden">
                <p>
                    Vous l'option de recherche le plus efficace:
                </p>
                <p>
                    <b>recherche par mots-cles</b>, la page totalement la AllTime; utilisez la zone de recherche ci-dessus et entrez votre annonce representant 1-2 mots. Par exemple:
                </p>
                <img src="{{URL::asset('/img/help-img/search.png')}}">
                <p>
                    Lorsque vous voyez une annonce faites un <b>clic droit sur le titre</b>. La communication la plus
                    efficace est de creer des opportunites vendeurs avec le message du client ou si
                    l'achat direct, la communication la plus efficace est d'envoyer un message.
                </p>
                <img src="{{URL::asset('/img/help-img/message.png')}}">
            </div>
        </div>
        <div class="panel-category">
            <div class="panel-header">
                A propos de AllTime
                <a>
                    <i class="fa fa-chevron-down trigger" aria-hidden="true" data-id="fourth"></i>
                </a>
            </div>
            <div id="fourth" class="panel-content hidden">
                <p>
                    AllTime relie les gens de la meme region et aider a acheter, vendre ou produits d'encheres utilise / nous dans un très rapide et facile directement a partir de l'ordinateur.
                </p>
                <p>
                    Etre ventes sur le terrain et la gestion des ventes, nos services sont gratuits heberges ad ad quel que soit le terme fixe par le vendeur sur AllTime
                </p>
                <p>
                    Comme vous pouvez le voir nos clients a etablir leur période de validite de l'avis quelle que soit sa duree. Vous pouvez le voir dans l'image ci-dessous pour ajouter une nouvelle annonce:
                </p>
                <img src="{{URL::asset('/img/help-img/calendar.png')}}">
                <p>
                    Adresse sediu: Str. Intre Lacuri nr. 24, bl. C2, ap. 19<br>
                    E-mail: samy_gui95[at]yahoo.com<br>
                    Tel.: +40748152672
                </p>
            </div>
        </div>
    @else
        <div class="panel-category marginTop40">
            <div class="panel-header">
                Publication of advertisements
                <a>
                    <i class="fa fa-chevron-down trigger" aria-hidden="true" data-id="first"></i>
                </a>
            </div>
            <div id="first" class="panel-content hidden">
                <p>
                    <strong>Step 1:</strong> Complete the ad insertion form - find it in the top left corner of all the pages on the site, titled
                    <b>"Sell"</b>.  If you get to the page that looks like below, it means it's in the right place.
                </p>
                <img src="{{URL::asset('/img/help-img/add-item.png')}}">
                <p>
                    <strong>Step 2: Fill in the form data:</strong> name, appropriate category, pictures, etc. And finally click on the save button:
                </p>
                <img src="{{URL::asset('/img/help-img/save-item.png')}}">
            </div>
        </div>
        <div class="panel-category">
            <div class="panel-header">
                Manage ads
                <a>
                    <i class="fa fa-chevron-down trigger" aria-hidden="true" data-id="second"></i>
                </a>
            </div>
            <div id="second" class="panel-content hidden">
                <p>
                    Log in and here's what you'll see (the picture below is an example):
                </p>
                <img src="{{URL::asset('/img/help-img/admin-messages.png')}}">
                <p>
                    So here you can find each ad with the options:<br>
                    - <i>Preview</i> (when you want to see how your ad appears on the site, as buyers see)<br>
                    - <i>Edit</i> (when you want to change texts, pictures or other information in the ad)<br>
                    - <i>Delete</i> (when you sell and want to mark the ad as such)
                </p>
            </div>
        </div>
        <div class="panel-category">
            <div class="panel-header">
                Account administration
                <a>
                    <i class="fa fa-chevron-down trigger" aria-hidden="true" data-id="second2"></i>
                </a>
            </div>
            <div id="second2" class="panel-content hidden">
                <p>
                    To create an account on AllTime, you need a username, a mailing address, and a password.
                </p>
                <p>
                    To <b>create your accoun</b> t follow the steps below:
                </p>
                <ul>
                    <li>Access AllTime "My Account;</li>
                    <li>Select "Sign up";</li>
                    <li>Fill in the full name and email address - which was not used to create another account;</li>
                    <li>Set a password for your account.</li>
                </ul>
                <img src="{{URL::asset('/img/help-img/add-user.png')}}">
            </div>
        </div>
        <div class="panel-category">
            <div class="panel-header">
                Posts
                <a>
                    <i class="fa fa-chevron-down trigger" aria-hidden="true" data-id="third"></i>
                </a>
            </div>
            <div id="third" class="panel-content hidden">
                <p>
                    You have the most effective search option:
                </p>
                <p>
                    Search by keyword on the AllTime main page; Use the top search box and write 1-2 words representative of your ad. E.g:
                </p>
                <img src="{{URL::asset('/img/help-img/search.png')}}">
                <p>
                    When you see an appropriate ad, click on the title. The most effective communication option is
                    to create offers for sellers along with the customer's message or in the case of direct purchase,
                    the most effective communication method is sending a message.
                </p>
                <img src="{{URL::asset('/img/help-img/message.png')}}">
            </div>
        </div>
        <div class="panel-category">
            <div class="panel-header">
                About AllTime
                <a>
                    <i class="fa fa-chevron-down trigger" aria-hidden="true" data-id="fourth"></i>
                </a>
            </div>
            <div id="fourth" class="panel-content hidden">
                <p>
                    AllTime connects people in the same region and helps them buy, sell or bid, used / new goods in a very fast and easy way, directly from the computer.                </p>
                <p>
                    Being new in sales and bid management, our ad hosting services are free of charge regardless of the time limit set by the seller on AllTime                </p>
                <p>
                    As our clients can see, they can set the ad's validity term regardless of its duration. You can see in the image below, when you add a new ad:                </p>
                <img src="{{URL::asset('/img/help-img/calendar.png')}}">
                <p>
                    Address: Str. Intre Lacuri nr. 24, bl. C2, ap. 19<br>
                    E-mail: samy_gui95[at]yahoo.com<br>
                    Phone: +40748152672
                </p>
            </div>
        </div>
    @endif
</div>
<script>
    $(document).ready(function(){
        $(".trigger").on("click", function(){
            var id = $(this).attr("data-id");
            if($(this).hasClass("fa-chevron-up")) {
                $(this).removeClass("fa-chevron-up");
                $(this).addClass("fa-chevron-down");
                $("#" + id).addClass("hidden");
            }else {
                $(".trigger").removeClass("fa-chevron-up").addClass("fa-chevron-down");

                $(this).removeClass("fa-chevron-down");
                $(this).addClass("fa-chevron-up");
                $(".panel-content").addClass("hidden");
                $("#" + id).removeClass("hidden");
            }

        });
    });
</script>
@stop
