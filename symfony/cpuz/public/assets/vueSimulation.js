import { JsonRepository } from "./JsonRepository.js";
import { Production } from "./Production.js";

const app = {
    data() {
        return {
            prods: []
        }
    },
    async mounted() {
        this.prods = await JsonRepository.getProdsList();
    },
    methods: {
        startProd(event) {
            let prodId = event.target.dataset.id;
            let prodObj = this.prods.find(x => x.id == prodId);
            prodObj.start();
        }
    }
}

Vue.createApp(app).mount('#app');