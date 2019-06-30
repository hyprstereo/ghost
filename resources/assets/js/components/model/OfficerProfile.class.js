class OfficerProfile {
    constructor() {
        this.id = 0;
        this.rank = '';
        this.grade = '';
        this.name = '';
        this.officerId = '';
        this.identityCard = '';

        this.caseId = 0;
        this.responsibility = ''; // leader or investigator or prosecutor
    }

    displayName() {
        return this.rank + ' ' + this.name;
    }
}

export default OfficerProfile;