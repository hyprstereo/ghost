
import axios from 'axios';

const OFFICERS_DATA = [
    {
        rank: 'PPK',
        grade: 'WK44',
        name: 'Emmanuel Lim Chen Chon',
    },
    {
        rank: 'PKPK',
        grade: 'WK48',
        name: 'Axel Rose'
    },
    {
        rank: 'PaK',
        grade: 'WK41',
        name: 'Johnny Stephens'
    }
];

class OfficersData {
    constructor() {
        this.officers = [];
    }

    getOfficers() {
        let self = this;
        return new Promise((resolve, reject) => {
            axios
                .get('/api/officers')
                .then(result => {
                    resolve(result.data);
                })
                .catch(err=> {
                    reject(err);
                })
        });
    }

    generate() {
        this.officers = [];
        /*for (let i = 0; i < OFFICERS_DATA.length; i++) {
            let officer = OFFICERS_DATA[i];
            let result = officer.rank + ' ' + officer.name;
            this.officers.push (result);
        }*/
        let self = this;
        this.getOfficers()
            .then(result => {
                let officers = [];
                for (let i = 0; i < result.length; i++) {
                    let officer = result[i];
                    officers.push ({
                        name: officer.grade + ' ' + officer.full_name,
                        id: officer.id
                    });
                }
                self.officers = officers;
                return officers;
            })
            .catch (err => {
                console.log('error> ' + err);
                return null;
            })
    }
}


export default OfficersData;

/*
this.id = 0;
        this.rank = '';
        this.name = '';
        this.officerId = '';
        this.identityCard = '';
*/