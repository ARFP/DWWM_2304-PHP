import { PaysRepository } from './PaysRepository.js';

const app = {
    data() {
        return {
            listePays: [],
            listeVilles: [],
            monPays: null
        }
    },

    async mounted() {
        this.listePays = await PaysRepository.getListePays();
        this.listeVilles = await PaysRepository.getListeVilles();
        this.monPays = this.listePays[0] ?? {};
        console.log(this.listePays);
    },
    methods: {
        ouvrirModal(event) {
            let idPays = event.target.dataset.id;
            this.monPays = this.listePays.find(x => x.id == idPays);
            this.$refs.modal.style.display = 'block';
        },
        fermerModal() {
            this.$refs.modal.style.display = 'none';
        }
    }
}

Vue.createApp(app).mount('#app'); 
