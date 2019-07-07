<template>
<div>
    <div>
    <a-form
        id="investigation-crime"
        :form="form"
        style="min-height: 400px;"
    >
        <a-row>
            <a-form-item
                v-bind="formItemLayout"
                label="Tarikh &amp; Masa"
                >
                    <a-date-picker
                        placeholder="Open Date"
                        showTime
                        format="YYYY-MM-DD HH:mm"
                        v-decorator="[
                            'dateOpen',
                            {
                                rules: [
                                {
                                    required: true, message: 'Date is required',
                                }],
                                initialValue: this.dateTime
                            }
                        ]"
                    />
                </a-form-item>
        </a-row>

        <a-row>
            <a-form-item
                v-bind="formItemLayout"
                label="Kesalahan"
                >
                    <a-input
                        style="width:300px;"
                        v-decorator="[
                            'offence',
                            {
                                rules: [
                                {
                                    required: true, message: 'Enter Offence',
                                }],
                                initialValue: this.caseProfile.offence
                            }
                        ]"
                    />
                </a-form-item>
        </a-row>

        <a-row>
            <a-form-item
                v-bind="formItemLayout"
                label="Komoditi"
                has-feedback
                >
                <a-auto-complete
                        style="width: 300px"
                        @search="handleCommSearch"
                        placeholder="Komoditi"
                        :filterOption="filterOption"
                        v-decorator="[
                            'commodity',
                            {
                                rules: [
                                {
                                    required: true, message: 'Enter Commodity Details',
                                }],
                                initialValue: this.caseProfile.commodity
                            }
                        ]"
                    >
                        <template slot="dataSource">
                        <a-select-option v-for="comm in commOptions" :value="comm.name" :key="comm.name">{{comm.name}}</a-select-option>
                        </template>
                    </a-auto-complete>
            </a-form-item>
        </a-row>

        <a-row>
            <a-form-item
                v-bind="formItemLayout"
                label="Perihal Kesalahan"
                >
                    <a-input
                        style="width:300px;"
                        v-decorator="[
                            'offence_details',
                            {
                                rules: [
                                {
                                    required: true, message: 'Enter Offence Details',
                                }],
                                initialValue: this.caseProfile.offence_details
                            }
                        ]"
                    />
                </a-form-item>
        </a-row>

        <a-row>
            <a-col>
                <a-form-item
                    v-bind="formItemLayout"
                    label="Tempat Kesalahan"
                    >
                    <a-input
                        style="width:300px;"
                        v-decorator="[
                            'location',
                            {
                                rules: [
                                {
                                    required: true, message: 'Enter Location',
                                }],
                                initialValue: this.placeOfOffence
                            }
                        ]"
                    />
                </a-form-item>
                <a-divider orientation="left" style="font-size: 12px;color:#8e8e8e;">Laporan Polis</a-divider>
                <a-form-item
                    v-bind="formItemLayout"
                    label="Nama"
                    >
                    <a-input
                        style="width:300px;"
                        v-decorator="[
                            'cName',
                            {
                                rules: [
                                {
                                    required: false, message: 'Enter A Name',
                                }],
                                initialValue: this.complainName
                            }
                        ]"
                    />
                </a-form-item>
                <a-form-item
                    v-bind="formItemLayout"
                    label="No Repot"
                    >
                    <a-input
                        style="width:300px;"
                        v-decorator="[
                            'cReportNo',
                            {
                                rules: [
                                {
                                    required: false, message: 'Report Number',
                                }],
                                initialValue: this.complainReportNo
                            }
                        ]"
                    />
                </a-form-item>

                <a-form-item
                    v-bind="formItemLayout"
                    label="Balai"
                    >
                    <a-input
                        style="width:300px;"
                        v-decorator="[
                            'cStation',
                            {
                                rules: [
                                {
                                    required: false, message: 'Enter Station Name',
                                }],
                                initialValue: this.complainStation
                            }
                        ]"
                    />
                </a-form-item>
                <a-form-item
                v-bind="formItemLayout"
                label="Tarikh &amp; Masa"
                >
                    <a-date-picker
                        placeholder="Open Date"
                        showTime
                        format="YYYY-MM-DD HH:mm"
                        v-decorator="[
                            'cDateTime',
                            {
                                rules: [
                                {
                                    required: false, message: 'Date is required',
                                }],
                                initialValue: this.complainDateTime
                            }
                        ]"
                    />
                </a-form-item>

                <a-form-item
                    v-bind="formItemLayout"
                    label="Attachments"
                >
                    <a-upload
                        @change="handleChange"
                        :remove="handleRemove"
                        action="/api/upload"
                        v-decorator="['upload', {
                            valuePropName: 'fileList',
                            getValueFromEvent: normFile,
                        }]"
                        >
                        <a-button>
                            <a-icon type="upload" /> Select File
                        </a-button>
                    </a-upload>
                </a-form-item>
            </a-col>
        </a-row>
    </a-form>
