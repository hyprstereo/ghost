<template>
<div>
    <a-modal
        :visible="showModal"
        title='Add New Profile'
        okText='Add'
        @cancel="onCancel"
        @ok="onAddProfile"
        width="80%"
    >

        <a-form
            id="investigation-entry"
            :form="form"
            style="height: 500px;width: 90%;"
        >
            <a-row>
                <a-form-item
                    v-bind="formItemLayout"
                    label="Profile Type"
                >
                    <a-radio-group
                        v-decorator="[
                            'profileType', {
                                initialValue: 'private'
                            }
                        ]"
                        @change="handleProfileType"
                    >
                        <a-radio value="private">
                        Private
                        </a-radio>
                        <a-radio value="company">
                        Company
                        </a-radio>
                    </a-radio-group>
                </a-form-item>

                <div v-if="isPrivate()">

                    <a-form-item
                        label="Identity Card / Passport"
                        :label-col="{ span: 8 }"
                        :wrapper-col="{ span: 12 }"
                    >
                        <a-input
                            :min="18"
                            :max="100"
                            style="width: 300px"
                            v-decorator="[
                            'identity',
                            {
                                rules: [{ required: isPrivate(), message: 'Please enter age!' }],
                                initialValue: currentProfile.identity
                            }
                            ]"
                        />
                    </a-form-item>

                    <a-form-item
                        label="Name"
                        :label-col="{ span: 8 }"
                        :wrapper-col="{ span: 12 }"
                    >
                        <a-input
                            v-decorator="[
                            'name',
                            {
                                rules: [{ required: isPrivate(), message: 'Please enter the accused name' }],
                                initialValue: currentProfile.name
                            }
                            ]"
                        />
                    </a-form-item>

                    <a-form-item
                        label="Race"
                        :label-col="{ span: 8 }"
                        :wrapper-col="{ span: 12 }"
                    >
                        <a-input
                            style="width: 300px"
                            v-decorator="[
                            'race',
                            {
                                rules: [{ required: isPrivate(), message: 'Please enter race' }],
                                initialValue: currentProfile.race
                            }
                            ]"
                        />
                    </a-form-item>

                    <a-form-item
                        label="Gender"
                        :label-col="{ span: 8 }"
                        :wrapper-col="{ span: 12 }"
                        >
                        <a-select
                            style="width: 150px"
                            v-decorator="[
                            'gender',
                            {
                                rules: [{ required: isPrivate(), message: 'Please select your gender!' }],
                                initialValue: currentProfile.gender
                            }
                            ]"
                            placeholder="Select Gender"
                        >
                            <a-select-option value="Male">
                            Male
                            </a-select-option>
                            <a-select-option value="Female">
                            Female
                            </a-select-option>
                        </a-select>
                    </a-form-item>

                    <a-form-item
                        label="Age"
                        :label-col="{ span: 8 }"
                        :wrapper-col="{ span: 12 }"
                    >
                        <a-input-number
                            :min="18"
                            :max="100"
                            style="width: 80px"
                            v-decorator="[
                            'age',
                            {
                                rules: [{ required: true, message: 'Please enter age!' }],
                                initialValue: currentProfile.age
                            }
                            ]"
                        />
                    </a-form-item>

                    <a-form-item
                        label="Job Description"
                        :label-col="{ span: 8 }"
                        :wrapper-col="{ span: 12 }"
                    >
                        <a-input
                            style="width: 300px"
                            v-decorator="[
                            'occupation',
                            {
                                rules: [{ required: false, message: 'Please enter race' }],
                                initialValue: currentProfile.occupation
                            }
                            ]"
                        />
                    </a-form-item>
                </div>
                <div v-if="isCompany()">
                    <a-form-item
                        label="Company Name"
                        :label-col="{ span: 8 }"
                        :wrapper-col="{ span: 12 }"
                    >
                        <a-input
                            v-decorator="[
                            'companyName',
                            {
                                rules: [{ required: isCompany(), message: 'Please enter the company name' }],
                                initialValue: currentProfile.name
                            }
                            ]"
                        />
                    </a-form-item>

                    <a-form-item
                        label="Company Reg No"
                        :label-col="{ span: 8 }"
                        :wrapper-col="{ span: 12 }"
                    >
                        <a-input
                            v-decorator="[
                            'companyReg',
                            {
                                rules: [{ required: isCompany(), message: 'Please enter the company name' }],
                                initialValue: currentProfile.regNumber
                            }
                            ]"
                        />
                    </a-form-item>
                </div>
            </a-row>

        </a-form>

    </a-modal>
    <div>
        <a-table bordered :dataSource="dataSource" :columns="columns">
            <template slot="operation" slot-scope="text, record">
                <a-popconfirm
                v-if="dataSource.length"
                title="Edit selected?"
                @confirm="() => onEdit(record.key)">
                <a href="javascript:;">Edit</a>
                </a-popconfirm>
                <a-divider type="vertical"/>
                <a-popconfirm
                v-if="dataSource.length"
                title="Sure to delete?"
                @confirm="() => onDelete(record.key)">
                <a href="javascript:;">Delete</a>
                </a-popconfirm>
            </template>
        </a-table>
    </div>
    <div>
        <div class="addProfileBtn">
            <a-button
                type="dashed"
                style="width: 80%"
                @click="onAddNewProfile"
            >
                <a-icon type="plus" /> Add Profile
            </a-button>
        </div>
    </div>
