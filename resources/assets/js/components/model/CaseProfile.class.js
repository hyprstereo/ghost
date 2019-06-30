class CaseProfile {
    constructor() {
        this.id = 0;
        this.dateOpen = null;
        this.dateClose = null;

        this.caseBookNo = null;
        this.location = null;
        this.station = null;

        this.profiles = [];

        this.crimeDetails = {
            location: '',
            dateTime: null,
            complainer: {
                name: '',
                reportNo: '',
                station: '',
                dateTime: null
            }
        }

        //officers
        this.teamLead = null;
        this.investigators = [];
        this.prosecutors = [];
    }

    getProfilesDataSource() {
        let results = [];
        // name | type | id/regnumber | operations
        for (let i = 0; i < this.profiles.length; i++) {
            let profile = this.profiles[i];
            results.push(profile.getProfileTableData(i));
        }
        console.log(results);
        return results;
    }
}

export default CaseProfile;