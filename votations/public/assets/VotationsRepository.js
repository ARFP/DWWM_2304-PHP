import { Candidat } from "./Candidat.js";

/**
 * Contient les requêtes vers l'API
 */
class VotationsRepository 
{
    /** @var {String} apiBaseUrl URL de base de l'api  */
    static apiBaseUrl = '/api';

    /**
     * Emet une requête vers l'api et retourne la réponse correspondante
     * @param {String} chemin Chemin vers la ressource 
     * @param {Object} options options pour la requête
     * @returns {Array|Object} La réponse JSON formattée en tableau ou objet
     */
    static async fetchUrl(chemin, options = {}) 
    {
        // Concaténation de l'url de base avec le chemin fourni en argument
        let url = VotationsRepository.apiBaseUrl + chemin;

        // Exécution de la requête vers l'API
        let response = await fetch(url, options);

        // Formattage de la réponse en array ou objet exploitable en JS
        let json = await response.json();

        console.log(url, json);

        return json;
    }

    /**
     * Récupère les information d'un candidat
     * @param {Number} identifiant L'identifiant du candidat à récupérer
     * @returns {Object} Les données du candidat
     */
    static async getCandidat(identifiant)
    {
        // concaténation du chemin et de l'identifiant du candidat
        let chemin = '/candidats/' + identifiant;

        // Récupération des données
        let json = await VotationsRepository.fetchUrl(chemin);

        // Instanciation d'u nobjet candidat à partir des données récupérées
        let c = new Candidat(json);

        return c;
    }

    /**
     * Récupère les informations d'une session de vote
     * @param {Number} identifiant L'identifiant de la session de vote
     * @returns {Object} Les informations de la session de vote
     */
    static async getSessionVote(identifiant)
    {
        // concaténation du chemin et de l'identifiant de la session de vote
        let chemin = '/sessions_votes/' + identifiant;

        // Récupération des données
        let json = await VotationsRepository.fetchUrl(chemin);

        console.log('session_vote', json);

        return json;
    }

    /**
     * Récupération des sessions de vote
     * @returns {Array} La liste des sessions de vote
     */
    static async getSessionsVotes() 
    {
        let chemin = '/sessions_votes';

        let json = await VotationsRepository.fetchUrl(chemin);

        console.log('session_vote', json);

        return json;
    }

    static async addVote(idCandidat, idSession)
    {
        /*
        {
        "tour": 1,
        "session": "/api/sessions_votes/1",
        "candidat": "/api/candidats/3"
        }
        */

        let newVote = {
            tour: 1,
            session: "/api/sessions_votes/" + idSession,
            candidat: "/api/candidats/" + idCandidat
        }

        let newVoteJson = JSON.stringify(newVote);

        let options = {
            method: 'POST', // GET, POST, PUT, PATCH, DELETE
            headers: {
                "Content-Type": "application/json",
                accept: "application/json"
            },
            body: newVoteJson
        }

        let response = await fetch('http://localhost:3000/api/votes', options);

        if(response.status == 201) {
             let json = response.json();
             return json;
        }
       
        throw new Error("Le vote n'a pas été enregistré !");

    }

    
    /*
    static async getCandidats()
    {
        let listeCandidats = [];

        let json = await VotationsRepository.fetchUrl('/candidats');
        
        for(let candidat of json){
            let c = new Candidat(candidat);
            listeCandidats.push(c);
        }

        console.log('candidats', listeCandidats);

        return listeCandidats;
    }
    */
}

export { VotationsRepository, Candidat }