</div>
</template>
<script>
import AccusedProfile from '../../../../components/model/AccusedProfile.class';

export default {
    props: ['caseProfile'],
    data() {
        return {
            formItemLayout: {
                labelCol: { span: 8 },
                wrapperCol: { span: 14 },
            },
            form: this.$form.createForm(this),
            showModal: false,
            profileType: 'private', // private or company
            dataSource: null,
            count: 0,
            currentProfile: new AccusedProfile(),
            editIndex: -1,
            columns: [
                {
                    title: 'Name',
                    dataIndex: 'name',
                    width: '25%'
                },
                {
                    title: 'Type',
                    dataIndex: 'type',
                    width: '25%'
                },
                {
                    title: 'Identity / Reg No',
                    dataIndex: 'identity',
                    width: '25%'
                },
                {
                    title: 'Operation',
                    dataIndex: 'operation',
                    width: '25%',
                    scopedSlots: { customRender: 'operation'}
                }
            ]
        }
    },
    created() {
        this.refreshData();
    },
    methods: {
        onDelete(key) {
            this.caseProfile.profiles.splice(key, 1);
            this.refreshData();
        },
        onEdit(key) {
            this.currentProfile = this.caseProfile.profiles[key];
            this.editIndex = key;
            this.form.setFields({
                profileType: {
                    value: this.currentProfile.type
                }
            });
            this.profileType = this.currentProfile.type;

            this.showModal = true;
        },
        isPrivate() {
            return (this.profileType == 'private');
        },
        isCompany() {
            return (this.profileType == 'company');
        },
        onAddProfile (e) {

            let pass = true;
            this.form.validateFields((err, values) => {
                if (err) {
                    pass = false;
                } else {
                    console.log(values);
                }
            });
            if (pass) {
                let newProfile = new AccusedProfile();

                newProfile.type = this.form.getFieldValue('profileType');

                if (newProfile.type == 'private') {
                    newProfile.name = this.form.getFieldValue('name');
                    newProfile.identity = this.form.getFieldValue('identity');
                    newProfile.race = this.form.getFieldValue('race');
                    newProfile.age = this.form.getFieldValue('age');
                    newProfile.gender = this.form.getFieldValue('gender');
                    newProfile.occupation = this.form.getFieldValue('occupation');
                } else {
                    newProfile.name = this.form.getFieldValue('companyName');
                    newProfile.regNumber = this.form.getFieldValue('companyReg');
                }
                if (this.editIndex > -1) {
                    this.caseProfile.profiles[this.editIndex] = newProfile;
                } else {
                    this.caseProfile.profiles.push(newProfile);
                }

                this.$message.success('Profile Added');
                this.refreshData();

                this.onCancel();

                return true;
            } else {
                this.$message.error('Please fill required fields');
                return false;
            }
        },
        resetForm() {
            this.form.resetFields([
                'profileType',
                'name', 'identity', 'race', 'age', 'gender', 'occupation',
                'companyName', 'companyReg'
            ])
        },
        refreshData() {
            let source = this.caseProfile.getProfilesDataSource();
            if (source) {
                this.dataSource = source;
                this.count = source.length;
            }
        },

        onSubmit(e) {
            if (this.caseProfile.profiles.length > 0) {
                return true;
            } else {
                return false;
            }
        },
        handleProfileType (e) {
            this.profileType = e.target.value;

            if (this.profileType == 'company') {
                this.form.getFieldDecorator('name', {required: false});
                this.form.getFieldDecorator('identity', {required: false});
            }
        },
        onAddNewProfile() {
            this.currentProfile = new AccusedProfile();
            this.onShowModal();
        },
        onShowModal() {
            this.showModal = true;
        },
        onCancel() {
            this.resetForm();
            this.editIndex = -1;
            this.showModal = false;
            this.currentProfile = new AccusedProfile();
        }
    }
}
</script>
<style>
.addProfileBtn {
    margin-top: 30px;
    text-align: center;
}
</style>