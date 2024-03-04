class Cpu 
{
    constructor(cpu) {
        Object.assign(this, cpu);
        this.stock = 0;
        this.fullname = this.brand + ' ' + this.family + ' ' + this.model;
    }

}

export { Cpu }
