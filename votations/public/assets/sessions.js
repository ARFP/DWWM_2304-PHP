import { VotationsRepository } from "./VotationsRepository.js";

const app = {

    data() {
        return {
            listeSessions: [],
            sessionSelectionnee: 0
        }
    },

    async mounted() {
        this.listeSessions = await VotationsRepository.getSessionsVotes()
        console.log(this.listeSessions);
    },

    methods: {
        afficherSession()
        {
            let maSession = this.listeSessions.filter(x => x.id == this.sessionSelectionnee)
            maSession = JSON.stringify(maSession[0] ?? {});
            localStorage.setItem('idSession', this.sessionSelectionnee);
            localStorage.setItem('objSession', maSession);
            document.location.href="./candidats.html";
        }
    }

}

Vue.createApp(app).mount('#app'); 