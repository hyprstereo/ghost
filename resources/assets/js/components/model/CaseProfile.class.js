import AccusedProfile from './AccusedProfile.class';

const moment = require('moment');
class CaseProfile {
    constructor() {
        this.id = 0;
        this.dateOpen = null;
        this.dateClose = null;

        this.caseBookNo = null;
        this.reference = null;

        this.location = null;
        this.station = null;
        this.commodity = null;
        this.offence = null;
        this.offence_details = null;
        this.offence_location = null;

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

        this.files = [];

        //officers
        this.teamLead = null;
        this.investigators = [];
        this.prosecutors = [];
    }

    parseData (data) {
        console.log('parsing');
        console.log(data);
        this.id = data.id;
        this.files = data.attachments;
        this.caseBookNo = data.case_no;
        this.status = data.status;
        this.dateOpen = moment(data.date);
        this.reference = data.reference;
        this.location = data.location;
        this.station = data.station.split('/');


        this.crimeDetails.dateTime = moment(data.complainer_date_time);
        this.crimeDetails.station = data.police_station;
        this.crimeDetails.name = data.complainer_name;
        this.crimeDetails.reportNo = data.complainer_report_no;
        this.teamLead = data.raid_leader_id;
        this.offence = data.offence;
        this.offence_details = data.offence_details;
        this.offence_location = data.complainer_place_of_offence;
        this.commodity = data.commodity;
        this.profiles = [];

        for (let i = 0; i < data.profiles.length; i++) {
            let p = data.profiles[i];
            let newProfile = new AccusedProfile();
            newProfile.parseData(p);
            this.profiles.push(newProfile);
        }
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