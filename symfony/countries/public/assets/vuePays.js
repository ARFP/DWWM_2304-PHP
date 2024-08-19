import { PaysRepository } from './PaysRepository.js';

const app = {
    data() {
        return {
            listePays: [],
            listeVilles: [],
            monPays: null,
            newVille: '',
            newVilleId: 1000
        }
    },

    async mounted() {
        this.listePays = await PaysRepository.getListePays();
        this.listeVilles = await PaysRepository.getListeVilles();
        this.monPays = this.listePays[0] ?? {};
        for(let i = 0; i < this.listePays.length; i++) {
            this.listePays[i].villes = this.listeVilles.filter(x => x.country_code == this.listePays[i].country_code)
        }
        console.log(this.listePays);
    },
    methods: {
        ouvrirModal(event) {
            let idPays = event.target.dataset.id;
            this.monPays = this.listePays.find(x => x.id == idPays);
            this.$refs.modal.style.display = 'block';
            console.log(this.monPays);
        },
        fermerModal() {
            this.$refs.modal.style.display = 'none';
        },
        ajouterUneVille(e) {
            console.log(this.monPays, this.newVille);

            if(this.newVille.length > 2) {
                this.monPays.villes.push({
                    "id": ++this.newVilleId,
                    "city_zipcode": "",
                    "city_name": this.newVille.trim(),
                    "country_code": this.monPays.country_code,
                    "country_name": this.monPays.country_name
                });
            }
        }
    }
}

Vue.createApp(app).mount('#app'); 
