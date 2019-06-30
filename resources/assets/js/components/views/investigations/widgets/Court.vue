<template>
<div>
    <div>
    <a-form
            id="investigation-prosecutor"
            :form="form"
            style="height: 400px;"
            layout="vertical"
        >
            <a-row :gutter="40">
                <a-col>
                    <a-divider orientation="left" style="font-size: 12px;color:#8e8e8e;">Investigation Details</a-divider>
                    <p>State/Station: {{ this.locationDisplay }}</p>
                    <p>Case No/Page: {{ this.caseProfile.caseBookNo }}</p>
                    <p>
                        Investigation Date: {{ this.$moment(this.caseProfile.dateOpen).format('DD-MM-YYYY HH:mm') }}
                    </p>
                    <a-divider orientation="left" style="font-size: 12px;color:#8e8e8e;">Profiles</a-divider>
                    <a-table :columns="columns" :dataSource="this.getProfilesData"/>
                </a-col>
            </a-row>
            <a-row :gutter="40">
                <a-col :span="12">
                    <a-divider orientation="right" style="font-size: 12px;color:#8e8e8e;">Raiding Team</a-divider>

                    <p>Raid Team Leader: {{this.caseProfile.teamLead}}</p>


                </a-col>
                <a-col :span="12">
                    <a-divider orientation="right" style="font-size: 12px;color:#8e8e8e;">Crime Scene</a-divider>
                    <p>Place of Offence: {{ this.caseProfile.crimeDetails.location }}</p>
                    <p>Complainant Name: {{ this.caseProfile.crimeDetails.complainer.name }}</p>
                    <p>Report No: {{ this.caseProfile.crimeDetails.complainer.reportNo }}</p>
                    <p>Station: {{ this.caseProfile.crimeDetails.complainer.station }}</p>
                    <p>Date/Time: {{ this.$moment(this.caseProfile.crimeDetails.complainer.dateTime).format('DD-MM-YYYY HH:mm') }}</p>
                </a-col>
            </a-row>
        </a-form>
</div>
</div>
</template>
<script>
export default {
    props: ['caseProfile'],
    data() {
        return {
            formItemLayout: {
                labelCol: { span: 6 },
                wrapperCol: { span: 14 },
            },
            dateNow: this.$moment(),
            profiles: this.getProfilesData,
        }
    },
    beforeCreate() {
        this.form = this.$form.createForm (this);
    },
    methods: {

    },
    computed: {
        locationDisplay() {
            let display = this.caseProfile.location.join(', ') + '/' + this.caseProfile.station;
            return display;
        },
        columns() {
            const columns = [
                {
                    title: 'Accused Name',
                    dataIndex: 'accused',
                    key: 'accused'
                },
                {
                    title: 'Race',
                    dataIndex: 'race',
                    key: 'race'
                },
                {
                    title: 'Age',
                    dataIndex: 'age',
                    key: 'age'
                },
                {
                    title: 'Identity / Reg No',
                    dataIndex: 'ident',
                    key: 'ident'
                },
                {
                    title: 'Occupation',
                    dataIndex: 'occupation',
                    key: 'occupation'
                }
            ];

            return columns;
        },
        getProfilesData() {
            let profiles = this.caseProfile.profiles;
            let data = [];
            for (let i = 0; i < profiles.length; i++) {
                let newData = null;
                if (profiles[i].regNumber) {
                    newData = {
                        accused: profiles[i].name,
                        ident: profiles[i].regNumber
                    };
                } else {
                    newData = {
                        accused: profiles[i].name,
                        ident: profiles[i].identity,
                        race: profiles[i].race,
                        age: profiles[i].age,
                        occupation: profiles[i].occupation
                    };
                }

                data.push (newData);
            }
            return data;
        }
    },

    created() {
        //this.profiles = this.getProfilesData();
    },
    methods: {
        onSubmit(e) {
            console.log('sub');
            return true;
        },
        fillDefaults (caseProfile) {
            if (caseProfile != null) {
                console.log(caseProfile);
            }
        }
    }
}
</script>