<template>
<div>
    <div>
        <h3>
            <a-icon type="select" /> Open New Investigation
        </h3>
    </div>
    <a-divider/>
    <a-steps :current="currentStep" size="small">
        <a-step v-for="item in steps" :key="item.title" :title="item.title"/>
    </a-steps>
    <a-divider orientation="left" dashed>{{this.steps[this.currentStep].title.toUpperCase()}}</a-divider>    
    <div style="min-height: 450px;">
        <div v-if="currentStep==0">
            <Reference ref="reference" :caseProfile="this.caseProfile"/>
        </div>
        
        <div v-if="currentStep == 1">
                <Profile ref="profile" :caseProfile="this.caseProfile"/>
        </div>

        <div v-if="currentStep == 2">
            <Prosecutor ref="prosecutor"/>
        </div>

        <div v-if="currentStep == 3">
            <Crime ref="crime"/>
        </div>
        <div v-if="currentStep == 4">
            <Court ref="court"/>
        </div>
        <div v-if="currentStep == 5">

        </div>
        
    </div>
    <div style="text-align: center;">
        <a-button @click="prev()" v-if="currentStep > 0">Back</a-button>
        <a-button @click="prev()" disabled v-if="currentStep < 1">Back</a-button>
        <a-button @click="next()" type="primary">Next</a-button>
    </div>
</div>
</template>
<script>
import Reference from './widgets/Reference';
import Profile from './widgets/Profile';
import Prosecutor from './widgets/Prosecutor';
import Crime from './widgets/Crime';
import Court from './widgets/Court';

import CaseProfile from '../../../components/model/CaseProfile.class';

export default {
    components: {
        Reference,
        Profile,
        Prosecutor,
        Crime,
        Court
    },
    data() {
        return {
            formItemLayout: {
                labelCol: { span: 6 },
                wrapperCol: { span: 14 },
            },
            status: 'new',
            currentStep: 0,
            steps: [
                {title: 'Reference'}, 
                {title: 'Profile'}, 
                {title: 'Prosecutor'},
                {title: 'Crime'},
                {title: 'Court'},
                {title: 'Summary'}
            ],
            widgets: ['reference', 'profile', 'prosecutor', 'crime', 'court'],
            showProfileModal: false,
            caseProfile: new CaseProfile()
        }
    },
    beforeCreate() {
    },
    created() {
        
    },
    methods: {
        next() {
            let result = this.$refs[this.widgets[this.currentStep]].onSubmit();
            if (result) {
                if (this.currentStep < this.steps.length) {
                    this.currentStep++;
                }
            } else {
                this.$message.warning('Please correct the required fields.');
            }
        },
        prev() {
            if (this.currentStep > 0) {
                this.currentStep--;
            }
        },
        onProfileCancel() {
            this.showProfileModal = false;
        }
    }
}
</script>
<style>
.entryBox {
    width: 100%;
    display: block;
    padding: 10px;
}

.ant-advanced-search-form {
  padding: 24px;
  background: #fbfbfb;
  border: 1px solid #d9d9d9;
  border-radius: 6px;
}
</style>