<template>
<div>
    <a-form
        id="investigation-reference"
        :form="form"
        style="height: 400px;"
    >
        <a-row>
            <a-form-item
                v-bind="formItemLayout"
                label="Open Date"
                >
                    <a-date-picker
                        placeholder="Open Date"

                        v-decorator="[
                            'dateOpen',
                            {
                                rules: [
                                {
                                    required: true, message: 'Date is required',
                                }],
                                initialValue: this.dateOpen
                            }
                        ]"
                    />
                </a-form-item>
        </a-row>
        <a-row>
            <a-col>
                <a-form-item
                    v-bind="formItemLayout"
                    label="Case Book/Page #"
                    >
                    <a-input
                        style="width:300px;"
                        v-decorator="[
                            'caseBookNo',
                            {
                                rules: [
                                {
                                    required: true, message: 'Please Enter Case Book & Page Number',
                                }],
                                initialValue: this.caseBookNo
                            }
                        ]"
                    />
                </a-form-item>
            </a-col>
        </a-row>
        <a-row>
            <a-col>
                <a-form-item
                    v-bind="formItemLayout"
                    label="Location"
                    has-feedback
                    >
                    <a-cascader
                        style="width:300px;"
                        :options="locationOptions"
                        @change="onLocationChange"
                        placeholder="Please select"
                        v-decorator="[
                        'location',
                            {
                                rules: [
                                    { required: true, message: 'Please select your location!' }
                                ],
                                initialValue: this.location
                            }
                        ]"
                    />
                </a-form-item>
                <a-form-item
                    v-bind="formItemLayout"
                    label="Station"
                    >
                    <a-input
                        style="width:300px;"
                        v-decorator="[
                            'station',
                            {
                                rules: [
                                {
                                    required: true, message: 'Enter Station Name',
                                }],
                                initialValue: this.station
                            }
                        ]"
                    />
                </a-form-item>

                <a-form-item
                    v-bind="formItemLayout"
                    label="Raid Leader"
                >
                    <a-auto-complete
                        style="width: 300px"
                        @search="handleOfficerSearch"
                        placeholder="Type Officer name"
                        :filterOption="filterOption"
                        v-decorator="[
                            'teamLead',
                            {
                                rules: [
                                {
                                    required: true, message: 'Enter Officer Name',
                                }],
                                initialValue: this.teamLead
                            }
                        ]"
                    >
                        <template slot="dataSource">
                        <a-select-option v-for="officer in officers" :value="officer.name" :key="officer.name">{{officer.name}}</a-select-option>
                        </template>
                    </a-auto-complete>
                </a-form-item>
            </a-col>
        </a-row>
    </a-form>
</div>
</template>
<script>
//import '../../../consts/locations.data.js';
import LocationGenerator from '../../../consts/locations.data.js';
import OfficersData from '../../../consts/officers.data.js';

export default {
    props: ['caseProfile'],
    data() {
        return {
            formItemLayout: {
                labelCol: { span: 6 },
                wrapperCol: { span: 14 },
            },
            dateOpen: this.caseProfile.dateOpen || this.$moment(),
            caseBookNo: this.caseProfile.caseBookNo || '',
            location: this.caseProfile.location || null,
            station: this.caseProfile.station || '',
            teamLead: this.caseProfile.teamLead || '',
            form: this.$form.createForm(this),
            locationOptions: [],
            officers: []
        }
    },
    beforeCreate() {

    },
    created() {
        let self = this;
        let locationData = new LocationGenerator();
        this.locationOptions = locationData.generate();

        let officerData = new OfficersData();
        officerData
            .getOfficers()
            .then (result=> {
                let officers = [];
                for (let i = 0; i < result.length; i++) {
                    let officer = result[i];
                    officers.push ({
                        name: officer.grade + ' ' + officer.full_name,
                        id: officer.id
                    });
                }
                self.officers = officers;
            })
            .catch(err => {
                console.log('error> ' + err);
            })

    },
    methods: {
        handleOfficerSearch (value) {

        },
        filterOption(input, option) {
            return option.componentOptions.children[0].text.toUpperCase().indexOf(input.toUpperCase()) >= 0
        },
        onLocationChange (val) {
            console.log(val);
        },
        onSubmit(e) {
            let pass = true;
            this.form.validateFields((err, values) => {
                if (err) {
                    pass = false;
                } else {
                    console.log(values);
                }
            });
            if (pass) {
                this.caseProfile.dateOpen = this.form.getFieldValue('dateOpen');
                this.caseProfile.caseBookNo = this.form.getFieldValue('caseBookNo');
                this.caseProfile.location = this.form.getFieldValue('location');
                this.caseProfile.station = this.form.getFieldValue('station');
                this.caseProfile.teamLead = this.form.getFieldValue('teamLead');
                return true;
            } else {
                return false;
            }
        }
    }
}
</script>