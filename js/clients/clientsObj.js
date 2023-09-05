class Clients {
    constructor (){
        this._id="";
        this._name="";
        this._zipcode="";
        this._address="";
    }

    setId(id) {
        this.id = id;
    }

    getId() {
        return this._id;
    }
    
    setName(name) {
        this._name = name;
    }

    getName() {
        return this._name;
    }

    setZipcode(zipcode) {
        this._zipcode = zipcode;
    }

    getZipcode() {
        return this._zipcode;
    }

    setAddress(address) {
        this._address = address;
    }

    getAddress() {
        return this._address;
    }

    setAll()
}