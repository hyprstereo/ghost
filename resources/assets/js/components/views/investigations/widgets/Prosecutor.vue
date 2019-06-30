<template>
<div>
    <a-form
            id="investigation-prosecutor"
            :form="form"
            style="height: 400px;"
            layout="vertical"
        >
            <a-row :gutter="40">
                <a-col :span="12">
                    <a-divider orientation="right" style="font-size: 12px;color:#8e8e8e;">Raiding Team</a-divider>
                    
                    <a-skeleton />
                    
                </a-col>
                <a-col :span="12">
                    <a-divider orientation="right" style="font-size: 12px;color:#8e8e8e;">Crime Scene</a-divider>

                    <a-skeleton />
                </a-col>
            </a-row>
        </a-form>
</div>
</template>
<script>
import AccusedProfile from '../../../../components/model/AccusedProfile.class';

export default {
    data() {
        return {
            formItemLayout: {
                labelCol: { span: 6 },
                wrapperCol: { span: 14 },
            },
            dateNow: this.$moment(),
        }
    },
    beforeCreate() {
        this.form = this.$form.createForm (this);
    },
    methods: {
        onSubmit(e) {
            return {};
        }
    }
}
</script>