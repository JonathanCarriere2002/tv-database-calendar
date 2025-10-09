//@author Jonathan Carrière
let lstAnimes = [];

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$.ajax({
    type: "POST",
    url: "/async/horaires",
    dataType: 'json',
    success: function (data) {
        lstAnimes = data;
        chargement()
        creerCalendrier(lstAnimes)
    }
});

function chargement() {
    $("#spinner").addClass("hidden")
}

function afficherAnime(animeId){
    $.ajax({
        type: 'GET',
        url: '/afficherAnime',
        data: {id: animeId},
        dataType: 'json'
    })
    console.log("send")
}

/**
 * Fonction qui calcul la date des épisodes hébdomadaire
 * @param premierEpisode date du premier épisode
 * @param episode nombre d'épisodes
 * @returns {Date} retourne la date de l'épisode
 */
function calculerDateEpisode(premierEpisode, episode){
    const date = new Date(premierEpisode)
    let nbrJours = 7 * episode
    return new Date(date.setDate(date.getDate() + nbrJours))
}

function creerCalendrier(lstAnimes) {

    let calendarEl = document.getElementById('calendar');
    let calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            start: 'dayGridMonth,timeGridWeek,timeGridDay',
            center: 'title',
            end: 'prevYear,prev,today,next,nextYear'
        },
        eventClick: function(info) {
            window.location.href = `/animes/${info.event.id}`

        },
        titleFormat: {day: 'numeric', month: 'long', year: 'numeric'},
    });

    /**
    //Création d'un EventSource pour chaque genre d'anime
    // - Romance
    calendar.addEventSource({
        id: 'Romance',
        backgroundColor: '#F119DB',
        borderColorolor: '#F119DB',
        textColor: '#FFFFFF',
        className: 'Romance'
    })
    // - Action
    calendar.addEventSource({
        id: 'Action',
        backgroundColor: '#f11919',
        borderColorolor: '#f11919',
        textColor: '#FFFFFF',
        className: 'Action'
    })
    // - Aventure
    calendar.addEventSource({
        id: 'Aventure',
        backgroundColor: '#288306',
        borderColorolor: '#288306',
        textColor: '#FFFFFF',
        className: 'Aventure'
    })
    // - Mecha
    calendar.addEventSource({
        id: 'Mecha',
        backgroundColor: '#64c52a',
        borderColorolor: '#64c52a',
        textColor: '#FFFFFF',
        className: 'Mecha'
    })
    // - Shonen
    calendar.addEventSource({
        id: 'Shonen',
        backgroundColor: '#c5ab2a',
        borderColorolor: '#c5ab2a',
        textColor: '#FFFFFF',
        className: 'Shonen'
    })
    // - Slice of Life
    calendar.addEventSource({
        id: 'Slice of Life',
        backgroundColor: '#2ac5a1',
        borderColorolor: '#2ac5a1',
        textColor: '#FFFFFF',
        className: 'Slice of Life'
    })
    // - Drame
    calendar.addEventSource({
        id: 'Drame',
        backgroundColor: '#730202',
        borderColorolor: '#730202',
        textColor: '#FFFFFF',
        className: 'Drame'
    })
    // - Comédie
    calendar.addEventSource({
        id: 'Comédie',
        backgroundColor: '#2547b7',
        borderColorolor: '#2547b7',
        textColor: '#FFFFFF',
        className: 'Comédie'
    })
    // - Seinen
    calendar.addEventSource({
        id: 'Seinen',
        backgroundColor: '#c5782a',
        borderColorolor: '#c5782a',
        textColor: '#FFFFFF',
        className: 'Seinen'
    })
    // - Isekai
    calendar.addEventSource({
        id: 'Isekai',
        backgroundColor: '#520c7c',
        borderColorolor: '#520c7c',
        textColor: '#FFFFFF',
        className: 'Isekai'
    })
     */

    /* #######################################
       ## Ajout des animés à leur catégorie ##
       #######################################
     */
    lstAnimes.forEach(anime=>{
        if (anime.genre === 'Romance') {
            //Ajout d'un événement pour chaque épisode
            for(let e = 0; e < anime.episodes; e++){
                let dateEpisode = calculerDateEpisode(anime.date_debut, e)
                calendar.addEvent({
                    id: anime.id,
                    title: anime.titre,
                    start: dateEpisode,
                    allDay: true,
                    backgroundColor: '#F119DB',
                    borderColor: '#F119DB'
                });
            }
        }
        if (anime.genre === 'Action') {
            //Ajout d'un événement pour chaque épisode
            for(let e = 0; e < anime.episodes; e++) {
                let dateEpisode = calculerDateEpisode(anime.date_debut, e)
                calendar.addEvent({
                    id: anime.id,
                    title: anime.titre,
                    start: dateEpisode,
                    allDay: true,
                    backgroundColor: '#f11919',
                    borderColor: '#f11919'
                });
            }
        }
        if (anime.genre === 'Aventure') {
            //Ajout d'un événement pour chaque épisode
            for(let e = 0; e < anime.episodes; e++) {
                let dateEpisode = calculerDateEpisode(anime.date_debut, e)
                calendar.addEvent({
                    id: anime.id,
                    title: anime.titre,
                    start: dateEpisode,
                    allDay: true,
                    backgroundColor: '#288306',
                    borderColor: '#288306'
                });
            }
        }
        if (anime.genre === 'Mecha') {
            //Ajout d'un événement pour chaque épisode
            for(let e = 0; e < anime.episodes; e++) {
                let dateEpisode = calculerDateEpisode(anime.date_debut, e)
                calendar.addEvent({
                    id: anime.id,
                    title: anime.titre,
                    start: dateEpisode,
                    allDay: true,
                    backgroundColor: '#64c52a',
                    borderColor: '#64c52a'
                });
            }
        }
        if (anime.genre === 'Shonen') {
            //Ajout d'un événement pour chaque épisode
            for(let e = 0; e < anime.episodes; e++) {
                let dateEpisode = calculerDateEpisode(anime.date_debut, e)
                calendar.addEvent({
                    id: anime.id,
                    title: anime.titre,
                    start: dateEpisode,
                    allDay: true,
                    backgroundColor: '#c5ab2a',
                    borderColor: '#c5ab2a'
                });
            }
        }
        if (anime.genre === 'Slice of Life') {
            for(let e = 0; e < anime.episodes; e++) {
                //Ajout d'un événement pour chaque épisode
                let dateEpisode = calculerDateEpisode(anime.date_debut, e)
                calendar.addEvent({
                    id: anime.id,
                    title: anime.titre,
                    start: dateEpisode,
                    allDay: true,
                    backgroundColor: '#2ac5a1',
                    borderColor: '#2ac5a1'
                });
            }
        }
        if (anime.genre === 'Drame') {
            //Ajout d'un événement pour chaque épisode
            for(let e = 0; e < anime.episodes; e++) {
                let dateEpisode = calculerDateEpisode(anime.date_debut, e)
                calendar.addEvent({
                    id: anime.id,
                    title: anime.titre,
                    start: dateEpisode,
                    allDay: true,
                    backgroundColor: '#730202',
                    borderColor: '#730202'
                });
            }
        }
        if (anime.genre === 'Comédie') {
            //Ajout d'un événement pour chaque épisode
            for(let e = 0; e < anime.episodes; e++) {
                let dateEpisode = calculerDateEpisode(anime.date_debut, e)
                calendar.addEvent({
                    id: anime.id,
                    title: anime.titre,
                    start: dateEpisode,
                    allDay: true,
                    backgroundColor: '#2547b7',
                    borderColor: '#2547b7'
                });
            }
        }
        if (anime.genre === 'Seinen') {
            //Ajout d'un événement pour chaque épisode
            for(let e = 0; e < anime.episodes; e++) {
                let dateEpisode = calculerDateEpisode(anime.date_debut, e)
                calendar.addEvent({
                    id: anime.id,
                    title: anime.titre,
                    start: dateEpisode,
                    allDay: true,
                    backgroundColor: '#c5782a',
                    borderColor: '#c5782a'
                });
            }
        }
        if (anime.genre === 'Isekai') {
            //Ajout d'un événement pour chaque épisode
            for(let e = 0; e < anime.episodes; e++){
                let dateEpisode = calculerDateEpisode(anime.date_debut, e)
                calendar.addEvent({
                    id: anime.id,
                    title: anime.titre,
                    start: dateEpisode,
                    allDay: true,
                    backgroundColor: '#520c7c',
                    borderColor: '#520c7c'
                });
            }
        }
        //Affichage du calendrier
        calendar.render();
    })
}
