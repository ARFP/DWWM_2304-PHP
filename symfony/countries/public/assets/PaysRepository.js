class PaysRepository 
{
    static baseUrl = "./assets";

    static async getListePays() 
    {
        try {
            let r = await fetch(PaysRepository.baseUrl + '/countries.json');
            let json = await r.json();
            for(let i = 0; i < json.length; i++) {
                json[i].id = i+1;
                json[i].villes = [];
            }
            return json;
        }
        catch(err) {
            console.warn('Liste des pays indisponible');
        }
        
    }

    static async getListeVilles()
    {
        try {
            let r = await fetch(PaysRepository.baseUrl + '/cities.json');
            let json = await r.json();
            return json;
        }
        catch(err) {
            console.warn('Liste des villes indisponible');
        }
    }

/* -------------------------------------------------------- */

    static async initListeVilles()
    {
        let c = await PaysRepository.initListePays();
        let j = await PaysRepository.getListeVilles();
        
        console.log(j.length, c.length);

        if(j.length > 0) {
            return j;
        }

        let r = await fetch('./assets/cities.json');
        let json = await r.json();

        for(let p of json) {
            let villePays = c.find(x => x.codePays == p.country_code);
            let idPays = villePays.id;
            let pp = await fetch(PaysRepository.baseUrl + '/villes', {
                method: 'POST',
                headers: {
                    "Content-Type": 'application/json',
                    accept: 'application/json'
                },
                body: JSON.stringify({
                    codePostalVille: p.city_zipcode,
                    nomVille: p.city_name,
                    pays: '/api/pays/' + idPays
                })
            });
            let result = await pp.json();
            console.log(result);
        }
        
        return await PaysRepository.getListeVilles();
    }

    static async initListePays()
    {
        let j = await PaysRepository.getListePays();
        
        console.log(j.length);

        if(j.length > 0) {
            return j;
        }

        let r = await fetch('./assets/countries.json');
        let json = await r.json();

        for(let p of json) {
            let pp = await fetch(PaysRepository.baseUrl + '/pays', {
                method: 'POST',
                headers: {
                    "Content-Type": 'application/json',
                    accept: 'application/json'
                },
                body: JSON.stringify({
                    codePays: p.country_code,
                    nomPays: p.country_name,
                    villes: []
                })
            });
            let result = await pp.json();
            console.log(result);
        }
        
        return await PaysRepository.getListePays();
    }
}

export { PaysRepository }