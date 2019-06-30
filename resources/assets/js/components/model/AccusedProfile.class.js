class AccusedProfile {
    constructor() {
        this.id = 0;
        this.caseId = 0;
        this.type = 'private'; // private or company
        this.name = '';

        // if accused is a person
        this.identity = '';
        this.race = '';
        this.gender = '';
        this.age = 18;
        this.occupation = '';

        // if accused is a company
        this.regNumber = '';

        this.remarks = '';
    }

    getProfileTableData (key=0) {
        let dataItem = {
            key: key,
            name: this.name,
            type: '',
            id: ''
        };

        if (this.type == 'private') {
            dataItem.type = 'Private';
            dataItem.identity = this.identity;
        } else {
            dataItem.type = 'Company';
            dataItem.identity = this.regNumber;
        }
        return dataItem;
    }
}

export default AccusedProfile;