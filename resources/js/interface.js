/**
 * Fonctions permettant d'ajouter ou supprimer une classe sur les colonnes sur la page d'accueil
 * Source : https://stackoverflow.com/questions/43666655/remove-class-only-depending-on-screen-size
 * @author Jonathan Carrière
 */
$(document).ready(function(){
    if(window.innerWidth <= 500){
        $('.container.col-3.mb-3.text-center').removeClass('container');
    }
});

$(window).resize(function(){
    if(window.innerWidth <= 500){
        $('.container.col-3.mb-3.text-center').removeClass('container');
    }else{
        $('.col-3.mb-3.text-center').addClass('container');
    }
});


/**
 * Fonctions permettant d'indiquer clairement à l'utilisateur sur quelle page il se retrouve via les liens de la navbar
 * Source : https://stackoverflow.com/questions/48239/getting-the-id-of-the-element-that-fired-an-event
 * Source : https://stackoverflow.com/questions/51606783/keep-added-jquery-classes-after-page-refresh-or-page-load
 * @author Jonathan Carrière
 */
$(".nav-link.text-light, .navbar-brand, .dropdown-item.bg-dark.text-light").on('click', function(event){
    localStorage.setItem("id", event.target.id);
});

$(document).ready(function() {
    $("#"+localStorage.id).addClass('fw-bolder text-decoration-underline');
});


/**
 * Sélecteur JQuery permettant de supprimer la classe 'text-muted' sur le texte pour la pagination
 * @author Jonathan Carrière
 */
$('.text-muted').removeClass('text-muted');
