import { VotationsRepository } from './VotationsRepository.js';


const app = {
    data() {
        return {
            listeCandidats:[],
            sessionEnCours: {},
        }
    },
    async mounted() {
        
        let maSession = localStorage.getItem('objSession');
        this.sessionEnCours = JSON.parse(maSession);

        console.log(this.sessionEnCours);

        for(let unCandidat of this.sessionEnCours.candidats) {

            let monCandidat = unCandidat.split('/');

            let identifiant = monCandidat[monCandidat.length-1];

            monCandidat = await VotationsRepository.getCandidat(identifiant);

            console.log(identifiant, monCandidat);

            this.listeCandidats.push(monCandidat);
        }
        
        this.listeCandidats = this.listeCandidats.sort((a,b) => Math.random() - 0.5);
        
        localStorage.setItem('arrayCandidats', JSON.stringify(this.listeCandidats));
    },
    computed: {
        nbCandidats() {
            return this.listeCandidats.length;
        }
    },
    methods: {
        async clickBouton(event) {
            let idCandidat = event.target.dataset.id;
            let ouiNon = event.target.textContent;
            let idSession = this.sessionEnCours.id;

            document.getElementById(idCandidat).classList.add('hide');

            if(ouiNon == 'Oui') {
                //console.log(idCandidat, idSession);
                let resultat = await VotationsRepository.addVote(idCandidat, idSession);
                console.log(resultat);
            }
        }
    }
}

Vue.createApp(app).mount('#app');