class Production 
{
    constructor(prod) {
        this.id = prod.id;
        this.name = prod.name;
        this.description = prod.description;
        this.productionTime = prod.productionTime;
        this.cpuId = prod.cpuId;
        this.cpu = null;
        this.interval = null;
        this.currentStatus = 0;
        this.nbToProduce = 1;
        this.totalProduced = 0;
    }

    setCpu(_cpu) {
        this.cpu = _cpu;
        this.description = "Production Line for " + this.cpu.fullname;
    }

    start() {
        this.currentStatus = 0;
        this.totalProduced = 0;
        this.interval = setInterval(() => {
            if(this.totalProduced < this.nbToProduce) {
                if(this.currentStatus < this.productionTime) {
                    this.currentStatus += 0.1;
                } else {
                    this.currentStatus = 0;
                    this.totalProduced++;
                }
            } else {
                this.stop();
            }
        }, 100);
    }

    stop() {
        clearInterval(this.interval);
        this.interval = null;
    }
}

export { Production }