</div>
</div>
</template>
<script>

const _commodities = [
    { name: 'Minuman Keras'},
    { name:'Rokok'},
    { name:'Kenderaan'},
    { name:'Dadah'},
    { name:'Mercun'},
    { name:'AMLA'},
    { name:'ATIPSOM'},
    { name:'Pelbagai'}
];
export default {
    props: ['caseProfile'],
    data() {
        return {
            formItemLayout: {
                labelCol: { span: 6 },
                wrapperCol: { span: 14 },
            },
            dateTime: this.caseProfile.crimeDetails.dateTime || this.$moment(),
            placeOfOffence: this.caseProfile.crimeDetails.location || '',
            complainName: this.caseProfile.crimeDetails.complainer.name || '',
            complainDateTime: this.caseProfile.crimeDetails.complainer.dateTime || null,
            complainReportNo: this.caseProfile.crimeDetails.complainer.reportNo || '',
            complainStation: this.caseProfile.crimeDetails.complainer.station || '',
            fileList: this.caseProfile.files,
            commOptions: _commodities
        }
    },
    beforeCreate() {
        this.form = this.$form.createForm (this);
    },
    methods: {
        handleCommSearch (value) {

        },
        filterOption(input, option) {
            return option.componentOptions.children[0].text.toUpperCase().indexOf(input.toUpperCase()) >= 0
        },
        onCommodityChange(e) {
            console.log('comm ' + e);
        },
        normFile  (e) {
            console.log('Upload event:', e);
            this.fileList = e;
            if (Array.isArray(e)) {
                return e;
            }
            return e && e.fileList;
        },
        handleChange(info) {
            console.log('change');
            console.log(info);

        },
        handleRemove(file) {
            console.log(file);
            const index = this.fileList.indexOf(file);
            const newFileList = this.fileList.slice();
            let res = newFileList.splice(index, 1);
            console.log(file);
            this.fileList = newFileList;
        },
        beforeUpload(file) {
            this.fileList = [...this.fileList, file]
            return false;
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
                this.caseProfile.crimeDetails.dateTime = this.form.getFieldValue('dateOpen');
                this.caseProfile.crimeDetails.location = this.form.getFieldValue('location');

                this.caseProfile.crimeDetails.complainer.name = this.form.getFieldValue('cName');
                this.caseProfile.crimeDetails.complainer.reportNo = this.form.getFieldValue('cReportNo');
                this.caseProfile.crimeDetails.complainer.station = this.form.getFieldValue('cStation');
                this.caseProfile.crimeDetails.complainer.dateTime = this.form.getFieldValue('cDateTime');
                this.caseProfile.commodity = this.form.getFieldValue('commodity');
                this.caseProfile.offence = this.form.getFieldValue('offence');
                this.caseProfile.offence_details = this.form.getFieldValue('offence_details');
                //this.caseProfile.files = this.fileList;
                //console.log('next');
                //console.log(this.caseProfile.files);

                return true;
            } else {
                return false;
            }
        },
        fillDefaults (caseProfile) {
            if (caseProfile != null) {
            }
        }
    }
}
</script>