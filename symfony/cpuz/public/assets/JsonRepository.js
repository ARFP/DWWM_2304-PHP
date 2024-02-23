import { Cpu } from "./Cpu.js";
import { Production } from "./Production.js";

class JsonRepository 
{
    static cpuList = [];
    static prodsList = [];

    static async fetchJson(url, options = {})
    {
        let r = await fetch(url, options);
        let j = await r.json();
        return j;
    }

    static async getCpuList()
    {
        if(JsonRepository.cpuList.length < 1) {
            let c = await JsonRepository.fetchJson('./assets/cpuz.json');
            JsonRepository.cpuList = c.map(x => new Cpu(x));
        }

        return JsonRepository.cpuList;
    }

    static async getProdsList()
    {
        if(JsonRepository.prodsList.length < 1) {

            await JsonRepository.getCpuList();

            let prods = await JsonRepository.fetchJson('./assets/productions.json');

            for(let prod of prods) {
                let p = new Production(prod);
                p.setCpu(JsonRepository.cpuList.find(x => x.id == p.cpuId));
                JsonRepository.prodsList.push(p);
            }
        }
        
        return JsonRepository.prodsList;
    }
}

export { JsonRepository }
