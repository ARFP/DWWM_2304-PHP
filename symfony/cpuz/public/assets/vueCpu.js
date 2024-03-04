import { Cpu } from "./Cpu.js";
import { JsonRepository } from "./JsonRepository.js";

const app = {
    data() {
        return {
            cpuList: [],
            cpuSelect: null
        }
    },
    async mounted() {
        this.cpuList = await JsonRepository.getCpuList();
    },
    computed: {
        nbCpus() {
            return this.cpuList.length;
        }
    },
    methods: {
       /* selectCpu(event) {
            
            if(parseInt(event.target.value) > 0 ) {
                this.cpuSelect = this.cpuList.find(x => x.id == event.target.value);
            } else {
                this.cpuSelect = null;
            }
            
        }*/
    }
}

Vue.createApp(app).mount('#app');