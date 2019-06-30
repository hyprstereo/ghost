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
                label="Date &amp; Time"
                >
                    <a-date-picker 
                        placeholder="Open Date"
                        showTime
                        format="YYYY-MM-DD HH:mm:ss"
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
            <a-col>
                <a-form-item
                    v-bind="formItemLayout"
                    label="Place of Offence"
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
                <a-divider orientation="left" style="font-size: 12px;color:#8e8e8e;">Complainer</a-divider>
                <a-form-item
                    v-bind="formItemLayout"
                    label="Name"
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
                    label="Report No"
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
                    label="Station"
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
                label="Date &amp; Time"
                >
                    <a-date-picker 
                        placeholder="Open Date"
                        showTime
                        format="YYYY-MM-DD HH:mm:ss"
                        v-decorator="[
                            'cDateTime',
                            {
                                rules: [
                                {
                                    required: trfalseue, message: 'Date is required',
                                }],
                                initialValue: this.complainDateTime
                            }
                        ]"
                    />
                </a-form-item>
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
            dateTime: this.caseProfile.crimeDetails.dateTime || this.$moment(),
            placeOfOffence: this.caseProfile.crimeDetails.location || '',
            complainName: this.caseProfile.crimeDetails.complainer.name || '',
            complainDateTime: this.caseProfile.crimeDetails.complainer.dateTime || null,
            complainReportNo: this.caseProfile.crimeDetails.complainer.reportNo || '',
            complainStation: this.caseProfile.crimeDetails.complainer.station || ''
        }
    },
    beforeCreate() {
        this.form = this.$form.createForm (this);
    },
    methods: {
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